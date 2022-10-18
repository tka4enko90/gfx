<?php
/**
 * Admin View: Notice - Review
 *
 * @package WCPBC/Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="notice notice-warning">
	<?php if ( 'expired' === $license_data['status'] || 1 > $days ) : ?>
	<p>
		<?php
		// translators: HTML tags.
		printf( esc_html( __( 'Your license key for %1$sPrice Based on Country Pro has expired%2$s. Buy a new license to get support and updates.', 'wc-price-based-country-pro' ) ), '<strong>', '</strong>' );
		?>
	</p>
	<p>
		<a class="button-primary" href="https://www.pricebasedcountry.com/pricing/?utm_source=activate-license&utm_medium=banner&utm_campaign=Renew"><?php esc_html_e( 'Buy a new license', 'wc-price-based-country-pro' ); ?></a>
		<a class="skip button-secondary" href="<?php echo esc_url( admin_url( 'admin.php?page=wc-settings&tab=price-based-country&section=license' ) ); ?>"><?php esc_html_e( 'I have already bought a license.', 'wc-price-based-country-pro' ); ?></a>
	</p>
	<?php else : ?>
	<p>
		<?php
		if ( $percent_discount ) {
			// translators: HTML tags.
			printf( esc_html( __( 'Your license key for %1$sPrice Based on Country Pro%2$s is expiring within %3$s days. It\'s time to %1$srenew and get a %4$s off%2$s.', 'wc-price-based-country-pro' ) ), '<strong>', '</strong>', esc_html( $days ), absint( $percent_discount ) . '%' );
		} else {
			// translators: HTML tags.
			printf( esc_html( __( 'Your license key for %1$sPrice Based on Country Pro%2$s is expiring within %3$s days. It\'s time to %1$srenew and get a discount%2$s.', 'wc-price-based-country-pro' ) ), '<strong>', '</strong>', esc_html( $days ) );
		}
		?>
	</p>
	<p>
		<a class="button-primary" href="<?php echo esc_url( $renewal_url ); ?>"><?php esc_html_e( 'Renew your license now', 'wc-price-based-country-pro' ); ?></a>
		<a class="skip button-secondary" href="<?php echo esc_url( wp_nonce_url( add_query_arg( 'hide-renewal-license-notice', '1' ), 'hide_renewal_license_notice' ) ); ?>"><?php esc_html_e( 'I already renewed my license.', 'wc-price-based-country-pro' ); ?></a>
	</p>
	<?php endif; ?>
</div>
