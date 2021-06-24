<section class="single-product-also-from-this-package">
    <div class="container">
        <div class="section-holder">
            <div class="title-holder">
                <h3>Also from this package</h3>
                <div class="description">
                    Don’t want to commit to the full package? You can also get the seperate
                    elements!
                </div>
            </div>

            <div class="products-holder">
                <?php foreach ($bundled_items as $bundled_item) :
                    $bundled_item_id = $bundled_item['id'];
                    if ($bundled_item_id) :
                        $bundled_product = wc_get_product($bundled_item_id);
                        if (isset($bundled_product) && $bundled_product instanceof WC_Product) :
                            $product_title = $bundled_product->get_title($bundled_item_id);
                            $product_price = $bundled_product->get_price($bundled_item_id);
                            $product_image = $bundled_product->get_image('gfx_semi_medium');

                            if ($product_price) :
                                $product_full_price = wc_price($product_price);
                            endif; ?>

                            <a class="product" href="<?php the_permalink($bundled_item_id); ?>">
                                <?php if ($product_image) : ?>
                                    <div class="thumbnail">
                                        <?php echo $product_image; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($product_title) : ?>
                                    <div class="title">
                                        <?php echo $product_title; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($product_full_price) : ?>
                                    <div class="price">
                                        <?php echo $product_full_price; ?>
                                    </div>
                                <?php endif; ?>
                            </a>
                        <?php endif;
                    endif; ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</section>