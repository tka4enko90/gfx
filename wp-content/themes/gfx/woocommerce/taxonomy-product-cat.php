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
