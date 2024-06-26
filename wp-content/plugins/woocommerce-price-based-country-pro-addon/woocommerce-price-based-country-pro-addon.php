<?php
/**
 * Plugin Name: WooCommerce Price Based on Country Pro Add-on
 * Plugin URI: https://www.pricebasedcountry.com/
 * Description: Supercharge Price Based on Country with professionals features
 * Version: 2.20.1
 * Author: Oscar Gare
 * Author URI: https://www.pricebasedcountry.com/
 * Domain Path: /languages/
 * Text Domain: wc-price-based-country-pro
 * WC requires at least: 3.4
 * WC tested up to: 6.9
 * License: GPLv2
 *
 * @package WCPBC
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

// Define WCPBC_PRO_PLUGIN_FILE.
if ( ! defined( 'WCPBC_PRO_PLUGIN_FILE' ) ) {
	define( 'WCPBC_PRO_PLUGIN_FILE', __FILE__ );
}

// Include the main WooCommerce class.
if ( ! class_exists( 'WC_Product_Price_Based_Country_Pro' ) ) {
	include_once dirname( __FILE__ ) . '/includes/class-wc-product-price-based-country-pro.php';
	WC_Product_Price_Based_Country_Pro::init();
}
