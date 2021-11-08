<?php if ( ! empty( $args ) && isset( $args['product'] ) ) :
	$product   = $args['product'];
	$downloads = $product->get_downloads();
	$is_free   = $product->get_price() === '0';
endif; ?>

<?php
	$popup_title_discord  = get_field( 'free_download_popup_title_discord', 'option' );
	$popup_discord_button = get_field( 'free_download_popup_discord_button', 'option' );
	$popup_title          = get_field( 'free_download_popup_title', 'option' );
	$popup_text           = get_field( 'free_download_popup_text', 'option' );
	$popup_twitter_link   = get_field( 'free_download_popup_twitter_link', 'option' );
	$popup_youtube_link   = get_field( 'free_download_popup_youtube_link', 'option' );
	$popup_instagram_link = get_field( 'free_download_popup_instagram_link', 'option' );

?>

<?php if ( $is_free && count( $downloads ) ) : ?>
	<?php wp_enqueue_style( 'single_product_popup_thanks_css', get_template_directory_uri() . '/static/css/template-parts/blocks/single_product_popup_thanks/single-product-popup-thanks.css', '', '', 'all' ); ?>
	<?php wp_enqueue_script( 'single_product_popup_thanks_js', get_template_directory_uri() . '/static/js/template-parts/blocks/single_product_popup_thanks/single-product-popup-thanks.js', array( 'jquery' ), '', true ); ?>

	<div class="thanks-popup js-thanks-popup">
		<?php if ( $popup_title_discord && $popup_discord_button['url'] ) : ?>
			<div class="thanks-popup-discord">
				<div class="thanks-popup-discord-holder">
					<img class="thanks-popup-discord-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/static/img/discord.svg" alt="" />
					<p class="thanks-popup-discord-text">
						<?php echo $popup_title_discord; ?>
					</p>

					<a class="secondary-button thanks-popup-discord-button" href="<?php echo $popup_discord_button['url']; ?>" target="<?php echo $popup_discord_button['target']; ?>">
						<?php echo $popup_discord_button['title']; ?>
					</a>
				</div>
			</div>
		<?php endif; ?>

		<?php if ( $popup_title && $popup_text ) : ?>
			<div class="thanks-popup-wrapper">
				<div class="thanks-popup-wrapper-close js-close-btn"></div>
				<h3 class="thanks-popup-title"><?php echo $popup_title; ?></h3>
				<div class="thanks-popup-text"><?php echo $popup_text; ?></div>

				<?php if ( $popup_twitter_link['url'] || $popup_youtube_link['url'] || $popup_instagram_link['url'] ) : ?>
					<div class="thanks-popup-social">
						<?php if ( $popup_twitter_link && $popup_twitter_link['url'] ) : ?>
							<a class="thanks-popup-social-link" href="<?php echo $popup_twitter_link['url']; ?>" target="<?php echo $popup_twitter_link['target']; ?>">
								<img class="thanks-popup-social-link-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/static/img/twitter.svg" alt="">
								<?php echo $popup_twitter_link['title']; ?>
							</a>
						<?php endif; ?>

						<?php if ( $popup_youtube_link && $popup_youtube_link['url'] ) : ?>
							<a class="thanks-popup-social-link" href="<?php echo $popup_youtube_link['url']; ?>" target="<?php echo $popup_youtube_link['target']; ?>">
								<img class="thanks-popup-social-link-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/static/img/youtube.svg" alt="">
								<?php echo $popup_youtube_link['title']; ?>
							</a>
						<?php endif; ?>

						<?php if ( $popup_instagram_link && $popup_instagram_link['url'] ) : ?>
							<a class="thanks-popup-social-link" href="<?php echo $popup_instagram_link['url']; ?>" target="<?php echo $popup_instagram_link['target']; ?>">
								<img class="thanks-popup-social-link-icon" src="<?php echo get_stylesheet_directory_uri(); ?>/static/img/instagram.svg" alt="">
								<?php echo $popup_instagram_link['title']; ?>
							</a>
						<?php endif; ?>
					</div>
				<?php endif; ?>



				<?php if ( count( $downloads ) === 1 ) : ?>
					<?php
					foreach ( $downloads as $key => $each_download ) {
						echo '
                            <div class="thanks-popup-wrapper-repeat">
                                    If the download didn’t start automatically, <a class="thanks-popup-wrapper-repeat-link" download href="' . $each_download['file'] . '">click here</a>
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
                        <div class="thanks-popup-wrapper-repeat">
                            If the download didn’t start automatically, <button class="thanks-popup-wrapper-repeat-link js-thanks-popup-repeat-btn" data-links="' . $link_array . '" >click here</button>
                        </div>
                        ';
					?>
				<?php endif; ?>


			</div>
		<?php endif; ?>
	</div>
	<div class="thanks-popup-overlay js-thanks-popup-overlay"></div>
<?php endif; ?>
