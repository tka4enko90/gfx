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
                                            <?php if($post_id) : ?>
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
endif; ?>