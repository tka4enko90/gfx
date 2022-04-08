<?php
$support_page_id = get_field('support_page_id', 'option');
if(empty($support_page_id)) {
    $support_page_id = get_page_by_title( __('Support', 'gfx') )->ID;
}
if ( $support_page_id ) :
	$support_page_title = __( 'Support', 'gfx' );
	$term               = get_queried_object();
	if ( $term instanceof WP_Term ) {
		$image = get_field( 'section_hero_image', 'term_' . $term->term_id );
	}
	$support_hero_subtitle = get_field( 'support_hero_subtitle', $support_page_id );
	$args                  = array(
		'title'       => $support_page_title,
		'subtitle'    => $support_hero_subtitle,
		'search_type' => 'support',
	);
	if ( ! empty( $image ) && $image['ID'] ) {
		$args['image']      = $image;
		$args['image_size'] = 'gfx_wc_hero_large';
	}

	if ( isset( $page_title ) || isset( $support_hero_subtitle ) ) :
		get_template_part(
			'template-parts/blocks/hero_search/hero-search',
			'',
			$args
		);
	endif;

	get_template_part( 'template-parts/blocks/taxonomy_section_posts/taxonomy-section-posts', '', array( 'support_page_id' => $support_page_id ) );
endif;
