<?php
get_header();

?>
<main id="main" class="site-main">
	<?php
	/* Start the Loop */
	while (have_posts()) :
		the_post();
		get_template_part('theme-parts/media', 'view');
	endwhile; // End of the loop.
	?>

</main><!-- #main -->
<?php
get_footer();
