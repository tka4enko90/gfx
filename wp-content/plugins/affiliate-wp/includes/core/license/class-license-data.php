<?php
/**
 * License
 *
 * Handles the license functionality.
 *
 * @package     AffiliateWP
 * @subpackage  Core
 * @copyright   Copyright (c) 2021, Sandhills Development, LLC
 * @license     http://opensource.org/licenses/gpl-2.0.php GNU Public License
 * @since       2.9
 */

namespace AffWP\Core\License;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Core class used to handle the License functionality from EDD.
 *
 * @since 2.9
 */
class License_Data {

	/**
	 * Stored license key value.
	 *
	 * @since 2.9
	 * @var   string
	 */
	private $license_key;

	/**
	 * Set up license data.
	 *
	 * @since 2.9
	 * @return void
	 */
	public function __construct() {
		if ( $this->is_license_valid() ) {
			$license_key       = affiliate_wp()->settings->get_license_key();
			$this->license_key = sanitize_text_field( $license_key );
		} else {
			$this->license_key = '';
		}
	}

	/**
	 * Returns the activation status for the given license key.
	 *
	 * @since 2.9 Adapted from the Settings class, save functionality extracted to other functions, and added license key param.
	 *
	 * @param string $license_key License key.
	 * @return array Returns status with error info or license data.
	 */
	public function activation_status( $license_key ) {
		// Retrieve the license status from the database.
		$status = affiliate_wp()->settings->get( 'license_status' );

		if ( isset( $status->license ) ) {
			$status = $status->license;
		}

		if ( 'valid' === $status ) {
			return; // License already activated and valid.
		}

		$license_key = sanitize_text_field( $license_key );

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'activate_license',
			'license'    => $license_key,
			'item_name'  => 'AffiliateWP',
			'url'        => home_url()
		);

		// Call the custom API.
		$response = wp_remote_post( 'https://affiliatewp.com', array(
			'timeout'   => 35,
			'sslverify' => false,
			'body'      => $api_params,
		) );

		$response_code = wp_remote_retrieve_response_code( $response );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			return array(
				'license_status' => false,
				'affwp_notice'   => 'license-http-failure',
				'affwp_message'  => $response->get_error_message(),
			);
		}

		// check response error code
		if ( 200 !== $response_code ) {
			return array(
				'license_status' => false,
				'affwp_notice'   => 'license-http-failure',
				'affwp_message'  => wp_remote_retrieve_response_message( $response ),
			);
		}

		// Decode the license data.
		$license_data = json_decode( wp_remote_retrieve_body( $response ) );

		// Return license data.
		return array(
			'license_status' => true,
			'license_data'   => $license_data,
			'license_key'    => $license_key,
		);
	}

	/**
	 * Returns the deactivation status for the given license key.
	 *
	 * @since 2.9 Adapted from the Settings class and save functionality extracted to other functions.
	 * @return bool|array Returns true or array with error info.
	 */
	public function deactivation_status() {

		$license_key = $this->license_key;

		// Data to send in our API request.
		$api_params = array(
			'edd_action' => 'deactivate_license',
			'license'    => $license_key,
			'item_name'  => 'AffiliateWP',
			'url'        => home_url(),
		);

		// Call the custom API.
		$response = wp_remote_post( 'https://affiliatewp.com', array(
			'timeout'   => 35,
			'sslverify' => false,
			'body'      => $api_params,
		) );

		// Make sure the response came back okay.
		if ( is_wp_error( $response ) ) {
			return array(
				'license_status' => false,
				'message'        => $response->get_error_message(),
			);
		}

		return true;
	}

	/**
	 * Retrieves the license key.
	 *
	 * If the `AFFILIATEWP_LICENSE_KEY` constant is defined, it will override values
	 * stored in the database.
	 *
	 * @since 1.9
	 * @access public
	 * @static
	 *
	 * @param string $key    Optional. License key to check. Default empty.
	 * @param bool   $saving Optional. Whether a saving operation is being performed. If true,
	 *                       the already-saved key value will be ignored. Default false.
	 * @return string License key.
	 */
	public static function get_license_key( $key = '', $saving = false ) {
		if ( defined( 'AFFILIATEWP_LICENSE_KEY' ) && AFFILIATEWP_LICENSE_KEY ) {
			$license = AFFILIATEWP_LICENSE_KEY;
		} elseif ( ! empty( $key ) || true === $saving ) {
			$license = $key;
		} else {
			$license = affiliate_wp()->settings->get( 'license_key' );
		}

		return trim( $license );
	}

	/**
	 * Checks validity of the license key.
	 *
	 * @since 1.0
	 * @since 2.9 Extracted this from the Settings class and updated name.
	 *
	 * @param bool $force Optional. Whether to force checking the license (bypass caching).
	 * @return bool|mixed|void
	 */
	public function check_status( $force = false ) {
		$status = get_transient( 'affwp_license_check' );

		$request_url = 'https://affiliatewp.com';

		// Run the license check a maximum of once per day.
		if ( ( false === $status || $force ) && site_url() !== $request_url ) {
			// data to send in our API request.
			$api_params = array(
				'edd_action' => 'check_license',
				'license'    => self::get_license_key(),
				'item_name'  => 'AffiliateWP',
				'url'        => home_url(),
			);

			/**
			 * Filters whether to send site data.
			 *
			 * @since 1.0
			 *
			 * @param bool $send Whether to send site data. Default true.
			 */
			if ( apply_filters( 'affwp_send_site_data', true ) ) {

				// Send checkins once per week.
				$last_checked = get_option( 'affwp_last_checkin', false );

				if ( ! is_numeric( $last_checked ) || $last_checked < strtotime( '-1 week', current_time( 'timestamp' ) ) ) {

					$api_params['site_data'] = $this->get_site_data();

				}
			}

			// Call the custom API.
			$response = wp_remote_post( $request_url, array(
				'timeout'   => 15,
				'sslverify' => false,
				'body'      => $api_params,
			) );

			// Make sure the response came back okay.
			if ( is_wp_error( $response ) ) {

				// Connection failed, try again in three hours.
				set_transient( 'affwp_license_check', $response, 3 * HOUR_IN_SECONDS );

				return false;
			}

			$license_data = json_decode( wp_remote_retrieve_body( $response ) );

			affiliate_wp()->settings->set( array( 'license_status' => $license_data) );

			if ( isset( $license_data->license ) ) {
				set_transient( 'affwp_license_check', $license_data->license, DAY_IN_SECONDS );
			}

			if ( ! empty( $api_params['site_data'] ) ) {

				update_option( 'affwp_last_checkin', current_time( 'timestamp' ) );

			}

			if ( isset( $license_data->license ) ) {
				$status = $license_data->license;
			}
		}

		return $status;

	}

	/**
	 * Returns whether the license key is valid or not.
	 *
	 * @since 2.9 Extracted this from the Settings class.
	 * @return bool
	 */
	public function is_license_valid() {
		return 'valid' === $this->check_status();
	}

	/**
	 * Returns the type of the license.
	 *
	 * @since 2.9
	 *
	 * @param int $license_id License id.
	 * @return string Personal, Plus, Professional, or Ultimate
	 */
	public function get_license_type( $license_id ) {
		if ( 0 === $license_id ) {
			$license_type = 'Personal';
		} elseif ( 1 === $license_id ) {
			$license_type = 'Plus';
		} elseif ( 2 === $license_id ) {
			$license_type = 'Professional';
		} elseif ( 3 === $license_id ) {
			$license_type = 'Ultimate';
		} else {
			$license_type = '';
		}

		return $license_type;
	}

	/**
	 * Retrieves site data (plugin versions, integrations, etc) to be sent along with the license check.
	 *
	 * @since 1.9
	 * @since 2.9 Extracted this from the Settings class.
	 * @access public
	 *
	 * @return array
	 */
	public function get_site_data() {

		$data = array();

		$theme_data = wp_get_theme();
		$theme      = $theme_data->Name . ' ' . $theme_data->Version;

		$data['php_version']   = phpversion();
		$data['affwp_version'] = AFFILIATEWP_VERSION;
		$data['wp_version']    = get_bloginfo( 'version' );
		$data['server']        = isset( $_SERVER['SERVER_SOFTWARE'] ) ? $_SERVER['SERVER_SOFTWARE'] : '';
		$data['install_date']  = get_post_field( 'post_date', affwp_get_affiliate_area_page_id() );
		$data['multisite']     = is_multisite();
		$data['url']           = home_url();
		$data['theme']         = $theme;

		// Retrieve current plugin information.
		if ( ! function_exists( 'get_plugins' ) ) {
			include ABSPATH . '/wp-admin/includes/plugin.php';
		}

		$plugins        = array_keys( get_plugins() );
		$active_plugins = get_option( 'active_plugins', array() );

		foreach ( $plugins as $key => $plugin ) {
			if ( in_array( $plugin, $active_plugins ) ) {
				// Remove active plugins from list so we can show active and inactive separately.
				unset( $plugins[ $key ] );
			}
		}

		$data['active_plugins']   = $active_plugins;
		$data['inactive_plugins'] = $plugins;
		$data['locale']           = get_locale();
		$data['integrations']     = affiliate_wp()->integrations->get_enabled_integrations();
		$data['affiliates']       = affiliate_wp()->affiliates->count( array( 'number' => -1 ) );
		$data['creatives']        = affiliate_wp()->creatives->count( array( 'number' => -1 ) );
		$data['customers']        = affiliate_wp()->customers->count( array( 'number' => -1 ) );
		$data['payouts']          = affiliate_wp()->affiliates->payouts->count( array( 'number' => -1 ) );
		$data['referrals']        = affiliate_wp()->referrals->count( array( 'number' => -1 ) );
		$data['consumers']        = affiliate_wp()->REST->consumers->count( array( 'number' => -1 ) );
		$data['visits']           = affiliate_wp()->visits->count( array( 'number' => -1 ) );
		$data['referral_rate']    = affiliate_wp()->settings->get( 'referral_rate' );
		$data['flat_rate_basis']  = affiliate_wp()->settings->get( 'flat_rate_basis' );
		$data['rate_type']        = affiliate_wp()->settings->get( 'referral_rate_type' );

		return $data;
	}

}
