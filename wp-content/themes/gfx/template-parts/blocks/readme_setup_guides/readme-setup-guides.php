<?php
$title = get_sub_field('title');
$subtitle = get_sub_field('subtitle');

if (have_rows('blocks') || $title || $subtitle) {
    wp_enqueue_style('readme_setup_guides_css', get_template_directory_uri() . '/static/css/template-parts/blocks/readme_setup_guides/readme-setup-guides.css', '', '', 'all'); ?>

    <section class="readme-setup-guides">
        <div class="container">
            <div class="section-holder">
                <?php if ($title || $subtitle) { ?>
                    <div class="title-holder">
                        <?php if ($title) { ?>
                            <h3><?php echo $title; ?></h3>
                        <?php }
                        if ($subtitle) { ?>
                            <div class="subtitle">
                                <?php echo $subtitle; ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
                if (have_rows('blocks')) { ?>
                    <div class="blocks">
                        <?php while (have_rows('blocks')) : the_row(); ?>
                            <div class="block">
                                <div class="holder">
                                    <?php
                                    $icon = get_sub_field('icon');
                                    $title = get_sub_field('title');
                                    $description = get_sub_field('description');
                                    if ($icon) { ?>
                                        <div class="icon">
                                            <?php echo wp_get_attachment_image($icon, 'gfx_semi_small_2'); ?>
                                        </div>
                                    <?php }
                                    if ($title) { ?>
                                        <h5>
                                            <?php echo $title; ?>
                                        </h5>
                                    <?php }
                                    if ($description) { ?>
                                        <div class="description">
                                            <?php echo $description; ?>
                                        </div>
                                    <?php } ?>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>