<?php
// disable woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// add woocommerce theme support
function add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'add_woocommerce_support');

add_filter( 'lostpassword_url', 'change_lostpassword_url', 10, 2 );
function change_lostpassword_url( $url, $redirect ){
    $new_url = home_url( '/lostpassword' );
    return add_query_arg( array('redirect'=>$redirect), $new_url );
}

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
    if (function_exists('tml_get_form_field')) {
        if ($user_login = tml_get_form_field('login', 'log')) {
            $user_login->set_label('Email Address');
            $user_login->add_attribute('placeholder', 'Enter your email');
        }
        if ($user_password = tml_get_form_field('login', 'pwd')) {
            $user_password->add_attribute('placeholder', 'Enter your password');
        }
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

// for pagination
function cpt_archive_per_page($query)
{
    if ($query->is_main_query() && !is_admin() && (is_post_type_archive('product') || is_tax('product_cat'))) {
        $query->set('posts_per_page', '3');
    }
}

add_action('pre_get_posts', 'cpt_archive_per_page');

// change search results count
function search_results_per_page($query)
{
    if ($query->is_search)
        if(!empty($_GET['post_type']) && $_GET['post_type'] == 'support') {
            $query->query_vars['posts_per_page'] = -1;
        }
    return $query;
}

add_filter('pre_get_posts', 'search_results_per_page');

// product-filtration
function product_form_filters()
{
    if (isset($_SERVER['HTTP_X_FILTER_PRODUCT'])) :
        get_template_part('template-parts/blocks/shop_products_grid/shop_products-item', '', array('args' => $_GET['form']));
        exit();
    endif;
}

add_action('wp', 'product_form_filters');
add_action('wp', 'product_form_filters');

// my account ajax pagination
function my_account_table_ajax_pagination()
{
    if (!empty($_POST['items'])) :
        $items_cleaned = stripslashes($_POST['items']);
        $items = json_decode($items_cleaned, true);
    endif;

    if (isset($_POST['offset'])) :
        $offset = $_POST['offset'];
    endif;

    if (!empty($_POST['itemsPerPage'])) :
        $items_per_page = $_POST['itemsPerPage'];
    endif;

    if (!empty($_POST['template'])) :
        $template = $_POST['template'];
    endif;

    if (isset($items) && isset($offset) && isset($items_per_page) && isset($template)) :
        ob_start();
        get_template_part($template, '',
            array(
                'items' => $items,
                'offset' => $offset,
                'items_per_page' => $items_per_page,
            ));
        $content = ob_get_clean();

        wp_send_json(array(
            'content' => $content
        ));
    else :
        wp_send_json_error();
    endif;
}

add_action('wp_ajax_my_account_table_ajax_pagination', 'my_account_table_ajax_pagination');
add_action('wp_ajax_nopriv_my_account_table_ajax_pagination', 'my_account_table_ajax_pagination');

// Checkout Page
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form');
remove_action('woocommerce_before_checkout_form', 'woocommerce_checkout_login_form');
remove_action('woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20);

// Change billing fields on my account page
add_filter( 'woocommerce_billing_fields' , 'change_billing_fields' );
function change_billing_fields( $fields ) {
    unset($fields['billing_phone']);
    $fields['billing_email']['priority'] = 21;
    $fields['billing_email']['label'] = __('Email Address', 'gfx');

    return $fields;
}

// Change billing fields on checkout page
add_filter( 'woocommerce_checkout_fields' , 'change_checkout_fields' );
function change_checkout_fields( $fields ) {
    unset($fields['billing']['billing_phone']);
    $fields['billing']['billing_state']['label'] = __('County', 'gfx');
    $fields['billing']['billing_postcode']['label'] = __('Postcode', 'gfx');

    return $fields;
}

// Change address fields
add_filter( 'woocommerce_default_address_fields' , 'change_address_fields' );
function change_address_fields( $fields ) {
    unset($fields[ 'address_2' ]);
    unset($fields['phone']);

    $fields['first_name']['label'] = __('First Name', 'gfx');
    $fields['last_name']['label'] = __('Last Name', 'gfx');
    $fields['company']['label'] = __('Company Name', 'gfx');
    $fields['country']['label'] = __('Country', 'gfx');
    $fields['address_1']['label'] = __('Street Address', 'gfx');
    $fields['address_1']['placeholder'] = '';
    $fields['postcode']['label'] = __('Postcode', 'gfx');
    $fields['state']['label'] = __('County', 'gfx');
    $fields['state']['required'] = false;
    $fields['email']['priority'] = 21;
    $fields['email']['label'] = __('Email Address', 'gfx');

    return $fields;
}

add_filter('woocommerce_get_country_locale', 'wpse_120741_wc_change_state_label_locale');
function wpse_120741_wc_change_state_label_locale($locale){
    $locale['US']['state']['label'] = __('County', 'gfx');
    $locale['US']['state']['required'] = false;
    $locale['US']['postcode']['label'] = __('Postcode', 'gfx');
    $locale['US']['postcode']['required'] = false;

    return $locale;
}

// change Proceed to PayPal text on submit button
add_filter( 'gettext', 'paypal_button_text', 20, 3 );
function paypal_button_text( $translated_text ) {
    if( $translated_text == 'Proceed to PayPal' ) {
        $translated_text = 'Complete Order';
    }
    return $translated_text;
}

// remove checkout fields if cart is free
add_filter( 'woocommerce_checkout_fields' , 'remove_checkout_fields_for_free_cart' );
function remove_checkout_fields_for_free_cart( $fields ) {

    $cart_total = WC()->cart->get_cart_contents_total();

    if( $cart_total == 0 ) {
        unset($fields['billing']['billing_country']);
        unset($fields['billing']['billing_address_1']);
        unset($fields['billing']['billing_address_2']);
        unset($fields['billing']['billing_postcode']);
        unset($fields['billing']['billing_city']);
        unset($fields['billing']['billing_state']);
    }

    return $fields;
}

 // Add Menu Icons
 add_filter('wp_nav_menu_objects', 'gfx_wp_nav_menu_objects', 10, 2);

 function gfx_wp_nav_menu_objects( $items, $args ) {
     
     // loop
     foreach( $items as &$item ) {
         
         // vars
         $icon = get_field('menu_icon', $item);
         $description = get_field('description', $item);
 
         // append icon and description
         if( $item->menu_item_parent > 0 ) {
            if ( $description ) {
                $title = '<div class="menu-title"><span class="title">' . $item->title . '</span><span class="description">' . $description . '</span></div>';
            } else {
                $title = $item->title;
            }

            if ( $icon ) {
                $item->title = '<div class="wrap-icon"><img class="style-svg" src="'.$icon.'" alt="Icon"></div>'.$title;
            } else {
                $item->title = $title;
            }
             
        }
         
    }
     
    // return
    return $items;
     
 }