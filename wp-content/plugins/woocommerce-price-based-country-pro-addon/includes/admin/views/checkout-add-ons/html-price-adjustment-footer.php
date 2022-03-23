<?php
/**
 * Admin View: Checkout add-ons price adjustment option row.
 *
 * @package WCPBC/Admin/Views
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<script type="text/html" id="tmpl-wcpbc-checkout-add-ons-option">
<tr data-option-id="{{{data.id}}}" class="wcpbc-checkout-add-ons-option-{{{data.id}}}">
	<td>
		<input style="width:100%" type="text" readonly="readonly" class="wcpbc-checkout-add-ons-option-label" value="{{{data.label}}}">
	</td>
	<td>
		<input type="number" step="<?php echo esc_attr( pow( 10, -1 * wc_get_price_decimals() ) ); ?>" class="short wcpbc-checkout-add-ons-option-price-adjustment" name="wcpbc_checkout_add_ons[{{{data.zone_id}}}][options][{{{data.id}}}][adjustment]" value="{{{data.value}}}">
	</td>
</tr>
</script>
<p style="display:none;" id="wcpbc-checkout-add-ons-no-fixed-alert">
	<span style="font-size: 14px; font-style: italic;"><?php echo esc_html__( 'There is not fixed price adjustments for this field.', 'wc-price-based-country-pro' ); ?></span>
</p>
