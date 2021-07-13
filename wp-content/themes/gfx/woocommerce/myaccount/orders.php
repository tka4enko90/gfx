<?php
/**
 * Orders
 *
 * Shows orders on the account page.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/orders.php.
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

do_action('woocommerce_before_account_orders', $has_orders); ?>

<div class="my-account-info-block orders-section">
    <?php if ($has_orders) : ?>
        <h3><?php _e('Manage Orders', 'gfx'); ?></h3>

        <?php $orders = $customer_orders->orders; ?>
        <?php $orders_per_page = 5; ?>
        <?php $orders_offset = 0; ?>
        <?php $orders_count = count($orders); ?>
        <?php $orders_number_of_pages = $orders_count / $orders_per_page; ?>

        <div class="table-holder">
            <?php get_template_part('woocommerce/order/orders-table', '',
                array(
                    'items' => $orders,
                    'offset' => $orders_offset,
                    'items_per_page' => $orders_per_page,
                )); ?>
        </div>

        <?php $orders_jsons_arr = array(); ?>
        <?php foreach ($orders as $order) : ?>
            <?php $orders_jsons_arr[] = $order->__toString(); ?>
        <?php endforeach; ?>

        <?php if ($orders_number_of_pages > 1) : ?>
            <div class="posts-pagination my-account-orders-pagination"
                 data-items='<?php echo json_encode($orders_jsons_arr); ?>'
                 data-current-page="1"
                 data-last-page="<?php echo ceil($orders_number_of_pages); ?>"
                 data-items-per-page="<?php echo $orders_per_page; ?>">

                <button class="prev page-numbers hidden">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px"
                         y="0px" viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;"
                         xml:space="preserve">
                                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"></path>
                                </svg>
                </button>

                <?php for ($i = 0; $i < $orders_number_of_pages; $i++) : ?>
                    <?php $page_num = $i; ?>
                    <?php ++$page_num; ?>

                    <button class="page-numbers page-number <?php echo $page_num === 1 ? 'current' : '' ?>"><?php echo $page_num; ?></button>
                <?php endfor; ?>
                <button class="next page-numbers">
                    <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                         x="0px"
                         y="0px" viewBox="0 0 492.004 492.004"
                         style="fill:white;enable-background:new 0 0 492.004 492.004;"
                         xml:space="preserve">
                                        <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                            c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                            c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                            c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"></path>
                                </svg>
                </button>
            </div>
        <?php endif; ?>

        <?php do_action('woocommerce_before_account_orders_pagination'); ?>
    <?php else : ?>
        <a class="woocommerce-Button button"
           href="<?php echo esc_url(apply_filters('woocommerce_return_to_shop_redirect', wc_get_page_permalink('shop'))); ?>">
            <?php _e('Browse products', 'gfx'); ?>
        </a>
        <?php _e('No order has been made yet.', 'gfx'); ?>
    <?php endif; ?>
</div>

<?php do_action('woocommerce_after_account_orders', $has_orders); ?>
