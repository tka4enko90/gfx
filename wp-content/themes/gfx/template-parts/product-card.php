<?php
if (!empty($args)) :
    $product = $args['product'];

    $product_id = $product->get_id();
    $product_title = $product->get_title();
    $product_price = wc_get_price_including_tax($product);
    $product_image = $product->get_image('gfx_semi_medium');

    if (isset($product_price)) :
        $product_full_price = wc_price($product_price);
    endif;
    ?>

    <a class="product-card" href="<?php the_permalink($product_id); ?>">
        <?php if ($product_image) : ?>
            <div class="thumbnail">
                <?php echo $product_image; ?>
            </div>
        <?php endif; ?>
        <?php if ($product_title) : ?>
            <h6 class="title"><?php echo $product_title; ?></h6>
        <?php endif; ?>
        <?php if (!empty($product_full_price)) : ?>
            <div class="price">
                <?php echo $product_full_price; ?>
            </div>
        <?php endif; ?>
    </a>
<?php endif; ?>