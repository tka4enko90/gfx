<?php if (!empty($args) && isset($args['product'])) :
    $product = $args['product'];
endif; ?>

<?php if (isset($product) && $product instanceof WC_Product) :
    $product_image_id = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();

    if ($product_image_id) :
        $product_image = wp_get_attachment_image($product_image_id, 'gfx_wc_gallery_large');
    endif;

    if (isset($product_image) || isset($attachment_ids)) : ?>
        <?php wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all'); ?>
        <?php wp_enqueue_style('single_product_product_info_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_product_info/single-product-product-info.css', '', '', 'all'); ?>

        <?php wp_enqueue_script('slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array('jquery'), '', true); ?>
        <?php wp_enqueue_script('single_product_product_info_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_product_info/single-product-product-info.js', array('slick-js'), '', true); ?>

        <?php $read_me_page = get_field('read_me_page'); ?>
        <?php if (!empty($product_image) || !empty($attachment_ids) || has_excerpt() || have_rows('what’s_inside')) : ?>
            <section class="single-product-product-info">
                <div class="container">
                    <div class="section-holder">
                        <?php if (!empty($product_image) || !empty($attachment_ids)) : ?>
                            <div class="gallery-col">
                                <?php if (isset($product_image) && empty($attachment_ids)) : ?>
                                    <?php echo $product_image; ?>
                                <?php endif; ?>

                                <?php if (!empty($attachment_ids)) : ?>
                                    <div class="single-product-gallery-slider">
                                        <?php foreach ($attachment_ids as $attachment_id) : ?>
                                            <?php if ($attachment_id) : ?>
                                                <div class="slide">
                                                    <?php $gallery_image = wp_get_attachment_image($attachment_id, 'gfx_wc_gallery_large'); ?>
                                                    <?php if ($gallery_image) : ?>
                                                        <?php echo $gallery_image; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                    <div class="single-product-gallery-slider-nav">
                                        <?php foreach ($attachment_ids as $attachment_id) : ?>
                                            <?php if ($attachment_id) : ?>
                                                <div class="slide">
                                                    <?php $gallery_image = wp_get_attachment_image($attachment_id, 'gfx_wc_gallery_large'); ?>
                                                    <?php if ($gallery_image) : ?>
                                                        <?php echo $gallery_image; ?>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php endforeach; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>

                        <div class="info-col <?php if (empty($product_image) && empty($attachment_ids)) : ?>full-width<?php endif; ?>">
                            <?php if (has_excerpt()) : ?>
                                <div class="description">
                                    <h5><?php _e('Description', 'gfx'); ?></h5>
                                    <div class="text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (have_rows('what’s_inside')) : ?>
                                <div class="what_inside">
                                    <h5><?php _e('What’s Inside?', 'gfx'); ?></h5>
                                    <?php while (have_rows('what’s_inside')) : the_row(); ?>
                                        <?php $title = get_sub_field('title'); ?>
                                        <?php $description = get_sub_field('description'); ?>

                                        <div class="item <?php if ($title && $description) : ?>dropdown-item<?php endif; ?>">
                                            <?php if ($title) : ?>
                                                <div class="dropdown-title"><?php echo $title; ?></div>
                                            <?php endif; ?>

                                            <?php if ($description) : ?>
                                                <div class="dropdown-description"><?php echo $description; ?></div>
                                            <?php endif; ?>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>

                            <?php if (!empty($read_me_page)) : ?>
                                <a class="readme-link" href="<?php echo $read_me_page['url']; ?>"
                                   target="<?php echo $read_me_page['target']; ?>"><?php echo $read_me_page['title']; ?></a>
                            <?php endif; ?>

                            <?php if (isset($product) && $product instanceof WC_Product) : ?>
                                <div class="add-to-cart-btn-holder">
                                    <?php $args = array(
                                        'quantity' => 1,
                                        'class' => implode(
                                            ' ',
                                            array_filter(
                                                array(
                                                    'button',
                                                    'primary-button',
                                                    'product_type_' . $product->get_type(),
                                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                                    $product->supports('ajax_add_to_cart') && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                                                )
                                            )
                                        ),
                                        'attributes' => array(
                                            'data-product_id' => $product->get_id(),
                                            'data-product_title' => $product->get_title(),
                                            'data-product_sku' => $product->get_sku(),
                                            'aria-label' => $product->add_to_cart_description(),
                                            'rel' => 'nofollow',
                                        ),
                                    );
                                    woocommerce_template_loop_add_to_cart($args); ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif;
endif; ?>