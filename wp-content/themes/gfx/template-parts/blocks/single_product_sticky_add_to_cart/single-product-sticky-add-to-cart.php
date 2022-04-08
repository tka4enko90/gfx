<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product = $args['product'];
endif; ?>


<?php
if ( isset( $product ) && $product instanceof WC_Product ) :
	?>
	<?php wp_enqueue_style( 'single_product_sticky_add_to_cart_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_sticky_add_to_cart/single-product-sticky-add-to-cart.css', '', '', 'all' ); ?>
	<?php wp_enqueue_script( 'single_product_sticky_add_to_cart_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_sticky_add_to_cart/single-product-sticky-add-to-cart.js', array( 'jquery' ), '', true ); ?>

	<div class="single-product-sticky-add-to-cart js-single-product-sticky-add-to-cart">
		<div class="container container-large">
			<div class="section-holder">
				<h3 class="single-product-sticky-add-to-cart-title">
					<?php the_title(); ?>
				</h3>
				<?php get_template_part( 'template-parts/ui/single_product_add_to_cart_button/single-product-add-to-cart-button', '', array( 'product' => $product ) ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>
