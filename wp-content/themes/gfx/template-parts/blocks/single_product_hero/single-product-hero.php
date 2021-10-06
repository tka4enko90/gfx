<?php wp_enqueue_style('single_product_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_hero/single-product-hero.css', '', '', 'all'); ?>
<?php wp_enqueue_script('single_product_hero_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_hero/single-product-hero.js', '', '', true); ?>

<?php if (!empty($args)) :
    if (isset($args['product'])) :
        $product = $args['product'];
        $product_trailer_youtube = get_field('product_trailer_youtube');

        if (isset($product) && $product instanceof WC_Product) :
            $product_id = $product->get_id();
            $product_type = $product->get_type();

            if (isset($product_id)) : ?>
                <section
                        class="single-product-hero <?php if (isset($product_type) && $product_type == 'woosb') : ?>package<?php endif; ?>">
                    <div class="container">
                        <div class="section-holder">
                            <div class="content-col">
                                <div class="title <?php if (have_rows('compatible_with')) : ?>compatible-box<?php endif; ?>">
                                    <h2><?php the_title(); ?>
                                        <?php if (have_rows('compatible_with')) : ?>
                                            <div class="verified-icon">
                                                <img src="<?php echo get_template_directory_uri() ?>/static/img/verified-icon.png"
                                                     alt="verified icon">

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
                                        <?php endif; ?>
                                    </h2>
                                </div>
                                <?php $categories = get_the_terms($product_id, 'product_cat');
                                if (isset($categories) && !empty($categories)) : ?>
                                    <div class="category">
                                        <?php echo $categories[0]->name; ?>
                                    </div>
                                <?php endif; ?>

                                <?php
                                $hero_show_whats_inside_button = get_field('hero_show_whats_inside_button');
                                if ($product_trailer_youtube || (isset($product_type) && $product_type == 'woosb')) : ?>
                                    <div class="buttons-holder">
                                        <?php if ($product_trailer_youtube) : ?>
                                            <button class="primary-button open-product-trailer-popup"><?php _e('Play Trailer', 'gfx'); ?></button>
                                        <?php endif; ?>
                                        <?php if (isset($product_type) && $product_type == 'woosb' && $hero_show_whats_inside_button) : ?>
                                            <button class="secondary-button scroll-down-link"><?php _e('What’s Inside?', 'gfx'); ?></button>
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

                <?php if ($product_trailer_youtube) : ?>
                    <div class="product-trailer-popup">
                        <div class="container">
                            <div class="popup-holder">
                                <div class="holder">
                                    <button class="close-product-trailer-popup-btn">
                                        <svg style="fill:white" id="Capa_1" enable-background="new 0 0 386.667 386.667" height="512" viewBox="0 0 386.667 386.667" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m386.667 45.564-45.564-45.564-147.77 147.769-147.769-147.769-45.564 45.564 147.769 147.769-147.769 147.77 45.564 45.564 147.769-147.769 147.769 147.769 45.564-45.564-147.768-147.77z"/></svg>
                                    </button>

                                    <?php echo $product_trailer_youtube; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif;
        endif;
    endif;
endif; ?>