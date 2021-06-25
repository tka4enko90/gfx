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

if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'gfx_logo_small', 25, 25 );
    add_image_size( 'logo', 60, 45 );
    add_image_size( 'gfx_avatar', 80, 80 );
    add_image_size( 'gfx_small', 73, 53 );
    add_image_size( 'gfx_semi_small', 96, 126 );
    add_image_size( 'gfx_semi_medium', 460, 260 );
    add_image_size( 'gfx_medium', 580, 335 );
    add_image_size( 'gfx_medium_2', 471, 567 );
    add_image_size( 'gfx_wc_gallery_large', 744, 419 );
}

include_once('includes/menus.php');
include_once('includes/acf.php');
include_once('includes/cpt.php');
include_once('includes/theme-functions.php');