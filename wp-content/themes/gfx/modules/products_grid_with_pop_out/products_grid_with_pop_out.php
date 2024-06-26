<?php wp_enqueue_style('products_grid_with_pop_out_styles', get_template_directory_uri() . '/static/css/modules/products_grid_with_pop_out/products_grid_with_pop_out.css', '', '', 'all'); ?>
<?php wp_enqueue_script('products_grid_with_pop_out_js', get_template_directory_uri() . '/static/js/modules/products_grid_with_pop_out/products_grid_with_pop_out.js', '', '', true); ?>

<?php $products_grid_with_pop_out_title = get_sub_field('products_grid_with_pop_out_title'); ?>
<?php $products_grid_with_pop_out_subtitle = get_sub_field('products_grid_with_pop_out_subtitle'); ?>
<?php $products_grid_with_pop_out_button = get_sub_field('products_grid_with_pop_out_button'); ?>

<section class="products-grid-with-pop-out">
    <div class="container">
        <div class="section-holder">
            <?php if ($products_grid_with_pop_out_title || $products_grid_with_pop_out_subtitle) : ?>
                <div class="titles-holder">
                    <?php if ($products_grid_with_pop_out_title) : ?>
                        <h3><?php echo $products_grid_with_pop_out_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($products_grid_with_pop_out_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $products_grid_with_pop_out_subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php $products = get_posts([
                'numberposts' => 6,
                'post_type' => 'product',
                'product_tag' => 'homepage',
            ]);
            if (isset($products) && !empty($products)) : ?>
                <div class="products-holder">
                    <?php foreach ($products as $item) :
                        $product_id = $item->ID;
                        $product_pop_out_info = [];
                        if ($product_id) :
                            $product_pop_out_info["product_permalink"] = get_permalink($product_id);
                            $product_pop_out_info["product_title"] = get_the_title($product_id);
                            $product_pop_out_info["product_id"] = $product_id;

                            $categories = get_the_terms($product_id, 'product_cat');
                            if (isset($categories) && !empty($categories)) :
                                $product_pop_out_info["product_category"] = $categories[0]->name;
                            endif;

                            $product_pop_out_info["assets_preview"] = get_field('assets_preview', $product_id);
                            $product_pop_out_info["assets_preview_poster"] = get_field('assets_preview_poster', $product_id);

                            $product_pop_out_info["alert_preview"] = get_field('alert_preview', $product_id);
                            $product_pop_out_info["alert_preview_poster"] = get_field('alert_preview_poster', $product_id);

                            $product_pop_out_info["screen_preview"] = get_field('screen_preview', $product_id);
                            $product_pop_out_info["screen_preview_poster"] = get_field('screen_preview_poster', $product_id);

                            $product_pop_out_info["compatible_with"] = get_field('compatible_with', $product_id);

                            $product = wc_get_product($product_id);
                            if (isset($product) && $product instanceof WC_Product) :
                                $product_price = wc_get_price_including_tax($product);
                                $product_sku = $product->get_sku();
                                $product_add_to_cart_url = $product->add_to_cart_url();

                                if (isset($product_price)) :
                                    $product_pop_out_info["product_price"] = wc_price($product_price);
                                endif;

                                if ($product_add_to_cart_url) :
                                    $product_pop_out_info["product_add_to_cart_url"] = $product_add_to_cart_url;
                                endif;

                                if ($product_sku) :
                                    $product_pop_out_info["product_sku"] = $product_sku;
                                endif;

                            endif;

                            $product_trailer = get_field('product_trailer', $product_id);
                            if ($product_trailer && $product_trailer['url']) :
                                $product_pop_out_info["product_trailer"] = $product_trailer;
                            endif;
                            ?>

                            <div class="product-card product-card-open-pop-out"
                                 data-product-pop-out='<?php echo json_encode($product_pop_out_info); ?>'>
                                <div class="thumbnail">
                                    <?php echo get_the_post_thumbnail($product_id, 'gfx_semi_medium'); ?>
                                </div>
                                <div class="title"><?php echo $item->post_title; ?></div>
                                <?php if (isset($product_price)) : ?>
                                    <div class="price">
                                        <?php echo wc_price($product_price); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                            <?php
                            unset($product_pop_out_info);
                        endif;
                    endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($products_grid_with_pop_out_button && $products_grid_with_pop_out_button['url']) : ?>
                <div class="btn-holder">
                    <a href="<?php echo $products_grid_with_pop_out_button['url']; ?>" class="primary-button "
                       target="<?php echo !empty($products_grid_with_pop_out_button['target']) ? $products_grid_with_pop_out_button['target'] : '_self' ?>">
                        <?php echo $products_grid_with_pop_out_button['title']; ?>
                    </a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>