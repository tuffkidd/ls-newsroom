<?php
global $Frontend, $wp_query;
$total_posts = $wp_query->found_posts;
?>
<li class="post-item-wrap" id="post-<?php the_ID(); ?>">
	<div class="post-thumb">
		<a href="<?php the_permalink(); ?>" class="thumbnail-link">
			<?php the_post_thumbnail('post-list') ?>
		</a>
	</div>
	<div class="post-detail">
		<a href="<?php the_permalink(); ?>" class="post-title">
			<?php the_title(); ?>
		</a>

		<div class="post-etc">
			<span class="post-date"><?php the_date('Y.m.d'); ?></span>
		</div>

		<div class="post-excerpt">
			<?php echo get_the_excerpt() ?>
		</div>
	</div>
</li>