<?php if (!empty($args)) : ?>
    <?php if (!empty($args['support_page_id'])) : ?>
        <?php $support_page_id = $args['support_page_id']; ?>
    <?php endif; ?>

    <?php $current_page = get_queried_object(); ?>

    <?php wp_enqueue_style('taxonomy_section_posts_css', get_template_directory_uri() . '/static/css/template-parts/blocks/taxonomy_section_posts/taxonomy-section-posts.css', '', '', 'all'); ?>

    <?php if (!empty($current_page)) : ?>
        <section class="taxonomy-section-posts">
            <div class="container xsmall">
                <div class="cols-holder">
                    <div class="left-col">
                        <div class="breadcrumbs">
                            <?php if (isset($support_page_id)) : ?>
                                <a href="<?php the_permalink($support_page_id); ?>"><?php _e('Support', 'gfx'); ?></a>
                                <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                     xmlns:xlink="http://www.w3.org/1999/xlink"
                                     x="0px" y="0px"
                                     viewBox="0 0 492.004 492.004"
                                     style="fill:white;enable-background:new 0 0 492.004 492.004;"
                                     xml:space="preserve">
                                <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                    c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                    c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                    c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                        </svg>
                                <span><?php echo $current_page->name; ?></span>
                            <?php endif; ?>
                        </div>

                        <?php $section_name = $current_page->name; ?>
                        <?php $section_description = $current_page->description; ?>
                        <?php $section_icon = get_field('section_icon', $current_page); ?>

                        <div class="section-posts">
                            <div class="section-info">
                                <?php if ($section_icon) : ?>
                                    <div class="icon">
                                        <?php echo wp_get_attachment_image($section_icon, 'gfx_semi_small_2'); ?>
                                    </div>
                                <?php endif; ?>

                                <div>
                                    <h3><?php echo $section_name; ?></h3>
                                    <?php if (!empty($section_description)) : ?>
                                        <div class="description">
                                            <?php echo $section_description ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>

                            <?php
                            $section_slug = $current_page->slug;
                            $args = array(
                                'post_type' => 'support',
                                'posts_per_page' => -1,
                                'tax_query' => array(
                                    array(
                                        'taxonomy' => 'section',
                                        'field' => 'slug',
                                        'terms' => $section_slug
                                    )
                                ));
                            $questions = new WP_Query($args);
                            if ($questions->have_posts()) : ?>
                                <div class="posts">
                                    <?php while ($questions->have_posts()) : $questions->the_post(); ?>
                                        <a href="<?php the_permalink(); ?>">
                                            <h6><?php the_title(); ?></h6>
                                            <div class="excerpt">
                                                <?php the_excerpt(); ?>
                                            </div>
                                        </a>
                                    <?php endwhile; ?>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <?php $support_sections = get_terms('section', array('hide_empty' => false));
                    if (!empty($support_sections)) : ?>
                        <div class="right-col sidebar">
                            <h6><?php _e('Categories', 'gfx'); ?></h6>
                            <?php foreach ($support_sections as $section) :
                                $section_id = $section->term_id;
                                $section_name = $section->name; ?>
                                <a href="<?php echo get_term_link($section_id); ?>" <?php echo $section_id === $current_page->term_id ? 'class="current"' : ''; ?>>
                                    <?php echo $section_name; ?>
                                </a>
                            <?php endforeach; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <?php $text_after_search_results = get_field('text_after_search_results', 'option'); ?>
                <?php if ($text_after_search_results) : ?>
                    <div class="bottom-text">
                        <?php echo $text_after_search_results; ?>
                    </div>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>