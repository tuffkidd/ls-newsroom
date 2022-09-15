<?php
// $tags = get_the_tags();
$tags = wp_get_post_terms(get_the_ID(), 'post_tag', array('orderby' => 'term_id', 'fields' => 'all'));
?>

<div class="entry-footer">
	<div class="entry-footer-tag-wrap">
		<?php if ($tags) { ?>
			<div class="entry-footer-tags">
				<?php foreach ($tags as $key => $val) : ?>
					<a href="<?php echo get_tag_link($val->term_id); ?>" class="entry-footer-tag"><?php echo $val->name ?></a>
				<?php endforeach; ?>
			</div>
		<?php } ?>

	</div>
	<div class="entry-footer-sig">
		<img src="<?php echo THEME_IMAGE_URI ?>/content-bottom-sig.png" alt="LS전선 뉴스룸">
	</div>
	<?php /*
	<div class="entry-footer-sig">
		<img src="<?php echo THEME_IMAGE_URI;?>/logo-content.png" alt="삼성반도체이야기">
	</div>
	*/ ?>
</div>