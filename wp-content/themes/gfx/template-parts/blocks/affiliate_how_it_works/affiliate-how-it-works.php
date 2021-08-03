<?php
$how_it_works_title = get_sub_field('how_it_works_title');
$how_it_works_subtitle = get_sub_field('how_it_works_subtitle');

if ($how_it_works_title || $how_it_works_subtitle || have_rows('how_it_works_blocks')) :

    wp_enqueue_style('affiliate_how_it_works_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_how_it_works/affiliate-how-it-works.css', '', '', 'all'); ?>

    <section class="how-it-works">
        <div class="container">
            <?php if ($how_it_works_title || $how_it_works_subtitle) : ?>
                <div class="titles-holder">
                    <?php if ($how_it_works_title) : ?>
                        <h3><?php echo $how_it_works_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($how_it_works_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $how_it_works_subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif;

            if (have_rows('how_it_works_blocks')) : ?>
                <div class="blocks">
                    <?php $i = 1;
                    while (have_rows('how_it_works_blocks')) : the_row();
                        $title = get_sub_field('title');
                        $description = get_sub_field('description'); ?>
                        <div class="block">
                            <div class="holder">
                                <div class="number">
                                    <?php echo $i; ?>
                                </div>
                                <?php if ($title) : ?>
                                    <h5><?php echo $title; ?></h5>
                                <?php endif;
                                if ($description) : ?>
                                    <div class="description">
                                        <?php echo $description; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <?php $i++; endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>