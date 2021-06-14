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

    <title>
        <?php
        global $page, $paged;
        wp_title('|', true, 'right');
        bloginfo('name');
        $site_description = get_bloginfo('description', 'display');
        if ($site_description && (is_home() || is_front_page()))
            echo " | $site_description";
        if ($paged >= 2 || $page >= 2)
            echo ' | ' . sprintf(__('Page %s', 'gfx'), max($paged, $page));
        ?>
    </title>

    <!-- FAVICON -->
    <!-- /FAVICON -->

    <script>(function (H) {
            H.className = H.className.replace(/\bno-js\b/, 'js')
        })(document.documentElement)</script>
    <?php wp_head() ?>
</head>

<body <?php body_class() ?>>
<?php wp_body_open() ?>

<div class="wrapper">
    <header class="header">
        <div class="container">
            <div class="inner">
                <div class="logo-holder">
                    <a href="<?php echo get_home_url(); ?>">
                        <?php $header_logo = get_field('header_logo', 'option');
                        if ($header_logo['url']) : ?>
                            <img src="<?php echo $header_logo['url']; ?>" alt="logo icon">
                        <?php endif; ?>
                        <span>Premade</span>
                        <span class="red">GFX</span>
                    </a>
                </div>

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
                    </button>
                <?php endif; ?>
            </div>
        </div>
    </header>
