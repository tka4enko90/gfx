<?php if (!empty($args) && isset($args['product'])) :
    $product = $args['product'];

    if (isset($product) && $product instanceof WC_Product) :
        if ($product->get_type() == 'woosb') :
            $bundled_items = $product->get_items();
            if (!empty($bundled_items)) : ?>
                <?php wp_enqueue_style('single_product_also_from_this_package_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_also_from_this_package/single-product-also-from-this-package.css', '', '', 'all'); ?>

                <?php $also_from_this_package_title = get_field('also_from_this_package_title', 'option'); ?>
                <?php $also_from_this_package_description = get_field('also_from_this_package_description', 'option'); ?>

                <section class="single-product-also-from-this-package">
                    <div class="container small">
                        <div class="section-holder">
                            <?php if ($also_from_this_package_title || $also_from_this_package_description) : ?>
                                <div class="title-holder">
                                    <?php if ($also_from_this_package_title) : ?>
                                        <h3><?php echo $also_from_this_package_title; ?></h3>
                                    <?php endif; ?>
                                    <?php if ($also_from_this_package_description) : ?>
                                        <div class="description">
                                            <?php echo $also_from_this_package_description; ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            <?php endif; ?>

                            <div class="products-holder">
                                <?php foreach ($bundled_items as $bundled_item) :
                                    $bundled_item_id = $bundled_item['id'];
                                    if ($bundled_item_id) :
                                        $bundled_product = wc_get_product($bundled_item_id);
                                        if (isset($bundled_product) && $bundled_product instanceof WC_Product) :
                                            get_template_part('template-parts/product-card', '', array('product' => $bundled_product));
                                        endif;
                                    endif;
                                endforeach; ?>
                            </div>
                        </div>
                    </div>
                </section>
            <?php endif;
        endif;
    endif;
endif; ?>