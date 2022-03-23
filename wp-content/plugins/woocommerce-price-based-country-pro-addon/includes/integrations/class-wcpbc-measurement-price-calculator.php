<?php
/**
 * Handle integration with WooCommerce Measurement Price Calculator by SkyVerge.
 *
 * @see https://woocommerce.com/products/measurement-price-calculator/
 * @since 2.10.0
 * @package WCPBC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'WCPBC_Measurement_Price_Calculator' ) ) :

	/**
	 *
	 * WCPBC_Measurement_Price_Calculator Class
	 */
	class WCPBC_Measurement_Price_Calculator {

		/**
		 * Hook actions and filters.
		 */
		public static function init() {
			add_action( 'wc_price_based_country_frontend_princing_init', array( __CLASS__, 'frontend_princing_init' ) );
			add_filter( 'woocommerce_get_cart_item_from_session', array( __CLASS__, 'get_cart_item_from_session' ), 0, 2 );
			add_filter( 'wc_price_based_country_product_simple_fields', array( __CLASS__, 'product_simple_fields' ), 20 );
			add_filter( 'wc_price_based_country_product_variation_fields', array( __CLASS__, 'product_variation_fields' ), 10, 2 );
			add_action( 'woocommerce_process_product_meta_simple', array( __CLASS__, 'process_product_meta' ), 30 );
			add_action( 'woocommerce_save_product_variation', array( __CLASS__, 'process_product_meta' ), 30, 2 );
			add_filter( 'wc_price_based_country_ajax_geolocation_product_data', array( __CLASS__, 'ajax_geolocation_product_data' ), 10, 2 );
			add_filter( 'wc_measurement_price_calculator_get_price_html', array( __CLASS__, 'price_calculator_get_price_html' ), 10, 2 );
		}

		/**
		 * Frontend init hooks.
		 */
		public static function frontend_princing_init() {
			add_filter( 'woocommerce_add_cart_item', array( __CLASS__, 'add_cart_item' ), 0, 1 );
			add_filter( 'woocommerce_product_get__wc_measurement_price_calculator_min_price', array( __CLASS__, 'get_measurement_price_calculator_min_price' ), 5, 2 );
			add_filter( 'woocommerce_product_variation_get__wc_measurement_price_calculator_min_price', array( __CLASS__, 'get_measurement_price_calculator_min_price' ), 5, 2 );
			add_filter( 'woocommerce_product_get__wc_price_calculator_pricing_rules', array( __CLASS__, 'get_price_calculator_pricing_rules' ), 5, 2 );
			add_filter( 'woocommerce_get_price_html', array( __CLASS__, 'get_price_html' ), 9, 2 );
		}

		/**
		 * Recalculate the measurement price.
		 *
		 * @param array $cart_item Associative array of data representing a cart item (product).
		 * @return array
		 */
		public static function add_cart_item( $cart_item ) {
			if ( isset( $cart_item['data'], $cart_item['pricing_item_meta_data']['_measurement_needed'], $cart_item['pricing_item_meta_data']['_measurement_needed_unit'] ) ) {
				$measurement_needed      = $cart_item['pricing_item_meta_data']['_measurement_needed'];
				$measurement_needed_unit = $cart_item['pricing_item_meta_data']['_measurement_needed_unit'];
				$_product                = $cart_item['data'];

				// Recalculate the measurement price.
				$cart_item['pricing_item_meta_data']['_price'] = \WC_Price_Calculator_Product::calculate_price( $_product, $measurement_needed, $measurement_needed_unit );
			}
			return $cart_item;
		}

		/**
		 * Recalculate the price if the zone has changed.
		 *
		 * @param array $cart_item Associative array of data representing a cart item (product).
		 * @param array $values Associative array of data for the cart item, currently in the session.
		 * @return array
		 */
		public static function get_cart_item_from_session( $cart_item, $values ) {
			$zone_id      = wcpbc_the_zone() ? wcpbc_the_zone()->get_id() : false;
			$prev_zone_id = empty( $values['wcpbc_zone_id'] ) ? false : $values['wcpbc_zone_id'];

			if ( $zone_id !== $prev_zone_id && isset( $values['pricing_item_meta_data']['_measurement_needed'], $values['pricing_item_meta_data']['_measurement_needed_unit'] ) ) {

				$cart_item['wcpbc_zone_id']          = $zone_id;
				$cart_item['pricing_item_meta_data'] = $values['pricing_item_meta_data'];

				$measurement_needed      = $cart_item['pricing_item_meta_data']['_measurement_needed'];
				$measurement_needed_unit = $cart_item['pricing_item_meta_data']['_measurement_needed_unit'];
				$_product                = $cart_item['data'];

				// Recalculate the measurement price.
				$cart_item['pricing_item_meta_data']['_price'] = \WC_Price_Calculator_Product::calculate_price( $_product, $measurement_needed, $measurement_needed_unit );

				$cart_item = wc_measurement_price_calculator()->get_cart_instance()->set_product_prices( $cart_item );

				// Do it once.
				remove_filter( 'woocommerce_get_cart_item_from_session', array( wc_measurement_price_calculator()->get_cart_instance(), 'get_cart_item_from_session' ), 1, 2 );
			}
			return $cart_item;
		}

		/**
		 * Return the measurement price calculator min_price.
		 *
		 * @param mixed      $value Property value.
		 * @param WC_Product $product Product instance.
		 * @return mixed
		 */
		public static function get_measurement_price_calculator_min_price( $value, $product ) {
			return wcpbc_the_zone()->get_price_prop( $product, $value, '_wc_measurement_price_calculator_min_price' );

		}

		/**
		 * Return the measurement pricing rules
		 *
		 * @param mixed      $value Property value.
		 * @param WC_Product $product Product instance.
		 * @return mixed
		 */
		public static function get_price_calculator_pricing_rules( $value, $product ) {
			if ( ! is_array( $value ) ) {
				return $value;
			}

			foreach ( $value as $i => $row ) {
				foreach ( array( 'price', 'regular_price', 'sale_price' ) as $field ) {
					if ( isset( $row[ $field ] ) && is_numeric( $row[ $field ] ) ) {
						$value[ $i ][ $field ] = wcpbc_the_zone()->get_exchange_rate_price( $row[ $field ], true, 'product', $product );
					}
				}
			}
			return $value;
		}

		/**
		 * Set the price of the product for that the Measurement plugin generates the HTML properly.
		 *
		 * @param string     $price_html HTML product price.
		 * @param WC_Product $product The product object.
		 */
		public static function get_price_html( $price_html, $product ) {
			if ( empty( $price_html ) || $product->is_type( 'variable' ) ) {
				return $price_html;
			}

			$_product = $product->is_type( 'variation' ) ? wc_get_product( $product->get_parent_id() ) : $product;

			if ( \WC_Price_Calculator_Product::pricing_per_unit_enabled( $_product ) ) {
				$settings = new \WC_Price_Calculator_Settings( $product );
				if ( $settings->is_quantity_calculator_enabled() ) {
					WCPBC_Frontend_Pricing::adjust_product_price( $product );
				}
			}
			return $price_html;
		}

		/**
		 * Add the minimum price field to the product simple.
		 *
		 * @param array $fields Product simple fields.
		 * @return array
		 */
		public static function product_simple_fields( $fields ) {

			$fields[] = array(
				'name'  => '_wc_measurement_price_calculator_min_price',
				// translators: %s is a currency symbol.
				'label' => __( 'Minimum Price (%s)', 'wc-price-based-country-pro' ),
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
			$fields['_wc_measurement_price_calculator_min_price'] = array(
				'name'          => "_variable_wc_measurement_price_calculator_min_price[$loop]",
				// translators: %s is a currency symbol.
				'label'         => __( 'Minimum Price (%s)', 'wc-price-based-country-pro' ),
				'wrapper_class' => 'form-row form-row-full _wc_measurement_price_calculator_min_price_wcpbc_field',
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

			foreach ( WCPBC_Pricing_Zones::get_zones() as $zone ) {

				$price_method = $zone->get_input_var( $variable . '_price_method', $index );

				if ( wcpbc_is_exchange_rate( $price_method ) ) {
					$min_price = $zone->get_exchange_rate_price_by_post( $post_id, '_wc_measurement_price_calculator_min_price' );
				} else {
					$min_price = wc_format_decimal( $zone->get_input_var( $variable . '_wc_measurement_price_calculator_min_price', $index ) );
				}

				$zone->set_postmeta( $post_id, '_wc_measurement_price_calculator_min_price', $min_price );
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
			if ( is_callable( array( 'WC_Price_Calculator_Product', 'calculator_enabled' ) ) && \WC_Price_Calculator_Product::calculator_enabled( $product ) ) {
				$min_price                     = $product->get_meta( '_wc_measurement_price_calculator_min_price' );
				$data['measurement_min_price'] = is_numeric( $min_price ) ? wc_get_price_to_display( $product, array( 'price' => $min_price ) ) : '';

				$settings = new \WC_Price_Calculator_Settings( $product );
				if ( $settings->pricing_rules_enabled() ) {
					$data['measurement_pricing_rules'] = $settings->get_pricing_rules();
				}
			}
			return $data;
		}

		/**
		 * Add a wrapper to the price per unit html.
		 *
		 * @param string     $price_html HTML product price.
		 * @param WC_Product $product The product object.
		 */
		public static function price_calculator_get_price_html( $price_html, $product ) {
			if ( WCPBC_Ajax_Geolocation::is_enabled() && false === strpos( $price_html, 'class="wcpbc-price' ) ) {
				$price_html = WCPBC_Ajax_Geolocation::wrapper_price( $product, $price_html );
			}
			return $price_html;
		}
	}

	// Init integration.
	WCPBC_Measurement_Price_Calculator::init();

endif;
