<?php
$title = get_sub_field('title');

$fonts_title = get_sub_field('fonts_title');
$fonts_description = get_sub_field('fonts_description');

$colours_title = get_sub_field('colours_title');
$colours_description = get_sub_field('colours_description');

if ($title || $fonts_title || $fonts_description || have_rows('fonts') ||
    $colours_title || $colours_description || have_rows('colours')) {
    wp_enqueue_style('readme_product_information_css', get_template_directory_uri() . '/static/css/template-parts/blocks/readme_product_information/readme-product-information.css', '', '', 'all');
    wp_enqueue_script('readme_product_information_js', get_template_directory_uri() . '/static/js/template-parts/blocks/readme_product_information/readme-product-information.js', '', '', true); ?>

    <section class="readme-product-information">
        <div class="container">
            <div class="section-holder">
                <?php if ($title) { ?>
                    <div class="title">
                        <h3><?php echo $title; ?></h3>
                    </div>
                <?php } ?>

                <div class="cols">
                    <?php if ($fonts_title || $fonts_description || have_rows('fonts')) { ?>
                        <div class="col">
                            <?php if ($fonts_title) { ?>
                                <h5>
                                    <?php echo $fonts_title; ?>
                                </h5>
                            <?php }
                            if ($fonts_description) { ?>
                                <div class="description">
                                    <?php echo $fonts_description; ?>
                                </div>
                            <?php }
                            if (have_rows('fonts')) { ?>
                                <div class="fonts">
                                    <?php while (have_rows('fonts')) : the_row();
                                        $font = get_sub_field('font');
                                        if ($font) { ?>
                                            <a href="<?php echo $font['url']; ?>"
                                               target="<?php echo $font['target']; ?>">
                                                <?php echo $font['title']; ?>
                                            </a>
                                        <?php }
                                    endwhile; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                    if ($colours_title || $colours_description || have_rows('colours')) { ?>
                        <div class="col">
                            <?php if ($colours_title) { ?>
                                <h5>
                                    <?php echo $colours_title; ?>
                                </h5>
                            <?php }
                            if ($colours_description) { ?>
                                <div class="description">
                                    <?php echo $colours_description; ?>
                                </div>
                            <?php }
                            if (have_rows('colours')) { ?>
                                <div class="colours">
                                    <?php while (have_rows('colours')) : the_row();
                                        $name = get_sub_field('name');
                                        $hex_code = get_sub_field('hex_code');

                                        if ($name && $hex_code) { ?>
                                            <div class="colour" style="background-color: <?php echo $hex_code; ?>" data-value="<?php echo $hex_code; ?>">
                                                <div class="name">
                                                    <?php echo $name; ?>
                                                </div>
                                                <div class="code">
                                                    <?php echo $hex_code; ?>
                                                </div>
                                            </div>
                                        <?php }
                                    endwhile; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </section>
<?php } ?>