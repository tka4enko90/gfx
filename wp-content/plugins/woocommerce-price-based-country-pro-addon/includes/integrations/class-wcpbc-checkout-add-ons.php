<?php
/**
 * Handle integration with WooCommerce Checkout Add-Ons by SkyVerge, Inc.
 *
 * @since 2.14.0
 * @see http://www.woocommerce.com/products/woocommerce-checkout-add-ons/
 * @package WCPBC/Integrations
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use SkyVerge\WooCommerce\Checkout_Add_Ons\Add_Ons\Add_On_Factory as Add_On_Factory;

if ( ! class_exists( 'WCPBC_Checkout_Add_Ons' ) ) :

	/**
	 * WCPBC_Checkout_Add_Ons Class
	 */
	class WCPBC_Checkout_Add_Ons {

		/**
		 * Check enviroment notice.
		 *
		 * @var string
		 */
		private static $notice = '';

		/**
		 * Array of add-ons adjustment price to use in the frontend.
		 *
		 * @var array
		 */
		private static $adjustment_prices = array();

		/**
		 * Init hooks
		 */
		public static function init() {
			add_action( 'wc_price_based_country_frontend_princing_init', array( __CLASS__, 'princing_init' ) );
			add_action( 'admin_enqueue_scripts', array( __CLASS__, 'load_styles_scripts' ), 30 );
			add_action( 'load-woocommerce_page_wc_checkout_add_ons', array( __CLASS__, 'admin_add_ons_actions' ), 5 );
			add_filter( 'wc_checkout_add_ons_meta_box_add_on_panels', array( __CLASS__, 'meta_box_add_on_panels' ) );
			add_filter( 'wc_checkout_add_ons_meta_box_add_on_fields', array( __CLASS__, 'meta_box_add_on_fields' ) );
			add_filter( 'wc_checkout_add_ons_get_field_renderer', array( __CLASS__, 'get_field_renderer' ), 10, 2 );
		}

		/**
		 * Init pricing hooks
		 */
		public static function princing_init() {
			self::load_adjustment_prices();
			add_filter( 'option_wc_checkout_add_ons', array( __CLASS__, 'frontend_checkout_add_ons' ), 1 );
		}

		/**
		 * Load the adjustment prices for the current zone.
		 */
		private static function load_adjustment_prices() {
			$checkout_add_ons        = get_option( 'wcpbc_checkout_add_ons', array() );
			self::$adjustment_prices = array();
			$zone_id                 = wcpbc_the_zone()->get_id();

			foreach ( $checkout_add_ons as $id => $data ) {
				if ( isset( $data[ $zone_id ]['price_method'] ) && ! wcpbc_is_exchange_rate( $data[ $zone_id ]['price_method'] ) ) {
					self::$adjustment_prices[ $id ]['adjustment'] = $data[ $zone_id ]['adjustment'];
					self::$adjustment_prices[ $id ]['options']    = isset( $data[ $zone_id ]['options'] ) && is_array( $data[ $zone_id ]['options'] ) ? $data[ $zone_id ]['options'] : array();
				}
			}
		}

		/**
		 * Update the price adjustment field and returns the option.
		 *
		 * @param array $add_ons Checkout add-ons as array.
		 * @return array
		 */
		public static function frontend_checkout_add_ons( $add_ons ) {
			if ( is_array( $add_ons ) ) {
				$add_ons = self::frontend_set_manual_adjustment( $add_ons, self::$adjustment_prices );
			}
			return $add_ons;
		}

		/**
		 * Set adjustment price for addons
		 *
		 * @param array $add_ons Checkout add-ons as array.
		 * @param array $adjustments Array of manual adjustment price.
		 * @return array
		 */
		private static function frontend_set_manual_adjustment( $add_ons, $adjustments ) {
			foreach ( $add_ons as $id => $data ) {
				// Price adjustment.
				if ( isset( $data['adjustment'], $data['adjustment_type'] ) && 'fixed' === $data['adjustment_type'] ) {
					if ( isset( $adjustments[ $id ]['adjustment'] ) ) {
						// Manual price.
						$add_ons[ $id ]['adjustment'] = '' === $adjustments[ $id ]['adjustment'] ? '' : floatval( $adjustments[ $id ]['adjustment'] );
					} else {
						$add_ons[ $id ]['adjustment'] = wcpbc_the_zone()->get_exchange_rate_price( $data['adjustment'], true, 'wc_checkout_add_ons' );
					}
				}

				// Cart rules.
				if ( isset( $data['rules']['cart_subtotal']['values'] ) && is_array( $data['rules']['cart_subtotal']['values'] ) ) {
					foreach ( $data['rules']['cart_subtotal']['values'] as $min_or_max => $cart_subtotal_value ) {
						if ( $cart_subtotal_value ) {
							$add_ons[ $id ]['rules']['cart_subtotal']['values'][ $min_or_max ] = wcpbc_the_zone()->get_exchange_rate_price( $cart_subtotal_value, true, 'wc_checkout_add_ons' );
						}
					}
				}

				// Options.
				if ( ! empty( $data['options'] ) ) {
					$option_adjustments        = isset( $adjustments[ $id ]['options'] ) ? $adjustments[ $id ]['options'] : array();
					$add_ons[ $id ]['options'] = self::frontend_set_manual_adjustment( $data['options'], $option_adjustments );
				}
			}
			return $add_ons;
		}

		/**
		 * Save add-ons data.
		 */
		public static function admin_add_ons_actions() {

			$edit   = self::get_edit_data();
			$delete = self::get_delete_data();

			if ( $edit || $delete ) {

				$add_ons = get_option( 'wcpbc_checkout_add_ons', array() );
				if ( ! is_array( $add_ons ) ) {
					$add_ons = array();
				}

				if ( $edit ) {
					$id             = $edit['id'];
					$add_ons[ $id ] = $edit['checkout_add_ons'];
				} else {
					foreach ( $delete as $id ) {
						unset( $add_ons[ $id ] );
					}
				}

				// Update the option.
				update_option( 'wcpbc_checkout_add_ons', $add_ons );
			}
		}

		/**
		 * Returns the edit addon data.
		 *
		 * @return array|bool
		 */
		private static function get_edit_data() {
			$addon = false;
			if ( ! empty( $_GET['add_on'] ) &&
				! empty( $_GET['action'] ) && 'edit' === $_GET['action'] &&
				! empty( $_POST['wcpbc_checkout_add_ons'] ) && is_array( $_POST['wcpbc_checkout_add_ons'] ) &&
				! empty( $_POST['_wpnonce'] ) && wp_verify_nonce( $_POST['_wpnonce'], 'wc_checkout_add_ons_add_on_data' )
			) {
				$addon = array(
					'checkout_add_ons' => wc_clean( $_POST['wcpbc_checkout_add_ons'] ),
					'id'               => wc_clean( $_GET['add_on'] ),
				);
			}
			return $addon;
		}

		/**
		 * Returns the delete addon data.
		 *
		 * @return array|bool
		 */
		private static function get_delete_data() {
			$addon = false;
			if ( ! empty( $_GET['add_on'] ) &&
				! empty( $_GET['action'] ) && 'delete' === $_GET['action'] &&
				current_user_can( 'manage_woocommerce' ) &&
				! empty( $_GET['security'] ) && wp_verify_nonce( $_GET['security'], 'delete_checkout_add_on_' . wc_clean( $_GET['add_on'] ) )
			) {
				$addon = array(
					wc_clean( $_GET['add_on'] ),
				);
			} elseif (
				! empty( $_REQUEST['action'] ) && 'bulk-delete' === $_REQUEST['action'] &&
				! empty( $_REQUEST['bulk-action'] ) && is_array( $_REQUEST['bulk-action'] ) &&
				! empty( $_REQUEST['_wpnonce'] ) && wp_verify_nonce( $_REQUEST['_wpnonce'], 'bulk-add-ons' )
			) {
				$addon = wc_clean( $_REQUEST['bulk-action'] );
			}

			return $addon;
		}

		/**
		 * Returns add-on ID.
		 *
		 * @return string
		 */
		private static function get_admin_addon_id() {
			return empty( $_GET['add_on'] ) ? false : wc_clean( $_GET['add_on'] ); // phpcs:ignore WordPress.Security.NonceVerification
		}

		/**
		 * Returns an add-on by ID.
		 *
		 * @param string $id Add-on ID.
		 * @return array
		 */
		private static function get_addon_from_db( $id = null ) {
			$add_ons = get_option( 'wcpbc_checkout_add_ons', array() );
			if ( is_null( $id ) ) {
				$id = self::get_admin_addon_id();
			}
			return isset( $add_ons[ $id ] ) && is_array( $add_ons[ $id ] ) ? $add_ons[ $id ] : array();
		}

		/**
		 * Load admin styles and scripts.
		 */
		public static function load_styles_scripts() {
			$screen    = get_current_screen();
			$screen_id = $screen ? $screen->id : '';
			if ( 'woocommerce_page_wc_checkout_add_ons' === $screen_id ) {
				// Scripts.
				$suffix = defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ? '' : '.min';
				wp_register_script( 'wcpbc_checkout_add_ons', WC_Product_Price_Based_Country_Pro::plugin_url() . 'assets/js/admin-checkout-add-ons' . $suffix . '.js', array( 'wc_price_based_country_admin', 'wp-util' ), WC_Product_Price_Based_Country_Pro::$version, true );
				wp_localize_script(
					'wcpbc_checkout_add_ons',
					'wcpbc_checkout_add_ons_param',
					array(
						'add_on'             => self::get_addon_from_db(),
						'types_with_options' => array_keys( Add_On_Factory::get_add_on_types_with_options() ),
					)
				);
				wp_enqueue_script( 'wcpbc_checkout_add_ons' );
			}
		}

		/**
		 * Add a zone pricing tab.
		 *
		 * @param array $panels Metabox panels.
		 * @return array
		 */
		public static function meta_box_add_on_panels( $panels ) {
			$panels['zone_pricing'] = array(
				'label'  => __( 'Zone pricing', 'wc-price-based-country-pro' ),
				'fields' => array( 'wcpbc_fixed_price_adjustment' ),
			);
			return $panels;
		}

		/**
		 * Returns the Pricing zone fields.
		 *
		 * @param array $fields Metabox Fields.
		 * @return array
		 */
		public static function meta_box_add_on_fields( $fields ) {

			$fields['wcpbc_fixed_price_adjustment'] = array(
				'id'         => '_price_method',
				'type'       => 'wcpbc_fixed_price_adjustment',
				'field_only' => true,
			);

			return $fields;
		}

		/**
		 * Return the field renderer
		 *
		 * @param callable $render_function Rendering function.
		 * @param string   $field_type Field type.
		 * @return callable
		 */
		public static function get_field_renderer( $render_function, $field_type ) {
			if ( 'wcpbc_fixed_price_adjustment' === $field_type ) {
				$render_function = array( __CLASS__, 'render_price_adjustment_field' );
			}
			return $render_function;
		}

		/**
		 * Renders price adjustment fields.
		 *
		 * @param array $field_data Initialized field data.
		 */
		public static function render_price_adjustment_field( $field_data ) {
			if ( ! self::get_admin_addon_id() ) {
				printf( '<p style="font-size: 14px; font-style: italic;">%s</p>', esc_html__( 'You have to save the add-on before editing the price by zone.', 'wc-price-based-country-pro' ) );
			} else {
				$addon = self::get_addon_from_db();

				foreach ( WCPBC_Pricing_Zones::get_zones() as $zone ) {
					$data = isset( $addon[ $zone->get_id() ] ) && is_array( $addon[ $zone->get_id() ] ) ? $addon[ $zone->get_id() ] : array();

					$price_method = isset( $data['price_method'] ) ? $data['price_method'] : 'exchange_rate';
					$adjustment   = isset( $data['adjustment'] ) ? $data['adjustment'] : false;
					// Output the input control.
					include WC_Product_Price_Based_Country_Pro::plugin_path() . 'includes/admin/views/checkout-add-ons/html-price-adjustment-field.php';
				}

				// Output the the table row template.
				include WC_Product_Price_Based_Country_Pro::plugin_path() . 'includes/admin/views/checkout-add-ons/html-price-adjustment-footer.php';
			}
		}

		/**
		 * Checks the environment for compatibility problems.
		 *
		 * @return boolean
		 */
		public static function check_environment() {
			$plugin_version = defined( 'SkyVerge\WooCommerce\Checkout_Add_Ons\Plugin::VERSION' ) ? SkyVerge\WooCommerce\Checkout_Add_Ons\Plugin::VERSION : 'unknown';

			if ( 'unknown' === $plugin_version || version_compare( $plugin_version, '2.0.0', '<' ) ) {
				// translators: 1: HTML tag, 2: HTML tag, 3: Germanized for WooCommerce version.
				self::$notice = sprintf( __( '%1$sPrice Based on Country Pro & WooCommerce Checkout Add-Ons%2$s compatibility requires WooCommerce Checkout Add-Ons +2.0.0. You are running Germanized for WooCommerce %3$s.', 'wc-price-based-country-pro' ), '<strong>', '</strong>', $plugin_version );
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

	if ( WCPBC_Checkout_Add_Ons::check_environment() ) {
		WCPBC_Checkout_Add_Ons::init();
	}

endif;
