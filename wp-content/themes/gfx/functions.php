<?php
/**
 * @package WordPress
 * @subpackage gfx
 */

function inclusion_enqueue()
{
    $ver_num = mt_rand();
    wp_enqueue_style('main', get_template_directory_uri() . '/static/css/main.min.css', [], $ver_num, 'all');
    wp_enqueue_style('style', get_template_directory_uri() . '/style.css', ['main'], $ver_num, 'all');
    wp_enqueue_script('scripts', get_template_directory_uri() . '/static/js/main.min.js', ['jquery'], $ver_num, true);
    wp_localize_script('scripts', 'ajaxurl', ['url' => admin_url('admin-ajax.php')]);
}

add_action('wp_enqueue_scripts', 'inclusion_enqueue');

add_theme_support('post-thumbnails');

$include_folders = array(
    'includes/'
);
foreach ($include_folders as $inc_folder) {
    $include_folder = get_stylesheet_directory() . '/' . $inc_folder;
    foreach (glob($include_folder . '*.php') as $file) {
        require_once $file;
    }
}

/**
 * Disable the emoji's
 */
function disable_emojis() {
    remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
    remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
    remove_action( 'wp_print_styles', 'print_emoji_styles' );
    remove_action( 'admin_print_styles', 'print_emoji_styles' );
    remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
    remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
    remove_filter( 'embed_head', 'print_emoji_detection_script' );
    remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
    add_filter( 'wp_resource_hints', 'disable_emojis_remove_dns_prefetch', 10, 2 );
}
//add_action( 'init', 'disable_emojis' );

if (!function_exists('disable_emojis_remove_dns_prefetch')) {
    function disable_emojis_remove_dns_prefetch($urls, $relation_type) {
        if ('dns-prefetch' == $relation_type) {
            $emoji_svg_url = apply_filters('emoji_svg_url', 'https://s.w.org/images/core/emoji/2/svg/');
            $urls = array_diff($urls, array($emoji_svg_url));
        }
        return $urls;
    }
}