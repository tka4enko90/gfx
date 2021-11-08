<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product = $args['product'];
endif; ?>

<?php
if ( isset( $product ) && $product instanceof WC_Product ) :
	$product_image_id = $product->get_image_id();
	$attachment_ids   = $product->get_gallery_image_ids();

	if ( $product_image_id ) :
		$product_image = wp_get_attachment_image( $product_image_id, 'gfx_wc_gallery_large' );
	endif;

	if ( isset( $product_image ) || isset( $attachment_ids ) ) :
		?>
		<?php wp_enqueue_style( 'slick-css', get_template_directory_uri() . '/static/css/slick.min.css', '', '', 'all' ); ?>
		<?php wp_enqueue_style( 'single_product_product_info_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_product_info/single-product-product-info.css', '', '', 'all' ); ?>

		<?php wp_enqueue_script( 'slick-js', get_template_directory_uri() . '/static/js/slick.min.js', array( 'jquery' ), '', true ); ?>
		<?php wp_enqueue_script( 'single_product_product_info_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_product_info/single-product-product-info.js', array( 'slick-js' ), '', true ); ?>

		<?php $read_me_page = get_field( 'read_me_page' ); ?>
		<?php if ( ! empty( $product_image ) || ! empty( $attachment_ids ) || has_excerpt() || have_rows( 'what’s_inside' ) ) : ?>
			<section class="single-product-product-info">
				<div class="container">
					<div class="section-holder">
						<?php if ( ! empty( $product_image ) || ! empty( $attachment_ids ) ) : ?>
							<div class="gallery-col">
								<?php if ( isset( $product_image ) && empty( $attachment_ids ) ) : ?>
									<?php echo $product_image; ?>
								<?php endif; ?>

								<?php if ( ! empty( $attachment_ids ) ) : ?>
									<div class="single-product-gallery-slider">
										<?php foreach ( $attachment_ids as $attachment_id ) : ?>
											<?php if ( $attachment_id ) : ?>
												<div class="slide">
													<?php
													$gallery_image = wp_get_attachment_image( $attachment_id, 'gfx_wc_gallery_large' );

													$attach_video = get_field( 'attach_video', $attachment_id );

													if ( $attach_video ) {
														$file_or_iframe = get_field( 'file_or_iframe', $attachment_id );
														$video_file     = get_field( 'video_file', $attachment_id );
														$video_iframe   = get_field( 'video_iframe', $attachment_id );

														if ( $file_or_iframe === 'file' && $video_file ) {
															echo '<video autoplay muted loop><source src="' . $video_file['url'] . '"></video>';
														}

														if ( $file_or_iframe === 'iframe' && $video_iframe ) {
															echo $video_iframe;
														}
													} else {
														if ( $gallery_image ) {
															echo $gallery_image;
														}
													}
													?>
												</div>
												<?php
											endif;
										endforeach;
										?>
									</div>
									<div class="single-product-gallery-slider-nav">
										<?php foreach ( $attachment_ids as $attachment_id ) : ?>
											<?php if ( $attachment_id ) : ?>
												<div class="slide">
													<?php $gallery_image = wp_get_attachment_image( $attachment_id, 'gfx_wc_gallery_large' ); ?>
													<?php if ( $gallery_image ) : ?>
														<?php echo $gallery_image; ?>
													<?php endif; ?>
												</div>
											<?php endif; ?>
										<?php endforeach; ?>
									</div>
								<?php endif; ?>
							</div>
						<?php endif; ?>

						<div class="info-col 
						<?php
						if ( empty( $product_image ) && empty( $attachment_ids ) ) :
							?>
							full-width<?php endif; ?>">
							<?php if ( has_excerpt() ) : ?>
								<div class="description">
									<h5><?php _e( 'Description', 'gfx' ); ?></h5>
									<div class="text">
										<?php the_excerpt(); ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( isset( $product ) && $product instanceof WC_Product ) : ?>
								<?php get_template_part( 'template-parts/ui/single_product_add_to_cart_button/single-product-add-to-cart-button', '', array( 'product' => $product ) ); ?>
							<?php endif; ?>

							<?php
							$what_inside = get_field( 'what’s_inside' );
							if ( have_rows( 'what’s_inside' ) ) :
								?>
								<div class="what_inside js-whats-inside">
									<h5><?php _e( 'What’s Inside?', 'gfx' ); ?></h5>

									<div class="cols">
										<div class="col">
											<?php
											$index = 1;
											while ( have_rows( 'what’s_inside' ) ) :
												the_row();
												if ( $index <= 6 ) :
													$title       = get_sub_field( 'title' );
													$description = get_sub_field( 'description' );
													?>

													<div class="item 
													<?php
													if ( $title && $description ) :
														?>
														dropdown-item<?php endif; ?>">
														<?php if ( $title ) : ?>
															<div class="dropdown-title"><?php echo $title; ?></div>
															<?php
														endif;

														if ( $description ) :
															?>
															<div class="dropdown-description"><?php echo $description; ?></div>
														<?php endif; ?>
													</div>
													<?php
												endif;
												$index++;
											endwhile;
											?>
										</div>

										<?php if ( sizeof( $what_inside ) > 6 ) { ?>
											<div class="col">
												<?php
												$index = 1;
												while ( have_rows( 'what’s_inside' ) ) :
													the_row();
													if ( $index > 6 ) :
														$title       = get_sub_field( 'title' );
														$description = get_sub_field( 'description' );
														?>

														<div class="item 
														<?php
														if ( $title && $description ) :
															?>
															dropdown-item<?php endif; ?>">
															<?php if ( $title ) : ?>
																<div class="dropdown-title"><?php echo $title; ?></div>
																<?php
															endif;

															if ( $description ) :
																?>
																<div class="dropdown-description"><?php echo $description; ?></div>
															<?php endif; ?>
														</div>
														<?php
													endif;
													$index++;
												endwhile;
												?>
											</div>
										<?php } ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $read_me_page ) ) : ?>
								<a class="readme-link" href="<?php echo $read_me_page['url']; ?>" target="<?php echo $read_me_page['target']; ?>"><?php echo $read_me_page['title']; ?></a>
							<?php endif; ?>


						</div>
					</div>
				</div>
			</section>
		<?php endif; ?>
	<?php endif;
endif; ?>
