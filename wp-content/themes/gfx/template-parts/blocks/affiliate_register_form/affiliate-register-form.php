<?php wp_enqueue_style('affiliate_register_form_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_register_form/affiliate-register-form.css', '', '', 'all'); ?>

<section class="register-affiliate" id="register-affiliate">
    <div class="container">
        <?php echo do_shortcode('[affiliate_registration]'); ?>
    </div>
</section>