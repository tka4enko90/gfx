<?php /* Template Name: Resources Page */; ?>
<?php
$page_settings = array(
    'hero' => array(
        'title' => get_field('hero_title'),
        'subtitle' => get_field('hero_subtitle'),
        'image' => get_field('hero_image'),
        'image_size' => 'full'//'gfx_wc_hero_large'
    ),
    'featured_post_section' => array(
        'section_title'      => get_field('feature_post_section_title'),
        'post_id'            => get_field('featured_post'),
        'custom_title'       => get_field('custom_post_title'),
        'custom_description' => get_field('custom_post_description'),
        'custom_image'       => get_field('custom_post_image'),
        'custom_date'        => get_field('custom_post_date'),
    ),
    'resources_section' => array(
        'section_title' => get_field('resources_section_title'),
        'resources'     => get_field('resources'),
    ),
    'products_section' => array(
        'section_title'    => get_field('products_section_title'),
        'section_subtitle' => get_field('products_section_subtitle'),
        'button_text'      => get_field('products_button_text'),
        'button_url'       => get_field('products_button_url'),
        'products'         => get_field('products')
    ),
    'affiliates_section' => array(
        'section_title' => get_field('affiliates_section_title'),
        'section_text' => get_field('affiliates_section_text'),
        'section_image' => get_field('affiliates_section_image'),
        'login_button_url' => get_field('affiliates_section_login_button_url'),
        'registration_button_url' => get_field('affiliates_section_registration_button_url'),

    )
); ?>
<?php get_header(); ?>
    <main class="main">
        <?php
        foreach ($page_settings as $template_key => $template_settings) {
            $template_path = 'template-parts/blocks/' . $template_key . '/' . $template_key;
            get_template_part($template_path, '', $template_settings);
        }
        ?>
    </main>
<?php get_footer(); ?>