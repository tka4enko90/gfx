<?php get_header(); ?>

    <main class="main">
        <?php
        $blog_page_id = get_page_by_title('Blog')->ID;
        $page_title = __('Blog', 'gfx');
        $blog_hero_subtitle = get_field('blog_hero_subtitle', $blog_page_id);

        if ($page_title || $blog_hero_subtitle) :
            get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $blog_hero_subtitle));
        endif;

        while (have_posts()) :
            the_post();
            get_template_part('template-parts/pages/single/content-single');
        endwhile; ?>
    </main>

<?php get_footer(); ?>