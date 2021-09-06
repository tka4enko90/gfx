<?php
get_template_part('template-parts/blocks/single_post_content/single-post-content');

$post = get_post();
if ($post) :
    get_template_part('template-parts/blocks/single_product_related/single-product-related', '', array('post' => $post));
endif; ?>