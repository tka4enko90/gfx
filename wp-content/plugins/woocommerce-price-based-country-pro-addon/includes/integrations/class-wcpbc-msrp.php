<?php
/**
 * Handle integration with WooCommerce MSRP Pricing by Ademti Software Ltd.
 *
 * @see https://woocommerce.com/products/msrp-pricing/
 * @since 2.11.0
 * @package WCPBC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WCPBC_MSRP' ) ) :

	/**
	 *
	 * WCPBC_MSRP Class
	 */
	class WCPBC_MSRP {

		/**
		 * Hook actions and filters.
		 */
		public static function init() {
			add_action( 'wc_price_based_country_frontend_princing_init', array( __CLASS__, 'frontend_princing_init' ) );
			add_filter( 'wc_price_based_country_price_meta_keys', array( __CLASS__, 'price_meta_keys' ) );
			add_filter( 'wc_price_based_country_ajax_geolocation_product_data', array( __CLASS__, 'ajax_geolocation_product_data' ), 10, 2 );
			if ( is_admin() ) {
				add_filter( 'wc_price_based_country_product_simple_fields', array( __CLASS__, 'product_simple_fields' ), 20 );
				add_filter( 'wc_price_based_country_product_variation_fields', array( __CLASS__, 'product_variation_fields' ), 10, 2 );
				add_action( 'woocommerce_process_product_meta_simple', array( __CLASS__, 'process_product_meta' ), 30 );
				add_action( 'woocommerce_save_product_variation', array( __CLASS__, 'process_product_meta' ), 30, 2 );
			}
		}

		/**
		 * Frontend init hooks.
		 */
		public static function frontend_princing_init() {
			add_filter( 'woocommerce_product_get__msrp_price', array( __CLASS__, 'get_msrp_price' ), 5, 2 );
			add_filter( 'woocommerce_product_variation_get__msrp', array( __CLASS__, 'get_msrp_price' ), 5, 2 );
		}

		/**
		 * Add the _mrp to the price meta key filter.
		 *
		 * @param array $metakeys Array of meta keys.
		 * @return array
		 * @see WCPBC_Integrations_Pro::get_post_metadata
		 */
		public static function price_meta_keys( $metakeys ) {
			$metakeys[] = '_msrp';
			return $metakeys;
		}

		/**
		 * Return the MSRP price.
		 *
		 * @param mixed      $value Property value.
		 * @param WC_Product $product Product instance.
		 * @return mixed
		 */
		public static function get_msrp_price( $value, $product ) {
			$meta_key = '_msrp' . ( 'woocommerce_product_get__msrp_price' === current_filter() ? '_price' : '' );
			return wcpbc_the_zone()->get_price_prop( $product, $value, $meta_key );

		}

		/**
		 * Add the minimum price field to the product simple.
		 *
		 * @param array $fields Product simple fields.
		 * @return array
		 */
		public static function product_simple_fields( $fields ) {

			$fields[] = array(
				'name'  => '_msrp_price',
				// translators: %s is a currency symbol.
				'label' => __( 'MSRP Price (%s)', 'wc-price-based-country-pro' ),
			);

			return $fields;
		}

		/**
		 * Add the minimum price field to product variation.
		 *
		 * @param array $fields Product simple fields.
		 * @param int   $loop Index of loop variation.
		 * @return array
		 */
		public static function product_variation_fields( $fields, $loop ) {
			$fields['_msrp'] = array(
				'name'          => "_variable_msrp[$loop]",
				// translators: %s is a currency symbol.
				'label'         => __( 'MSRP Price (%s)', 'wc-price-based-country-pro' ),
				'wrapper_class' => 'form-row form-row-full',
			);
			return $fields;
		}

		/**
		 * Save the minimum price price.
		 *
		 * @param int $post_id WP post id.
		 * @param int $index   Index of variations to save.
		 */
		public static function process_product_meta( $post_id, $index = false ) {
			$variable = false === $index ? '' : '_variable';
			$meta_key = false === $index ? '_msrp_price' : '_msrp';

			foreach ( WCPBC_Pricing_Zones::get_zones() as $zone ) {

				$price_method = $zone->get_input_var( $variable . '_price_method', $index );

				if ( wcpbc_is_exchange_rate( $price_method ) ) {
					$_msrp_price = $zone->get_exchange_rate_price_by_post( $post_id, $meta_key );
				} else {
					$_msrp_price = wc_format_decimal( $zone->get_input_var( $variable . $meta_key, $index ) );
				}
				$zone->set_postmeta( $post_id, $meta_key, $_msrp_price );
			}
		}

		/**
		 * Add extra data to the AJAX geolocate array.
		 *
		 * @param array      $data Data to geolocate price.
		 * @param WC_Product $product Product object.
		 * @return array
		 */
		public static function ajax_geolocation_product_data( $data, $product ) {
			global $woocommerce_msrp_frontend;
			if ( is_callable( array( $woocommerce_msrp_frontend, 'show_msrp' ) ) ) {
				ob_start();
				$woocommerce_msrp_frontend->show_msrp( $product );
				$msrp_html = ob_get_clean();

				if ( $msrp_html ) {
					$data['msrp_html'] = $msrp_html;
				}
			}

			if ( $product->is_type( 'variation' ) && is_callable( array( $woocommerce_msrp_frontend, 'add_msrp_to_js' ) ) ) {
				$data['mrsp_variation'] = $woocommerce_msrp_frontend->add_msrp_to_js( array(), null, $product );
			}
			return $data;
		}

		/**
		 * Checks the environment for compatibility problems.
		 *
		 * @return boolean
		 */
		public static function check_environment() {
			$version = defined( 'WOOCOMMERCE_MSRP_VERSION' ) ? WOOCOMMERCE_MSRP_VERSION : false;
			if ( ! $version || version_compare( $version, '3.4.0', '<' ) ) {
				add_action( 'admin_notices', array( __CLASS__, 'min_version_notice' ) );
				return false;
			}
			return true;
		}

		/**
		 * Display admin minimun version required
		 */
		public static function min_version_notice() {
			// Translators: 1, 2: HTML tags.
			$notice = sprintf( __( '%1$sPrice Based on Country Pro & WooCommerce MSRP Pricing%2$s compatibility requires WooCommerce MSRP Pricing +3.4.0.', 'wc-price-based-country-pro' ), '<strong>', '</strong>' );
			echo '<div id="message" class="error"><p>' . wp_kses_post( $notice ) . '</p></div>';
		}
	}

	if ( WCPBC_MSRP::check_environment() ) {
		// Init integration.
		WCPBC_MSRP::init();
	}

endif;
