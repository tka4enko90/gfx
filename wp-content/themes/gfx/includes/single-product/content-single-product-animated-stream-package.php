<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

wp_enqueue_style('single_product_page_styles', get_template_directory_uri() . '/static/css/page-templates/single-product.css', '', '', 'all');

defined('ABSPATH') || exit;

global $product;
$product_id = get_the_ID();

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <?php if ($product_id) : ?>
        <?php include_once('hero.php');

        include_once('complete-package.php');

        if (isset($product) && $product instanceof WC_Product) :
            if ($product->get_type() == 'woosb') :
                $bundled_items = $product->get_items();
                if (isset($bundled_items) && !empty($bundled_items)) :
                    include_once('also-from-this-package.php');
                endif;
            endif;
        endif;
    endif;

    include_once('one-click-setup.php');

    if (function_exists('woocommerce_output_related_products')) :
        woocommerce_output_related_products();
    endif;

    include_once('need-help.php'); ?>
</div>