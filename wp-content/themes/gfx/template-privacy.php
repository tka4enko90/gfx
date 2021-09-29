<?php /* Template Name: Privacy Policy Page */; ?>
<?php get_header(); ?>

<main class="main">
    <?php
    $content = get_field('content');
    if ($content) :
        get_template_part('template-parts/privacy-content/privacy_content', '', array('content' => $content));
    endif; ?>

</main>

<?php get_footer(); ?>
