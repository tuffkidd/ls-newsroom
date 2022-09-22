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
<div class="entry-share pc-share">
	<a href="#" class="post-share copy-url" title="URL 복사">URL 복사</a>
	<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo the_permalink(); ?>" class="post-share email" title="새창에서 이메일 공유">메일</a>
	<a href="#" class="post-share kakaotalk" data-url="<?php echo urldecode(the_permalink()); ?>" data-title="<?php echo the_title(); ?>" data-thumb="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'slider') ?>" title="새창으로 카카오톡 공유">카카오톡</a>
	<a href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>" target="_blank" class="post-share facebook" title="새창으로 페이스북 공유">페이스북</a>
	<a href="#" class="print-page" title="인쇄하기">인쇄</a>
</div>
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
				<div class="entry-top-date"><?php the_date('Y.m.d'); ?></div>
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