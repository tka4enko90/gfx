<?php /* Template Name: Contact Page */; ?>
<?php get_header(); ?>
    <main class="main">
        <?php $contact_hero_title = get_field('contact_hero_title'); ?>
        <?php $contact_hero_subtitle = get_field('contact_hero_subtitle'); ?>
        <?php $contact_hero_image_id = get_field('contact_hero_image'); ?>
        <?php if ($contact_hero_title || $contact_hero_subtitle || $contact_hero_image_id) : ?>
            <?php get_template_part('template-parts/blocks/hero/hero', '', array('title' => $contact_hero_title, 'subtitle' => $contact_hero_subtitle, 'image' => $contact_hero_image_id, 'image_size' => 'gfx_wc_hero_large')); ?>
        <?php endif; ?>
        <?php get_template_part('template-parts/blocks/contact_info/contact-info'); ?>
    </main>
<?php get_footer(); ?>
