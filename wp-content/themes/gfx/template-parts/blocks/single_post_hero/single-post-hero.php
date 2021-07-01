<?php $post_id = get_queried_object_id(); ?>

<?php if ($post_id) : ?>
    <?php $post_title = get_the_title($post_id); ?>
    <?php if ($post_title) : ?>
        <?php wp_enqueue_style('single_post_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_post_hero/single-post-hero.css', '', '', 'all'); ?>

        <section class="single-post-hero">
            <div class="container">
                <h2><?php echo $post_title; ?></h2>

                <?php $modified_date = get_the_modified_date('F j, Y'); ?>
                <?php if ($modified_date) : ?>
                    <div class="modified-date">
                        <?php echo __('Updated') . ' ' . $modified_date; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>