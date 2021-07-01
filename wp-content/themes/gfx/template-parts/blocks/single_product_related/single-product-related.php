<?php
if (!empty($args)) :
    if (isset($args['product'])) :
        $product = $args['product'];

        if (isset($product) && $product instanceof WC_Product) :
            $product_id = $product->get_id();
            if ($product_id) :
                $categories = get_the_terms($product_id, 'product_cat');
                if (isset($categories) && !empty($categories)) :
                    $product_category_slug = $categories[0]->slug;
                    if (isset($product_category_slug)) :
                        $args = array(
                            'post_type' => 'product',
                            'posts_per_page' => 3,
                            'product_cat' => $product_category_slug
                        );
                        $related_products = new WP_Query($args);

                        if ($related_products->have_posts()) : ?>
                            <?php wp_enqueue_style('single_product_related_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_related/single-product-related.css', '', '', 'all'); ?>

                            <section class="single-product-related">
                                <div class="container">
                                    <h3 class="title"><?php _e('Related Products'); ?></h3>
                                    <div class="subtitle">
                                        <?php _e('Here are some similar products we think you might like'); ?>
                                    </div>

                                    <div class="products-holder">
                                        <?php while ($related_products->have_posts()) : $related_products->the_post(); ?>
                                            <?php $post_id = get_the_ID(); ?>
                                            <?php if ($post_id) : ?>
                                                <?php $product = wc_get_product($post_id); ?>
                                                <?php if (isset($product) && $product instanceof WC_Product) : ?>
                                                    <?php get_template_part('template-parts/product-card', '', array('product' => $product)); ?>
                                                <?php endif; ?>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif;
                        wp_reset_postdata();
                    endif;
                endif;
            endif;
        endif;
    endif;

    if (isset($args['post'])) :
        $post = $args['post'];

        if (isset($post) && $post instanceof WP_Post) :
            $post_id = $post->ID;

            if ($post_id) :
                $categories = get_the_terms($post_id, 'category');
                if (isset($categories) && !empty($categories)) :
                    $post_category_slug = $categories[0]->slug;
                    if (isset($post_category_slug)) :
                        $args = array(
                            'post_type' => 'post',
                            'posts_per_page' => 3,
                            'post__not_in' => array($post_id),
                            'category_name' => $post_category_slug
                        );
                        $related_posts = new WP_Query($args);

                        if ($related_posts->have_posts()) : ?>
                            <?php wp_enqueue_style('single_product_related_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_related/single-product-related.css', '', '', 'all'); ?>

                            <section class="single-product-related">
                                <div class="container">
                                    <h3 class="title"><?php _e('Related Posts'); ?></h3>
                                    <div class="subtitle">
                                        <?php _e('Here are some similar posts we think you might like'); ?>
                                    </div>

                                    <div class="products-holder">
                                        <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                            <?php get_template_part('template-parts/blocks/single_product_related/post-card'); ?>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </section>
                        <?php endif;
                    endif;
                endif;
            endif;
        endif;
    endif;
endif; ?>