<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if (!defined('ABSPATH')) {
    exit;
}

wp_enqueue_style('checkout_page_styles', get_template_directory_uri() . '/static/css/page-templates/checkout.css', '', '', 'all');

$hero_title = get_the_title();
$checkout_hero_subtitle = get_field('checkout_hero_subtitle', 'option');

if ($hero_title || $checkout_hero_subtitle) :
    get_template_part('template-parts/blocks/hero/hero', '', array('title' => $hero_title, 'subtitle' => $checkout_hero_subtitle));
endif; ?>

<section class="checkout-section">
    <div class="container">
        <?php do_action('woocommerce_before_checkout_form', $checkout); ?>

        <div class="before-checkout-form-holder">
            <div class="login-form-holder">
                <?php woocommerce_checkout_login_form(); ?>
            </div>
            <?php woocommerce_checkout_coupon_form(); ?>
        </div>

        <form name="checkout" method="post" class="checkout woocommerce-checkout"
              action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
            <div class="form-holder">
                <div class="col left-col">

                    <!-- user information -->
                    <?php if (is_user_logged_in()) : ?>
                        <div class="user-information">
                            <h3><?php _e('Information', 'gfx'); ?></h3>

                            <?php
                            $user_name = wp_get_current_user()->display_name;
                            $user_email = wp_get_current_user()->user_email;
                            if ($user_name || $user_email) : ?>
                                <div class="text">
                                    <?php _e("Welcome back, ", 'gfx');
                                    if ($user_name) : ?>
                                        <span><?php echo $user_name; ?></span>
                                    <?php endif;
                                    if ($user_email) :
                                        echo '(' . $user_email . ')';
                                    endif; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <!-- Billing information -->
                    <?php if ($checkout->get_checkout_fields()) : ?>
                        <div class="billing-information">
                            <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                            <h3><?php _e('Billing Address', 'gfx'); ?></h3>

                            <div id="customer_details">
                                <?php do_action('woocommerce_checkout_billing'); ?>
                            </div>

                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                        </div>
                    <?php endif; ?>


                    <?php
                    $available_payment_gateways = WC()->payment_gateways->get_available_payment_gateways();
                    if (!empty($available_payment_gateways)) : ?>
                        <div class="payment-methods-box">
                            <h3><?php _e('Payment', 'gfx'); ?></h3>
                            <div class="subtitle">
                                <p><?php _e('Please select a payment method:', 'gfx'); ?></p>
                            </div>

                            <div class="payments-box">
                                <h6><?php _e('Payment Methods', 'gfx'); ?></h6>
                                <?php woocommerce_checkout_payment(); ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php wc_get_template('checkout/terms.php'); ?>

                    <div class="submit-holder">
                        <button type="submit" class="primary-button">
                            <?php _e('Complete Order', 'gfx'); ?>
                        </button>
                    </div>
                </div>
                <div class="col right-col">
                    <div class="order-review-box">
                        <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>
                        <h6 id="order_review_heading"><?php esc_html_e('Your Order', 'gfx'); ?></h6>
                        <?php do_action('woocommerce_checkout_before_order_review'); ?>
                        <div id="order_review" class="woocommerce-checkout-review-order">
                            <?php do_action('woocommerce_checkout_order_review'); ?>
                        </div>
                        <?php do_action('woocommerce_checkout_after_order_review'); ?>
                    </div>
                </div>
            </div>
        </form>

        <?php do_action('woocommerce_after_checkout_form', $checkout); ?>
    </div>
</section>