<?php
if (!empty($args)) :
    wp_enqueue_style('affiliates_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliates_section/affiliates_section.css', '', '', 'all');
    ?>
    <section class="affiliates-section">
        <div class="container small">
            <div class="section-holder">
                <div class="content-column">
                    <?php if (!empty($args['section_title'])) {
                        echo '<h2 class="section-heading">' . $args['section_title'] . '</h2>';
                    } ?>
                    <?php if (!empty($args['section_text'])) {
                        echo '<p>' . $args['section_text'] . '</p>';
                    } ?>
                    <div class="buttons-wrap">
                        <?php if (!empty($args['login_button_url'])) {
                            echo '<a class="primary-button" href="' . $args['login_button_url'] . '">Register</a>';
                        } ?>
                        <?php if (!empty($args['registration_button_url'])) {
                            echo '<a class="secondary-button" href="' . $args['registration_button_url'] . '">Login</a>';
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
