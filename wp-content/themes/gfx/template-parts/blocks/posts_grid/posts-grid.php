<?php wp_enqueue_style('posts_grid_css', get_template_directory_uri() . '/static/css/template-parts/blocks/posts_grid/posts-grid.css', '', '', 'all'); ?>

<?php if (!empty($args['post_type'])) :
    $post_type = $args['post_type'];
endif; ?>

<section class="posts-grid-section">
    <div class="container">
        <?php global $wp_query;
        if ($wp_query->is_search) :
            if ($wp_query->have_posts()) : ?>
                <div class="showing-text">
                    <?php _e('Showing', 'gfx'); ?>
                    <?php echo $wp_query->post_count; ?> of <?php echo $wp_query->found_posts; ?>
                    <?php _e('results for: ', 'gfx'); ?>
                    <span><?php echo get_search_query(); ?></span>
                </div>
            <?php else : ?>
                <div class="empty">
                    <?php _e('No results found for: ', 'gfx'); ?>
                    <span><?php echo get_search_query(); ?></span>
                </div>
            <?php endif;
        endif; ?>
        <div class="cols-holder">
            <div class="left-col">
                <div class="posts-grid">
                    <?php if (isset($post_type) && $post_type == 'tutorial') :
                        $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

                        $args = array(
                            'post_type' => $post_type,
                            'posts_per_page' => '12',
                            'paged' => $paged,
                        );

                        if (!empty($_GET['s'])) {
                            $args['s'] = $_GET['s'];
                        }

                        if(is_tax('tutorials_category')) {
                            $args['tax_query'] = array(
                                array (
                                    'taxonomy' => 'tutorials_category',
                                    'field' => 'id',
                                    'terms' => get_queried_object_id(),
                                )
                            );
                        }

                        $posts = new WP_Query($args);
                        while ($posts->have_posts()) : $posts->the_post();
                            get_template_part('template-parts/blocks/posts_grid/post-card', '', array('post_type' => $post_type));
                        endwhile; wp_reset_postdata();
                    else :
                        while (have_posts()) : the_post();
                            get_template_part('template-parts/blocks/posts_grid/post-card');
                        endwhile;
                    endif; ?>
                </div>

                <?php if (isset($post_type) && $post_type == "tutorial") : ?>
                    <div class="posts-pagination">
                        <?php $total_pages = $posts->max_num_pages;
                        if ($total_pages > 1) {
                            $current_page = max(1, get_query_var('paged'));
                            echo paginate_links(array(
                                'format' => 'page/%#%',
                                'current' => $current_page,
                                'total' => $total_pages,
                                'mid_size' => 1,
                                'prev_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;" xml:space="preserve">
                                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                                </svg>',
                                'next_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                     viewBox="0 0 492.004 492.004" style="fill:white;enable-background:new 0 0 492.004 492.004;" xml:space="preserve">
                                        <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                            c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                            c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                            c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                </svg>',
                            ));
                        } ?>
                    </div>
                <?php else : ?>
                    <div class="posts-pagination">
                        <?php the_posts_pagination(array(
                            'mid_size' => 1,
                            'format' => 'page/%#%',
                            'prev_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 492 492" style="fill:white;enable-background:new 0 0 492 492;" xml:space="preserve">
                        <path d="M198.608,246.104L382.664,62.04c5.068-5.056,7.856-11.816,7.856-19.024c0-7.212-2.788-13.968-7.856-19.032l-16.128-16.12
                            C361.476,2.792,354.712,0,347.504,0s-13.964,2.792-19.028,7.864L109.328,227.008c-5.084,5.08-7.868,11.868-7.848,19.084
                            c-0.02,7.248,2.76,14.028,7.848,19.112l218.944,218.932c5.064,5.072,11.82,7.864,19.032,7.864c7.208,0,13.964-2.792,19.032-7.864
                            l16.124-16.12c10.492-10.492,10.492-27.572,0-38.06L198.608,246.104z"/>
                </svg>',
                            'next_text' => '<svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     viewBox="0 0 492.004 492.004" style="fill:white;enable-background:new 0 0 492.004 492.004;" xml:space="preserve">
                        <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                            c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                            c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                            c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                </svg>',
                        )); ?>
                    </div>
                <?php endif; ?>
            </div>

            <?php
            if (isset($post_type)) :
                if ($post_type == 'post') :
                    $taxonomy_slug = 'category';
                    $all_posts_page_url = get_post_type_archive_link('post');
                    $all_posts_link_title = __('All Posts', 'gfx');
                elseif ($post_type == 'tutorial') :
                    $taxonomy_slug = 'tutorials_category';
                    $all_posts_page = get_page_by_title('Rescourses');

                    if (!empty($all_posts_page)) :
                        $all_posts_page_url = get_permalink($all_posts_page);
                    endif;

                    $all_posts_link_title = __('All Tutorials', 'gfx');
                endif;

                if (isset($taxonomy_slug)) :
                    $categories = get_terms($taxonomy_slug);
                    $current_category = get_queried_object_id();

                    if (!empty($categories)) : ?>
                        <div class="right-col sidebar">
                            <h6><?php _e('Categories', 'gfx'); ?></h6>

                            <?php if (!empty($all_posts_page_url) && !empty($all_posts_link_title)) :
                                if (($post_type == 'post' && is_home()) ||
                                    ($post_type == 'tutorial' && is_page( 'Rescourses' ))) :
                                    $classes_list = 'current';
                                endif; ?>

                                <a href="<?php echo $all_posts_page_url; ?>" <?php echo !empty($classes_list) ? 'class="'.$classes_list.'"' : ''; ?>>
                                    <?php echo $all_posts_link_title; ?>
                                </a>
                            <?php endif; ?>

                            <?php foreach ($categories as $cat) :
                                $cat_id = $cat->term_id;
                                $cat_name = $cat->name; ?>
                                <a href="<?php echo get_term_link($cat_id); ?>" <?php echo $cat_id === $current_category ? 'class="current"' : ''; ?>>
                                    <?php echo $cat_name; ?>
                                </a>
                            <?php endforeach;

                            if ($taxonomy_slug == "post" && function_exists('zg_recently_viewed')): ?>
                                <h6><?php _e('Recently Viewed Posts', 'gfx'); ?></h6>
                                <?php zg_recently_viewed();
                            endif; ?>
                        </div>
                    <?php endif;
                endif;
            endif; ?>
        </div>
    </div>
</section>