<?php wp_enqueue_style( 'information_block_styles', get_template_directory_uri() . '/static/css/modules/information_block/information_block.css', '', '', 'all' ); ?>

<?php $information_block_title = get_sub_field( 'information_block_title' ); ?>
<?php $information_block_content = get_sub_field( 'information_block_content' ); ?>
<?php $information_block_button = get_sub_field( 'information_block_button' ); ?>
<?php $information_block_image_id = get_sub_field( 'information_block_image' ); ?>
<?php $information_block_content_position = get_sub_field( 'information_block_content_position' ); ?>

<section class="information-block">
	<div class="container small">
		<div class="section-holder 
		<?php
		if ( $information_block_content_position ) {
			echo $information_block_content_position; }
		?>
		">
			<?php if ( $information_block_title || $information_block_content ) : ?>
				<div class="content-holder 
				<?php
				if ( ! $information_block_image_id ) :
					?>
					full-width<?php endif; ?>">
					<?php if ( $information_block_title ) : ?>
						<h3><?php echo $information_block_title; ?></h3>
					<?php endif; ?>
					<?php if ( $information_block_content ) : ?>
						<div class="block-content">
							<?php echo $information_block_content; ?>
						</div>
					<?php endif; ?>
					<?php if ( $information_block_button && $information_block_button['url'] ) : ?>
						<a href="<?php echo $information_block_button['url']; ?>"
                           class="primary-button"
						   target="<?php echo ! empty( $information_block_button['target'] ) ? $information_block_button['target'] : '_self'; ?>"
                        >
							<?php echo $information_block_button['title']; ?>
						</a>
					<?php endif; ?>
				</div>
			<?php endif; ?>
			<?php if ( $information_block_image_id ) : ?>
				<div class="image-holder"  data-aos-duration='1500' data-aos="fade-
				<?php
				if ( $information_block_content_position ) {
					echo $information_block_content_position; }
				?>
				">
					<?php echo wp_get_attachment_image( $information_block_image_id, 'gfx_medium' ); ?>
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
