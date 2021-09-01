<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
get_header(); ?>

    <main class="main">
        <section>
            <div class="container">
                <?php
                while (have_posts()) :
                    the_post();

                    the_content();
                endwhile;
                ?>
            </div>
        </section>
    </main>

<?php get_footer(); ?>