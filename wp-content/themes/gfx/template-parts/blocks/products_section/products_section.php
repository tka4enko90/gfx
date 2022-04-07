<?php
$products_section_settings = array();
if (!empty($args)) :
    if (!empty($args['section_title'])) :
        $products_section_settings['section_title'] = $args['section_title'];
    endif;
    if (!empty($args['section_subtitle'])) :
        $products_section_settings['section_subtitle'] = $args['section_subtitle'];
    endif;
    if (!empty($args['products'])) :
        $products_section_settings['products'] = $args['products'];
    endif;
    if (!empty($args['custom_description'])) :
        $products_section_settings['custom_description'] = $args['custom_description'];
    endif;
    if (!empty($args['button_text'])) :
        $products_section_settings['button_text'] = $args['button_text'];
    endif;
    if (!empty($args['custom_date'])) :
        $products_section_settings['button_url'] = $args['button_url'];
    endif;

    if( !empty($products_section_settings['products']) ) {
        wp_enqueue_style('slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all');
        wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array( 'jquery' ), '', true );

        wp_enqueue_style('products_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/products_section/products_section.css', '', '', 'all');
        wp_enqueue_script('products_section_js', get_template_directory_uri() . '/static/js/template-parts/blocks/products_section/products_section.js', '', '', true);
    ?>
        <section class="products-carousel-section">
            <div class="container small">
                <?php if (!empty($products_section_settings['section_title'])) {
                    $words = explode(' ', $products_section_settings['section_title']);
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
                <?php if (!empty($products_section_settings['section_subtitle'])) {
                    echo '<p class="section-subheading"  data-aos="fade-up" data-aos-duration="1000">' . $products_section_settings['section_subtitle'] . '</p>';
                } ?>
                <div class="carousel products-carousel">
                    <?php
                    foreach ($products_section_settings['products'] as $product_fields) {
                        ?><div class="item" data-aos="zoom-in" data-aos-duration='1000'><?php
                            get_template_part('template-parts/product-card', '', array('product' => wc_get_product($product_fields['product_id'])))
                        ?></div><?php
                    }
                    ?>
                </div>
                <?php if (!empty($products_section_settings['button_url'])) {
                    echo '<a href="' . $products_section_settings['button_url'] . '" class="primary-button">View More</a>';
                } ?>
            </div>
        </section>
        <?php
    }
endif;
