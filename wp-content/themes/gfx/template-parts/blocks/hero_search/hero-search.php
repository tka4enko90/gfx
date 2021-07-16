<?php if (!empty($args)) : ?>
    <?php if (!empty($args['title'])) : ?>
        <?php $hero_title = $args['title']; ?>
    <?php endif; ?>

    <?php if (!empty($args['subtitle'])) : ?>
        <?php $hero_subtitle = $args['subtitle']; ?>
    <?php endif; ?>

    <?php if (!empty($args['search_type'])) : ?>
        <?php $search_type = $args['search_type']; ?>
    <?php endif; ?>

    <?php if (isset($hero_title) || isset($hero_subtitle)) : ?>
        <?php wp_enqueue_style('blog_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/hero_search/hero-search.css', '', '', 'all'); ?>

        <section class="hero-search">
            <div class="container">
                <div class="section-holder">
                    <?php if (isset($hero_title)) : ?>
                        <h1><?php echo $hero_title; ?></h1>
                    <?php endif; ?>

                    <?php if (isset($hero_subtitle)) : ?>
                        <div class="subtitle">
                            <?php echo $hero_subtitle; ?>
                        </div>
                    <?php endif; ?>

                    <div class="search-form-holder">
                        <?php if (isset($search_type) && $search_type == 'support') : ?>
                            <?php get_template_part('searchform-support'); ?>
                        <?php else : ?>
                            <?php get_search_form(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>