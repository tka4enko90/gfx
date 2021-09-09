<?php if (!empty($args)) :
    if (!empty($args['css_class'])) :
        $css_class = $args['css_class'];
    endif;
    if (!empty($args['title'])) :
        $hero_title = $args['title'];
    endif;
    if (!empty($args['subtitle'])) :
        $hero_subtitle = $args['subtitle'];
    endif;
    if (!empty($args['image'])) :
        $hero_image_id = $args['image'];
    endif;
    if (!empty($args['image_size'])) :
        $hero_image_size = $args['image_size'];
    endif;
    if (!empty($args['buttons'])) :
        $hero_buttons = $args['buttons'];
    endif;
    if (!empty($args['button'])) :
        $hero_button = $args['button'];
    endif;
    if (!empty($args['file'])) :
        $hero_file = $args['file'];
    endif;

    if (isset($hero_title) || isset($hero_subtitle) || isset($hero_image_id)) :
        wp_enqueue_style('hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/hero/hero.css', '', '', 'all'); ?>

        <section
                class="hero-section <?php echo empty($hero_image_id) ? 'no-image' : ''; ?> <?php echo isset($css_class) ? $css_class : ''; ?>">
            <div class="container">
                <div class="section-holder">
                    <?php if (isset($hero_title) || isset($hero_subtitle)) : ?>
                        <div class="text-col">
                            <?php if (isset($hero_title)) :
                                if (isset($css_class) && $css_class === 'join') : ?>
                                    <h3><?php echo $hero_title; ?></h3>
                                <?php else : ?>
                                    <h1><?php echo $hero_title; ?></h1>
                                <?php endif;
                            endif;
                            if (isset($hero_subtitle)) : ?>
                                <div class="subtitle">
                                    <?php echo $hero_subtitle; ?>
                                </div>
                            <?php endif;
                            if (!empty($hero_buttons)) : ?>
                                <div class="buttons-holder">
                                    <?php foreach ($hero_buttons as $key => $button) :
                                        $btn = $button['button'];
                                        $smooth_scroll_to_section = $button['smooth_scroll_to_section']; ?>

                                        <a href="<?php echo $btn['url']; ?>"
                                           target="<?php echo $btn['target']; ?>"
                                           class="<?php echo $key === 0 ? 'primary-button' : 'secondary-button'; echo $smooth_scroll_to_section ? ' scroll-to-anchor' : ''; ?>">
                                            <?php echo $btn['title']; ?>
                                        </a>
                                    <?php endforeach; ?>
                                </div>
                            <?php endif;
                            if (!empty($hero_button) && !empty($hero_file)) : ?>
                                <div class="download-button-holder">
                                    <a href="<?php echo $hero_file; ?>"
                                       class="primary-button"><?php echo $hero_button; ?></a>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endif;
                    if (isset($hero_image_id)) : ?>
                        <div class="image-col">
                            <?php if (isset($hero_image_size)) :
                                echo wp_get_attachment_image($hero_image_id, $hero_image_size);
                            else :
                                echo wp_get_attachment_image($hero_image_id, 'gfx_wc_gallery_large');
                            endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>
