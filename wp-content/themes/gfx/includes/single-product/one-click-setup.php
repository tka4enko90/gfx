<?php $one_click_setup_youtube_video_iframe = get_field('one_click_setup_youtube_video_iframe'); ?>
<?php $one_click_setup_title = get_field('one_click_setup_title'); ?>
<?php $one_click_setup_description = get_field('one_click_setup_description'); ?>
<?php $one_click_setup_button_1 = get_field('one_click_setup_button_1'); ?>
<?php $one_click_setup_button_2 = get_field('one_click_setup_button_2'); ?>

<?php if ($one_click_setup_youtube_video_iframe || $one_click_setup_title || $one_click_setup_description || $one_click_setup_button_1 || $one_click_setup_button_2) : ?>
    <section class="single-product-one-click-setup">
        <div class="container">
            <div class="section-holder">
                <?php if ($one_click_setup_youtube_video_iframe) : ?>
                    <div class="video-col">
                        <div class="video-holder">
                            <?php echo $one_click_setup_youtube_video_iframe; ?>
                        </div>
                    </div>
                <?php endif; ?>
                <div class="info-col">
                    <?php if ($one_click_setup_title) : ?>
                        <h3><?php echo $one_click_setup_title; ?></h3>
                    <?php endif; ?>

                    <?php if ($one_click_setup_description) : ?>
                        <div class="description">
                            <?php echo $one_click_setup_description; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ($one_click_setup_button_1['url'] || $one_click_setup_button_2['url']) : ?>
                        <div class="buttons-holder">
                            <?php if ($one_click_setup_button_1['url']) : ?>
                                <a class="primary-button" href="<?php echo $one_click_setup_button_1['url']; ?>"
                                   target="<?php echo $one_click_setup_button_1['target']; ?>">
                                    <?php echo $one_click_setup_button_1['title']; ?>
                                </a>
                            <?php endif; ?>

                            <?php if ($one_click_setup_button_2['url']) : ?>
                                <a class="primary-button" href="<?php echo $one_click_setup_button_2['url']; ?>"
                                   target="<?php echo $one_click_setup_button_2['target']; ?>">
                                    <?php echo $one_click_setup_button_2['title']; ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>