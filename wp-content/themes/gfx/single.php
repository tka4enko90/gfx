<?php get_header(); ?>

	<main class="main">
		<?php
		$blog_page_id       = get_option( 'page_for_posts' );
		$page_title         = __( 'Blog', 'gfx' );
		$blog_hero_subtitle = get_field( 'blog_hero_subtitle', $blog_page_id );
		$single_hero_image  = get_field( 'single_hero_image' );
		$image              = $single_hero_image ? $single_hero_image : get_field( 'blog_hero_image', $blog_page_id );
		$args               = array(
			'title'    => $page_title,
			'subtitle' => $blog_hero_subtitle,
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

		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/pages/single/content-single' );
		endwhile;
		?>
	</main>

<?php get_footer(); ?>
