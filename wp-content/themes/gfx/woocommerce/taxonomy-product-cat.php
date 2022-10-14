<?php
/**
 * The Template for displaying products in a product category. Simply includes the archive template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/taxonomy-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     4.7.0
 */
?>


<?php get_header(); ?>

<main class="main">
    <?php
    $current_category = get_queried_object();

    if($current_category) {
        $cat_name = $current_category->name;
        $cat_description = $current_category->description;
        $current_category_id = $current_category->term_id;

        get_template_part('template-parts/blocks/hero/hero', '',
            array(
                'title' => $cat_name,
                'subtitle' => $cat_description
            )
        );
    }

    get_template_part('template-parts/blocks/shop_products_grid/shop-products-grid'); ?>
</main>

<?php get_footer(); ?>
