<?php $support_page_id = get_page_by_title('Support')->ID; ?>

<?php if ($support_page_id) : ?>
    <?php $support_page_title = __('Support', 'gfx'); ?>
    <?php $support_hero_subtitle = get_field('support_hero_subtitle', $support_page_id); ?>

    <?php if (isset($page_title) || isset($support_hero_subtitle)) : ?>
        <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $support_page_title, 'subtitle' => $support_hero_subtitle, 'search_type' => 'support')); ?>
    <?php endif; ?>

    <?php get_template_part('template-parts/blocks/taxonomy_section_posts/taxonomy-section-posts', '', array('support_page_id' => $support_page_id)); ?>
<?php endif; ?>