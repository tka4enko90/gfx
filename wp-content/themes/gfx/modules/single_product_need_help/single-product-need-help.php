<?php $need_help_title = get_field('need_help_title', 'option'); ?>
<?php $need_help_description = get_field('need_help_description', 'option'); ?>

<?php if ($need_help_title || $need_help_description || have_rows('need_help_links', 'option')) : ?>

    <?php wp_enqueue_style('single_product_need_help_css', get_template_directory_uri() . '/static/css/modules/single_product_need_help/single-product-need-help.css', '', '', 'all'); ?>

    <section class="single-product-need-help">
        <div class="container">
            <div class="title-holder">
                <?php if ($need_help_title) : ?>
                    <h3><?php echo $need_help_title; ?></h3>
                <?php endif; ?>

                <?php if ($need_help_description) : ?>
                    <div class="description">
                        <?php echo $need_help_description; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>

        <?php if (have_rows('need_help_links', 'option')) : ?>
            <div class="container blocks-container">
                <div class="blocks-holder">
                    <?php while (have_rows('need_help_links', 'option')) : the_row(); ?>
                        <?php $icon_id = get_sub_field('icon'); ?>
                        <?php $title = get_sub_field('title'); ?>
                        <?php $url = get_sub_field('url'); ?>
                        <?php $description = get_sub_field('description'); ?>

                        <a href="<?php if ($url) {
                            echo $url;
                        } ?>" class="block">
                            <div class="holder">
                                <?php if ($icon_id) : ?>
                                    <?php echo wp_get_attachment_image($icon_id, 'gfx_semi_small'); ?>
                                <?php endif; ?>

                                <?php if ($title) : ?>
                                    <h5><?php the_sub_field('title'); ?></h5>
                                <?php endif; ?>

                                <?php if ($description) : ?>
                                    <div class="description">
                                        <?php the_sub_field('description'); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    <?php endwhile; ?>
                </div>
            </div>
        <?php endif; ?>
    </section>
<?php endif; ?>