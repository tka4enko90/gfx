<?php
// disable woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// change registration form
add_action('init', 'change_sign_up_form');
function change_sign_up_form()
{
    if (function_exists('tml_get_form_field')) {
        if ($user_login = tml_get_form_field('register', 'user_login')) {
            $user_login->add_attribute('placeholder', 'Enter your name');
        }
        if ($user_email = tml_get_form_field('register', 'user_email')) {
            $user_email->set_label('Email Address');
            $user_email->add_attribute('placeholder', 'Enter your email');
        }
        if ($user_pass1 = tml_get_form_field('register', 'user_pass1')) {
            $user_pass1->add_attribute('placeholder', 'Enter your password');
        }
        if ($user_pass2 = tml_get_form_field('register', 'user_pass2')) {
            $user_pass2->add_attribute('placeholder', 'Enter your password');
        }
        if ($register_submit_btn = tml_get_form_field('register', 'submit')) {
            $register_submit_btn->set_value('Sign Up');
        }
    }
}

// change login form
add_action('init', 'change_login_form');
function change_login_form()
{
    if (function_exists('tml_get_form_field') && $user_login = tml_get_form_field('login', 'log')) {
        $user_login->set_label('Email Address');
    }
}

// change count of related products
add_filter('woocommerce_output_related_products_args', 'related_products_args', 20);
function related_products_args($args)
{
    $args['posts_per_page'] = 3;
    return $args;
}

remove_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10);

// replace product thumbnail
add_action('woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumb', 10);
if (!function_exists('woocommerce_template_loop_product_thumb')) {
    function woocommerce_template_loop_product_thumb()
    {
        echo woocommerce_get_product_thumbnail('gfx_semi_medium');
    }
}

// replace product title
add_action('woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10);
if (!function_exists('woocommerce_template_loop_product_title')) {
    function woocommerce_template_loop_product_title()
    {
        echo '<div class="woocommerce-loop-product_title">' . get_the_title() . '</div>';
    }
}

// remove cf7 default tags
add_filter('wpcf7_autop_or_not', '__return_false');