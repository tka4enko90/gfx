<?php get_header(); ?>

<?php wp_enqueue_style('search_page_styles', get_template_directory_uri() . '/static/css/page-templates/search.css', '', '', 'all'); ?>

    <main class="main">
        <?php if (!empty($_GET['post_type'])) :
            $post_type = $_GET['post_type'];

            if (!empty($post_type)) :
                if ($post_type == 'post') :
                    $page_id = get_option( 'page_for_posts' );
                    $page_title = __('Blog', 'gfx');
                    $hero_subtitle = get_field('blog_hero_subtitle', $page_id);
                elseif ($post_type == 'tutorial') :
                    $page_id = get_field('tutorials_archive_page_id', 'option');
                    if(empty($page_id)) { // Deprecated
                        $page_id = get_page_by_title( __( 'Tutorials', 'gfx' ) );
                    }
                    $page_title = __('Tutorials', 'gfx');
                    $hero_subtitle = get_field('resources_hero_subtitle', $page_id);
                else :
                    $page_id = get_field('support_page_id', 'option');
                    if(empty($page_id)) {
                        $page_id = get_page_by_title(__('Support', 'gfx'))->ID;
                    }
                    $page_title = __('Support', 'gfx');
                    $hero_subtitle = get_field('support_hero_subtitle', $page_id);
                endif;

                if (isset($page_title) || isset($support_hero_subtitle)) :
                    get_template_part('template-parts/blocks/hero_search/hero-search', '', array('title' => $page_title, 'subtitle' => $hero_subtitle, 'search_type' => $post_type));
                endif;

                if ($post_type == 'post' || $post_type == 'tutorial') :
                    get_template_part('template-parts/blocks/posts_grid/posts-grid','', array('post_type' => $post_type));
                else : ?>
                    <section class="search-results-section">
                        <div class="container">
                            <?php if (have_posts()) : ?>
                                <?php global $wp_query; ?>
                                <div class="showing-text">
                                    <?php _e('Showing', 'gfx'); ?>
                                    <?php echo $wp_query->post_count; ?> of <?php echo $wp_query->found_posts; ?>
                                    <?php _e('results for: ', 'gfx'); ?>
                                    <span><?php echo get_search_query(); ?></span>
                                </div>

                                <div class="blocks">
                                    <?php while (have_posts()) : the_post(); ?>
                                        <?php get_template_part('template-parts/content-search'); ?>
                                    <?php endwhile; ?>
                                </div>

                                <?php $text_after_search_results = get_field('text_after_search_results', 'option'); ?>
                                <?php if ($text_after_search_results) : ?>
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
                <?php endif;
            endif;
        endif; ?>

    </main>
<?php get_footer(); ?>