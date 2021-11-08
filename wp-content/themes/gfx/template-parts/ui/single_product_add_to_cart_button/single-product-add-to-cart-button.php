<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product   = $args['product'];
	$downloads = $product->get_downloads();
	$is_free   = $product->get_price() === '0' || $product->get_price() === '0.00';
endif; ?>

<?php if ( ! $is_free ) : ?>
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
<?php endif; ?>

<?php if ( $is_free && count( $downloads ) ) : ?>
	<?php if ( count( $downloads ) === 1 ) : ?>
		<?php
		foreach ( $downloads as $key => $each_download ) {
			echo '
                <div class="add-to-cart-btn-holder">
                    <a download href="' . $each_download['file'] . '" class="primary-button download js-download-btn" >
                        <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0H6V12.5856L1.41421 7.99985L0 9.41406L6 15.4141V15.4151L7 16.5L8 15.5V15.4847L14.0587 9.42593L12.6445 8.01172L8 12.6562V0ZM14 20V18.5H0V20H14Z" fill="white"/>
                        </svg>
                        Download
                    </a>
                </div>
            ';
		}
		?>
	<?php endif; ?>

	<?php if ( count( $downloads ) > 1 ) : ?>
		<?php
		$link_array = '';
		foreach ( $downloads as $key => $each_download ) {
			$link_array .= "{$each_download['file']},";
		}
		echo '
            <div class="add-to-cart-btn-holder">
                <button  data-links="' . $link_array . '" class="primary-button download js-download-some-links-btn" >
                    <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0H6V12.5856L1.41421 7.99985L0 9.41406L6 15.4141V15.4151L7 16.5L8 15.5V15.4847L14.0587 9.42593L12.6445 8.01172L8 12.6562V0ZM14 20V18.5H0V20H14Z" fill="white"/>
                    </svg>
                    Download
                </button>
            </div>
            ';
		?>
	<?php endif; ?>
<?php endif; ?>
