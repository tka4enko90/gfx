<?php
$post_id = get_the_ID();
$tutorial_video_url = get_field('tutorial_video_url');

if (!empty($args['post_type'])) :
    $post_type = $args['post_type'];
endif;

if ($post_id) :
    $post_thumbnail = get_the_post_thumbnail($post_id, 'gfx_post_grid');

    if (!empty($post_type)) :
        if (isset($tutorial_video_url)) : ?>
            <a href="<?php echo $tutorial_video_url; ?>" class="post-card" target="_blank">
                <?php if ($post_thumbnail) : ?>
                    <div class="thumbnail">
                        <?php echo $post_thumbnail; ?>
                    </div>
                <?php endif; ?>
                <h6 class="title"><?php the_title(); ?></h6>
                <div class="date">
                    <?php
                    $post_date = get_the_date('Y-m-d H:i');
                    $current_date = new DateTime();
                    if ($post_date && $current_date) :
                        $publication_date = DateTime::createFromFormat("Y-m-d H:i", $post_date);
                        $interval = $current_date->diff($publication_date);

                        if ($interval) :
                            $years = $interval->y;
                            $months = $interval->m;
                            $days = $interval->d;

                            if ($years > 0) :
                                echo $years . ' year(s) ago';
                            elseif ($months > 0) :
                                echo $months . ' month(s) ago';
                            elseif ($days > 0) :
                                echo $days . ' day(s) ago';
                            else :
                                echo 'today';
                            endif;
                        endif;
                    endif;
                    ?>
                </div>
            </a>
        <?php else: ?>
            <div class="post-card">
                <?php if ($post_thumbnail) : ?>
                    <div class="thumbnail">
                        <?php echo $post_thumbnail; ?>
                    </div>
                <?php endif; ?>
                <h6 class="title"><?php the_title(); ?></h6>
                <div class="date">
                    <?php
                    $post_date = get_the_date('Y-m-d H:i');
                    $current_date = new DateTime();
                    if ($post_date && $current_date) :
                        $publication_date = DateTime::createFromFormat("Y-m-d H:i", $post_date);
                        $interval = $current_date->diff($publication_date);

                        if ($interval) :
                            $years = $interval->y;
                            $months = $interval->m;
                            $days = $interval->d;

                            if ($years > 0) :
                                echo $years . ' year(s) ago';
                            elseif ($months > 0) :
                                echo $months . ' month(s) ago';
                            elseif ($days > 0) :
                                echo $days . ' day(s) ago';
                            else :
                                echo 'today';
                            endif;
                        endif;
                    endif;
                    ?>
                </div>
            </div>
        <?php endif;
    else : ?>
        <a href="<?php the_permalink(); ?>" class="post-card">
            <?php if ($post_thumbnail) : ?>
                <div class="thumbnail">
                    <?php echo $post_thumbnail; ?>
                </div>
            <?php endif; ?>
            <h6 class="title"><?php the_title(); ?></h6>
            <div class="date">
                <?php
                $post_date = get_the_date('Y-m-d H:i');
                $current_date = new DateTime();
                if ($post_date && $current_date) :
                    $publication_date = DateTime::createFromFormat("Y-m-d H:i", $post_date);
                    $interval = $current_date->diff($publication_date);

                    if ($interval) :
                        $years = $interval->y;
                        $months = $interval->m;
                        $days = $interval->d;

                        if ($years > 0) :
                            echo $years . ' year(s) ago';
                        elseif ($months > 0) :
                            echo $months . ' month(s) ago';
                        elseif ($days > 0) :
                            echo $days . ' day(s) ago';
                        else :
                            echo 'today';
                        endif;
                    endif;
                endif;
                ?>
            </div>
        </a>
    <?php
    endif;
endif; ?>