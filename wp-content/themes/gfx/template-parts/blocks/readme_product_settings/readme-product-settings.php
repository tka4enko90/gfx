<?php
$title = get_sub_field('title');
$show_html_css_code = get_sub_field('show_html_css_code');
$html_css_title = get_sub_field('html_css_title');
$html_code = get_sub_field('html_code');
$css_code = get_sub_field('css_code');

if ($title || $html_code || $css_code || have_rows('settings')) {
    wp_enqueue_style('readme_product_settings_css', get_template_directory_uri() . '/static/css/template-parts/blocks/readme_product_settings/readme-product-settings.css', '', '', 'all');

    wp_enqueue_script('highlight_js', get_template_directory_uri() . '/static/js/highlight.min.js', '', '', true);
    wp_enqueue_script('highlight_line_numbers_js', get_template_directory_uri() . '/static/js/highlightjs-line-numbers.min.js', '', '', true);
    wp_enqueue_script('readme_product_settings_js', get_template_directory_uri() . '/static/js/template-parts/blocks/readme_product_settings/readme-product-settings.js', array('highlight_js'), '', true); ?>

    <section class="readme-product-settings">
        <div class="container">
            <div class="section-holder">
                <?php if ($title) { ?>
                    <div class="title">
                        <h3><?php echo $title; ?></h3>
                    </div>
                <?php }
                if (have_rows('settings')) { ?>
                    <div class="settings">
                        <?php while (have_rows('settings')) : the_row();
                            $title = get_sub_field('title');
                            $content = get_sub_field('content'); ?>

                            <div class="block">
                                <?php if ($title) { ?>
                                    <h5><?php echo $title; ?></h5>
                                <?php }
                                if ($content) { ?>
                                    <div class="content">
                                        <?php echo $content; ?>
                                    </div>
                                <?php } ?>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php }
                if ($show_html_css_code && ($html_code || $css_code)) { ?>
                    <div class="editor-block">
                        <?php if ($html_css_title) { ?>
                            <h6><?php echo $html_css_title; ?></h6>
                        <?php } ?>
                        <div class="tabs">
                            <div class="tab-names-holder">
                                <?php if ($html_code) { ?>
                                    <div class="tab-name" data-type="html"><?php _e('HTML', 'gfx'); ?></div>
                                <?php }
                                if ($css_code) { ?>
                                    <div class="tab-name" data-type="css"><?php _e('CSS', 'gfx'); ?></div>
                                <?php } ?>
                            </div>

                            <?php if ($html_code) { ?>
                                <div class="tab-content" data-type="html">
                                    <pre><code class="language-html"><?php echo esc_html($html_code); ?></code></pre>
                                    <div class="btn-holder">
                                        <button class="primary-button small copy-code-btn"
                                                data-value="<?php echo esc_html($html_code); ?>"><?php _e('Copy All', 'gfx'); ?></button>
                                    </div>
                                </div>
                            <?php }
                            if ($css_code) { ?>
                                <div class="tab-content" data-type="css">
                                    <pre><code class="language-css"><?php echo esc_html($css_code); ?></code></pre>
                                    <div class="btn-holder">
                                        <button class="primary-button small copy-code-btn"
                                                data-value="<?php echo esc_html($css_code); ?>"><?php _e('Copy All', 'gfx'); ?></button>
                                    </div>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </section>

<?php } ?>
