<?php if (!empty($args)) : ?>
    <?php if(!empty($args['title'])) : ?>
        <?php $hero_title = $args['title']; ?>
    <?php endif; ?>
    <?php if(!empty($args['subtitle'])) : ?>
        <?php $hero_subtitle = $args['subtitle']; ?>
    <?php endif; ?>
    <?php if(!empty($args['image'])) : ?>
        <?php $hero_image_id = $args['image']; ?>
    <?php endif; ?>
    <?php if(!empty($args['image_size'])) : ?>
        <?php $hero_image_size = $args['image_size']; ?>
    <?php endif; ?>

    <?php if (isset($hero_title) || isset($hero_subtitle) || isset($hero_image_id)) : ?>
        <?php wp_enqueue_style('hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/hero/hero.css', '', '', 'all'); ?>

        <section class="hero-section <?php echo empty($hero_image_id) ? 'no-image' : ''; ?>">
            <div class="container">
                <div class="section-holder">
                    <?php if (isset($hero_title) || isset($hero_subtitle)) : ?>
                        <div class="text-col">
                            <?php if (isset($hero_title)) : ?>
                                <h1><?php echo $hero_title; ?></h1>
                            <?php endif; ?>
                            <?php if (isset($hero_subtitle)) : ?>
                                <div class="subtitle">
                                    <?php echo $hero_subtitle; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                    <?php if (isset($hero_image_id)) : ?>
                        <div class="image-col">
                            <?php if(isset($hero_image_size)) : ?>
                                <?php echo wp_get_attachment_image($hero_image_id, $hero_image_size); ?>
                            <?php else : ?>
                                <?php echo wp_get_attachment_image($hero_image_id, 'gfx_wc_gallery_large'); ?>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>
