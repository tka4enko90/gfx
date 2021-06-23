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

                        <div class="lost-password-link">
                            <a href="<?php echo wp_lostpassword_url(); ?>">Lost your password?</a>
                        </div>

                        <?php $register_page_bottom_text = get_field('register_page_bottom_text'); ?>
                        <?php if ($register_page_bottom_text) : ?>
                            <div class="description-text">
                                <?php echo $register_page_bottom_text; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php $register_page_image = get_field('register_page_image'); ?>
                    <?php if ($register_page_image) : ?>
                        <div class="image-col">
                            <?php echo wp_get_attachment_image($register_page_image, 'gfx_medium_2'); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endwhile; ?>
</main>
<?php get_footer(); ?>
