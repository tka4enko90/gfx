<?php
$faq_section_title = get_sub_field('faq_section_title');
$faq_section_subtitle = get_sub_field('faq_section_subtitle');

if ($faq_section_title || $faq_section_subtitle || have_rows('faq_section_faqs')) :
    wp_enqueue_style('affiliate_faq_section_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_faq_section/affiliate-faq-section.css', '', '', 'all');
    wp_enqueue_script('affiliate_faq_section_js', get_template_directory_uri() . '/static/js/template-parts/blocks/affiliate_faq_section/affiliate-faq-section.js', '', '', true); ?>

    <section class="affiliate-faq-section">
        <div class="container container-small">
            <?php if ($faq_section_title || $faq_section_subtitle) : ?>
                <div class="titles-holder">
                    <?php if ($faq_section_title) : ?>
                        <h3><?php echo $faq_section_title; ?></h3>
                    <?php endif; ?>
                    <?php if ($faq_section_subtitle) : ?>
                        <div class="subtitle">
                            <?php echo $faq_section_subtitle; ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif;

            $faq_section_faqs_title = get_sub_field('faq_section_faqs_title');

            if ($faq_section_faqs_title) : ?>
                <h4 class="faqs-title"><?php echo $faq_section_faqs_title; ?></h4>
            <?php endif;

            if (have_rows('faq_section_faqs')) : ?>
                <div class="faqs">
                    <?php while (have_rows('faq_section_faqs')) : the_row(); ?>
                        <div class="faq faq-dropdown">
                            <?php
                            $question = get_sub_field('question');
                            $answer = get_sub_field('answer');
                            if ($question) : ?>
                                <div class="question">
                                    <?php echo $question; ?>

                                    <span>+</span>
                                </div>
                            <?php endif;
                            if ($answer) : ?>
                                <div class="answer">
                                    <?php echo $answer; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </section>
<?php endif; ?>