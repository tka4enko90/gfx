<?php
$affiliate_tiers_title = get_sub_field('affiliate_tiers_title');
$affiliate_tiers_subtitle = get_sub_field('affiliate_tiers_subtitle');

if ($affiliate_tiers_title || $affiliate_tiers_subtitle || have_rows('affiliate_tiers_tiers')) :
    wp_enqueue_style('affiliate_tiers_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_tiers/affiliate-tiers.css', '', '', 'all'); ?>

    <section class="affiliate-tiers">
        <div class="container">
            <?php if ($affiliate_tiers_title || $affiliate_tiers_subtitle) : ?>
                <div class="titles-holder">
                    <?php if ($affiliate_tiers_title) : ?>
                        <h3><?php echo $affiliate_tiers_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($affiliate_tiers_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $affiliate_tiers_subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif;

            if (have_rows('affiliate_tiers_tiers')) : ?>
                <div class="tiers">
                    <?php while (have_rows('affiliate_tiers_tiers')) : the_row();
                        $icon = get_sub_field('icon');
                        $title = get_sub_field('title');
                        $subtitle = get_sub_field('subtitle'); ?>

                        <div class="tier">
                            <div class="holder">
                                <?php if ($icon) : ?>
                                    <div class="icon">
                                        <?php echo wp_get_attachment_image($icon, 'gfx_semi_small_2'); ?>
                                    </div>
                                <?php endif;

                                if ($title) : ?>
                                    <h4><?php echo $title; ?></h4>
                                <?php endif;

                                if ($subtitle) : ?>
                                    <div class="subtitle">
                                        <?php echo $subtitle; ?>
                                    </div>
                                <?php endif;

                                if (have_rows('what_you_get')) : ?>
                                    <div class="what-you-get">
                                        <span><?php _e('What you get:', 'gfx'); ?></span>
                                        <ul>
                                            <?php while (have_rows('what_you_get')) : the_row();
                                                $text = get_sub_field('text');
                                                if ($text) :?>
                                                    <li>
                                                        <span>></span>
                                                        <?php the_sub_field('text'); ?>
                                                    </li>
                                                <?php endif;
                                            endwhile; ?>
                                        </ul>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>