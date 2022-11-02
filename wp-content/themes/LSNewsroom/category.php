<?php
global $Frontend, $wp_query;
get_header();
$total_posts = $wp_query->found_posts;

$current_cat = rawurldecode(get_queried_object()->slug);
?>
<section id="content">
	<div class="container">
		<div class="post-list-wrap">
			<div class="post-list-header">
				<h1><?php echo get_queried_object()->name; ?></h1>
				<span>총 <?php echo $wp_query->found_posts; ?>건의 글이 있습니다</span>
			</div>
			<?php if ($current_cat == 'hi테크놀러지') : ?>
				<div class="category-tags">
					<?php /* if (get_term_by('name', 'hvdc', 'post_tag')) : ?>
						<a href="<?php echo get_term_link(get_queried_object_id()) . "?tag=hvdc" ?>">HVDC</a>
					<?php endif; */ ?>
					<?php if (get_term_by('name', '해저케이블', 'post_tag')) : ?>
						<a href="<?php echo get_term_link(get_queried_object_id()) . "?tag=해저케이블" ?>">해저케이블</a>
					<?php endif; ?>
					<?php if (get_term_by('name', '초전도', 'post_tag')) : ?>
						<a href="<?php echo get_term_link(get_queried_object_id()) . "?tag=초전도" ?>">초전도</a>
					<?php endif; ?>
					<?php if (get_term_by('name', '전기차', 'post_tag')) : ?>
						<a href="<?php echo get_term_link(get_queried_object_id()) . "?tag=전기차" ?>">전기차</a>
					<?php endif; ?>
				</div>
				<?php /*
				<div class="category-tags">
					<?php if (get_term_by('name', 'hvdc', 'post_tag')) : ?>
						<a href="<?php echo get_tag_link(get_term_by('name', 'HVDC', 'post_tag')); ?>">HVDC</a>
					<?php endif; ?>
					<?php if (get_term_by('name', '해저', 'post_tag')) : ?>
						<a href="<?php echo get_tag_link(get_term_by('name', '해저', 'post_tag')); ?>">해저</a>
					<?php endif; ?>
					<?php if (get_term_by('name', '초전도', 'post_tag')) : ?>
						<a href="<?php echo get_tag_link(get_term_by('name', '초전도', 'post_tag')); ?>">초전도</a>
					<?php endif; ?>
					<?php if (get_term_by('name', '전기차', 'post_tag')) : ?>
						<a href="<?php echo get_tag_link(get_term_by('name', '전기차', 'post_tag')); ?>">전기차</a>
					<?php endif; ?>
				</div>
				*/ ?>
			<?php endif; ?>
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

								<?php if ($current_cat !== '성공사례') : ?>
									<div class="post-etc">
										<span class="post-date"><?php echo get_the_date('Y.m.d'); ?></span>
									</div>
								<?php endif; ?>

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
