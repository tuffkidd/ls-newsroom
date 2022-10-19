<?php
get_header()
?>
<section id="content">
	<div class="page-wrap container" id="content-wrap">
		<div id="page-<?php the_ID(); ?>">
			<!-- 헤더 -->
			<div class="entry-header">
				<h1 class="entry-header-title"><?php echo the_title(); ?></h1>
			</div>

			<!-- 바디 -->
			<div class="entry-body">
				<div class="entry-body-wrap">
					<?php the_content(); ?>
				</div>
			</div>
		</div>
</section><!-- #main -->
<?php
get_footer();
