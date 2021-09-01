<?php if (have_rows('assets')) { ?>
    <?php wp_enqueue_style('download_assets_css', get_template_directory_uri() . '/static/css/template-parts/blocks/download_assets/download-assets.css', '', '', 'all'); ?>

    <section class="download-assets">
        <div class="container">
            <?php
            if (have_rows('assets')) {
                while (have_rows('assets')) {
                    the_row(); ?>
                    <div class="assets-group">
                        <?php
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                        $images_or_colors = get_sub_field('images_or_colors');
                        $file_url = get_sub_field('file_url');

                        if (!empty($title) || !empty($subtitle)) { ?>
                            <div class="title-holder">
                                <?php if (!empty($title)) { ?>
                                    <h3><?php echo $title; ?></h3>
                                <?php }
                                if (!empty($subtitle)) { ?>
                                    <div class="subtitle">
                                        <?php echo $subtitle; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                        if (!$images_or_colors && have_rows('images')) : ?>
                            <div class="images-holder">
                                <?php while (have_rows('images')) {
                                    the_row();
                                    $image = get_sub_field('image');
                                    if (!empty($image)) { ?>
                                        <div class="image">
                                            <?php echo wp_get_attachment_image($image, 'gfx_semi_medium');; ?>
                                        </div>
                                    <?php }
                                } ?>
                            </div>
                        <?php endif;
                        $button = get_sub_field('button');
                        if (!$images_or_colors && !empty($button) && !empty($file_url)) { ?>
                            <div class="button-holder">
                                <a href="<?php echo $file_url; ?>" class="primary-button"><?php echo $button; ?></a>
                            </div>
                        <?php }
                        if ($images_or_colors && have_rows('colors')) { ?>
                            <div class="colors-holder">
                                <?php while (have_rows('colors')) : the_row();
                                    $color_hex_code = get_sub_field('color_hex_code');
                                    $color_name = get_sub_field('color_name');

                                    if ($color_hex_code || $color_name) { ?>
                                        <div class="color" <?php echo $color_hex_code ? 'style="background-color:' . $color_hex_code . '"' : ''; ?>>
                                            <div class="color-info">
                                                <?php if ($color_name) { ?>
                                                    <div class="name">
                                                        <?php echo $color_name; ?>
                                                    </div>
                                                <?php }
                                                if ($color_hex_code) { ?>
                                                    <div class="code">
                                                        <?php echo $color_hex_code; ?>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                    <?php } ?>
                                <?php endwhile; ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php }
            } ?>
        </div>
    </section>
<?php } ?>