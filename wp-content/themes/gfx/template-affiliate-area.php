<?php
/* Template Name: Affiliate Area */;
get_header(); ?>
    <main class="main">
        <?php
        $user_id = get_current_user_id();

        if (function_exists('affwp_is_affiliate') && affwp_is_affiliate($user_id)) :
            $affiliate_dashboard_hero_title = get_field('affiliate_dashboard_hero_title', 'option');
            $affiliate_dashboard_hero_subtitle = get_field('affiliate_dashboard_hero_subtitle', 'option');
            if ($affiliate_dashboard_hero_title || $affiliate_dashboard_hero_subtitle) :
                get_template_part('template-parts/blocks/hero/hero', '',
                    array(
                        'title' => $affiliate_dashboard_hero_title,
                        'subtitle' => $affiliate_dashboard_hero_subtitle,
                        'css_class' => 'affiliate-dashboard'));
            endif;

            get_template_part('template-parts/blocks/affiliate_wp_dashboard/affiliate-wp-dashboard', '', '');
        else :
            if (have_rows('affiliate_area_modules')):
                while (have_rows('affiliate_area_modules')) : the_row();

                    // Hero section
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
                                    'hero' => true,
                                    'buttons' => $hero_section_buttons));
                        endif;

                    // How it works section
                    elseif (get_row_layout() == 'how_it_works_section') :
                        get_template_part('template-parts/blocks/affiliate_how_it_works/affiliate-how-it-works', '', '');

                    // Affiliate tiers
                    elseif (get_row_layout() == 'affiliate_tiers') :
                        get_template_part('template-parts/blocks/affiliate_tiers/affiliate-tiers', '', '');

                    // FAQ section
                    elseif (get_row_layout() == 'faq_section') :
                        get_template_part('template-parts/blocks/affiliate_faq_section/affiliate-faq-section', '', '');

                    // Text block
                    elseif (get_row_layout() == 'affiliate_text_block') :
                        get_template_part('template-parts/blocks/affiliate_text_block/affiliate-text-block', '', '');
                    // Join program section
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

            get_template_part('template-parts/blocks/affiliate_register_form/affiliate-register-form', '', '');
        endif; ?>
    </main>
<?php get_footer(); ?>