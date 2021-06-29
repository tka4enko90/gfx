<?php
global $wpdb;

if (!empty($args) && isset($args['product_id'])) :
    $product_id = $args['product_id'];
endif;

if (isset($product_id)) :
    $parent_product_ids = $wpdb->get_results("SELECT post_id FROM $wpdb->postmeta as m WHERE m.meta_key = 'woosb_ids' and concat(',', m.meta_value ,',') like concat('%,', " . $product_id . " ,'/%')");
    if ($parent_product_ids) :
        $parent_product_id = $parent_product_ids[0]->post_id;
        if ($parent_product_id) :
            $parent_product_title = get_the_title($parent_product_id);
            $parent_product_permalink = get_the_permalink($parent_product_id);
            $parent_product_trailer_youtube = get_field('product_trailer_youtube', $parent_product_id);

            $get_full_package_title = get_field('get_full_package_title');
            $get_full_package_subtitle = get_field('get_full_package_subtitle'); ?>
            <?php wp_enqueue_style('single_product_get_full_package_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_get_full_package/single-product-get-full-package.css', '', '', 'all'); ?>

            <section class="single-product-get-full-package">
                <div class="container">
                    <div class="section-holder">
                        <?php if ($get_full_package_title || $get_full_package_subtitle) : ?>
                            <div class="text-col <?php if (!$parent_product_trailer_youtube) : ?>full-width<?php endif; ?>">
                                <?php if ($get_full_package_title) : ?>
                                    <h3><?php echo $get_full_package_title; ?></h3>
                                <?php endif; ?>
                                <?php if ($get_full_package_subtitle) : ?>
                                    <div class="text">
                                        <?php echo $get_full_package_subtitle; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($parent_product_title && $parent_product_permalink) : ?>
                                    <div class="btn-holder">
                                        <a href="<?php echo $parent_product_permalink; ?>" class="primary-button">
                                            <?php echo $parent_product_title; ?>
                                        </a>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php endif; ?>
                        <?php if ($parent_product_trailer_youtube) : ?>
                            <div class="video-col">
                                <?php echo $parent_product_trailer_youtube; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endif; ?>
<?php endif; ?>
