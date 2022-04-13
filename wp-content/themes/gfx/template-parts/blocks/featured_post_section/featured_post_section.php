<?php
if (!empty($args)) :
    if (!empty($args['post_id'])) {
        wp_enqueue_style('featured_post_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/featured_post_section/featured_post_section.css', '', '', 'all');
        ?>
        <section class="featured-post">
            <div class="container">
                <div class="section-holder">
                    <div class="image-column aos-init aos-animate" data-aos-duration="1000" data-aos="fade-right">
                        <div class="image-wrap">
                            <?php
                            $post_thumb = !empty($args['custom_image']) ?  wp_get_attachment_image($args['custom_image'], 'full') : get_the_post_thumbnail($args['post_id']);
                            if (!empty($post_thumb)) {
                                echo $post_thumb;
                            }
                            ?>
                        </div>
                    </div>
                    <div class="content-column">
                        <div class="content-wrap">
                            <?php if (!empty($args['section_title'])) { ?>
                                <h4 class="section-heading"><?php echo $args['section_title']; ?></h4>
                                <?php
                            } ?>
                            <span class="post-date">
                            <?php if (!empty($args['custom_date'])) {
                                echo $args['custom_date'];
                            } else { ?>
                                <?php echo get_the_time('Y-m-d', $args['post_id']); ?>
                                <?php
                            } ?>
                        </span>
                            <h2 class="post-title">
                                <?php echo !empty($args['custom_title']) ? $args['custom_title'] : get_the_title($args['post_id']); ?>
                            </h2>
                            <p class="post-excerpt">
                                <?php echo !empty($args['custom_description']) ? $args['custom_description'] : get_the_excerpt($args['post_id']); ?>
                            </p>
                            <a href="<?php echo get_post_permalink($args['post_id']); ?>" class="primary-button"><?php echo __('Read Post', 'gfx'); ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
endif;