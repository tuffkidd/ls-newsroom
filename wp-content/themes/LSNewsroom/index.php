<?php
get_header();
// 최신글
$latest_posts_1 = $Frontend->get_latest_posts([]);

/***********************************************
 * 탭스타일
 */
// 신재생에너지
$latest_posts_2 = $Frontend->get_latest_posts(['tags' => '지속가능경영']);
// ESG
$latest_posts_3 = $Frontend->get_latest_posts(['tags' => 'ESG']);
// 세대공감
$latest_posts_4 = $Frontend->get_latest_posts(['tags' => '세대공감']);
// 보도자료
$latest_posts_5 = $Frontend->get_latest_posts(['tags' => '보도자료']);
?>

<section class="slider">
	<img src="<?php echo THEME_IMAGE_URI ?>/dummy/slider-1.png">
</section>
<section class="latest">
	<div class="latest-tabs">
		<a href="#" class="latest-tab-link">최신글</a>
		<a href="#" class="latest-tab-link">신재생에너지</a>
		<a href="#" class="latest-tab-link">ESG</a>
		<a href="#" class="latest-tab-link">세대공감</a>
		<a href="#" class="latest-tab-link">보도자료</a>
	</div>
	<div class="latest-content">
		<ul id="latest-content-1">
			<?php if ($latest_posts_1) : foreach ($latest_posts_1 as $post) : setup_postdata($post->ID);
					$term = $Frontend->get_post_cat($post->ID, 2, 1); ?>
					<li>
						<a href="<?php echo get_the_permalink() ?>">
							<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail', false)[0]; ?>">

						</a>
						<div class="post-meta">
							<div class="post-title">
								<a href=" <?php echo get_category_link($term[0]->term_id); ?>" class="cat"><?php echo $term[0]->name; ?></a>
								<a href="<?php echo get_the_permalink() ?>" class="title"><?php echo the_title(); ?></a>
							</div>
							<div class="post-date">
								<?php the_date('Y-m-d') ?>
							</div>
						</div>
					</li>
			<?php endforeach;
			endif; ?>
		</ul>
		<ul id=" latest-content-2">

		</ul>
		<ul id="latest-content-3">

		</ul>
		<ul id="latest-content-4">

		</ul>
		<ul id="latest-content-5">

		</ul>
	</div>
</section>
<section class="medialibrary">

</section>
<section class="about-lscns">

</section>

<?php
get_footer();
