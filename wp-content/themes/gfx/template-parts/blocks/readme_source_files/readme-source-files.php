<?php
$title = get_sub_field('title');
$description = get_sub_field('description');
$bottom_text = get_sub_field('bottom_text');
$support_title = get_sub_field('support_title');
$support_posts = get_sub_field('support_posts');

if (have_rows('videos') || $title || $description || $support_title || !empty($support_posts)) {
    wp_enqueue_style('readme_source_files_css', get_template_directory_uri() . '/static/css/template-parts/blocks/readme_source_files/readme-source-files.css', '', '', 'all'); ?>

    <section class="readme-source-files">
        <div class="container">
            <div class="cols">
                <div class="col left-col">
                    <?php if ($title || $description) { ?>
                        <div class="title-holder">
                            <?php if ($title) { ?>
                                <h3><?php echo $title; ?></h3>
                            <?php }
                            if ($description) { ?>
                                <div class="description">
                                    <?php echo $description; ?>
                                </div>
                            <?php } ?>
                        </div>
                    <?php }
                    if (have_rows('videos')) { ?>
                        <div class="videos">
                            <?php while (have_rows('videos')) : the_row();
                                $title = get_sub_field('title');
                                $video = get_sub_field('video');
                                $watch_on_youtube_link = get_sub_field('watch_on_youtube_link');

                                if ($video) { ?>
                                    <div class="video">
                                        <?php echo $video;
                                        if ($title) { ?>
                                            <h6><?php echo $title; ?></h6>
                                        <?php }
                                        if ($watch_on_youtube_link) { ?>
                                            <a href="<?php echo $watch_on_youtube_link['url']; ?>"
                                               target="<?php echo $watch_on_youtube_link['target']; ?>"><?php echo $watch_on_youtube_link['title']; ?></a>
                                        <?php } ?>
                                    </div>
                                <?php }
                            endwhile; ?>
                        </div>
                    <?php } ?>
                </div>

                <?php if ($support_title || !empty($support_posts)) { ?>
                    <div class="col support">
                        <?php if ($support_title) { ?>
                            <h6>
                                <?php echo $support_title; ?>
                            </h6>
                        <?php }
                        if (!empty($support_posts)) { ?>
                            <div class="posts">
                                <?php foreach ( $support_posts as $post ):  ?>
                                    <?php setup_postdata( $post ); ?>
                                    <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                <?php endforeach; ?>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        <?php } ?>
                    </div>
                <?php } ?>
            </div>

            <?php if ($bottom_text) { ?>
                <div class="bottom-text">
                    <?php echo $bottom_text; ?>
                </div>
            <?php } ?>
        </div>
    </section>
<?php } ?>