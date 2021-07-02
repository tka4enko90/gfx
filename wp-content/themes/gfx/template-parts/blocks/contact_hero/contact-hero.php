<?php $contact_hero_title = get_field('contact_hero_title'); ?>
<?php $contact_hero_subtitle = get_field('contact_hero_subtitle'); ?>
<?php $contact_hero_image_id = get_field('contact_hero_image'); ?>

<?php if ($contact_hero_title || $contact_hero_subtitle || $contact_hero_image_id) : ?>
    <?php wp_enqueue_style('contact_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/contact_hero/contact-hero.css', '', '', 'all'); ?>

    <section class="contact-hero <?php echo empty($contact_hero_image_id) ? 'no-image' : ''; ?>">
        <div class="container">
            <div class="section-holder">
                <?php if ($contact_hero_title || $contact_hero_subtitle) : ?>
                    <div class="text-col">
                        <?php if ($contact_hero_title) : ?>
                            <h1><?php echo $contact_hero_title; ?></h1>
                        <?php endif; ?>
                        <?php if ($contact_hero_subtitle) : ?>
                            <div class="subtitle">
                                <?php echo $contact_hero_subtitle; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                <?php endif; ?>
                <?php if ($contact_hero_image_id) : ?>
                    <div class="image-col">
                        <?php echo wp_get_attachment_image( $contact_hero_image_id, 'gfx_wc_gallery_large' ); ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
<?php endif; ?>