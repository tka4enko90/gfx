<?php if (!empty($args)) : ?>
    <?php if (!empty($args['support_page_id'])) : ?>
        <?php $support_page_id = $args['support_page_id']; ?>
    <?php endif; ?>

    <?php wp_enqueue_style('single_support_content_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_support_content/single-support-content.css', '', '', 'all'); ?>

    <?php $current_post = get_queried_object(); ?>

    <?php if (!empty($current_post)) : ?>
        <?php $sections = get_the_terms($current_post, 'section'); ?>

        <section class="single-support-content">
            <div class="container">
                <div class="breadcrumbs">
                    <?php if (isset($support_page_id)) : ?>
                        <a href="<?php the_permalink($support_page_id); ?>"><?php _e('Support', 'gfx'); ?></a>
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                             x="0px" y="0px"
                             viewBox="0 0 492.004 492.004" style="fill:white;enable-background:new 0 0 492.004 492.004;"
                             xml:space="preserve">
                                <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                    c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                    c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                    c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                        </svg>

                        <?php if (!empty($sections)) : ?>
                            <a href="<?php echo get_term_link($sections[0]->term_id, 'section'); ?>"><?php echo $sections[0]->name; ?></a>
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
                        <?php endif; ?>

                        <span><?php the_title(); ?></span>
                    <?php endif; ?>
                </div>

                <div class="post-holder">
                    <div class="title-holder">
                        <h3><?php the_title(); ?></h3>

                        <?php $modified_date = get_the_modified_date('F j, Y'); ?>
                        <?php if ($modified_date) : ?>
                            <div class="modified-date">
                                <?php echo __('Last Updated') . ' ' . $modified_date; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                    <?php if(!empty(get_the_content())) : ?>
                        <div class="post-content">
                            <?php the_content(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </section>
    <?php endif; ?>
<?php endif; ?>