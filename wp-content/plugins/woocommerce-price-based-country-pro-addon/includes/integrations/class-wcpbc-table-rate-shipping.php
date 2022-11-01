<?php
/**
 * Handle integration with WooCommerce Table Rate Shipping by WooCommerce.
 *
 * @since 2.19.0
 * @see https://woocommerce.com/products/table-rate-shipping/
 * @package WCPBC/Integrations
 */

defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'WCPBC_Table_Rate_Shipping' ) ) :

	/**
	 * WCPBC_Checkout_Add_Ons Class
	 */
	class WCPBC_Table_Rate_Shipping {

		/**
		 * Check enviroment notice.
		 *
		 * @var string
		 */
		private static $notice = '';

		/**
		 * Init hooks
		 */
		public static function init() {
			add_action( 'wc_price_based_country_frontend_princing_init', array( __CLASS__, 'frontend_princing_init' ) );
		}

		/**
		 * Init pricing hooks
		 */
		public static function frontend_princing_init() {
			add_filter( 'woocommerce_table_rate_query_rates_args', array( __CLASS__, 'query_rates_args' ) );
			add_filter( 'woocommerce_shipping_zone_shipping_methods', array( __CLASS__, 'shipping_zone_shipping_methods' ), 10 );
		}

		/**
		 * Convert the price to base currency to the plugin find rates.
		 *
		 * @param array $args Query rates args.
		 * @return array
		 */
		public static function query_rates_args( $args ) {
			if ( ! empty( $args['price'] ) && wcpbc_the_zone()->get_currency() !== wcpbc_get_base_currency() ) {
				$args['price'] = wcpbc_the_zone()->get_base_currency_amount( $args['price'] );
			}
			return $args;
		}

		/**
		 * Apply exchange rate to shipping properties.
		 *
		 * @param array $methods Array of shipping methods.
		 * @return array
		 */
		public static function shipping_zone_shipping_methods( $methods ) {
			foreach ( $methods as $instance_id => $method ) {
				if ( isset( $method->id ) && 'table_rate' === $method->id && is_a( $method, 'WC_Shipping_Table_Rate' ) ) {
					foreach ( array( 'order_handling_fee', 'max_shipping_cost', 'fee', 'min_cost', 'max_cost' ) as $prop ) {
						if ( isset( $method->{$prop} ) && is_numeric( $method->{$prop} ) ) {
							$method->{$prop} = wcpbc_the_zone()->get_exchange_rate_price( floatval( $method->{$prop} ), true, 'wc_shipping_table_rate', $method );
						}
					}
				}
			}
			return $methods;
		}

		/**
		 * Checks the environment for compatibility problems.
		 *
		 * @return boolean
		 */
		public static function check_environment() {
			$plugin_version = defined( 'TABLE_RATE_SHIPPING_VERSION' ) ? TABLE_RATE_SHIPPING_VERSION : 'unknown';

			if ( 'unknown' === $plugin_version || version_compare( $plugin_version, '3.0.0', '<' ) ) {
				// translators: 1: HTML tag, 2: HTML tag, 3: Germanized for WooCommerce version.
				self::$notice = sprintf( __( '%1$sPrice Based on Country Pro & WooCommerce Table Rate Shipping%2$s compatibility requires WooCommerce Table Rate Shipping +3.0.0. You are running version %3$s.', 'wc-price-based-country-pro' ), '<strong>', '</strong>', $plugin_version );
				add_action( 'admin_notices', array( __CLASS__, 'min_version_notice' ) );
				return false;
			}

			return true;
		}

		/**
		 * Display admin minimun version required
		 */
		public static function min_version_notice() {
			echo '<div id="message" class="error"><p>' . wp_kses_post( self::$notice ) . '</p></div>';
		}
	}

	if ( WCPBC_Table_Rate_Shipping::check_environment() ) {
		WCPBC_Table_Rate_Shipping::init();
	}

endif;
