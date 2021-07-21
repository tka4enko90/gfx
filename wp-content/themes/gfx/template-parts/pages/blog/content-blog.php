<?php $page_id = get_queried_object_id(); ?>
<?php if ($page_id) : ?>
    <?php $page_title = get_the_title($page_id); ?>
    <?php $blog_hero_subtitle = get_field('blog_hero_subtitle', $page_id); ?>

    <?php if ($page_title || $blog_hero_subtitle) : ?>
        <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $blog_hero_subtitle)); ?>
    <?php endif; ?>
<?php endif; ?>

<?php if (have_posts()) : ?>
    <?php get_template_part('template-parts/blocks/posts_grid/posts-grid'); ?>
<?php endif; ?>