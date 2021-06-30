<?php get_template_part( 'template-parts/blocks/blog_hero/blog-hero' ); ?>

<?php if (have_posts()) : ?>
    <?php get_template_part( 'template-parts/blocks/blog_posts_grid/blog-posts-grid' ); ?>
<?php endif; ?>