<?php $page_id = get_queried_object_id(); ?>

<?php if ($page_id) : ?>
    <?php $page_title = get_the_title($page_id); ?>
    <?php $blog_hero_subtitle = get_field('blog_hero_subtitle', $page_id); ?>

    <?php wp_enqueue_style('blog_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/blog_hero/blog-hero.css', '', '', 'all'); ?>

    <section class="blog-hero">
        <div class="container">
            <div class="section-holder">
                <?php if ($page_title) : ?>
                    <h1><?php echo $page_title; ?></h1>
                <?php endif; ?>

                <?php if ($blog_hero_subtitle) : ?>
                    <div class="subtitle">
                        <?php echo $blog_hero_subtitle; ?>
                    </div>
                <?php endif; ?>

                <div class="search-form-holder">
                    <?php get_search_form(); ?>
                </div>
            </div>
        </div>
    </section>
<?php endif; ?>