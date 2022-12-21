<?php
global $Frontend, $wp_query, $recommendTagsFrontend;
get_header();
$total_posts = $wp_query->found_posts;

$current_cat = rawurldecode(get_queried_object()->slug);

$h_tags = $recommendTagsFrontend->getHiTechTags();

$current_tag = rawurldecode(get_query_var('tag'));
$ckey = esc_attr(get_query_var('ckey'));
$cat_query = new WP_Query(['s' => $ckey]);
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
					<?php if ($h_tags) :
						foreach ($h_tags as $key => $val) : $tag = get_term($val->term_id);
							$is_on = '';
							if ($current_tag == $tag->name) {
								$is_on = 'class="on"';
					?>
								<a href="<?php echo get_term_link(get_queried_object_id()) ?>" <?php echo $is_on; ?>><?php echo $tag->name; ?></a>
							<?php
							} else {
							?>
								<a href="<?php echo get_term_link(get_queried_object_id()) . "?tag=" . $tag->name; ?>" <?php echo $is_on; ?>><?php echo $tag->name; ?></a>
							<?php
							}
							?>

					<?php
						endforeach;
					endif; ?>
				</div>
			<?php elseif ($current_cat == '보도자료') : ?>
				<form id="categorySearchFrm" method="get" action="<?php echo get_term_link(get_queried_object_id()) ?>">
					<div class="category-search">
						<div class="category-search-wrap">
							<label for="ckey" class="hidden-text">보도자료 검색</label>
							<input type="text" name="ckey" id="ckey" placeholder="보도자료 검색" value="<?php echo $ckey; ?>">
							<a href="#" id="del-ckey" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
							<button type="submit" class="hidden-text" title="검색하기">검색하기</button>
						</div>
					</div>
				</form>
			<?php endif; ?>
			<?php
			if (have_posts()) :
			?>
				<ul class="post-list">
					<?php
					while ($cat_query->have_posts()) : $cat_query->the_post();
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
