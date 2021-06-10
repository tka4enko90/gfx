<?php

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
}