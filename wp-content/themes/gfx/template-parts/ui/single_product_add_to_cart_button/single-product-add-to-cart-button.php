<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product   = $args['product'];
	$downloads = $product->get_downloads();
	$is_free   = $product->get_price() === '0' || $product->get_price() === '0.00';
endif; 

$popup_discord_button = get_field( 'free_download_popup_discord_button', 'option' );

?>

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
                    </a>';
					if ( $popup_discord_button['url'] ) {
						echo '
						<a class="primary-button blue discord" href="' . $popup_discord_button['url'] . '" target="' . $popup_discord_button['target'] . '">
							<svg width="26" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M22.454 2.364S19.745.244 16.546 0l-.288.577c2.893.708 4.22 1.722 5.607 2.968-2.39-1.22-4.75-2.363-8.864-2.363-4.113 0-6.473 1.143-8.864 2.363C5.523 2.3 7.102 1.173 9.743.577L9.455 0c-3.357.317-5.91 2.364-5.91 2.364S.52 6.75 0 15.364c3.05 3.517 7.682 3.545 7.682 3.545l.968-1.291a11.835 11.835 0 01-5.105-3.436C5.46 15.629 8.347 17.136 13 17.136c4.653 0 7.541-1.506 9.454-2.954a11.835 11.835 0 01-5.104 3.436l.968 1.291s4.632-.028 7.682-3.545c-.52-8.613-3.546-13-3.546-13zM9.16 13c-1.142 0-2.068-1.058-2.068-2.364 0-1.305.926-2.363 2.068-2.363s2.068 1.058 2.068 2.363c0 1.306-.926 2.364-2.068 2.364zm7.682 0c-1.142 0-2.068-1.058-2.068-2.364 0-1.305.926-2.363 2.068-2.363s2.068 1.058 2.068 2.363c0 1.306-.926 2.364-2.068 2.364z" fill="#fff"/>
							</svg>
							Source Files
						</a>';
					}

			echo '	
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
                <button data-links="' . $link_array . '" class="primary-button download js-download-some-links-btn" >
                    <svg width="15" height="20" viewBox="0 0 15 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" clip-rule="evenodd" d="M8 0H6V12.5856L1.41421 7.99985L0 9.41406L6 15.4141V15.4151L7 16.5L8 15.5V15.4847L14.0587 9.42593L12.6445 8.01172L8 12.6562V0ZM14 20V18.5H0V20H14Z" fill="white"/>
                    </svg>
                    Download
                </button>';
				if ( $popup_discord_button['url'] ) {
					echo '
						<a class="primary-button blue discord" href="' . $popup_discord_button['url'] . '" target="' . $popup_discord_button['target'] . '">
							<svg width="26" height="19" fill="none" xmlns="http://www.w3.org/2000/svg">
								<path d="M22.454 2.364S19.745.244 16.546 0l-.288.577c2.893.708 4.22 1.722 5.607 2.968-2.39-1.22-4.75-2.363-8.864-2.363-4.113 0-6.473 1.143-8.864 2.363C5.523 2.3 7.102 1.173 9.743.577L9.455 0c-3.357.317-5.91 2.364-5.91 2.364S.52 6.75 0 15.364c3.05 3.517 7.682 3.545 7.682 3.545l.968-1.291a11.835 11.835 0 01-5.105-3.436C5.46 15.629 8.347 17.136 13 17.136c4.653 0 7.541-1.506 9.454-2.954a11.835 11.835 0 01-5.104 3.436l.968 1.291s4.632-.028 7.682-3.545c-.52-8.613-3.546-13-3.546-13zM9.16 13c-1.142 0-2.068-1.058-2.068-2.364 0-1.305.926-2.363 2.068-2.363s2.068 1.058 2.068 2.363c0 1.306-.926 2.364-2.068 2.364zm7.682 0c-1.142 0-2.068-1.058-2.068-2.364 0-1.305.926-2.363 2.068-2.363s2.068 1.058 2.068 2.363c0 1.306-.926 2.364-2.068 2.364z" fill="#fff"/>
							</svg>
							Source Files
						</a>';
				}

        echo '</div>
            ';
		?>
	<?php endif; ?>
<?php endif; ?>
