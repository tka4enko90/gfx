<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
?>
<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset') ?>"/>
    <meta http-equiv="x-ua-compatible" content="ie=edge"/>
    <meta content="" name="description"/>
    <meta content="" name="keywords"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1"/>
    <meta content="telephone=no" name="format-detection"/>
    <meta name="HandheldFriendly" content="true"/>

    <title><?php bloginfo('name'); ?> <?php wp_title("", true); ?></title>

    <!-- FAVICON -->
    <link rel="apple-touch-icon" sizes="180x180" href="<?php echo get_template_directory_uri(); ?>/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="<?php echo get_template_directory_uri(); ?>/favicon/favicon-16x16.png">
    <link rel="manifest" href="/<?php echo get_template_directory_uri(); ?>/faviconsite.webmanifest">
    <meta name="msapplication-TileColor" content="#da532c">
    <meta name="theme-color" content="#ffffff">
    <!-- /FAVICON -->

    <?php wp_head() ?>
</head>

<?php
$body_class = '';
if (sizeof( WC()->cart->get_cart() ) > 0 ) :
    $body_class = 'not-empty-cart';
endif; ?>
<body <?php body_class($body_class) ?>>
<?php wp_body_open() ?>
<div class="wrapper">

    <header class="header">
        <div class="container container-large">
            <div class="inner">

                <?php
                $logo_options = get_field('logo_options', 'option');
                $header_logo = get_field('header_logo', 'option');
                $logo_first = get_field('logo_first', 'option');
                $logo_second = get_field('logo_second', 'option'); ?>
                <?php if ($header_logo || $logo_first || $logo_second) : ?>
                    <div class="logo-holder">
                        <a href="<?php echo home_url(); ?>">
                            <?php
                            if ($header_logo && $logo_options === 'image') :
                                if (get_post_mime_type($header_logo) === 'image/svg+xml'){
                                    echo file_get_contents(wp_get_original_image_path($header_logo));
                                }else{
                                    echo wp_get_attachment_image($header_logo, 'logo');
                                }
                            ?>
                            <?php else : ?>
                                <?php if ($logo_first) : ?><span><?php echo $logo_first; ?></span><?php endif; ?>
                                <?php if ($logo_first) : ?><span
                                        class="red"><?php echo $logo_second; ?></span><?php endif; ?>
                            <?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('header_menu')) : ?>
                    <div class="menu-holder">
                        <?php wp_nav_menu(['theme_location' => 'header_menu', 'container' => '']); ?>
                        <?php wp_nav_menu(['theme_location' => 'login_menu', 'container' => '', 'menu_id' => 'mobile-login-menu']); ?>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('login_menu')) : ?>
                    <div class="login-menu-holder">
                        <?php wp_nav_menu(['theme_location' => 'login_menu', 'container' => '']); ?>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('header_menu')) : ?>
                    <button class="burger-btn">
                        <img src="<?php echo get_template_directory_uri() ?>/static/img/menu-icon.svg" alt="menu icon">
                        <img src="<?php echo get_template_directory_uri() ?>/static/img/close-icon.svg"
                             alt="close menu icon">
                    </button>
                <?php endif; ?>
            </div>

            <div class="product-added-to-cart-popup">
                <button class="product-added-to-cart-close-btn">
                    <img src="<?php echo get_template_directory_uri() ?>/static/img/close-btn-icon.svg"
                         alt="close icon">
                </button>

                <div class="product-name"></div>
                <div class="additional-text"><?php _e( 'has been added to your cart.', 'gfx' ); ?></div>
                <?php $cart_link = wc_get_cart_url(); ?>
                <a href="<?php echo $cart_link; ?>" class="primary-button extra-small"><?php _e( 'View Cart', 'gfx' ); ?></a>
            </div>
        </div>
    </header>