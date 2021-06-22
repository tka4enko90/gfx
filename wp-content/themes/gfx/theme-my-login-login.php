<?php get_header(); ?>
    <main class="main">
        <?php
        while (have_posts()) :
            the_post(); ?>
            <section class="login-section">
                <div class="container">
                    <?php the_content(); ?>
                </div>
            </section>
        <?php endwhile; ?>
    </main>
<?php get_footer(); ?>