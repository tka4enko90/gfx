<?php $support_sections = get_terms('section', array('hide_empty' => false)); ?>
<?php if (!empty($support_sections)) : ?>
    <?php wp_enqueue_style('support_sections_css', get_template_directory_uri() . '/static/css/template-parts/blocks/support_sections/support-sections.css', '', '', 'all'); ?>

    <section class="support-sections">
        <div class="container">
            <div class="section-holder">
                <?php foreach ($support_sections as $section) : ?>
                    <?php $section_id = $section->term_id; ?>
                    <?php $section_name = $section->name; ?>
                    <?php $section_description = $section->description; ?>

                    <?php $section_icon = get_field('section_icon', $section); ?>

                    <div class="section">
                        <a href="<?php echo get_term_link($section_id); ?>">
                            <?php if ($section_icon) : ?>
                                <div class="icon">
                                    <?php echo wp_get_attachment_image($section_icon, 'shop_thumbnail'); ?>
                                </div>
                            <?php endif; ?>
                            <div class="information">
                                <h4><?php echo $section_name; ?></h4>

                                <?php if(!empty($section_description)) : ?>
                                <div class="description">
                                    <?php echo $section_description ?>
                                </div>
                                <?php endif; ?>
                            </div>
                        </a>
                    </div>
                <?php endforeach; ?>
            </div>

            <span class="line"></span>
        </div>
    </section>
<?php endif; ?>