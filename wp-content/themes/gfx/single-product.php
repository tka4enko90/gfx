<?php
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

get_header(); ?>

    <main class="main">
        <?php while (have_posts()) : ?>
            <?php the_post(); ?>

            <?php $product_id = get_the_ID();
            if ($product_id) :
                if (has_term('animated-stream-package', 'product_cat', $product_id)) :
                    get_template_part('template-parts/pages/single-product/content-single-product-package');
                else :
                    get_template_part('template-parts/pages/single-product/content-single-product');
                endif;
            endif; ?>

        <?php endwhile; ?>
    </main>

<?php get_footer(); ?>