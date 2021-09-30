<?php /* Template Name: Privacy policy */; ?>
<?php get_header(); ?>

<main class="main">
    <?php
    $content = get_field('content');
    if (!empty($content)) :
        get_template_part('template-parts/blocks/privacy_content/privacy-content', '', array('content' => $content));
    endif; ?>
</main>

<?php get_footer(); ?>
