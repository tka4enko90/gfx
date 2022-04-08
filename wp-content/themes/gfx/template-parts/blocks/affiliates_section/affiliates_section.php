<?php
if (!empty($args)) :
    wp_enqueue_style('affiliates_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliates_section/affiliates_section.css', '', '', 'all');
    ?>
    <section class="affiliates-section">
        <div class="container container-small">
            <div class="section-holder">
                <div class="content-column">
                    <?php if (!empty($args['section_title'])) { ?>
                        <h2 class="section-heading"><?php echo $args['section_title'];?></h2><?php
                    } ?>
                    <?php if (!empty($args['section_text'])) { ?>
                        <p><?php echo $args['section_text'];?></p><?php
                    } ?>
                    <div class="buttons-wrap">
                        <?php if (!empty($args['login_button_url'])) { ?>
                            <a class="primary-button" href="<?php echo $args['login_button_url']; ?>"><?php echo __( 'Register', 'gfx' ); ?></a><?php
                        } ?>
                        <?php if (!empty($args['registration_button_url'])) { ?>
                            <a class="secondary-button" href="<?php echo $args['registration_button_url']; ?>"><?php echo __( 'Login', 'gfx' ); ?></a><?php
                        } ?>
                    </div>
                </div>
                <div class="image-column aos-init aos-animate" data-aos-duration="1000" data-aos="fade-left">
                    <?php if (!empty($args['section_image'])) {
                        echo wp_get_attachment_image($args['section_image'], 'full');
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php
endif;
