<?php if ( ! empty( $args ) ) : ?>
	<?php if ( ! empty( $args['title'] ) ) : ?>
		<?php $hero_title = $args['title']; ?>
	<?php endif; ?>

	<?php if ( ! empty( $args['subtitle'] ) ) : ?>
		<?php $hero_subtitle = $args['subtitle']; ?>
	<?php endif; ?>

	<?php if ( ! empty( $args['search_type'] ) ) : ?>
		<?php $search_type = $args['search_type']; ?>
	<?php endif; ?>

	<?php if ( ! empty( $args['image'] ) ) : ?>
		<?php $image = $args['image']; ?>
	<?php endif; ?>

	<?php if ( ! empty( $args['image_size'] ) ) : ?>
		<?php $image_size = $args['image_size']; ?>
	<?php endif; ?>
	<?php if ( isset( $hero_title ) || isset( $hero_subtitle ) ) : ?>
		<?php wp_enqueue_style( 'blog_hero_css', get_template_directory_uri() . '/static/css/template-parts/blocks/hero_search/hero-search.css', '', '', 'all' ); ?>
		<section class="hero-search">
			<div class="container">
				<?php if ( isset( $image_size ) && isset( $image['ID'] ) ) : ?>
					<div class="overlay" style="background-image: url( <?php echo wp_get_attachment_image_url( $image['ID'], $image_size ); ?>);"></div>
				<?php else : ?>
					<div class="overlay" style="background-image: url( <?php echo get_template_directory_uri() . '/src/img/support-hero-bg.png'; ?>"></div>
				<?php endif; ?>
				<div class="section-holder">
					<?php if ( isset( $hero_title ) ) : ?>
						<h1><?php echo $hero_title; ?></h1>
					<?php endif; ?>

					<?php if ( isset( $hero_subtitle ) ) : ?>
						<div class="subtitle">
							<?php echo $hero_subtitle; ?>
						</div>
					<?php endif; ?>

					<div class="search-form-holder">
						<?php if ( isset( $search_type ) && $search_type == 'support' ) : ?>
							<?php get_template_part( 'searchform-support' ); ?>
						<?php elseif ( isset( $search_type ) && $search_type == 'tutorial' ) : ?>
							<?php get_template_part( 'searchform-tutorials' ); ?>
						<?php else : ?>
							<?php get_search_form(); ?>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif; ?>
<?php endif; ?>
