<?php
$readme_product = get_field('readme_product');

$subtitle = get_sub_field('subtitle');
$description = get_sub_field('description');

if ($readme_product || $subtitle || $description) {
    wp_enqueue_style('readme_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/readme_hero/readme-hero.css', '', '', 'all'); ?>

    <section class="readme-hero">
        <div class="container">
            <div class="section-holder">
                <div class="info-col">
                    <h3><?php the_title(); ?></h3>
                    <?php if ($subtitle) { ?>
                        <div class="subtitle">
                            <?php echo $subtitle ?>
                        </div>
                    <?php }
                    if ($description) { ?>
                        <div class="description">
                            <?php echo $description; ?>
                        </div>
                    <?php } ?>
                    <div class="buttons-holder">
                        <a href="#"
                           class="secondary-button scroll-down-link"><?php _e('Get Started', 'gfx'); ?></a>

                        <?php if ($readme_product) { ?>
                            <a href="<?php echo get_permalink($readme_product); ?>" class="primary-button">
                                <?php _e('Buy Now', 'gfx'); ?>
                            </a>
                        <?php } ?>
                    </div>
                </div>
                <?php if ($readme_product && has_post_thumbnail($readme_product)) { ?>
                    <div class="image-col">
                        <a href="<?php echo get_permalink($readme_product); ?>">
                            <?php echo get_the_post_thumbnail($readme_product, 'gfx_medium'); ?>
                        </a>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>
<?php } ?>