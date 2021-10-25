<?php
if (!empty($args['args'])) :
    $form = $args['args'];
    $form_data = array();

    // if data = array
    if (is_array($form)) :
        if (isset($form['action']) && isset($form['form'])) :
            parse_str($form['form'], $form_data);
        else :
            $form_data = $form;
        endif;
    // if data = form.serialize
    else :
        parse_str($form, $form_data);
    endif;
endif;

if (!empty(get_queried_object()->slug)) :
    $category = get_queried_object()->slug;
endif;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

if (isset($category)) :
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => '18',
        'paged' => $paged,
        'tax_query' => array(
            array(
                'taxonomy' => 'product_cat',
                'field' => 'slug',
                'terms' => $category
            )
        )
    );
else :
    $args = array(
        'post_type' => 'product',
        'posts_per_page' => '18',
        'paged' => $paged,
    );
endif;

// fill args with correct params
if (isset($form_data)) :
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
endif;

// feature products id
$feature_product_ids = wc_get_featured_product_ids();
$products = new WP_Query($args);

if ($products->have_posts()) :

    // show featured products first
    if(!empty($feature_product_ids) && !array_key_exists('orderby', $args)) {
        foreach($products->posts as $k => $post) {
            $post_id = $post->ID;
            if(in_array($post_id, $feature_product_ids) && $k !== 0) {
                $temp = $post;
                unset($products->posts[$k]);
                array_unshift($products->posts, $temp);
            }
        }
    } ?>
    <div class="col ajax-content" data-posts-count="<?php echo count($products->posts); ?>" data-all-posts-count="<?php echo $products->found_posts; ?>">
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
<?php else : ?>
    <div class="col ajax-content" data-posts-count="0" data-all-posts-count="0">
        <?php _e('No products found', 'gfx'); ?>
    </div>
<?php endif;
wp_reset_postdata(); ?>