<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.7.0
 */

defined('ABSPATH') || exit;

wp_enqueue_style('my_account_page_styles', get_template_directory_uri() . '/static/css/page-templates/my-account.css', '', '', 'all');
wp_enqueue_style('thank_you_page_styles', get_template_directory_uri() . '/static/css/page-templates/thank-you.css', '', '', 'all');
?>

<div class="woocommerce-order">
    <?php
    if ($order) :
        do_action('woocommerce_before_thankyou', $order->get_id());

        if ($order->has_status('failed')) :
            $hero_title = __('Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'gfx');
            $hero_subtitle = '';
        else :
            $hero_title = get_field('thank_you_title', 'option');
            $hero_subtitle = get_field('thank_you_subtitle', 'option');
        endif;

        if ($hero_title || $hero_subtitle) :
            get_template_part('template-parts/blocks/hero/hero', '', array('title' => $hero_title, 'subtitle' => $hero_subtitle));
        endif;

        if ($order->has_status('failed')) : ?>
            <p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
                <a href="<?php echo esc_url($order->get_checkout_payment_url()); ?>"
                   class="button pay"><?php esc_html_e('Pay', 'gfx'); ?></a>
                <?php if (is_user_logged_in()) : ?>
                    <a href="<?php echo esc_url(wc_get_page_permalink('myaccount')); ?>"
                       class="button pay"><?php esc_html_e('My account', 'gfx'); ?></a>
                <?php endif; ?>
            </p>
        <?php else : ?>
            <section class="thank-you-section">
                <div class="container">
                    <div class="section-holder">
                        <div class="order-info">
                            <h3><?php _e('Order Completed', 'gfx'); ?></h3>
                            <ul class="woocommerce-order-overview woocommerce-thankyou-order-details order_details">

                                <li class="woocommerce-order-overview__order order">
                                    <?php esc_html_e('Order number:', 'woocommerce'); ?>
                                    <span><?php echo $order->get_order_number(); ?></span>
                                </li>
                                <li class="woocommerce-order-overview__date date">
                                    <?php esc_html_e('Date:', 'woocommerce'); ?>
                                    <span><?php echo wc_format_datetime($order->get_date_created()); ?></span>
                                </li>
                                <li class="woocommerce-order-overview__total total">
                                    <?php esc_html_e('Total:', 'woocommerce'); ?>
                                    <?php echo $order->get_formatted_order_total(); ?>
                                </li>
                            </ul>
                        </div>

                        <?php do_action('woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id()); ?>
                        <?php do_action('woocommerce_thankyou', $order->get_id()); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php else :
        $hero_title = __('Thank you. Your order has been received.', 'gfx');
        $hero_subtitle = '';

        if ($hero_title || $hero_subtitle) :
            get_template_part('template-parts/blocks/hero/hero', '', array('title' => $hero_title, 'subtitle' => $hero_subtitle));
        endif;
    endif; ?>
</div>
