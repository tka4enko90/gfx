<?php
wp_enqueue_style('select2_css', get_template_directory_uri() . '/static/css/select2.min.css', '', '', 'all');
wp_enqueue_style('affiliate_wp_dashboard_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_wp_dashboard/affiliate-wp-dashboard.css', '', '', 'all');

wp_enqueue_script('select2_js', get_template_directory_uri() . '/static/js/select2.min.js', '', '', true);
wp_enqueue_script('affiliate_wp_dashboard_js', get_template_directory_uri() . '/static/js/template-parts/blocks/affiliate_wp_dashboard/affiliate-wp-dashboard.js', array('select2_js'), '', true); ?>

<section class="affiliate-wp-dashboard">
    <?php echo do_shortcode('[affiliate_area]'); ?>
</section>