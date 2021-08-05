<?php wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all'); ?>
<?php wp_enqueue_style('testimonials_carousel', get_template_directory_uri() . '/static/css/modules/testimonials_carousel/testimonials_carousel.css', '', '', 'all'); ?>

<?php wp_enqueue_script('slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array('jquery'), '', true); ?>
<?php wp_enqueue_script('testimonials_carousel_js', get_template_directory_uri() . '/static/js/modules/testimonials_carousel/testimonials_carousel.js', array('slick-js'), '', true); ?>

<?php $testimonials_carousel_title = get_sub_field('testimonials_carousel_title'); ?>
<?php $testimonials_carousel_subtitle = get_sub_field('testimonials_carousel_subtitle'); ?>
<?php $testimonials_carousel_testimonials = get_sub_field('testimonials_carousel_testimonials'); ?>

<section class="testimonials-carousel">
    <div class="container">
        <div class="section-holder">
            <?php if ($testimonials_carousel_title) : ?>
                <h3><?php echo $testimonials_carousel_title; ?></h3>
            <?php endif; ?>

            <?php if ($testimonials_carousel_subtitle) : ?>
                <div class="subtitle">
                    <?php echo $testimonials_carousel_subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if ($testimonials_carousel_testimonials) : ?>
                <div class="carousel testimonials-carousel-slider">
                    <?php foreach ($testimonials_carousel_testimonials as $item) : ?>
                        <?php $item_id = $item->ID; ?>

                        <?php if ($item_id) : ?>
                            <?php $subheading = get_field('subheading', $item_id); ?>
                            <?php $body_text = get_field('body_text', $item_id); ?>

                            <div class="item">
                                <div class="info">
                                    <?php if(has_post_thumbnail($item_id)) : ?>
                                        <?php echo get_the_post_thumbnail($item_id, 'gfx_avatar'); ?>
                                    <?php endif; ?>
                                    <div class="holder <?php if(!has_post_thumbnail($item_id)) : ?>full-width<?php endif; ?>">
                                        <div class="title">
                                            <?php echo $item->post_title; ?>
                                        </div>
                                        <?php if (isset($subheading) && $subheading['url']) : ?>
                                            <a class="subheading"
                                               href="<?php echo $subheading['url']; ?>"
                                               target="<?php echo !empty($subheading['target']) ? $subheading['target'] : '_self' ?>">
                                                <?php echo $subheading['title']; ?>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if ($body_text) : ?>
                                    <div class="bodytext">
                                        <?php echo $body_text; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>