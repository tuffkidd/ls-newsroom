<?php
global $Frontend, $post;
$cats = $Frontend->get_post_cat(get_the_ID(), 2, 2);

// 하위 카테고리만 노출
$breadcrumbs = [];
if ($cats) {
	foreach ($cats as $key => $val) {
		$breadcrumbs[] = sprintf('<a href="%s">%s</a>', esc_url(get_term_link($val->term_id)), esc_html($val->name));
	}
}
?>
<?php get_template_part('theme-parts/post', 'share'); ?>
<div class="entry-wrap container" id="content-wrap">
	<div id="post-<?php the_ID(); ?>" <?php post_class('entry'); ?>>
		<!-- 헤더 -->
		<div class="entry-header">
			<h1 class="entry-header-title"><?php echo the_title(); ?></h1>
			<div class="entry-meta">
				<?php if ($breadcrumbs) : ?>
					<div class="entry-categories">
						<?php if (is_array($breadcrumbs)) { ?><?php echo join(', ', $breadcrumbs); ?><?php } ?>
					</div>
				<?php endif; ?>
				<div class="entry-top-date"><?php echo get_the_date('Y.m.d'); ?></div>
			</div>
		</div>

		<!-- 바디 -->
		<div class="entry-body">
			<div class="entry-body-wrap">
				<?php the_content(); ?>
			</div>
		</div>
		<?php get_template_part('theme-parts/post', 'footer-tag'); ?>
		<?php get_template_part('theme-parts/post', 'related'); ?>
	</div>


	<div id="print-content">
		<div class="entry-header">
			<h1><?php echo get_the_title(); ?></h1>
			<div class="entry-meta-wrap">
				<div class="entry-meta">
					<div class="entry-categories">
						<?php if (is_array($breadcrumbs)) { ?><?php echo join(', ', $breadcrumbs); ?><?php } ?>
					</div>
					<div class="entry-top-date"><?php echo get_the_date('Y.m.d'); ?></div>
				</div>
			</div>
		</div>
		<!-- 바디 -->
		<div class="entry-body">
			<div class="entry-body-wrap">
				<?php the_content(); ?>
			</div>
		</div>
		<?php get_template_part('theme-parts/post', 'footer-tag'); ?>
		<input type="hidden" id="content-url" value="<?php echo the_permalink(); ?>">
	</div>
</div>