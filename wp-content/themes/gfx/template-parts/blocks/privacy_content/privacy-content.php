<?php if (!empty($args)) :
    if (!empty($args['content'])) :
        $content = $args['content'];
    endif;
    if (isset($content)) :
        wp_enqueue_style('privacy_content_css', get_template_directory_uri() . '/static/css/template-parts/blocks/privacy_content/privacy-content.css', '', '', 'all'); ?>

        <section class="privacy-content">
            <div class="container">
                <div class="content">
                    <?php echo $content; ?>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>