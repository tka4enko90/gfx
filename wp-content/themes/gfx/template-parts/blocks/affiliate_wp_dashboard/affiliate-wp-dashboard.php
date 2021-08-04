<?php wp_enqueue_style('affiliate_wp_dashboard_css', get_template_directory_uri() . '/static/css/template-parts/blocks/affiliate_wp_dashboard/affiliate-wp-dashboard.css', '', '', 'all'); ?>

<section class="affiliate-wp-dashboard">
    <div class="container">
        <?php echo do_shortcode('[affiliate_area]'); ?>
    </div>
</section>