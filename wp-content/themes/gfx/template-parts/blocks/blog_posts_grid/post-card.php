<?php $post_id = get_the_ID(); ?>
<?php if ($post_id) : ?>
    <?php $post_thumbnail = get_the_post_thumbnail($post_id, 'gfx_post_grid'); ?>
    <a href="<?php the_permalink(); ?>" class="post-card">
        <?php if ($post_thumbnail) : ?>
            <div class="thumbnail">
                <?php echo $post_thumbnail; ?>
            </div>
        <?php endif; ?>
        <h6><?php the_title(); ?></h6>
        <div class="date">
            <?php
            $post_date = get_the_date('Y-m-d H:i');
            $current_date = new DateTime(); // текущее время на сервере
            if ($post_date && $current_date) :
                $publication_date = DateTime::createFromFormat("Y-m-d H:i", $post_date); // задаем дату в любом формате
                $interval = $current_date->diff($publication_date); // получаем разницу в виде объекта DateInterval

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
<?php endif; ?>