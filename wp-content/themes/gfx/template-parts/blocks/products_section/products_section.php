<?php
$products_section_settings = array();
if (!empty($args)) :
    if (!empty($args['section_title'])) :
        $products_section_settings['section_title'] = $args['section_title'];
    endif;
    if (!empty($args['section_subtitle'])) :
        $products_section_settings['section_subtitle'] = $args['section_subtitle'];
    endif;
    if (!empty($args['query_args'])) :
        $products_section_settings['query_args'] = $args['query_args'];
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

    if( !empty($products_section_settings['query_args']) ) {
    wp_enqueue_style('products_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/products_section/products_section.css', '', '', 'all');
    wp_enqueue_script('hero_js', get_template_directory_uri() . '/static/js/template-parts/blocks/products_section/products_section.js', '', '', true);
    ?>
        <section class="items-carousel-section">
            <div class="container">
                <?php if( ! empty( $products_section_settings['section_title'] ) ) {
                    echo '<h2 class="section-heading">' . $products_section_settings['section_title'] . '</h2>';
                } ?>
                <?php if( ! empty( $products_section_settings['section_subtitle'] ) ) {
                    echo '<p class="section-subheading">' . $products_section_settings['section_subtitle'] . '</p>';
                } ?>
                <div class="carousel items-carousel">
                    <?php
                    if( !empty($products_section_settings['query_args'])) {
                        $posts = new WP_Query($products_section_settings['query_args']);
                        while ($posts->have_posts()) : $posts->the_post();
                            get_template_part('template-parts/blocks/posts_grid/post-card', '', array('post_type' => $products_section_settings['query_args']['post_type']));
                        endwhile; wp_reset_postdata();
                    }
                    ?>
                </div>
                <a href="#" class="primary-button">View More</a>
            </div>
            <?php  ?>
            <?php  ?>
        </section>
        <?php
    }
endif;
