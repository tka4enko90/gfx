<?php /* Template Name: Resources Page */; ?>
<?php get_header(); ?>
    <main class="main">
        <?php $page_id = get_queried_object_id(); ?>
        <?php if ($page_id) : ?>
            <?php $page_title = __('Tutorials', 'gfx'); ?>
            <?php $resources_hero_subtitle = get_field('resources_hero_subtitle', $page_id); ?>

            <?php if (isset($page_title) || isset($support_hero_subtitle)) : ?>
                <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $resources_hero_subtitle, 'search_type' => 'tutorial')); ?>
            <?php endif; ?>
        <?php endif; ?>

        <?php get_template_part('template-parts/blocks/posts_grid/posts-grid', '', array('post_type' => 'tutorial')); ?>
    </main>
<?php get_footer(); ?>