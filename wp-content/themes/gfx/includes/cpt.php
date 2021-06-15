<?php
function register_custom_post_types() {
    $labels = array(
        'name' => 'Testimonials',
        'singular_name' => 'Testimonial',
        'add_new' => 'Add testimonial',
        'add_new_item' => 'Add testimonial',
        'edit_item' => 'Edit testimonial',
        'new_item' => 'New testimonial',
        'all_items' => 'All testimonials',
        'menu_name' => 'Testimonials'
    );
    $args = array(
        'labels' => $labels,
        'publicly_queryable' => false,
        'exclude_from_search' => false,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'menu_icon' => 'dashicons-editor-paste-text',
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array( 'title', 'thumbnail' )
    );
    register_post_type('testimonials', $args);
}
add_action( 'init', 'register_custom_post_types' );