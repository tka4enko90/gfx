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
                        <?php $buttons_url_options = array( // Get Url from options
                                'login' => get_field('login_page_id', 'option'),
                                'registration' => get_field('registration_page_id', 'option'),
                        );
                        if(!empty($args['registration_button_url'])) { // Custom URL
                            $buttons_url_options['registration'] = $args['registration_button_url'];
                        }
                        if(!empty($args['login_button_url'])) { // Custom URL
                            $buttons_url_options['login'] = $args['login_button_url'];
                        }
                        ?>
                        <?php if (!empty($buttons_url_options['registration'])) { ?>
                            <a class="primary-button" href="<?php echo $buttons_url_options['registration']; ?>"><?php echo __( 'Register', 'gfx' ); ?></a><?php
                        } ?>
                        <?php if (!empty($buttons_url_options['login'])) { ?>
                            <a class="secondary-button" href="<?php echo $buttons_url_options['login']; ?>"><?php echo __( 'Login', 'gfx' ); ?></a><?php
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
