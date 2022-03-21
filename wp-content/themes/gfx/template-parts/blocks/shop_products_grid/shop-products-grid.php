<?php wp_enqueue_style( 'select2_css', get_template_directory_uri() . '/static/css/select2.min.css', '', '', 'all' ); ?>
<?php wp_enqueue_style( 'shop_products_grid_css', get_template_directory_uri() . '/static/css/template-parts/blocks/shop_products_grid/shop-products-grid.css', '', '', 'all' ); ?>

<?php wp_enqueue_script( 'select2_js', get_template_directory_uri() . '/static/js/select2.min.js', '', '', true ); ?>
<?php wp_enqueue_script( 'shop_products_grid_js', get_template_directory_uri() . '/static/js/template-parts/blocks/shop_products_grid/shop-products-grid.js', array( 'select2_js' ), '', true ); ?>

<?php if ( is_tax( 'product_cat' ) ) : ?>
	<?php $current_term_id = get_queried_object()->term_id; ?>
<?php endif; ?>

<section class="shop-products-grid">
	<div class="container">
		<form action="" id="product-filtration-form" method="GET">
			<input type="hidden" name="page" value="1">
			<div class="filters-holder">
				<div class="col filters">
					<div>
						<div class="search-form-holder">
							<input type="search" name="search" placeholder="Search Products..">
						</div>

						<?php
						$filter_tags = get_terms( 'filter_tag' );
						if ( ! empty( $filter_tags ) ) :
							?>
							<div class="filter-tags-holder">
								<span class="placeholder"><?php _e( 'Filters', 'gfx' ); ?></span>
								<select name="filter-tags[]" class="custom-select multiple filter-tags-select">
									<?php foreach ( $filter_tags as $filter_tag ) : ?>
										<option value="<?php echo $filter_tag->slug; ?>"><?php echo $filter_tag->name; ?></option>
									<?php endforeach; ?>
								</select>
							</div>
						<?php endif; ?>

						<?php
						$colors = get_terms( 'pa_color' );
						if ( ! empty( $colors ) ) :
							?>
							<div class="colors-holder">
								<?php foreach ( $colors as $color ) : ?>
									<?php $slug = $color->slug; ?>
									<?php $color_hex = get_field( 'color_hex', $color ); ?>
									<?php $multi_color = get_field( 'multi_color', $color ); ?>

									<?php if ( $multi_color ) : ?>
										<label class="multi-color" style="background-color: <?php echo $color_hex; ?>">
											<input type="checkbox" name="color[]" value="<?php echo $slug; ?>">
											<svg xmlns="http://www.w3.org/2000/svg"
												 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="512"
												 height="512" x="0" y="0" viewBox="0 0 515.556 515.556"
												 style="enable-background:new 0 0 512 512" xml:space="preserve"
												 class=""><g>
													<path xmlns="http://www.w3.org/2000/svg"
														  d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
														  fill="#576479" data-original="#000000" style="" class=""/>
												</g></svg>
										</label>
									<?php endif; ?>

									<?php if ( ! $multi_color && $color_hex ) : ?>
										<label style="background-color: <?php echo $color_hex; ?>">
											<input type="checkbox" name="color[]" value="<?php echo $slug; ?>">
											<svg xmlns="http://www.w3.org/2000/svg"
												 xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" width="512"
												 height="512" x="0" y="0" viewBox="0 0 515.556 515.556"
												 style="enable-background:new 0 0 512 512" xml:space="preserve"
												 class=""><g>
													<path xmlns="http://www.w3.org/2000/svg"
														  d="m0 274.226 176.549 176.886 339.007-338.672-48.67-47.997-290.337 290-128.553-128.552z"
														  fill="#576479" data-original="#000000" style="" class=""/>
												</g></svg>
										</label>
									<?php endif; ?>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
					</div>
					<div class="filter-bubbles"></div>
				</div>
				<div class="col sort">
					<div class="sort-holder">
						<select name="sort-by" class="custom-select sort-by-select">
							<option value="date-new-old">Date, new to old</option>
							<option value="date-old-new">Date, old to new</option>
							<option value="alphabetically-a-z">Alphabetically, A-Z</option>
							<option value="alphabetically-z-a">Alphabetically, Z-A</option>
							<option value="price-high-to-low">Price, high to low</option>
							<option value="price-low-to-high">Price, low to high</option>
						</select>
					</div>

					<div class="showing-results">
						Showing <span class="showing-posts-count"></span> of <span
								class="all-posts-count"></span>
						results
					</div>
				</div>
			</div>
			<div class="section-holder">
				<?php get_template_part( 'template-parts/blocks/shop_products_grid/shop_products-item', '', array( 'args' => $_GET ) ); ?>

				<?php
				$product_categories = get_terms(
					array(
						'taxonomy'   => 'product_cat',
						'hide_empty' => true,
						'parent'     => 0,
					)
				);
				?>
				<?php if ( ! empty( $product_categories ) ) : ?>
					<div class="col categories">
						<div class="categories-list">
							<h6><?php _e( 'Categories', 'gfx' ); ?></h6>
							<ul>
								<?php $products_count = wp_count_posts( 'product' ); ?>
								<?php $shop_page_url = wc_get_page_permalink( 'shop' ); ?>

								<?php if ( $shop_page_url ) : ?>
									<li>
										<a href="<?php echo $shop_page_url; ?>">
											All products
											<?php if ( $products_count ) : ?>
												<span><?php echo $products_count->publish; ?></span>
											<?php endif; ?>
										</a>
									</li>
								<?php endif; ?>
								<?php foreach ( $product_categories as $category ) : ?>
									<?php $term_id = $category->term_id; ?>
									<?php $term_name = $category->name; ?>
									<?php $term_count = $category->count; ?>
									<?php
									$children_terms = get_terms(
										array(
											'taxonomy' => 'product_cat',
											'parent'   => $term_id,
										)
									);
									?>
									<li 
									<?php
									if ( ! empty( $children_terms ) ) :
										?>
										class="has-children not-a-link"<?php endif; ?>>
										<a href="<?php echo get_term_link( $term_id ); ?>"
										   <?php
											if ( isset( $current_term_id ) && $term_id === $current_term_id ) :
												?>
												class="current"<?php endif; ?>>
											<?php if ( ! empty( $children_terms ) ) : ?>
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
										<?php if ( ! empty( $children_terms ) ) : ?>
											<ul>
												<?php foreach ( $children_terms as $child ) : ?>
													<?php $child_id = $child->term_id; ?>
													<?php $child_name = $child->name; ?>
													<?php $child_count = $child->count; ?>
													<li>
														<a href="<?php echo get_term_link( $child_id ); ?>"
														   <?php
															if ( isset( $current_term_id ) && $child_id === $current_term_id ) :
																?>
																class="current"<?php endif; ?>>
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
		</form>
	</div>
</section>
