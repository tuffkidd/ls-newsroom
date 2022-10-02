<?php
global $Frontend, $wp_query;
get_header();
$total_posts = $wp_query->found_posts;
?>
<section id="content">
	<div class="container">
		<div class="post-list-wrap">
			<div class="post-list-header">
				<h1><?php echo get_queried_object()->name; ?></h1>
				<span>총 <?php echo $wp_query->found_posts; ?>건의 글이 있습니다</span>
			</div>
			<?php
			if (have_posts()) :
			?>
				<ul class="post-list">
					<?php
					while (have_posts()) : the_post();
					?>
						<li class="post-item-wrap" id="post-<?php the_ID(); ?>">
							<div class="post-thumb">
								<a href="<?php the_permalink(); ?>" class="thumbnail-link">
									<?php the_post_thumbnail('category-list') ?>
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
					<?php
					endwhile;
					?>
				</ul>
			<?php else : ?>
				<div class="no-posts" style="padding: 40px 0;">
					아직 등록된 글이 없습니다.
				</div>
			<?php endif; ?>
			<?php get_template_part('theme-parts/pagination', ''); ?>
		</div>
	</div>
</section>
<?php
get_footer();
