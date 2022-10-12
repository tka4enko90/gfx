<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */
?>
<?php get_header(); ?>

<main class="main">
    <?php
    if (is_shop() && function_exists('wc_get_page_id')) :
        $page_id = wc_get_page_id('shop');

        if ($page_id) :
            $shop_hero_title = get_field('shop_hero_title', $page_id);
            $shop_hero_subtitle = get_field('shop_hero_subtitle', $page_id);
            $shop_hero_image = get_field('shop_hero_image', $page_id);

            if ($shop_hero_title || $shop_hero_subtitle || $shop_hero_image) :
                get_template_part('template-parts/blocks/hero/hero', '', array('title' => $shop_hero_title, 'subtitle' => $shop_hero_subtitle, 'image' => $shop_hero_image, 'image_size' => 'gfx_wc_hero_large'));
            endif;

            get_template_part('template-parts/blocks/shop_products_grid/shop-products-grid');
        endif;
    endif; ?>
</main>

<?php get_footer(); ?>
