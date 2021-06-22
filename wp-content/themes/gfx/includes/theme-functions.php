<?php
// disable woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// change registration form
add_action('init', 'change_sign_up_form');
function change_sign_up_form()
{
    if (function_exists(tml_get_form_field)) {
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
    if (function_exists(tml_get_form_field) && $user_login = tml_get_form_field('login', 'log')) {
        $user_login->set_label('Email Address');
    }
}