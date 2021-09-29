<?php if (!empty($args)) :
    if (!empty($args['content'])) :
        $content = $args['content'];
    endif;
    if (isset($content)) : ?>
        <section class="privacy-content">
            <div class="container">
                <div class="content">
                    <?php echo $content; ?>
                </div>
            </div>
        </section>
    <?php endif;
endif; ?>