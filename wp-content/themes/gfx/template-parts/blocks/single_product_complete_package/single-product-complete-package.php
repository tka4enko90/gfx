<?php $complete_package_title = get_field('complete_package_title'); ?>
<?php $complete_package_description = get_field('complete_package_description'); ?>

<?php if ($complete_package_title || $complete_package_description || have_rows('complete_package_blocks')) : ?>
    <?php wp_enqueue_style('single_product_complete_package_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_complete_package/single-product-complete-package.css', '', '', 'all'); ?>

    <section class="single-product-complete-package">
        <div class="container">
            <div class="section-holder">
                <?php if ($complete_package_title || $complete_package_description) : ?>
                    <div class="left-col <?php if (!have_rows('complete_package_blocks')) : ?>full-width<?php endif; ?>">
                        <div class="red-text">
                            <?php _e( 'You’ve selected the...', 'gfx' ); ?>
                        </div>

                        <?php if ($complete_package_title) : ?>
                            <div class="title">
                                <?php echo $complete_package_title; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($complete_package_description) : ?>
                            <div class="complete_package_description">
                                <?php echo $complete_package_description; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if (have_rows('complete_package_blocks')) : ?>
                    <div class="right-col <?php if (!$complete_package_title && !$complete_package_description) : ?>full-width<?php endif; ?>">
                        <?php while (have_rows('complete_package_blocks')) : the_row(); ?>
                            <?php $icon_id = get_sub_field('icon'); ?>
                            <?php $title = get_sub_field('title'); ?>
                            <?php $description = get_sub_field('description'); ?>
                            <?php $show_compatible_with_elements = get_sub_field('show_compatible_with_elements'); ?>

                            <div class="item">
                                <?php if ($icon_id) : ?>
                                    <div class="icon-holder">
                                        <?php echo wp_get_attachment_image($icon_id, 'full'); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="info-holder">
                                    <?php if ($title) : ?>
                                        <div class="name">
                                            <?php echo $title; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($show_compatible_with_elements && have_rows('compatible_with')) : ?>
                                        <div class="compatible-items">
                                            <?php while (have_rows('compatible_with')) : the_row(); ?>
                                                <div class="item">
                                                    <?php if (get_sub_field('icon')) { ?>
                                                        <img src="<?php the_sub_field('icon'); ?>"/>
                                                    <?php } ?>
                                                </div>
                                            <?php endwhile; ?>
                                        </div>
                                    <?php endif; ?>
                                    <?php if ($description) : ?>
                                        <div class="description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>