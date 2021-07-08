<?php
/**
 * My Account page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-account.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

defined('ABSPATH') || exit; ?>

<?php wp_enqueue_style('my_account_page_styles', get_template_directory_uri() . '/static/css/page-templates/my-account.css', '', '', 'all'); ?>

<?php
$user_name = wp_get_current_user()->user_login;
if (!empty($user_name)) :
    $hero_title = 'Hi, ' . $user_name;
    $my_account_hero_subtitle = get_field('my_account_hero_subtitle', 'option');
    $my_account_hero_image = get_field('my_account_hero_image', 'option');

    if ($hero_title) :
        get_template_part('template-parts/blocks/hero/hero', '', array('title' => $hero_title, 'subtitle' => $my_account_hero_subtitle, 'image' => $my_account_hero_image, 'image_size' => 'gfx_wc_hero_large'));
    endif;
endif; ?>

<section class="my-account-section">
    <div class="container">
        <h6 class="my-account-title"><?php _e('My Account'); ?></h6>
        <div class="section-holder">
            <?php
            /**
             * My Account navigation.
             *
             * @since 2.6.0
             */
            do_action('woocommerce_account_navigation'); ?>

            <div class="col">
                <?php
                /**
                 * My Account content.
                 *
                 * @since 2.6.0
                 */
                do_action('woocommerce_account_content');
                ?>
            </div>
        </div>
    </div>
</section>