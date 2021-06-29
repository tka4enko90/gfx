<?php wp_enqueue_style('single_product_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_hero/single-product-hero.css', '', '', 'all'); ?>
<?php wp_enqueue_script('single_product_hero_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_hero/single-product-hero.js', '', '', true); ?>

<?php if (!empty($args)) :
    if (isset($args['product'])) :
        $product = $args['product'];
    endif;
    if (isset($args['product_id'])) :
        $product_id = $args['product_id'];
    endif;
    $product_trailer_youtube = get_field('product_trailer_youtube');

    if (isset($product) && $product instanceof WC_Product) :
        $product_type = $product->get_type();
    endif;
endif; ?>

<?php if ($product_id) : ?>
    <section
            class="single-product-hero <?php if (isset($product_type) && $product_type == 'woosb') : ?>package<?php endif; ?>">
        <div class="container">
            <div class="section-holder">
                <div class="content-col">
                    <div class="title <?php if (have_rows('compatible_with')) : ?>compatible-box<?php endif; ?>">
                        <h2><?php the_title(); ?>
                            <?php if (have_rows('compatible_with')) : ?>
                                <img src="<?php echo get_template_directory_uri() ?>/static/img/verified-icon.png"
                                     alt="verified icon">
                            <?php endif; ?>
                        </h2>

                        <?php if (have_rows('compatible_with')) : ?>
                            <?php $hero_compatible_box_title = get_field('hero_compatible_box_title'); ?>
                            <?php $hero_compatible_box_description = get_field('hero_compatible_box_description'); ?>

                            <div class="compatible-with-box">
                                <?php if ($hero_compatible_box_title) : ?>
                                    <div class="title">
                                        <?php echo $hero_compatible_box_title; ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($hero_compatible_box_description) : ?>
                                    <div class="text">
                                        <?php echo $hero_compatible_box_description; ?>
                                    </div>
                                <?php endif; ?>
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

                    <?php if ($product_trailer_youtube || (isset($product_type) && $product_type == 'woosb')) : ?>
                        <div class="buttons-holder">
                            <?php if ($product_trailer_youtube) : ?>
                                <a href="#" class="primary-button">Play Trailer</a>
                            <?php endif; ?>
                            <?php if (isset($product_type) && $product_type == 'woosb') : ?>
                                <a href="#" class="secondary-button scroll-down-link">What’s Inside?</a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>
                <?php if ($product_trailer_youtube) : ?>
                    <div class="video-col">
                        <?php echo $product_trailer_youtube; ?>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <div class="scroll-here"></div>
<?php endif; ?>