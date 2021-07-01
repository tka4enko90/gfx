<?php $post_id = get_the_ID(); ?>
<?php if ($post_id) : ?>
    <?php $post_thumbnail = get_the_post_thumbnail($post_id, 'gfx_post_grid'); ?>
    <a href="<?php the_permalink(); ?>" class="post-card">
        <?php if ($post_thumbnail) : ?>
            <div class="thumbnail">
                <?php echo $post_thumbnail; ?>
            </div>
        <?php endif; ?>
        <h6 class="title"><?php the_title(); ?></h6>
        <div class="date">
            <?php
            $post_date = get_the_date('F d, Y');
            if ($post_date) :
                echo $post_date;
            endif; ?>
        </div>
    </a>
<?php endif; ?>