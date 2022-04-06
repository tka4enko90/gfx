<?php
$affiliates_section_settings = array();
if (!empty($args)) :
    if (!empty($args['section_title'])) :
        $affiliates_section_settings['section_title'] = $args['section_title'];
    endif;
    if (!empty($args['section_text'])) :
        $affiliates_section_settings['section_text'] = $args['section_text'];
    endif;
    if (!empty($args['section_image'])) :
        $affiliates_section_settings['section_image'] = $args['section_image'];
    endif;
    if (!empty($args['login_button_url'])) :
        $affiliates_section_settings['login_button_url'] = $args['login_button_url'];
    endif;
    if (!empty($args['registration_button_url'])) :
        $affiliates_section_settings['registration_button_url'] = $args['registration_button_url'];
    endif;

    wp_enqueue_style('affiliates_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliates_section/affiliates_section.css', '', '', 'all');
    ?>
    <section class="affiliates-section">
        <div class="container small">
            <div class="section-holder">
                <div class="content-column">
                    <?php if (!empty($affiliates_section_settings['section_title'])) {
                        echo '<h2 class="section-heading">' . $affiliates_section_settings['section_title'] . '</h2>';
                    } ?>
                    <?php if (!empty($affiliates_section_settings['section_text'])) {
                        echo '<p>' . $affiliates_section_settings['section_text'] . '</p>';
                    } ?>
                    <div class="buttons-wrap">
                        <?php if (!empty($affiliates_section_settings['login_button_url'])) {
                            echo '<a class="primary-button" href="' . $affiliates_section_settings['login_button_url'] . '">Register</a>';
                        } ?>
                        <?php if (!empty($affiliates_section_settings['registration_button_url'])) {
                            echo '<a class="primary-button" href="' . $affiliates_section_settings['registration_button_url'] . '">Login</a>';
                        } ?>
                    </div>
                </div>
                <div class="image-column aos-init aos-animate" data-aos-duration="1000" data-aos="fade-left">
                    <?php if (!empty($affiliates_section_settings['section_image'])) {
                        echo wp_get_attachment_image($affiliates_section_settings['section_image'], 'full');
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?php
endif;
