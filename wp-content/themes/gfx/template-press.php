<?php /* Template Name: Press Page */; ?>
<?php get_header(); ?>

<main class="main">
    <?php $press_hero_title = get_field('press_hero_title');
    $press_hero_subtitle = get_field('press_hero_subtitle');
    $press_hero_button = get_field('press_hero_button');
    $press_assets_file = get_field('press_assets_file'); ?>
    <?php if ($press_hero_title || $press_hero_subtitle || $press_hero_button || $press_assets_file) : ?>
        <?php get_template_part('template-parts/blocks/hero/hero', '', array('title' => $press_hero_title, 'subtitle' => $press_hero_subtitle, 'button' => $press_hero_button, 'file' => $press_assets_file)); ?>
    <?php endif;

    get_template_part('template-parts/blocks/download_assets/download-assets', '', ''); ?>
</main>

<?php get_footer(); ?>
