<?php
/**
 * The Template for displaying all single products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

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