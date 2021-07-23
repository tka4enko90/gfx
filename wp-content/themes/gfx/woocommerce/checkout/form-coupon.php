<?php
/**
 * Checkout coupon form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-coupon.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;
if ( ! wc_coupons_enabled() ) {
    return;
} ?>

<form class="checkout_coupon woocommerce-form-coupon" method="post">
    <h6><?php _e('Apply a Coupon', 'gfx'); ?></h6>
    <div class="holder">
        <input type="text" name="coupon_code" class="input-text" placeholder="<?php esc_attr_e( 'Coupon code', 'gfx' ); ?>" id="coupon_code" value="" />

        <button type="submit" class="primary-button small blue" name="apply_coupon" value="<?php _e('Apply', 'gfx'); ?>">
            <?php _e('Apply', 'gfx'); ?>
        </button>
    </div>
</form>