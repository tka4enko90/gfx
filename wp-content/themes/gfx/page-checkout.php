<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
get_header(); ?>

    <main class="main">
        <?php
        wp_enqueue_style('checkout_page_styles', get_template_directory_uri() . '/static/css/page-templates/checkout.css', '', '', 'all');

        $hero_title = get_the_title();
        $checkout_hero_subtitle = get_field('checkout_hero_subtitle', 'option');

        if ($hero_title || $checkout_hero_subtitle) :
            get_template_part('template-parts/blocks/hero/hero', '', array('title' => $hero_title, 'subtitle' => $checkout_hero_subtitle));
        endif;

        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>

<?php get_footer(); ?>