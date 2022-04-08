<?php wp_enqueue_style('section_404_css', get_template_directory_uri() . '/static/css/template-parts/blocks/section_404/section-404.css', '', '', 'all'); ?>

<?php
$page_title_404 = get_field('page_title_404', 'option');
$page_subtitle_404 = get_field('page_subtitle_404', 'option');
?>

<section class="section-404">
    <div class="container container-small">
        <div class="section-holder">
            <h1>404</h1>
            <?php if ($page_title_404) : ?>
                <h2><?php echo $page_title_404; ?></h2>
            <?php endif; ?>
            <?php if ($page_subtitle_404) : ?>
                <div class="subtitle"><?php echo $page_subtitle_404; ?></div>
            <?php endif; ?>
            <div class="btn-holder">
                <a href="<?php echo home_url(); ?>" class="primary-button">Back to Homepage</a>
            </div>
        </div>
    </div>
</section>