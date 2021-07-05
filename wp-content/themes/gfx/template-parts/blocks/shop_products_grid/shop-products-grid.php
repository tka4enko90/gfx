<?php wp_enqueue_style('shop_products_grid_css', get_template_directory_uri() . '/static/css/template-parts/blocks/shop_products_grid/shop-products-grid.css', '', '', 'all'); ?>
<?php wp_enqueue_script('shop_products_grid_js', get_template_directory_uri() . '/static/js/template-parts/blocks/shop_products_grid/shop-products-grid.js', '', '', true); ?>

<?php if (is_tax('product_cat')) : ?>
    <?php $current_term_id = get_queried_object()->term_id; ?>
<?php endif; ?>

<section class="shop-products-grid">
    <div class="container">
        <div class="filters-holder">
            <div class="col filters">
                <?php if(function_exists('get_product_search_form')) : ?>
                    <?php get_product_search_form(); ?>
                <?php endif; ?>
            </div>
            <div class="col sort">
                <select name="" id="">
                    <option value="1">1</option>
                    <option value="2">2</option>
                </select>
            </div>
        </div>
        <div class="section-holder">
            <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $args = array(
                'post_type' => 'product',
                'posts_per_page' => '6', // 18
                'paged' => $paged
            );
            $products = new WP_Query($args);
            if ($products->have_posts()) : ?>
                <div class="col">
                    <div class="products-grid">
                        <?php while ($products->have_posts()) : $products->the_post(); ?>
                            <?php $product_id = get_the_ID(); ?>
                            <?php if ($product_id) : ?>
                                <?php $product = wc_get_product($product_id); ?>
                                <?php if (isset($product) && $product instanceof WC_Product) : ?>
                                    <?php get_template_part('template-parts/product-card', '', array('product' => $product)); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endwhile; ?>
                    </div>
                    <div class="posts-pagination">
                        <?php $total_pages = $products->max_num_pages;
                        if ($total_pages > 1) {
                            $current_page = max(1, get_query_var('paged'));
                            echo paginate_links(array(
                                'base' => get_pagenum_link(1) . '%_%',
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
                </div>
            <?php endif;
            wp_reset_postdata(); ?>

            <?php $product_categories = get_terms(array(
                'taxonomy' => 'product_cat',
                'hide_empty' => true,
                'parent' => 0
            )); ?>
            <?php if (!empty($product_categories)) : ?>
                <div class="col categories">
                    <div class="categories-list">

                        <h6><?php _e('Categories'); ?></h6>
                        <ul>
                            <?php foreach ($product_categories as $category) : ?>
                                <?php $term_id = $category->term_id; ?>
                                <?php $term_name = $category->name; ?>
                                <?php $term_count = $category->count; ?>
                                <?php $children_terms = get_terms(array(
                                    'taxonomy' => 'product_cat',
                                    'parent' => $term_id
                                )); ?>
                                <li <?php if (!empty($children_terms)) : ?>class="has-children not-a-link"<?php endif; ?>>
                                    <a href="<?php echo get_term_link($term_id); ?>"
                                       <?php if (isset($current_term_id) && $term_id === $current_term_id) : ?>class="current"<?php endif; ?>>
                                        <?php if (!empty($children_terms)) : ?>
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                 viewBox="0 0 492.004 492.004"
                                                 style="fill:white;enable-background:new 0 0 492.004 492.004;"
                                                 xml:space="preserve">
                                                    <path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
                                                        c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
                                                        c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
                                                        c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
                                            </svg>
                                        <?php endif; ?>
                                        <?php echo $term_name; ?>
                                        <span><?php echo $term_count; ?></span>
                                    </a>
                                    <?php if (!empty($children_terms)) : ?>
                                        <ul>
                                            <?php foreach ($children_terms as $child) : ?>
                                                <?php $child_id = $child->term_id; ?>
                                                <?php $child_name = $child->name; ?>
                                                <?php $child_count = $child->count; ?>
                                                <li>
                                                    <a href="<?php echo get_term_link($child_id); ?>"
                                                       <?php if (isset($current_term_id) && $child_id === $current_term_id) : ?>class="current"<?php endif; ?>>
                                                        <?php echo $child_name; ?>
                                                        <span><?php echo $child_count; ?></span>
                                                    </a>
                                                </li>
                                            <?php endforeach; ?>
                                        </ul>
                                    <?php endif; ?>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>