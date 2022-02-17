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
