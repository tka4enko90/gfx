<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
get_header();

/**
 * Options for 404 Page.
 * @see Options -> 404 Page -> Title 404, Description 404, Background Image 404.
 */
$title404 = get_field('title_404', 'option');
$desc404 = get_field('description_404', 'option');
$BgImg404 = get_field('background_image_404', 'option');
?>

<main class="main">
	<div class="hero hero-page">
		<div class="container">
			<div class="hero-inner" style="background-image: url('<?php echo $BgImg404; ?>');">
				<div class="hero-body">
					<?php if($title404): ?>
						<h1 class="hero-title">
							<?php echo $title404; ?>
						</h1>
					<?php endif ?>
				</div>
			</div>
		</div>
	</div>
	<div class="page-content">
		<div class="container">
			<?php if($desc404): ?>
				<?php echo $desc404; ?>
			<?php endif ?>
		</div>
	</div>
</main>

<?php
get_footer();
