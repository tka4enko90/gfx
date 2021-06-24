<?php $product_trailer_youtube = get_field('product_trailer_youtube'); ?>

<section class="single-product-hero">
    <div class="container">
        <div class="section-holder">
            <div class="content-col">
                <div class="title <?php if (have_rows('compatible_with')) : ?>compatible-box<?php endif; ?>">
                    <h2><?php the_title(); ?> <img
                            src="<?php echo get_template_directory_uri() ?>/static/img/verified-icon.png"
                            alt="verified icon"></h2>

                    <?php if (have_rows('compatible_with')) : ?>
                        <div class="compatible-with-box">
                            <div class="title">
                                Fully Compatible
                            </div>
                            <div class="text">
                                This product is fully compatible with the following platforms:
                            </div>
                            <div class="items">
                                <?php while (have_rows('compatible_with')) : the_row(); ?>
                                    <div class="item">
                                        <?php if (get_sub_field('icon')) { ?>
                                            <img src="<?php the_sub_field('icon'); ?>"/>
                                        <?php } ?>
                                    </div>
                                <?php endwhile; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php $categories = get_the_terms($product_id, 'product_cat');
                if (isset($categories) && !empty($categories)) : ?>
                    <div class="category">
                        <?php echo $categories[0]->name;; ?>
                    </div>
                <?php endif; ?>

                <div class="buttons-holder">
                    <?php if ($product_trailer_youtube) : ?>
                        <a href="#" class="primary-button">Play Trailer</a>

                        <div class="product-trailer-popup">

                        </div>
                    <?php endif; ?>
                    <a href="#" class="secondary-button slow-scroll-link">What’s Inside?</a>
                </div>
            </div>
            <?php if ($product_trailer_youtube) : ?>
                <div class="video-col">
                    <?php echo $product_trailer_youtube; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>