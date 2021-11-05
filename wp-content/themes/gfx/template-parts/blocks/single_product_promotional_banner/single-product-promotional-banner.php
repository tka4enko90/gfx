<?php
	$background_id    = get_field( 'product_banner_background' );
	$text             = get_field( 'product_promotional_text' );
	$text_color       = get_field( 'product_promotional_text_color' );
	$promo_code       = get_field( 'product_promotional_code' );
	$promo_code_color = get_field( 'product_promo_code_color' );
	$button_text      = get_field( 'product_promotional_button_text' );
	$button_color     = get_field( 'product_promotional_button_color' );
?>

<?php
if ( $text && $promo_code && $button_text ) :
	?>
	<?php wp_enqueue_style( 'single_product_promotional_banner_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_promotional_banner/single-product-promotional-banner.css', '', '', 'all' ); ?>
	<?php wp_enqueue_script( 'single_product_promotional_banner_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_promotional_banner/single-product-promotional-banner.js', array( 'jquery' ), '', true ); ?>

	<div class="single-product-promotional-banner">
		<?php if ( $background_id ) : ?>
			<div class="single-product-promotional-banner-overlay">
				<?php echo wp_get_attachment_image( $background_id, 'gfx_product_banner' ); ?>
			</div>
		<?php endif; ?>

		<div class="container">
			<div class="section-holder">
				<div class="single-product-promotional-banner-text" style="color: <?php echo $text_color; ?>;">
					<?php echo str_replace( '%%CODE%%', '<span style="color: ' . $promo_code_color . '">' . $promo_code . '</span>', $text ); ?>
				</div>


				<button onclick="copyPromoCode('<?php echo $promo_code; ?>')" class="secondary-button js-promo-code-btn" style="color: <?php echo $button_color; ?>; border: 1px solid <?php echo $button_color; ?>;">
					<?php echo $button_text; ?>
				</button>
			</div>
		</div>
	</div>

<?php endif; ?>
