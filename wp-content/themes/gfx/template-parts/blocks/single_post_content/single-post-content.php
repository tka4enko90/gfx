<?php $post_id = get_the_ID();
if ( $post_id ) :
	$post_content            = get_the_content();
	$post_image              = get_the_post_thumbnail( $post_id, 'gfx_wc_gallery_large' );
	$categories              = get_terms( 'category' );
	$current_post_categories = get_the_terms( $post_id, 'category' );

	if ( $post_image || $post_content ) :
		wp_enqueue_style( 'single_post_content_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_post_content/single-post-content.css', '', '', 'all' ); ?>

		<section class="single-post-content">
			<div class="container container-small">
				<div class="section-holder">
					<div class="cols-holder">
						<div class="left-col">
							<div class="breadcrumbs">
								<?php
								$blog_page_id  = get_page_by_title( 'Blog' )->ID;
								$blog_page_url = get_the_permalink( $blog_page_id );
								?>

								<a href="<?php echo $blog_page_url; ?>"><?php _e( 'Blog', 'gfx' ); ?></a>

								<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
									 xmlns:xlink="http://www.w3.org/1999/xlink"
									 x="0px" y="0px"
									 viewBox="0 0 492.004 492.004"
									 style="fill:white;enable-background:new 0 0 492.004 492.004;"
									 xml:space="preserve">
								<path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
									c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
									c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
									c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
						</svg>

								<?php if ( ! empty( $current_post_categories ) ) : ?>
									<a href="<?php echo get_category_link( $current_post_categories[0]->term_id, 'section' ); ?>"><?php echo $current_post_categories[0]->name; ?></a>
									<svg version="1.1" xmlns="http://www.w3.org/2000/svg"
													 xmlns:xlink="http://www.w3.org/1999/xlink"
													 x="0px" y="0px"
													 viewBox="0 0 492.004 492.004"
													 style="fill:white;enable-background:new 0 0 492.004 492.004;"
													 xml:space="preserve">
											<path d="M382.678,226.804L163.73,7.86C158.666,2.792,151.906,0,144.698,0s-13.968,2.792-19.032,7.86l-16.124,16.12
												c-10.492,10.504-10.492,27.576,0,38.064L293.398,245.9l-184.06,184.06c-5.064,5.068-7.86,11.824-7.86,19.028
												c0,7.212,2.796,13.968,7.86,19.04l16.124,16.116c5.068,5.068,11.824,7.86,19.032,7.86s13.968-2.792,19.032-7.86L382.678,265
												c5.076-5.084,7.864-11.872,7.848-19.088C390.542,238.668,387.754,231.884,382.678,226.804z"/>
									</svg>
								<?php endif; ?>

								<span><?php the_title(); ?></span>
							</div>

							<h2><?php the_title(); ?></h2>

							<?php $modified_date = get_the_modified_date( 'F j, Y' ); ?>
							<?php if ( $modified_date ) : ?>
								<div class="modified-date">
									<?php echo __( 'Updated' ) . ' ' . $modified_date; ?>
								</div>
							<?php endif; ?>

							<?php if ( $post_image ) : ?>
								<div class="thumbnail">
									<?php echo $post_image; ?>
								</div>
							<?php endif; ?>

							<?php if ( $post_content ) : ?>
								<div class="content">
									<?php the_content(); ?>
								</div>
							<?php endif; ?>
						</div>

						<?php if ( ! empty( $categories ) ) : ?>
							<div class="right-col sidebar">
								<h6><?php _e( 'Categories', 'gfx' ); ?></h6>

								<?php $blog_page_url = get_post_type_archive_link( 'post' ); ?>
								<a href="<?php echo $blog_page_url; ?>"
									<?php echo is_home() ? 'class="current"' : ''; ?>>
									<?php _e( 'All Posts', 'gfx' ); ?>
								</a>

								<?php
								foreach ( $categories as $cat ) :
									$cat_id           = $cat->term_id;
									$cat_name         = $cat->name;
									$current_category = get_queried_object();
									?>
									<a href="<?php echo get_term_link( $cat_id ); ?>" <?php echo $cat_id === $current_category->term_id ? 'class="current"' : ''; ?>>
										<?php echo $cat_name; ?>
									</a>
									<?php
								endforeach;

								if ( function_exists( 'zg_recently_viewed' ) ) :
									?>
									<h6><?php _e( 'Recently Viewed Posts', 'gfx' ); ?></h6>
									<?php
									zg_recently_viewed();
								endif;
								?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</section>
	<?php endif;
endif; ?>
