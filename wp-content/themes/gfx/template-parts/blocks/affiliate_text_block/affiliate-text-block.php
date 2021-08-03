<?php
$affiliate_text_block_title = get_sub_field('affiliate_text_block_title');
$affiliate_text_block_content = get_sub_field('affiliate_text_block_content');

if ($affiliate_text_block_title || $affiliate_text_block_content) :
    wp_enqueue_style('affiliate_text_block_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_text_block/affiliate-text-block.css', '', '', 'all'); ?>

    <section class="affiliate-text-block">
        <div class="container">
            <?php if ($affiliate_text_block_title) : ?>
                <h3><?php echo $affiliate_text_block_title; ?></h3>
            <?php endif;
            if ($affiliate_text_block_content) : ?>
                <div class="content">
                    <?php echo $affiliate_text_block_content; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>