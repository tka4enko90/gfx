<?php $page_id = get_queried_object_id();
if ( $page_id ) :
	$search_type = '';
	$page        = get_queried_object();
	if ( is_category() ) {
		$blog_page_id       = get_option( 'page_for_posts' );
		$page_title         = __( 'Blog', 'gfx' );
		$blog_hero_subtitle = get_field( 'blog_hero_subtitle', $blog_page_id );
	} elseif ( is_tax( 'tutorials_category' ) ) {
		$blog_page_id       = get_field('tutorials_archive_page_id', 'option');
		if( empty( $blog_page_id ) ) { // Deprecated
            $blog_page_id = get_page_by_title( __( 'Tutorials', 'gfx' ) );
        }
		$page_title         = __( 'Tutorials', 'gfx' );
		$blog_hero_subtitle = get_field( 'resources_hero_subtitle', $blog_page_id );
		$search_type        = 'tutorial';
	} else {
		$page_title         = get_the_title( $page_id );
		$blog_hero_subtitle = get_field( 'blog_hero_subtitle', $page_id );
	}
	if ( $page instanceof WP_Post ) {
		$image = get_field( 'blog_hero_image', $page->ID );
	}

	$args = array(
		'title'       => $page_title,
		'subtitle'    => $blog_hero_subtitle,
		'search_type' => $search_type,
	);
	if ( ! empty( $image ) && $image['ID'] ) {
		$args['image']      = $image;
		$args['image_size'] = 'gfx_wc_hero_large';
	}
	if ( $page_title || $blog_hero_subtitle ) :
		get_template_part(
			'template-parts/blocks/hero_search/hero-search',
			'',
			$args
		);
	endif;
endif;

if ( is_tax( 'tutorials_category' ) ) {
	get_template_part( 'template-parts/blocks/posts_grid/posts-grid', '', array( 'post_type' => 'tutorial' ) );
} else {
	get_template_part( 'template-parts/blocks/posts_grid/posts-grid', '', array( 'post_type' => 'post' ) );
}
