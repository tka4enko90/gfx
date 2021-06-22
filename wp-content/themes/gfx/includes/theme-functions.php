<?php
// disable woocommerce styles
add_filter( 'woocommerce_enqueue_styles', '__return_empty_array' );

// change registration form
add_action( 'init', 'add_placeholder_text_to_tml_fields' );
function add_placeholder_text_to_tml_fields() {
    if ( $user_login = tml_get_form_field( 'register', 'user_login' ) ) {
        $user_login->add_attribute( 'placeholder', 'Enter your name' );
    }
    if ( $user_login = tml_get_form_field( 'register', 'user_email' ) ) {
        $user_login->add_attribute( 'placeholder', 'Enter your email' );
    }
    if ( $user_login = tml_get_form_field( 'register', 'user_pass1' ) ) {
        $user_login->add_attribute( 'placeholder', 'Enter your password' );
    }
    if ( $user_login = tml_get_form_field( 'register', 'user_pass2' ) ) {
        $user_login->add_attribute( 'placeholder', 'Enter your password' );
    }
}