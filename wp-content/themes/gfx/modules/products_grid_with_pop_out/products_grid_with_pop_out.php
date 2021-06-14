<?php wp_enqueue_style('products_grid_with_pop_out_styles', get_template_directory_uri() . '/static/css/modules/products_grid_with_pop_out/products_grid_with_pop_out.css', '', '', 'all'); ?>

<?php $products_grid_with_pop_out_title = get_sub_field('products_grid_with_pop_out_title'); ?>
<?php $products_grid_with_pop_out_subtitle = get_sub_field('products_grid_with_pop_out_subtitle'); ?>
<?php $products_grid_with_pop_out_button = get_sub_field('products_grid_with_pop_out_button'); ?>

<div class="products-grid-with-pop-out">
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
                        $id = $item->ID;
                        $product = wc_get_product($id);
                        $product_price = $product->get_price();
                        ?>
                        <div class="product-card">
                            <div class="thumbnail">
                                <?php echo get_the_post_thumbnail($id, 'gfx_semi_medium'); ?>
                            </div>
                            <div class="title"><?php echo $item->post_title; ?></div>
                            <?php if ($product_price) : ?>
                                <div class="price">
                                    <?php echo wc_price($product_price); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php endif; ?>

            <?php if ($products_grid_with_pop_out_button && $products_grid_with_pop_out_button['url']) : ?>
                <div class="btn-holder">
                    <a href="<?php echo $products_grid_with_pop_out_button['url']; ?>" class="primary-button "
                       target="<?php echo $products_grid_with_pop_out_button['target']; ?>"><?php echo $products_grid_with_pop_out_button['title']; ?></a>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>