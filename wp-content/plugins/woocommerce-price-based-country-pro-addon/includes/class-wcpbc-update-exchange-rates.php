<?php
/**
 *
 * Handle exchange rates updates from API providers
 *
 * @package WCPBC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'WCPBC_Update_Exchange_Rates' ) ) :

	/**
	 * WCPBC_Update_Exchange_Rates Class.
	 */
	class WCPBC_Update_Exchange_Rates {

		/**
		 * Logger instance
		 *
		 * @var WC_Logger
		 */
		private static $log = false;


		/**
		 * Exchange provides.
		 *
		 * @var array
		 */
		private static $exchange_rates_providers = array();

		/**
		 * Init plugin, Hook actions and filters
		 */
		public static function init() {
			add_action( 'woocommerce_scheduled_sales', array( __CLASS__, 'update_exchange_rates' ), 5 );
			add_action( 'update_option_woocommerce_currency', array( __CLASS__, 'update_exchange_rates' ) );
		}

		/**
		 * Logging method.
		 *
		 * @param string $message Log message.
		 * @param string $level   Optional. emergency|alert|critical|error|warning|notice|info|debug. Default 'info'.
		 */
		public static function log( $message, $level = 'error' ) {
			if ( empty( self::$log ) ) {
				self::$log = wc_get_logger();
			}
			self::$log->log( $level, $message, array( 'source' => 'wc_price_based_country' ) );
		}

		/**
		 * Get exchange rates providers.
		 *
		 * @return array
		 */
		public static function get_exchange_rates_providers() {

			if ( empty( self::$exchange_rates_providers ) ) {

				$exchange_rates_providers = array();

				$exchange_rates_providers['floatrates']        = include dirname( __FILE__ ) . '/exchage-rates-providers/class-wcpbc-floatrates.php';
				$exchange_rates_providers['openexchangerates'] = include dirname( __FILE__ ) . '/exchage-rates-providers/class-wcpbc-open-exchange-rates.php';
				$exchange_rates_providers['xrates']            = include dirname( __FILE__ ) . '/exchage-rates-providers/class-wcpbc-xrates.php';

				self::$exchange_rates_providers = apply_filters( 'wc_price_based_country_exchange_providers', $exchange_rates_providers );
			}

			return self::$exchange_rates_providers;
		}

		/**
		 * Update exchange rates
		 *
		 * @return void
		 */
		public static function update_exchange_rates() {
			$zones       = WCPBC_Pricing_Zones::get_zones();
			$to_currency = array();

			foreach ( $zones as $zone ) {
				$to_currency[] = $zone->get_currency();
			}

			// Log the info.
			self::log( 'Begin update exchange rates.', 'info' );

			$rates = self::get_exchange_rate_from_api( array_unique( $to_currency ) );

			if ( $rates ) {

				// Log the info.
				self::log( 'Get rates from API: ' . wp_json_encode( $rates ), 'info' );

				$base_currency = wcpbc_get_base_currency();

				foreach ( $zones as $zone ) {

					$rate = empty( $rates[ $zone->get_currency() ] ) ? false : floatval( $rates[ $zone->get_currency() ] );
					$data = self::calculate_exchange_rate( $rate, $zone->get_exchange_rate_fee(), $zone->get_currency() );

					if ( ! $data['error'] ) {
						$zone->set_real_exchange_rate( $data['real_exchange_rate'] );

						if ( $zone->get_auto_exchange_rate() ) {
							$zone->set_exchange_rate( $data['exchange_rate'] );
						}
					} else {
						// Log the error.
						self::log( $data['error'] );
					}
				}

				WCPBC_Pricing_Zones::bulk_save( $zones );
			}
		}

		/**
		 * Return a exchange rate
		 *
		 * @param array|string $to_currency Currency code.
		 * @param string       $from_currency Currency code.
		 * @return array|float
		 */
		public static function get_exchange_rate_from_api( $to_currency, $from_currency = '' ) {

			$rates         = false;
			$single        = is_array( $to_currency ) ? false : true;
			$to_currency   = $single ? array( $to_currency ) : $to_currency;
			$from_currency = $from_currency ? $from_currency : get_option( 'woocommerce_currency' );

			$api_providers     = self::get_exchange_rates_providers();
			$exchange_rate_api = get_option( 'wc_price_based_country_exchange_rate_api', 'floatrates' );

			if ( $exchange_rate_api && isset( $api_providers[ $exchange_rate_api ] ) ) {

				$rates        = array();
				$_to_currency = array();

				foreach ( $to_currency as $currency ) {
					if ( $currency === $from_currency ) {
						$rates[ $currency ] = 1;
					} else {
						$_to_currency[] = $currency;
					}
				}

				if ( ! empty( $_to_currency ) ) {
					$rates = array_map( 'floatval', array_merge( $rates, $api_providers[ $exchange_rate_api ]->get_exchange_rates( $from_currency, $_to_currency ) ) );
				}

				if ( $single ) {
					$rates = current( $rates );
				}
			}

			return $rates;
		}

		/**
		 * Returns an array with the exchange rate data.
		 *
		 * @since 2.9.0
		 * @param float  $rate Exchange rate.
		 * @param float  $fee Exchange rate fee.
		 * @param string $currency Currency.
		 * @return array
		 */
		public static function calculate_exchange_rate( $rate, $fee, $currency ) {
			$exchange_rate      = false;
			$real_exchange_rate = false;
			$error              = false;

			if ( ! $rate ) {
				// translators: Currency.
				$error = sprintf( __( 'Error updating the exchange rate from API. The API did not return value for %s.', 'wc-price-based-country-pro' ), $currency );
			}

			if ( ! $error ) {

				$real_exchange_rate = wcpbc_get_base_currency() === $currency ? 1 : $rate;

				if ( 1 == $real_exchange_rate && wcpbc_get_base_currency() !== $currency ) { // phpcs:ignore WordPress.PHP.StrictComparisons.LooseComparison
					// translators: Currency.
					$error = sprintf( __( 'Error updating the exchange rate. The API returned 1 as the exchange rate for %s.', 'wc-price-based-country-pro' ), $currency );
				}
			}

			if ( ! $error ) {
				$exchange_rate = $real_exchange_rate * ( 1 + ( $fee / 100 ) );

				/**
				 * Allow third-party to calculate the exchange rate using a custom function.
				 */
				$exchange_rate = apply_filters( 'wc_price_based_country_calculate_exchange_rate', $exchange_rate, $real_exchange_rate, $fee, $currency );
			}

			return array(
				'exchange_rate'      => $exchange_rate,
				'real_exchange_rate' => $real_exchange_rate,
				'error'              => $error,
			);
		}

		/**
		 * Fixes wrong "exchange rate" of orders. Callback of an admin tool.
		 *
		 * @since 2.16.0
		 * @see WCPBC_Admin_Pro::debug_tools
		 */
		public static function fix_order_exchange_rate() {
			global $wpdb;

			$rows = $wpdb->get_results(
				$wpdb->prepare(
					"SELECT posts.ID, _order_currency.meta_value AS order_currency
					FROM {$wpdb->posts} AS posts
						INNER JOIN {$wpdb->postmeta} AS _order_currency ON _order_currency.post_id = posts.ID AND _order_currency.meta_key = '_order_currency'
						LEFT JOIN {$wpdb->postmeta} AS _base_exchange_rate ON _base_exchange_rate.post_id = posts.ID AND _base_exchange_rate.meta_key = '_wcpbc_base_exchange_rate'
					WHERE posts.post_type IN ( 'shop_order', 'shop_order_refund' )
						AND ( trim(coalesce( _base_exchange_rate.meta_value, '')) = '' OR _base_exchange_rate.meta_value = '1' )
						AND _order_currency.meta_value <> %s",
					wcpbc_get_base_currency()
				)
			);

			if ( count( $rows ) ) {
				$rates = self::get_exchange_rate_from_api(
					array_unique(
						array_keys(
							get_woocommerce_currencies()
						)
					)
				);

				foreach ( $rows as $row ) {
					if ( ! empty( $rates[ $row->order_currency ] ) ) {
						$base_exchange_rate = 1 / $rates[ $row->order_currency ];
						update_post_meta( $row->ID, '_wcpbc_base_exchange_rate', $base_exchange_rate );
					}
				}

				if ( is_callable( array( 'Automattic\WooCommerce\Admin\API\Reports\Cache', 'invalidate' ) ) ) {
					// Clear Analitycs cache after update.
					Automattic\WooCommerce\Admin\API\Reports\Cache::invalidate();
				}
			}

			return __( 'Orders exchange rate regenerated, and the Analytics cache have been cleared.', 'wc-price-based-country-pro' );
		}
	}
endif;
