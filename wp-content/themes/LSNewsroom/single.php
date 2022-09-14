<?php
get_header();
?>
<section id="content">
	<?php
	/* Start the Loop */
	while (have_posts()) :
		the_post();

		get_template_part('theme-parts/post', 'view');
	endwhile; // End of the loop.
	?>

</section><!-- #main -->
<?php
get_footer();
