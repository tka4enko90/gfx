<?php
/**
 * Admin View: Checkout add-ons price adjustment field.
 *
 * @package WCPBC/Admin/Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="options_group wcpbc_pricing wcpbc_pricing_<?php echo esc_attr( $zone->get_id() ); ?>">
	<fieldset class="form-field <?php echo esc_attr( $zone->get_id() ); ?>_price_method_field _price_method_wcpbc_field">
		<legend><?php echo esc_html( wcpbc_price_method_label( __( 'Price adjustment for', 'wc-price-based-country-pro' ), $zone ) ); ?></legend>
		<ul class="wc-radios">
		<?php foreach ( wcpbc_price_method_options() as $key => $value ) : ?>
			<li>
			<label>
				<input
					name="wcpbc_checkout_add_ons[<?php echo esc_attr( $zone->get_id() ); ?>][price_method]"
					value="<?php echo esc_attr( $key ); ?>"
					<?php checked( $price_method, esc_attr( $key ) ); ?>
					type="radio"
					class="wcpbc_price_method" />
				<?php echo esc_html( $value ); ?>
			</label>
			</li>
		<?php endforeach; ?>
		</ul>
	</fieldset>
	<div class="wcpbc_show_if_manual">
		<p class="form-field _wcpbc_adjustment_field <?php echo esc_attr( $zone->get_postmetakey( '_adjustment' ) ); ?>_field">
			<label>
				<?php
				// Translators: currency symbol.
				echo esc_html( sprintf( __( 'Price adjustment (%s)', 'wc-price-based-country-pro' ), get_woocommerce_currency_symbol( $zone->get_currency() ) ) );
				?>
			</label>
			<input type="number" class="short" step="<?php echo esc_attr( pow( 10, -1 * wc_get_price_decimals() ) ); ?>" name="wcpbc_checkout_add_ons[<?php echo esc_attr( $zone->get_id() ); ?>][adjustment]" value="<?php echo esc_attr( $adjustment ); ?>">
		</p>
		<div style="margin:10px;" class="wrapper-wcpbc-checkout-add-ons-option-fields">
			<table class="widefat striped wcpbc-checkout-add-ons-option-fields">
				<thead>
					<tr>
						<th scope="col" class="" style="width: 50%;">Label</th>
						<th scope="col" class="" style="width: 50%;">
						<?php
						// Translators: currency symbol.
						echo esc_html( sprintf( __( 'Price adjustment (%s)', 'wc-price-based-country-pro' ), get_woocommerce_currency_symbol( $zone->get_currency() ) ) );
						?>
						</th>
					</tr>
				</thead>
				<tbody data-zone_id="<?php echo esc_attr( $zone->get_id() ); ?>"></tbody>
			</table>
		</div>
	</div>
</div>
