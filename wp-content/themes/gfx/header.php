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

    <!-- FAVICON -->
    <!-- /FAVICON -->

    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
<?php wp_body_open() ?>

<div class="wrapper">
    <header class="header">
        <div class="container">
            <div class="inner">
                <?php
                $header_logo = get_field('header_logo', 'option');
                $logo_first = get_field('logo_first', 'option');
                $logo_second = get_field('logo_second', 'option'); ?>

                <?php if ($header_logo || $logo_first || $logo_second) : ?>
                    <div class="logo-holder">
                        <a href="<?php echo home_url(); ?>">
                            <?php if ($header_logo['url']) : ?>
                                <img src="<?php echo $header_logo['url']; ?>" alt="logo icon">
                            <?php endif; ?>
                            <?php if ($logo_first) : ?><span><?php echo $logo_first; ?></span><?php endif; ?>
                            <?php if ($logo_first) : ?><span
                                    class="red"><?php echo $logo_second; ?></span><?php endif; ?>
                        </a>
                    </div>
                <?php endif; ?>

                <?php if (has_nav_menu('header_menu')) : ?>
                    <div class="menu-holder">
                        <?php wp_nav_menu(['theme_location' => 'header_menu', 'container' => '']); ?>
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
        </div>
    </header>
