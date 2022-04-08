<?php
if (!empty($args)) :
    if( !empty($args['products']) ) {
        wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all');
        wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array( 'jquery' ), '', true );

        wp_enqueue_style('products_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/products_section/products_section.css', '', '', 'all');
        wp_enqueue_script('products_section_js', get_template_directory_uri() . '/static/js/template-parts/blocks/products_section/products_section.js', '', '', true);
    ?>
        <section class="products-carousel-section">
            <div class="container container-small">
                <?php if (!empty($args['section_title'])) {
                    $words = explode(' ', $args['section_title']);
                    $length = count($words);
                    $title_html = '';
                    for ($i = 0; $i < $length; $i++) {
                        $duration_value = $i + 1;
                        $title_html .= "<span style='display: inline-block' data-aos-duration='500' data-aos='fade-up' data-aos-delay='{$duration_value}00'>{$words[ $i ]}</span> ";
                    }
                    ?>
                    <h2 class="section-heading" style="overflow: hidden"><?php echo $title_html; ?></h2>
                    <?php
                } ?>
                <?php if (!empty($args['section_subtitle'])) { ?>
                    <p class="section-subheading"  data-aos="fade-up" data-aos-duration="1000"><?php echo $args['section_subtitle']; ?></p><?php
                } ?>
                <?php if (!empty($args['decoration_element_text'])) { ?>
                    <span class="decoration-element"><?php echo $args['decoration_element_text']; ?></span><?php
                } ?>
                <div class="carousel products-carousel">
                    <?php
                    foreach ($args['products'] as $product_fields) {
                        ?><div class="item" data-aos="zoom-in" data-aos-duration='1000'><?php
                            get_template_part('template-parts/product-card', '', array('product' => wc_get_product($product_fields['product_id'])))
                        ?></div><?php
                    }
                    ?>
                </div>
                <?php if (!empty($args['button_url']) && !empty($args['button_text'])) { ?>
                    <a href="<?php echo $args['button_url']; ?>" class="primary-button"><?php echo $args['button_text']; ?></a><?php
                } ?>
            </div>
        </section>
        <?php
    }
endif;
