<?php
/* Template Name: Affiliate Area */;
get_header(); ?>
    <main class="main">

        <?php if (have_rows('affiliate_area_modules')):
            while (have_rows('affiliate_area_modules')) : the_row();

                // Hero Section
                if (get_row_layout() == 'hero_section') :
                    $hero_section_title = get_sub_field('hero_section_title');
                    $hero_section_subtitle = get_sub_field('hero_section_subtitle');
                    $hero_section_image = get_sub_field('hero_section_image');
                    $hero_section_buttons = get_sub_field('hero_section_buttons');

                    if ($hero_section_title || $hero_section_subtitle || $hero_section_buttons || $hero_section_image) :
                        get_template_part('template-parts/blocks/hero/hero', '',
                            array(
                                'title' => $hero_section_title,
                                'subtitle' => $hero_section_subtitle,
                                'image' => $hero_section_image,
                                'image_size' => 'gfx_wc_hero_large',
                                'buttons' => $hero_section_buttons));
                    endif;

                // Join Program Section
                elseif (get_row_layout() == 'join_section') :
                    $join_section_title = get_sub_field('join_section_title');
                    $join_section_subtitle = get_sub_field('join_section_subtitle');
                    $join_section_image = get_sub_field('join_section_image');
                    $join_section_buttons = get_sub_field('join_section_buttons');

                    if ($join_section_title || $join_section_subtitle || $join_section_image || $join_section_buttons) :
                        get_template_part('template-parts/blocks/hero/hero', '',
                            array(
                                'title' => $join_section_title,
                                'subtitle' => $join_section_subtitle,
                                'image' => $join_section_image,
                                'image_size' => 'gfx_wc_hero_large',
                                'buttons' => $join_section_buttons,
                                'css_class' => 'join'));
                    endif;
                endif;
            endwhile;
        endif;

        while (have_posts()) :
            the_post();
            the_content();
        endwhile;
        ?>
    </main>
<?php get_footer(); ?>