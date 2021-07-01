<?php $post_id = get_the_ID(); ?>
<?php if ($post_id) : ?>
    <?php $post_content = get_the_content(); ?>
    <?php $post_image = get_the_post_thumbnail($post_id, 'gfx_wc_gallery_large'); ?>
    <?php if ($post_image || $post_content) : ?>
        <?php wp_enqueue_style('single_post_content_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_post_content/single-post-content.css', '', '', 'all'); ?>
        <section class="single-post-content">
            <div class="container small">
                <div class="section-holder">
                    <?php if ($post_image) : ?>
                        <div class="thumbnail">
                            <?php echo $post_image; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($post_content) : ?>
                        <div class="content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>