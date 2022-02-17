<?php /* Template Name: Support Page */; ?>
<?php get_header(); ?>
    <main class="main">
        <?php $page_id = get_queried_object_id();
		$hero_section_image = get_field('hero_bg'); ?>
        <?php if ($page_id) : ?>
            <?php $page_title = get_the_title($page_id); ?>
            <?php $support_hero_subtitle = get_field('support_hero_subtitle', $page_id); ?>

            <?php if (isset($page_title) || isset($support_hero_subtitle)) : ?>
                <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array(
                        'title' => $page_title,
                        'subtitle' => $support_hero_subtitle,
                        'search_type' => 'support',
					    'image' => $hero_section_image,
					    'image_size' => 'gfx_wc_hero_large',
                )); ?>
            <?php endif; ?>

            <?php get_template_part('template-parts/blocks/support_sections/support-sections'); ?>
            <?php get_template_part('template-parts/blocks/single_product_need_help/single-product-need-help', '', array('page' => $page_id)); ?>
        <?php endif; ?>
    </main>
<?php get_footer(); ?>
