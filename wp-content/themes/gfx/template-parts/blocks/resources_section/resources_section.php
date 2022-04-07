<?php
if (!empty($args)) :
    if( ! empty( $args['resources'] ) ) {
        wp_enqueue_style('resources_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/resources_section/resources_section.css', '', '', 'all');
        ?>
        <section class="resources support-sections">
            <div class="container">
                <?php if( ! empty( $args['section_title'] ) ) {
                    echo '<h2 class="section-heading">' . $args['section_title'] . '</h2>';
                } ?>
                <div class="section-holder">
                    <?php foreach ($args['resources'] as $resource) { ?>
                        <div class="section">
                            <?php if(!empty($resource['link'])) { ?>
                            <a href="<?php echo $resource['link'];?>"><?php
                                } ?>
                                <?php if(!empty($resource['image'])) { ?>
                                    <div class="icon">
                                        <?php echo wp_get_attachment_image( $resource['image'], 'full' ); ?>
                                    </div>
                                    <?php
                                } ?>
                                <div class="information">
                                    <?php if(!empty($resource['heading'])) { echo '<h4>' . $resource['heading'] . '</h4>'; } ?>
                                    <?php if(!empty($resource['description'])) {
                                        echo '<div class="description"><span>' . $resource['description'] . '</span></div>';
                                    } ?>
                                </div>
                                <?php if(!empty($resource['link'])) { ?>
                            </a><?php
                        } ?>
                        </div>
                        <?php
                    }
                    ?>
                </div>
                <span class="line"></span>
            </div>
        </section>
        <?php
    } ?>
<?php
    
 endif;