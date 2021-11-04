<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product = $args['product'];
endif; ?>


<?php
if ( isset( $product ) && $product instanceof WC_Product ) :
	?>
	<?php wp_enqueue_style( 'single_product_sticky_add_to_cart_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_sticky_add_to_cart/single-product-sticky-add-to-cart.css', '', '', 'all' ); ?>
    <?php wp_enqueue_script( 'single_product_sticky_add_to_cart_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_sticky_add_to_cart/single-product-sticky-add-to-cart.js', array( 'jquery' ), '', true ); ?>


    <div class="single-product-sticky-add-to-cart js_single_product_sticky_add_to_cart">
		<div class="container large">
			<div class="section-holder">
				<h3 class="single-product-sticky-add-to-cart-title">
					<?php the_title(); ?>
				</h3>
				<div class="add-to-cart-btn-holder">
                    <?php
                    $args = array(
                        'quantity'   => 1,
                        'class'      => implode(
                            ' ',
                            array_filter(
                                array(
                                    'button',
                                    'primary-button',
                                    'product_type_' . $product->get_type(),
                                    $product->is_purchasable() && $product->is_in_stock() ? 'add_to_cart_button' : '',
                                    $product->supports( 'ajax_add_to_cart' ) && $product->is_purchasable() && $product->is_in_stock() ? 'ajax_add_to_cart' : '',
                                )
                            )
                        ),
                        'attributes' => array(
                            'data-product_id'    => $product->get_id(),
                            'data-product_title' => $product->get_title(),
                            'data-product_sku'   => $product->get_sku(),
                            'aria-label'         => $product->add_to_cart_description(),
                            'rel'                => 'nofollow',
                        ),
                    );
                    woocommerce_template_loop_add_to_cart( $args );
                    ?>
                </div>
			</div>
		</div>
	</div>
<?php endif; ?>
