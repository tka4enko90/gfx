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
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'menu_icon' => 'dashicons-editor-paste-text',
        'menu_position' => 5,
        'has_archive' => true,
        'supports' => array( 'title', 'thumbnail' )
    );
    register_post_type('testimonials', $args);

    $labels = array(
        'name' => 'Support',
        'singular_name' => 'Support',
        'add_new' => 'Add question',
        'add_new_item' => 'Add question',
        'edit_item' => 'Edit question',
        'new_item' => 'New question',
        'all_items' => 'All questions',
        'menu_name' => 'Support'
    );
    $args = array(
        'labels' => $labels,
        'publicly_queryable' => true,
        'exclude_from_search' => false,
        'show_in_nav_menus' => true,
        'show_ui' => true,
        'menu_icon' => 'dashicons-admin-site-alt3',
        'menu_position' => 6,
        'has_archive' => false,
        'supports' => array( 'title', 'excerpt' )
    );
    register_post_type('support', $args);
}
add_action( 'init', 'register_custom_post_types' );

function register_custom_post_taxonomies(){
    register_taxonomy( 'filter_tag', [ 'product' ], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Filter Tags',
            'singular_name'     => 'Filter Tag',
            'search_items'      => 'Search Filter Tag',
            'all_items'         => 'All Filter Tags',
            'view_item '        => 'View Filter Tag',
            'parent_item'       => 'Parent Filter Tag',
            'parent_item_colon' => 'Parent Filter Tag:',
            'edit_item'         => 'Edit Filter Tag',
            'update_item'       => 'Update Filter Tag',
            'add_new_item'      => 'Add New Filter Tag',
            'new_item_name'     => 'New Filter Tag Name',
            'menu_name'         => 'Filter Tags',
        ],
        'public'                => true,
        'hierarchical'          => false,
    ] );

    register_taxonomy( 'section', [ 'support' ], [
        'label'                 => '',
        'labels'                => [
            'name'              => 'Section',
            'singular_name'     => 'Section',
            'search_items'      => 'Search Section',
            'all_items'         => 'All Sections',
            'view_item '        => 'View Section',
            'parent_item'       => 'Parent Section',
            'parent_item_colon' => 'Parent Section:',
            'edit_item'         => 'Edit Section',
            'update_item'       => 'Update Section',
            'add_new_item'      => 'Add New Section',
            'new_item_name'     => 'New Section Name',
            'menu_name'         => 'Section',
        ],
        'public'                => true,
        'hierarchical'          => false,
    ] );
}
add_action( 'init', 'register_custom_post_taxonomies' );