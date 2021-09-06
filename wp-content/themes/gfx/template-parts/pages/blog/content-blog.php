<?php $page_id = get_queried_object_id();
if ($page_id) :
    if (is_category()) {
        $blog_page_id = get_page_by_title('Blog')->ID;
        $page_title = __('Blog', 'gfx');
        $blog_hero_subtitle = get_field('blog_hero_subtitle', $blog_page_id);
    } else {
        $page_title = get_the_title($page_id);
        $blog_hero_subtitle = get_field('blog_hero_subtitle', $page_id);
    }

    if ($page_title || $blog_hero_subtitle) :
        get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $blog_hero_subtitle));
    endif;
endif;

get_template_part('template-parts/blocks/posts_grid/posts-grid','', array('post_type' => 'post'));
