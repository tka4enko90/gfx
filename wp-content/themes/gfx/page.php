<?php
/**
 * @package WordPress
 * @subpackage gfx
 */
get_header();
?>

<main class="main">
	<?php
	while (have_posts()) :
		the_post();
		the_content();
	endwhile;
	?>
</main>

<?php
get_footer();
