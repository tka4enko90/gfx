<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

wp_enqueue_style('single_product_page_styles', get_template_directory_uri() . '/static/css/page-templates/single-product.css', '', '', 'all');

defined('ABSPATH') || exit;

global $product;
$product_id = get_the_ID();

if (post_password_required()) {
    echo get_the_password_form(); // WPCS: XSS ok.
    return;
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class('', $product); ?>>
    <?php if ($product_id) : ?>
        <?php $product_trailer = get_field('product_trailer'); ?>

        <section class="single-product-hero">
            <div class="container">
                <div class="section-holder">
                    <div class="content-col">
                        <div class="title <?php if (have_rows('compatible_with')) : ?>compatible-box<?php endif; ?>">
                            <h2><?php the_title(); ?> <img
                                        src="<?php echo get_template_directory_uri() ?>/static/img/verified-icon.png"
                                        alt="verified icon"></h2>

                            <?php if (have_rows('compatible_with')) : ?>
                                <div class="compatible-with-box">
                                    <div class="title">
                                        Fully Compatible
                                    </div>
                                    <div class="text">
                                        This product is fully compatible with the following platforms:
                                    </div>
                                    <div class="items">
                                        <?php while (have_rows('compatible_with')) : the_row(); ?>
                                            <div class="item">
                                                <?php if (get_sub_field('icon')) { ?>
                                                    <img src="<?php the_sub_field('icon'); ?>"/>
                                                <?php } ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                        <?php $categories = get_the_terms($product_id, 'product_cat');
                        if (isset($categories) && !empty($categories)) : ?>
                            <div class="category">
                                <?php echo $categories[0]->name;; ?>
                            </div>
                        <?php endif; ?>

                        <div class="buttons-holder">
                            <?php if (isset($product_trailer) && $product_trailer['url']) : ?>
                                <a href="#" class="primary-button">Play Trailer</a>
                            <?php endif; ?>
                            <a href="#" class="secondary-button slow-scroll-link">What’s Inside?</a>
                        </div>
                    </div>
                    <?php if (isset($product_trailer) && $product_trailer['url']) : ?>
                        <div class="video-col">
                            <video autoplay="true" loop="true" muted="true">
                                <source src="<?php echo $product_trailer['url'] ?>" type="video/mp4">
                            </video>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>

        <section class="single-product-complete-package">
            <div class="container">
                <div class="section-holder">
                    <div class="left-col">
                        <div class="red-text">
                            You’ve selected the...
                        </div>
                        <div class="title">
                            Complete Package
                        </div>
                        <?php $complete_package_description = get_field('complete_package_description'); ?>
                        <?php if ($complete_package_description) : ?>
                            <div class="complete_package_description">
                                <?php echo $complete_package_description; ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    <div class="right-col">
                        <div class="item">
                            <div class="icon-holder">
                                <img src="<?php echo get_template_directory_uri(); ?>/static/img/instant-icon.png"
                                     alt="instant icon">
                            </div>
                            <div class="info-holder">
                                <div class="name">
                                    Instant download
                                </div>
                                <div class="description">
                                    You’ll have access to your product as soon as you make your purchase.
                                </div>
                            </div>
                        </div>
                        <?php if (have_rows('compatible_with')) : ?>
                            <div class="item">
                                <div class="icon-holder">
                                    <img src="<?php echo get_template_directory_uri(); ?>/static/img/compatible-icon.png"
                                         alt="compatible icon">
                                </div>
                                <div class="info-holder">
                                    <div class="name">
                                        Compatible with:
                                    </div>
                                    <div class="compatible-items">
                                        <?php while (have_rows('compatible_with')) : the_row(); ?>
                                            <div class="item">
                                                <?php if (get_sub_field('icon')) { ?>
                                                    <img src="<?php the_sub_field('icon'); ?>"/>
                                                <?php } ?>
                                            </div>
                                        <?php endwhile; ?>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                        <div class="item">
                            <div class="icon-holder">
                                <img src="<?php echo get_template_directory_uri(); ?>/static/img/source-files-icon.png"
                                     alt="source files icon">
                            </div>
                            <div class="info-holder">
                                <div class="name">
                                    Source Files
                                </div>
                                <div class="description">
                                    After Effects and Photoshop source files are included in the full
                                    package.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php if (isset($product) && $product instanceof WC_Product) :
            $bundled_items = $product->get_items();
            if (isset($bundled_items) && !empty($bundled_items)) : ?>
                <section class="single-product-also-from-this-package">
                    <div class="container">
                        <div class="section-holder">
                            <div class="title-holder">
                                <h3>Also from this package</h3>
                                <div class="description">
                                    Don’t want to commit to the full package? You can also get the seperate elements!
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
            <?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>

    <?php if (function_exists('woocommerce_output_related_products')) : ?>
        <?php woocommerce_output_related_products(); ?>
    <?php endif; ?>
</div>