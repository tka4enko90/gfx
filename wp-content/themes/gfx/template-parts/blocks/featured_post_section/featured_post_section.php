<?php
$featured_post_section_settings = array();
if (!empty($args)) :
    if (!empty($args['section_title'])) :
        $featured_post_section_settings['section_title'] = $args['section_title'];
    endif;
    if (!empty($args['post_id'])) :
        $featured_post_section_settings['post_id'] = $args['post_id'];
    endif;
    if (!empty($args['custom_title'])) :
        $featured_post_section_settings['custom_title'] = $args['custom_title'];
    endif;
    if (!empty($args['custom_description'])) :
        $featured_post_section_settings['custom_description'] = $args['custom_description'];
    endif;
    if (!empty($args['custom_image'])) :
        $featured_post_section_settings['custom_image'] = $args['custom_image'];
    endif;
    if (!empty($args['custom_date'])) :
        $featured_post_section_settings['custom_date'] = $args['custom_date'];
    endif;

    if( !empty($featured_post_section_settings['post_id']) ) {
    wp_enqueue_style('featured_post_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/featured_post_section/featured_post_section.css', '', '', 'all');
    ?>
    <section class="featured-post">
        <div class="container">
            <div class="section-holder">
                <div class="image-column">
                    <?php if( ! empty($featured_post_section_settings['custom_image'] ) ) {
                        echo wp_get_attachment_image( $featured_post_section_settings['custom_image'], 'full' );
                    } else {
                        $post_thumb = get_the_post_thumbnail($featured_post_section_settings['post_id']);
                        if( ! empty( $post_thumb ) ) {
                            echo $post_thumb;
                        }
                    } ?>
                </div>
                <div class="content-column">
                    <?php if( ! empty( $featured_post_section_settings['section_title'] ) ) { ?>
                        <h4 class="section-heading"><?php echo $featured_post_section_settings['section_title']; ?></h4>
                        <?php
                    } ?>
                    <span class="post-date"><?php if( !empty($featured_post_section_settings['custom_date']) ) {
                            echo $featured_post_section_settings['custom_date'];
                        } else { ?>
                            <?php echo get_the_time('Y-m-d', $featured_post_section_settings['post_id'] ); ?>
                            <?php
                        } ?></span>
                    <h2 class="post-title"><?php if( ! empty( $featured_post_section_settings['custom_title'] ) ) {
                            echo $featured_post_section_settings['custom_date'];
                        } else {
                            echo get_the_title( $featured_post_section_settings['post_id'] );
                        } ?></h2>
                    <p class="post-excerpt"><?php if( ! empty( $featured_post_section_settings['custom_description'] ) ) {
                            echo $featured_post_section_settings['custom_description'];
                        } else {
                            echo get_the_excerpt( $featured_post_section_settings['post_id'] );
                        } ?></p>
                    <a href="<?php echo get_post_permalink( $featured_post_section_settings['post_id'] ); ?>" class="primary-button">Read Post</a>
                </div>
            </div>
        </div>
    </section>
    <?php
}
endif;