<?php
/**
 * @package WordPress
 * @subpackage gfx
 */

function inclusion_enqueue() {
	$ver_num = mt_rand();
	wp_enqueue_style('main', get_template_directory_uri() . '/static/css/main.min.css', [], $ver_num, 'all');
	wp_enqueue_style('style', get_template_directory_uri() . '/style.css', ['main'], $ver_num, 'all');
	wp_enqueue_script('scripts', get_template_directory_uri() . '/static/js/main.min.js', ['jquery'], $ver_num, true);
}
add_action('wp_enqueue_scripts', 'inclusion_enqueue');

// Add Page Options
if (function_exists('acf_add_options_page')) {
	acf_add_options_page(
		[
			'page_title' 	=> 'Options',
			'menu_title'	=> 'Options',
			'menu_slug' 	=> 'options',
			'capability'	=> 'edit_posts',
			'redirect'		=> false
		]
	);
}

add_theme_support('post-thumbnails');
// add_image_size('full-width', 1920);

// Register menu
register_nav_menus(
	[
		'header_menu'	=> 'Header Menu',
		'footer_menu'	=> 'Footer Menu'
	]
);