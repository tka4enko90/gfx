<?php
if (!empty($args)) :
    if (!empty($args['post_id'])) {
        wp_enqueue_style('featured_post_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/featured_post_section/featured_post_section.css', '', '', 'all');
        ?>
        <section class="featured-post">
            <div class="container">
                <div class="section-holder">
                    <div class="image-column aos-init aos-animate" data-aos-duration="1000" data-aos="fade-right">
                        <?php if (!empty($args['custom_image'])) {
                            echo wp_get_attachment_image($args['custom_image'], 'full');
                        } else {
                            $post_thumb = get_the_post_thumbnail($args['post_id']);
                            if (!empty($post_thumb)) {
                                echo $post_thumb;
                            }
                        } ?>
                    </div>
                    <div class="content-column">
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
                            <?php if (!empty($args['custom_title'])) {
                                echo $args['custom_title'];
                            } else {
                                echo get_the_title($args['post_id']);
                            } ?>
                        </h2>
                        <p class="post-excerpt">
                            <?php if (!empty($args['custom_description'])) {
                                echo $args['custom_description'];
                            } else {
                                echo get_the_excerpt($args['post_id']);
                            } ?>
                        </p>
                        <a href="<?php echo get_post_permalink($args['post_id']); ?>" class="primary-button">Read Post</a>
                    </div>
                </div>
            </div>
        </section>
        <?php
    }
endif;