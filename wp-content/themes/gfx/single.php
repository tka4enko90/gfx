<?php get_header(); ?>

    <main class="main">
        <?php while (have_posts()) :
            the_post();
            get_template_part('template-parts/pages/single/content-single');
        endwhile; ?>
    </main>

<?php get_footer(); ?>