<?php
if (!empty($args)) :
    $product = $args['product'];

    if (isset($product) && $product instanceof WC_Product) :
        $product_id = $product->get_id();
        $product_title = $product->get_title($product_id);
        $product_price = $product->get_price($product_id);
        $product_image = $product->get_image('gfx_semi_medium');

        if ($product_price) :
            $product_full_price = wc_price($product_price);
        endif;
        ?>

        <a class="product" href="<?php the_permalink($product_id); ?>">
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
            <?php if (isset($product_full_price)) : ?>
                <div class="price">
                    <?php echo $product_full_price; ?>
                </div>
            <?php endif; ?>
        </a>
    <?php endif;
endif; ?>