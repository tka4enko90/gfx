<?php get_header(); ?>

    <?php wp_enqueue_style('search_page_styles', get_template_directory_uri() . '/static/css/page-templates/search.css', '', '', 'all'); ?>

    <main class="main">
        <?php if (!empty($_POST) && !empty($_POST['post_type'])) : ?>
            <?php $post_type = $_POST['post_type']; ?>

            <?php if (!empty($post_type)) : ?>
                <?php if ($post_type == 'post') : ?>
                    <?php $page_id = get_page_by_title('Blog')->ID; ?>

                    <?php $page_title = get_the_title($page_id); ?>
                    <?php $blog_hero_subtitle = get_field('blog_hero_subtitle', $page_id); ?>

                    <?php if ($page_title || $blog_hero_subtitle) : ?>
                        <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $blog_hero_subtitle)); ?>
                    <?php endif; ?>

                <?php else : ?>
                    <?php $page_id = get_page_by_title('Support')->ID; ?>

                    <?php $page_title = get_the_title($page_id); ?>
                    <?php $support_hero_subtitle = get_field('support_hero_subtitle', $page_id); ?>

                    <?php if (isset($page_title) || isset($support_hero_subtitle)) : ?>
                        <?php get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $support_hero_subtitle, 'search_type' => 'support')); ?>
                    <?php endif; ?>
                <?php endif; ?>
            <?php endif; ?>
        <?php endif; ?>

        <section class="search-results-section">
            <div class="container">
                <?php if (have_posts()) : ?>
                    <?php global $wp_query; ?>
                    <div class="showing-text">
                        <?php _e('Showing'); ?>
                        <?php echo $wp_query->found_posts; ?> of <?php echo $wp_query->found_posts; ?>
                        <?php _e('results for: '); ?>
                        <span><?php echo get_search_query(); ?></span>
                    </div>

                    <div class="blocks">
                        <?php while (have_posts()) : the_post(); ?>
                            <?php get_template_part('template-parts/content-search'); ?>
                        <?php endwhile; ?>
                    </div>

                    <?php $text_after_search_results = get_field('text_after_search_results', 'option'); ?>
                    <?php if($text_after_search_results) : ?>
                        <div class="bottom-text">
                            <?php echo $text_after_search_results; ?>
                        </div>
                    <?php endif; ?>
                <?php else : ?>
                    <div class="empty">
                        <?php _e('No results found for: ', 'gfx'); ?>
                        <span><?php echo get_search_query(); ?></span>
                    </div>
                <?php endif; ?>
            </div>
        </section>

    </main>
<?php get_footer(); ?>