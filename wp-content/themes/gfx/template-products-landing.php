<?php /* Template Name: Products Landing */; ?>
<?php
$page_settings = array(
     'landing_head' => array(
         'section_title' => get_field('head_section_title'),
         'section_subtitle' => get_field('head_section_subtitle'), // Join our Discord server to stay updated.
         'button_text' => get_field('head_button_text'), // Browse All
         'button_url' => get_field('head_button_url'),
         'discord_url' => get_field('discord_url')
        ),
    'products_section' => array(
        'products'         => get_field('products')
    ),
); ?>
<?php wp_enqueue_style('products_landing', get_template_directory_uri() . '/static/css/page-templates/products-landing.css', '', '', 'all'); ?>
<?php get_header(); ?>
    <main class="main" style="background: url('<?php echo get_the_post_thumbnail_url(); ?>') center center / cover">
        <?php
        foreach ($page_settings as $template_key => $template_settings) {
            $template_path = 'template-parts/blocks/' . $template_key . '/' . $template_key;
            get_template_part($template_path, '', $template_settings);
        }
        ?>
    </main>
<?php get_footer(); ?>