<?php wp_enqueue_style('join_server_styles', get_template_directory_uri() . '/static/css/modules/join_server/join_server.css', '', '', 'all'); ?>

<?php $join_server_image_id = get_sub_field('join_server_image'); ?>
<?php $join_server_title = get_sub_field('join_server_title'); ?>
<?php $join_server_subtitle = get_sub_field('join_server_subtitle'); ?>
<?php $join_server_button = get_sub_field('join_server_button'); ?>

<section class="join-server">
    <div class="container">
        <div class="section-holder">

            <?php if ($join_server_image_id) : ?>
                <div class="icon">
                    <?php echo wp_get_attachment_image( $join_server_image_id, 'gfx_small' ); ?>
                </div>
            <?php endif; ?>

            <?php if ($join_server_title) : ?>
                <h3><?php echo $join_server_title; ?></h3>
            <?php endif; ?>

            <?php if ($join_server_subtitle) : ?>
                <div class="subtitle">
                    <?php echo $join_server_subtitle; ?>
                </div>
            <?php endif; ?>

            <?php if ($join_server_button && $join_server_button['url']) : ?>
                <div class="btn-holder">
                    <a href="<?php echo $join_server_button['url']; ?>" class="primary-button "
                       target="<?php echo $join_server_button['target']; ?>"><?php echo $join_server_button['title']; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>