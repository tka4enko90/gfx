<?php if (isset($product) && $product instanceof WC_Product) :
    $product_image_id = $product->get_image_id();
    $attachment_ids = $product->get_gallery_image_ids();

    if ($product_image_id) :
        $product_image = wp_get_attachment_image($product_image_id, 'gfx_wc_gallery_large');
    endif;
endif; ?>

<?php if (isset($product_image) || isset($attachment_ids)) : ?>
    <?php wp_enqueue_style('slick-css', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css', '', '', 'all'); ?>
    <?php wp_enqueue_style('single_product_product_info_css', get_template_directory_uri() . '/static/css/modules/single_product_product_info/single-product-product-info.css', '', '', 'all'); ?>

    <?php wp_enqueue_script('slick-js', 'https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js', array('jquery'), '', true); ?>
    <?php wp_enqueue_script('single_product_product_info_js', get_template_directory_uri() . '/static/js/modules/single_product_product_info/single-product-product-info.js', array('slick-js'), '', true); ?>

    <?php $read_me_page = get_field('read_me_page'); ?>
    <?php if (isset($product_image) || isset($attachment_ids) || has_excerpt() || have_rows('what’s_inside') || $read_me_page['url']) : ?>
        <section class="single-product-product-info">
            <div class="container">
                <div class="section-holder">
                    <?php if (isset($product_image) || isset($attachment_ids)) : ?>
                        <div class="gallery-col">
                            <?php if (isset($product_image) && !isset($attachment_ids)) : ?>
                                <?php echo $product_image; ?>
                            <?php endif; ?>

                            <?php if (isset($attachment_ids)) : ?>
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

                    <?php if (has_excerpt() || have_rows('what’s_inside') || $read_me_page['url']) : ?>
                        <div class="info-col">
                            <?php if (has_excerpt()) : ?>
                                <div class="description">
                                    <h5>Description</h5>
                                    <div class="text">
                                        <?php the_excerpt(); ?>
                                    </div>
                                </div>
                            <?php endif; ?>

                            <?php if (have_rows('what’s_inside')) : ?>
                                <div class="what_inside">
                                    <h5>What’s Inside?</h5>
                                    <?php while (have_rows('what’s_inside')) : the_row(); ?>
                                        <div class="item dropdown-item">
                                            <?php $title = get_sub_field('title'); ?>
                                            <?php $description = get_sub_field('description'); ?>

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

                            <?php if ($read_me_page['url']) : ?>
                                <a class="readme-link" href="<?php echo $read_me_page['url']; ?>"
                                   target="<?php echo $read_me_page['target']; ?>"><?php echo $read_me_page['title']; ?></a>
                            <?php endif; ?>

                            <?php if (isset($product) && $product instanceof WC_Product) :
                                $product_price = $product->get_price();
                                $product_sku = $product->get_sku();
                                $product_add_to_cart_url = $product->add_to_cart_url();

                                if ($product_add_to_cart_url) : ?>
                                    <div class="add-to-cart-btn-holder">
                                        <a href="<?php echo $product_add_to_cart_url; ?>"
                                           class="primary-button add_to_cart_button ajax_add_to_cart "
                                           rel="nofollow"
                                           data-quantity="1" data-product_id="" data-product_title=""
                                           data-product_sku="<?php echo $product_sku; ?>">Add to cart
                                            - <?php echo wc_price($product_price); ?></a>
                                    </div>
                                <?php endif; endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>