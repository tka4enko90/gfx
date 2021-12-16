<?php get_header(); ?>

<?php wp_enqueue_style('register_page_styles', get_template_directory_uri() . '/static/css/page-templates/register.css', '', '', 'all'); ?>

<main class="main">
    <?php
    while (have_posts()) :
        the_post(); ?>
        <section class="login-section">
            <div class="container">
                <div class="section-holder">
                    <div class="form-col">
                        <h1><?php the_title(); ?></h1>

                        <div class="form-holder">
                            <?php the_content(); ?>
                        </div>

                        <?php $register_page_bottom_text = get_field('register_page_bottom_text'); ?>
                        <?php if ($register_page_bottom_text) : ?>
                            <div class="description-text">
                                <?php echo $register_page_bottom_text; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
