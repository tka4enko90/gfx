<?php get_header(); ?>

<main class="main">
    <?php
    $category = get_queried_object()->slug;
    if ($category) :
        get_template_part('template-parts/blocks/shop_products_grid/shop-products-grid', '', array('category' => $category));
    endif; ?>
</main>

<?php get_footer(); ?>
