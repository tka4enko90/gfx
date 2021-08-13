<div id="affwp-affiliate-dashboard-creatives" class="affwp-tab-content">
    <div class="container">
        <h3><?php _e('Creatives', 'gfx'); ?></h3>
        <?php if (have_rows('affiliate_creatives', 'option')) : ?>
            <div class="creatives-holder">
                <?php while (have_rows('affiliate_creatives', 'option')) : the_row(); ?>
                    <div class="group">
                        <?php
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle');
                        if (!empty($title) || !empty($subtitle)) { ?>
                            <div class="title-holder">
                                <?php if (!empty($title)) { ?>
                                    <h5><?php echo $title; ?></h5>
                                <?php }
                                if (!empty($subtitle)) { ?>
                                    <div class="subtitle">
                                        <?php echo $subtitle; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php }
                        if (have_rows('images')) : ?>
                            <div class="images-holder">
                                <?php while (have_rows('images')) : the_row();
                                    $image = get_sub_field('image');
                                    if (!empty($image)) { ?>
                                        <div class="image">
                                            <?php echo wp_get_attachment_image($image, 'gfx_semi_medium');; ?>
                                        </div>
                                    <?php }
                                endwhile; ?>
                            </div>
                        <?php endif;
                        $button = get_sub_field('button');
                        if (!empty($button)) { ?>
                            <div class="button-holder">
                                <button class="primary-button"><?php echo $button; ?></button>
                            </div>
                        <?php } ?>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
    </div>
</div>
