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

add_theme_support('post-thumbnails');

$include_folders =  array(
    'includes/'
);
foreach ($include_folders as $inc_folder) {
    $include_folder = get_stylesheet_directory() . '/' . $inc_folder;
    foreach( glob( $include_folder.'*.php' ) as $file ) {
        require_once $file;
    }
}