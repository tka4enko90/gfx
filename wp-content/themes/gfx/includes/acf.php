<?php
// Add ACF json
add_filter('acf/settings/save_json', 'my_acf_json_save_point');
function my_acf_json_save_point($path)
{
    $path = get_stylesheet_directory() . '/acf-json';
    return $path;
}

// Add ACF Page Options
if (function_exists('acf_add_options_page')) {
    acf_add_options_page(
        [
            'page_title' 	=> 'Options',
            'menu_title'	=> 'Options',
            'menu_slug' 	=> 'options',
            'capability'	=> 'edit_posts',
            'redirect'		=> true
        ]
    );

    acf_add_options_page(
        [
            'page_title' 	=> 'Header',
            'menu_title'	=> 'Header',
            'parent_slug' => 'options',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ]
    );

    acf_add_options_page(
        [
            'page_title' 	=> 'Footer',
            'menu_title'	=> 'Footer',
            'parent_slug' => 'options',
            'capability'	=> 'edit_posts',
            'redirect'		=> false
        ]
    );
}