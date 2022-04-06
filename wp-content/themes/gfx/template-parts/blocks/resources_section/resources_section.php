<?php $resources_section_settings = array();
if (!empty($args)) :
    if (!empty($args['section_title'])) :
        $resources_section_settings['section_title'] = $args['section_title'];
    endif;
    if (!empty($args['resources'])) :
        $resources_section_settings['resources'] = $args['resources'];
    endif;

    if( ! empty( $resources_section_settings['resources'] ) ) {
        wp_enqueue_style('resources_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/resources_section/resources_section.css', '', '', 'all');
        ?>
        <section class="resources support-sections">
            <div class="container">
                <?php if( ! empty( $resources_section_settings['section_title'] ) ) {
                    echo '<h2 class="section-heading">' . $resources_section_settings['section_title'] . '</h2>';
                } ?>
                <div class="section-holder">
                    <?php foreach ($resources_section_settings['resources'] as $resource) { ?>
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