<?php
// disable woocommerce styles
add_filter('woocommerce_enqueue_styles', '__return_empty_array');

// add woocommerce theme support
function add_woocommerce_support()
{
    add_theme_support('woocommerce');
}

add_action('after_setup_theme', 'add_woocommerce_support');

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

// for pagination
function cpt_archive_per_page($query)
{
    if ($query->is_main_query() && !is_admin() && is_post_type_archive('product')) {
        $query->set('posts_per_page', '2');
    }
}

add_action('pre_get_posts', 'cpt_archive_per_page');

// product-filtration
function product_form_filters()
{
    if ($_GET['form']) :
        $form = $_GET['form'];
        $form_data = array();
        parse_str($form, $form_data);

        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => '3', // 18
            'paged' => $paged,
        );

        // fill args with correct params
        foreach ($form_data as $key => $value) :
            // search
            if ($key == "search") :
                $args['s'] = $value;
            endif;

            // filter-tags
            if ($key == "filter-tags") :
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'filter_tag',
                        'field' => 'slug',
                        'terms' => $value,
                        'operator' => 'AND'
                    )
                );
            endif;

            // color
            if ($key == "color") :
                $args['tax_query'][] = array(
                    array(
                        'taxonomy' => 'pa_color',
                        'field' => 'slug',
                        'terms' => $value,
                        'operator' => 'AND'
                    )
                );
            endif;

            // sort-by
            if ($key == "sort-by") :
                if ($value == 'date-new-old') :
                    $args['orderby'] = "date";
                    $args['order'] = "DESC";
                endif;

                if ($value == 'date-old-new') :
                    $args['orderby'] = "date";
                    $args['order'] = "ASC";
                endif;

                if ($value == 'alphabetically-a-z') :
                    $args['orderby'] = "title";
                    $args['order'] = "ASC";
                endif;

                if ($value == 'alphabetically-z-a') :
                    $args['orderby'] = "title";
                    $args['order'] = "DESC";
                endif;

                if ($value == 'price-high-to-low') :
                    $args['orderby'] = "meta_value_num";
                    $args['meta_key'] = "_price";
                    $args['order'] = "DESC";
                endif;

                if ($value == 'price-low-to-high') :
                    $args['orderby'] = "meta_value_num";
                    $args['meta_key'] = "_price";
                    $args['order'] = "ASC";
                endif;
            endif;
        endforeach;

        $products = new WP_Query($args);
        if ($products->have_posts()) :
            ob_start(); ?>
            <div class="col ajax-content">
                <div class="products-grid">
                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <?php $product_id = get_the_ID(); ?>
                        <?php if ($product_id) : ?>
                            <?php $product = wc_get_product($product_id); ?>
                            <?php if (isset($product) && $product instanceof WC_Product) : ?>
                                <?php get_template_part('template-parts/product-card', '', array('product' => $product)); ?>
                            <?php endif; ?>
                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
                <div class="posts-pagination">
                    <?php $total_pages = $products->max_num_pages;
                    if ($total_pages > 1) {
                        $current_page = max(1, get_query_var('paged'));
                        echo paginate_links(array(
                            'base' => get_pagenum_link(1) . '%_%',
                            'format' => 'page/%#%',
                            'current' => $current_page,
                            'total' => $total_pages,
                            'mid_size' => 1,
                            'prev_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;" xml:space="preserve">
                                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                                </svg>',
                            'next_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 492.004 492.004" style="fill:white;enable-background:new 0 0 492.004 492.004;" xml:space="preserve">
                                        <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                            c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                            c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                            c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                </svg>',
                        ));
                    } ?>
                </div>
            </div>
            <?php $content = ob_get_clean();
        else :
            $content = "No products";
        endif;
    endif;

    if (isset($content)) :
        wp_send_json([
            'content' => $content
        ]);
    else :
        wp_send_json_error();
    endif;
}

add_action('wp_ajax_product_form_filters', 'product_form_filters');
add_action('wp_ajax_nopriv_product_form_filters', 'product_form_filters');