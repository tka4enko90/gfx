<?php wp_enqueue_style('special_holidays_styles', get_template_directory_uri() . '/static/css/modules/special_holidays/special_holidays.css', '', '', 'all');

    $special_holidays_background = get_sub_field('special_holidays_background');
    $special_holidays_subtitle = get_sub_field('special_holidays_subtitle');
    $special_holidays_title = get_sub_field('special_holidays_title');
    $special_holidays_button = get_sub_field('special_holidays_button');
    $special_holidays_content_type = get_sub_field('special_holidays_content_type');
    $special_holidays_content_type_is_image = $special_holidays_content_type === 'img';
    $special_holidays_content_type_is_video = $special_holidays_content_type === 'video';
    $special_holidays_image_id = get_sub_field('special_holidays_image');
    $special_holidays_video = get_sub_field('special_holidays_video');
    $special_holidays_content_button = get_sub_field('special_holidays_content_button');
?>

<section class="special-holidays" style="background: url('<?php echo $special_holidays_background; ?>') center/cover no-repeat;">
    <div class="container">
        <div class="section-holder">
            <?php if ($special_holidays_subtitle || $special_holidays_title) : ?>
                <div class="content-col">
                    <?php if ($special_holidays_title) : ?>
                        <div class="title">
                            <h1><?php echo $special_holidays_title; ?></h1>
                        </div>
                    <?php endif; ?>
                    <?php if ($special_holidays_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $special_holidays_subtitle; ?>
                        </div>
                    <?php endif; ?>
                    <?php if ($special_holidays_button && $special_holidays_button['url']) : ?>
                        <a href="<?php echo $special_holidays_button['url']; ?>" class="primary-button "
                           target="<?php echo !empty($special_holidays_button['target']) ? $special_holidays_button['target'] : '_self' ?>">
                            <?php echo $special_holidays_button['title']; ?>
                        </a>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <div class="video-col">

                <?php if ( $special_holidays_content_type_is_image && $special_holidays_image_id) : ?>
                    <div class="video-col">
                        <?php echo wp_get_attachment_image( $special_holidays_image_id, 'gfx_medium' ); ?>
                    </div>
                <?php endif; ?>

                <?php if ($special_holidays_content_type_is_video && $special_holidays_video && $special_holidays_video['url']) : ?>
                    <video autoplay="true" loop="true" muted="true">
                        <source src="<?php echo $special_holidays_video['url'] ?>" type="video/mp4">
                    </video>
                <?php endif; ?>

                <?php if ( $special_holidays_content_button && $special_holidays_content_button['url']) : ?>
                    <a href="<?php echo $special_holidays_content_button['url']; ?>" class="secondary-button"
                       target="<?php echo !empty($special_holidays_content_button['target']) ? $special_holidays_content_button['target'] : '_self' ?>">
                        <?php echo $special_holidays_content_button['title']; ?>
                    </a>
                <?php endif; ?>
            </div>

        </div>
    </div>
</section>