<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */
defined('ABSPATH') || exit; ?>

<?php $page_id = get_queried_object_id(); ?>

<?php if ($page_id) : ?>
    <?php $page_title = get_the_title($page_id); ?>
    <?php $cart_hero_subtitle = get_field('cart_hero_subtitle', 'option'); ?>
    <?php $cart_hero_image_id = get_field('cart_hero_image', 'option'); ?>
    <?php if ($page_title || $cart_hero_subtitle || $cart_hero_image_id) : ?>
        <?php get_template_part('template-parts/blocks/hero/hero', '', array('title' => $page_title, 'subtitle' => $cart_hero_subtitle, 'image' => $cart_hero_image_id, 'image_size' => 'gfx_wc_hero_large')); ?>
    <?php endif; ?>

    <?php wp_enqueue_style('cart_page_styles', get_template_directory_uri() . '/static/css/page-templates/cart.css', '', '', 'all'); ?>

    <section class="cart-section empty">
        <div class="container">
            <?php $empty_cart_title = get_field('empty_cart_title', 'option'); ?>
            <?php $empty_cart_description = get_field('empty_cart_description', 'option'); ?>

            <?php if ($empty_cart_title) : ?>
                <h3><?php echo $empty_cart_title; ?></h3>
            <?php endif; ?>

            <?php if ($empty_cart_description) : ?>
                <div class="description">
                    <?php echo $empty_cart_description; ?>
                </div>
            <?php endif; ?>

            <?php if (wc_get_page_id('shop') > 0) : ?>
                <div class="return-to-shop">
                    <a class="primary-button arrow-left"
                       href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px"
                             viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;"
                             xml:space="preserve">
                                <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                    C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                    c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                    l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                        </svg>
                        <?php echo esc_html(apply_filters('woocommerce_return_to_shop_text', __('Continue Shopping', 'gfx'))); ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>