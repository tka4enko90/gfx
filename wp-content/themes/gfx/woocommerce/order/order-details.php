<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.6.0
 */

defined('ABSPATH') || exit;

$order = wc_get_order($order_id);

if (!$order) {
    return;
}

$order_items = $order->get_items(apply_filters('woocommerce_purchase_order_item_types', 'line_item'));
$show_purchase_note = $order->has_status(apply_filters('woocommerce_purchase_note_order_statuses', array('completed', 'processing')));
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads = $order->get_downloadable_items();
$show_downloads = $order->has_downloadable_item() && $order->is_download_permitted();
?>
    <div class="my-account-info-block order-details-section">
        <h3><?php _e('Order Details', 'gfx'); ?></h3>

        <div class="order-details-info">
            <?php printf(
            /* translators: 1: order number 2: order date 3: order status */
                esc_html__('Order %1$s was placed on %2$s and is currently %3$s', 'gfx'),
                '<span class="order-number">#' . $order->get_order_number() . '</span>',
                '<span class="order-date">' . wc_format_datetime($order->get_date_created()) . '</span>',
                '<span class="order-status">' . wc_get_order_status_name($order->get_status()) . '.</span>'
            ); ?>
        </div>

        <div class="table-holder">
            <table class="woocommerce-table woocommerce-table--order-details shop_table order_details">

                <thead>
                <tr>
                    <th class="woocommerce-table__product-name product-name"><?php esc_html_e('Product', 'woocommerce'); ?></th>
                    <th class="woocommerce-table__product-table product-total"><?php esc_html_e('Total', 'woocommerce'); ?></th>
                </tr>
                </thead>

                <tbody>
                <?php
                do_action('woocommerce_order_details_before_order_table_items', $order);

                foreach ($order_items as $item_id => $item) {
                    $product = $item->get_product();

                    wc_get_template(
                        'order/order-details-item.php',
                        array(
                            'order' => $order,
                            'item_id' => $item_id,
                            'item' => $item,
                            'show_purchase_note' => $show_purchase_note,
                            'purchase_note' => $product ? $product->get_purchase_note() : '',
                            'product' => $product,
                        )
                    );
                }

                do_action('woocommerce_order_details_after_order_table_items', $order);
                foreach ($order->get_order_item_totals() as $key => $total) : ?>
                    <tr class="total">
                        <td><?php echo esc_html($total['label']); ?></td>
                        <td><?php echo ('payment_method' === $key) ? esc_html($total['value']) : wp_kses_post($total['value']); ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <?php if ($show_downloads) : ?>
            <h3 class="downloads-title"><?php _e('Downloads', 'gfx'); ?></h3>
            <?php wc_get_template(
                'order/order-downloads.php',
                array(
                    'downloads' => $downloads,
                    'show_title' => true,
                )
            );
        endif;

        if ($show_customer_details) :
            wc_get_template('order/order-details-customer.php', array('order' => $order));
        endif; ?>
    </div>
<?php
/**
 * Action hook fired after the order details.
 *
 * @param WC_Order $order Order data.
 * @since 4.4.0
 */
do_action('woocommerce_after_order_details', $order);