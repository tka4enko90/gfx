<?php
/**
 * Cart Page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.8.0
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

    <section class="cart-section">
        <div class="container">
            <?php do_action('woocommerce_before_cart'); ?>
            <form class="woocommerce-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
                <div class="section-holder">
                    <div class="cart-col">
                        <div class="table-holder">
                            <?php do_action('woocommerce_before_cart_table'); ?>
                            <table class="shop_table shop_table_responsive cart woocommerce-cart-form__contents">
                                <thead>
                                    <tr>
                                        <th class="product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                                        <th></th>
                                        <th class="product-price"><?php esc_html_e('Price', 'woocommerce'); ?></th>
                                        <th class="product-remove">&nbsp;</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php do_action('woocommerce_before_cart_contents'); ?>
                                <?php foreach (WC()->cart->get_cart() as $cart_item_key => $cart_item) :
                                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                        $product_permalink = apply_filters('woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink($cart_item) : '', $cart_item, $cart_item_key);
                                        ?>
                                        <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                            <td class="product-thumbnail">
                                                <?php
                                                $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key);

                                                if (!$product_permalink) {
                                                    echo $thumbnail; // PHPCS: XSS ok.
                                                } else {
                                                    printf('<a href="%s">%s</a>', esc_url($product_permalink), $thumbnail); // PHPCS: XSS ok.
                                                }
                                                ?>
                                            </td>

                                            <td class="product-name"
                                                data-title="<?php esc_attr_e('Product', 'woocommerce'); ?>">
                                                <?php
                                                if (!$product_permalink) {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key) . '&nbsp;');
                                                } else {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', esc_url($product_permalink), $_product->get_name()), $cart_item, $cart_item_key));
                                                }

                                                do_action('woocommerce_after_cart_item_name', $cart_item, $cart_item_key);

                                                // Meta data.
                                                echo wc_get_formatted_cart_item_data($cart_item); // PHPCS: XSS ok.

                                                // Backorder notification.
                                                if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) {
                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_backorder_notification', '<p class="backorder_notification">' . esc_html__('Available on backorder', 'woocommerce') . '</p>', $product_id));
                                                }
                                                ?>
                                            </td>

                                            <td class="product-price"
                                                data-title="<?php esc_attr_e('Price', 'woocommerce'); ?>">
                                                <?php
                                                echo apply_filters('woocommerce_cart_item_price', WC()->cart->get_product_price($_product), $cart_item, $cart_item_key); // PHPCS: XSS ok.
                                                ?>
                                            </td>

                                            <td class="product-remove">
                                                <?php
                                                echo apply_filters( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
                                                    'woocommerce_cart_item_remove_link',
                                                    sprintf(
                                                        '<a href="%s" class="remove" aria-label="%s" data-product_id="%s" data-product_sku="%s"><svg style="fill:#969fad" enable-background="new 0 0 386.667 386.667" height="512" viewBox="0 0 386.667 386.667" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/></svg></a>',
                                                        esc_url(wc_get_cart_remove_url($cart_item_key)),
                                                        esc_html__('Remove this item', 'woocommerce'),
                                                        esc_attr($product_id),
                                                        esc_attr($_product->get_sku())
                                                    ),
                                                    $cart_item_key
                                                );
                                                ?>
                                            </td>
                                        </tr>
                                    <?php } endforeach; ?>
                                <?php do_action('woocommerce_cart_contents'); ?>
                                <?php do_action('woocommerce_after_cart_contents'); ?>
                                </tbody>
                            </table>
                            <?php do_action('woocommerce_after_cart_table'); ?>
                        </div>
                        <div class="buttons-holder">
                            <a href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>"
                               class="secondary-button grey arrow-left">
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px"
                                     viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;"
                                     xml:space="preserve">
                                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                                </svg>
                                <?php _e('Continue Shopping', 'gfx'); ?>
                            </a>
                            <button type="submit" class="primary-button" name="update_cart">
                                <?php _e('Update cart', 'gfx'); ?>
                            </button>
                        </div>
                    </div>

                    <?php do_action('woocommerce_before_cart_collaterals'); ?>
                    <div class="cart-collaterals">
                        <?php
                        /**
                         * Cart collaterals hook.
                         *
                         * @hooked woocommerce_cross_sell_display
                         * @hooked woocommerce_cart_totals - 10
                         */
                        do_action('woocommerce_cart_collaterals');
                        ?>

                        <?php if (wc_coupons_enabled()) : ?>
                            <div class="coupon">
                                <label for="coupon_code"><?php _e('Apply a Coupon', 'gfx'); ?></label>

                                <div class="holder">
                                    <input type="text" name="coupon_code" class="input-text" id="coupon_code" value=""
                                           placeholder="<?php _e('Coupon code', 'gfx'); ?>"/>
                                    <button type="submit" class="primary-button small blue" name="apply_coupon"
                                            value="<?php _e('Apply', 'gfx'); ?>">
                                        <?php _e('Apply', 'gfx'); ?>
                                    </button>
                                </div>
                                <?php do_action('woocommerce_cart_coupon'); ?>
                            </div>
                        <?php endif; ?>
                        <?php do_action('woocommerce_cart_actions'); ?>
                        <?php wp_nonce_field('woocommerce-cart', 'woocommerce-cart-nonce'); ?>
                    </div>
                </div>
            </form>
            <?php do_action('woocommerce_after_cart'); ?>
        </div>
    </section>
<?php endif; ?>




