<?php wp_enqueue_style('information_block_styles', get_template_directory_uri() . '/static/css/modules/information_block/information_block.css', '', '', 'all'); ?>

<?php $information_block_title = get_sub_field('information_block_title'); ?>
<?php $information_block_content = get_sub_field('information_block_content'); ?>
<?php $information_block_button = get_sub_field('information_block_button'); ?>
<?php $information_block_image = get_sub_field('information_block_image'); ?>
<?php $information_block_content_position = get_sub_field('information_block_content_position'); ?>

<div class="information-block">
    <div class="container">
        <div class="section-holder <?php if($information_block_content_position) { echo $information_block_content_position; } ?>">
            <?php if ($information_block_title || $information_block_content) : ?>
                <div class="content-holder">
                    <?php if ($information_block_title) : ?>
                        <h3><?php echo $information_block_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($information_block_content) : ?>
                        <div class="block-content">
                            <?php echo $information_block_content; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($information_block_button && $information_block_button['url']) : ?>
                        <a href="<?php echo $information_block_button['url']; ?>" class="primary-button" target="<?php echo $information_block_button['target']; ?>">
                            <?php echo $information_block_button['title']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>
            <?php if ($information_block_image) : ?>
                <div class="image-holder">
                    <img src="<?php echo $information_block_image['url']; ?>" alt="<?php echo $information_block_image['title']; ?>">
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>