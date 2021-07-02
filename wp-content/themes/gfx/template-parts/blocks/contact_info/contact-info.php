<?php $contact_form_title = get_field('contact_form_title'); ?>
<?php $contact_form_shortcode = get_field('contact_form_shortcode'); ?>

<?php $contact_block_page_icon_id = get_field('contact_block_page_icon'); ?>
<?php $contact_block_page_link = get_field('contact_block_page_link'); ?>
<?php $contact_block_description = get_field('contact_block_description'); ?>

<?php if ($contact_form_shortcode || $contact_block_page_icon_id || $contact_block_page_link || $contact_block_description) : ?>

    <?php wp_enqueue_style('contact_info_css', get_template_directory_uri() . '/static/css/template-parts/blocks/contact_info/contact-info.css', '', '', 'all'); ?>
    <?php wp_enqueue_script('contact_info_js', get_template_directory_uri() . '/static/js/template-parts/blocks/contact_info/contact-info.js', '', '', true); ?>

    <div class="contact-info">
        <div class="container">
            <div class="section-holder">
                <?php if ($contact_form_shortcode || $contact_form_title) : ?>
                    <div class="form-col">
                        <?php if ($contact_form_title) : ?>
                            <h3><?php echo $contact_form_title; ?></h3>
                        <?php endif; ?>
                        <?php if ($contact_form_shortcode) : ?>
                            <?php echo do_shortcode($contact_form_shortcode); ?>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>

                <?php if ($contact_block_page_icon_id || $contact_block_page_link || $contact_block_description) : ?>
                    <div class="info-col">
                        <?php if ($contact_block_page_icon_id || $contact_block_page_link || $contact_block_description) : ?>
                            <a class="page-block"
                               target="<?php echo !empty($contact_block_page_link['target']) ? $contact_block_page_link['target'] : '_self' ?>"
                               href="<?php echo !empty($contact_block_page_link['url']) ? $contact_block_page_link['url'] : '#' ?>">
                                <?php if ($contact_block_page_icon_id) : ?>
                                    <div class="icon">
                                        <?php echo wp_get_attachment_image($contact_block_page_icon_id, 'gfx_semi_small'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($contact_block_page_link['title'])) : ?>
                                    <div class="title">
                                        <?php echo $contact_block_page_link['title']; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($contact_block_description) : ?>
                                    <div class="description">
                                        <?php echo $contact_block_description; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        <?php endif; ?>

                        <?php if (have_rows('contact_info', 'option')) : ?>
                            <div class="info-blocks">
                                <?php while (have_rows('contact_info', 'option')) : the_row(); ?>
                                    <?php $icon_id = get_sub_field('icon'); ?>
                                    <?php $link = get_sub_field('link'); ?>
                                    <?php $description = get_sub_field('description'); ?>

                                    <a href="<?php echo !empty($link['url']) ? $link['url'] : '#' ?>" class="info-block"
                                       target="<?php echo !empty($link['target']) ? $link['target'] : '_self' ?>">
                                        <?php if ($icon_id) : ?>
                                            <div class="icon">
                                                <?php echo wp_get_attachment_image($icon_id, 'logo'); ?>
                                            </div>
                                        <?php endif; ?>

                                        <?php if (!empty($link['title']) || $description) : ?>
                                            <div class="holder">
                                                <?php if (!empty($link['title'])) : ?>
                                                    <div class="title">
                                                        <?php echo $link['title']; ?>
                                                    </div>
                                                <?php endif; ?>
                                                <?php if ($description) : ?>
                                                    <div class="description">
                                                        <?php echo $description; ?>
                                                    </div>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </a>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>