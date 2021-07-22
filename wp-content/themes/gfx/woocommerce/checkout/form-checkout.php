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
        <?php do_action('woocommerce_before_checkout_form', $checkout);
        // If checkout registration is disabled and not logged in, the user cannot checkout.
        if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
            echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
            return;
        } ?>

        <form name="checkout" method="post" class="checkout woocommerce-checkout"
              action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">
            <div class="form-holder">
                <div class="col left-col">

                    <div class="information-box">
                        <h3><?php _e('Information', 'gfx'); ?></h3>
                        <?php if(is_user_logged_in()) : ?>
                            <?php
                            $user_name = wp_get_current_user()->display_name;
                            $user_email = wp_get_current_user()->user_email;
                            if ($user_name || $user_email) : ?>
                                <div class="text">
                                    <?php _e("Welcome back, "); ?>
                                    <?php if ($user_name) : ?>
                                        <span><?php echo $user_name; ?></span>
                                    <?php endif; ?>
                                    <?php if ($user_email) : ?>
                                        <?php echo $user_email; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>
                        <?php else : ?>
                            <div class="text">
                                <?php _e('Already have an account?', 'gfx'); ?>
                                <a href="<?php echo wp_login_url(); ?>"><?php _e('Log in for a faster checkout experience.', 'gfx'); ?></a>
                            </div>
                        <?php endif; ?>
                    </div>

                    <div class="billing-info-box">
                        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

                        <h3><?php _e('Billing Address', 'gfx'); ?></h3>
                        <div class="subtitle">
                            <p><?php _e('Please select your billing address:', 'gfx'); ?></p>
                        </div>

                        <?php if ($checkout->get_checkout_fields()) : ?>
                            <div id="customer_details">
                                <?php do_action('woocommerce_checkout_billing'); ?>
                            </div>
                            <?php do_action('woocommerce_checkout_after_customer_details'); ?>
                        <?php endif; ?>
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