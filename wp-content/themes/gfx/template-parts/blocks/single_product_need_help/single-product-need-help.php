<?php if (!empty($args['page'])) :
    $page_id = $args['page'];
else :
    $page_id = 'option';
endif;

$need_help_title = get_field('need_help_title', $page_id);
$need_help_description = get_field('need_help_description', $page_id);
$need_help_links_have_rows = have_rows('need_help_links', $page_id);

if ($need_help_title || $need_help_description || $need_help_links_have_rows) :

    wp_enqueue_style('single_product_need_help_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_need_help/single-product-need-help.css', '', '', 'all'); ?>

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

            <?php if (have_rows('need_help_links', $page_id)) : ?>
                <div class="blocks-holder">
                    <?php while (have_rows('need_help_links', $page_id)) : the_row();
                        $icon_id = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $url = get_sub_field('link');
                        $description = get_sub_field('description');
                        if ($url) : ?>
                            <a href="<?php echo $url ?>" class="block">
                                <div class="holder">
                                    <?php if ($icon_id) :
                                        echo wp_get_attachment_image($icon_id, 'gfx_semi_small');
                                    endif; ?>

                                    <?php if ($title) : ?>
                                        <h5><?php echo $title; ?></h5>
                                    <?php endif; ?>

                                    <?php if ($description) : ?>
                                        <div class="description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </a>
                        <?php else : ?>
                            <div class="block">
                                <div class="holder">
                                    <?php if ($icon_id) :
                                        echo wp_get_attachment_image($icon_id, 'gfx_semi_small');
                                    endif; ?>

                                    <?php if ($title) : ?>
                                        <h5><?php echo $title; ?></h5>
                                    <?php endif; ?>

                                    <?php if ($description) : ?>
                                        <div class="description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endif;
                    endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>