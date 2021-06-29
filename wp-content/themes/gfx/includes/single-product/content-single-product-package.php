<?php
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
        <?php
        get_template_part('template-parts/blocks/single_product_hero/single-product-hero', '', ['product_id' => $product_id]);
        get_template_part('template-parts/blocks/single_product_product_info/single-product-product-info', '', ['product' => $product]);
        get_template_part('template-parts/blocks/single_product_complete_package/single-product-complete-package');
        get_template_part('template-parts/blocks/single_product_also_from_this_package/single-product-also-from-this-package', '', ['product' => $product]);
        get_template_part('template-parts/blocks/single_product_one_click_setup/single-product-one-click-setup');

        if (function_exists('woocommerce_output_related_products')) :
            woocommerce_output_related_products();
        endif;

        get_template_part('template-parts/blocks/single_product_need_help/single-product-need-help');
    endif; ?>
</div>