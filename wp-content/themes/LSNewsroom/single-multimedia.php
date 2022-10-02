<?php
global $Frontend, $wp_query, $post;
get_header();

$tax_name = get_query_var('album');
$taxo = 'album';
$lib = 'medialibrary';

// Term
$term = get_term_by('slug', $tax_name, $taxo);
$album_id = $term->term_id;

$type = isset($_GET['type']) ? esc_attr($_GET['type']) : 'albums';
$s = isset($_GET['type']) ? esc_attr($_GET['s']) : '';

if ($type == 'photostream') {
	$back_url = site_url('/medialibrary/photostream?paged=' .  get_query_var('paged') . '&s=' . $s);
} else {
	$back_url = site_url('/medialibrary/albums');
}

/**************************************************
 * 슬라이더 처리
 */
if ($type == 'photostream') {
	$current_post = $post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_previous_post(false, '', 'album');
		if ($post) {
			${'prev_' . $i} = $post;
			setup_postdata($post);
		}
	}
	$post = $current_post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_next_post(false, '', 'album');
		if ($post) {
			${'next_' . $i} = $post;
			setup_postdata($post);
		}
	}
	$post = $current_post;
	setup_postdata($post);
} else {
	$current_post = $post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_previous_post(true, '', 'album');
		if ($post) {
			${'prev_' . $i} = $post;
			setup_postdata($post);
		}
	}

	$post = $current_post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_next_post(true, '', 'album');
		if ($post) {
			${'next_' . $i} = $post;
			setup_postdata($post);
		}
	}
	$post = $current_post;
	setup_postdata($post);
}

/****************************************************
 * 비디오 처리
 */

$content = get_the_content();
$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
preg_match($pattern, $content, $matches);

if ($matches) {
	$video_src = $matches['src'];
	// $video_id = attachment_url_to_postid($src);

	$pattern = "'<figure class=\"wp-block-video\">(.*?)</figure>'si";
	$content = get_the_content();

	preg_match($pattern, $content, $matches);
	$video_content = $matches[0];

	preg_match("/<div class=\"wp-block-wildworks-extend-block-video-subtitle\">(.*?)<\/div>/", $content, $match);
	$subtitle = $match[0];
}

?>

<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<div class="medialibrary-header">
				<h1>미디어 라이브러리</h1>
				<span>LS전선의 다양한 이미지와 영상을 검색해보세요.</span>
			</div>
			<div class="medialibrary-control">
				<a href="<?php echo $back_url ?>" class="go-back">
					<!-- <span class="button-icon icon-go-back"></span> -->
					<img src="<?php echo THEME_IMAGE_URI ?>/icon-medialibrary-prev.png"> 이전
				</a>
				<div class="medialibrary-search">
					<div class="medialibrary-search-box">
						<form action="<?php echo site_url($lib . '/photostream'); ?>" method="GET">
							<label for="s" class="hidden-text">검색어를 입력하세요.</label>
							<input type="text" name="s" id="s" value="<?php echo $s; ?>" placeholder="검색어를 입력하세요.">
							<a href="#" id="del-mkeyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
							<button type="submit" id="album-search-submit" class="hidden-text">검색</button>
						</form>
					</div>
				</div>
			</div>
			<div class="media-wrap">
				<div class="media-title">
					<?php the_title(); ?>
					<div class="date">
						<?php echo  get_the_date('Y.m.d'); ?>
					</div>
				</div>
				<div class="media-download">
					<?php if (isset($video_src)) { ?>
						<a href="<?php echo $video_src; ?>" download class="download-media">다운로드</a>
					<?php } else { ?>
						<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . get_post_thumbnail_id(get_the_ID()) . '&size=full'); ?>" class="download-media">다운로드</a>
					<?php } ?>
				</div>
				<div class="media-slider">
					<div id="media-prev">
						<?php if (isset($next_1)) { ?>
							<a href="<?php echo get_permalink($next_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" class="hidden-text">이전 미디어</a>
						<?php } ?>
					</div>
					<?php if (isset($video_src)) : ?>
						<div class="video-thumb">
							<?php echo $video_content ?>
							<?php echo $subtitle; ?>
						</div>
					<?php else : ?>
						<div class="media-thumb">
							<?php the_post_thumbnail('media'); ?>
						</div>
					<?php endif; ?>
					<div id="media-next">
						<?php if (isset($prev_1)) { ?>
							<a href="<?php echo get_permalink($prev_1); ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" class="hidden-text">다음 미디어</a>
						<?php } ?>
					</div>
				</div>
				<div class="media-thumbs">
					<div>
						<?php if (isset($next_2)) : ?>
							<a href="<?php echo get_the_permalink($next_2) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" title="<?php echo get_the_title($next_2) ?>">
								<div class="img">
									<?php echo get_the_post_thumbnail($next_2, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div>
						<?php if (isset($next_1)) : ?>
							<a href="<?php echo get_the_permalink($next_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" title="<?php echo get_the_title($next_1) ?>">
								<div class="img">
									<?php echo get_the_post_thumbnail($next_1, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div>
						<span class="media-current">
							<div class="img">
								<?php echo the_post_thumbnail('category-list'); ?>
							</div>
						</span>
					</div>
					<div>
						<?php if (isset($prev_1)) : ?>
							<a href="<?php echo get_the_permalink($prev_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" title="<?php echo get_the_title($prev_1) ?>">
								<div class="img">
									<?php echo get_the_post_thumbnail($prev_1, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div>
						<?php if (isset($prev_2)) : ?>
							<a href="<?php echo get_the_permalink($prev_2) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $s ?>" title="<?php echo get_the_title($prev_2) ?>">
								<div class="img">
									<?php echo get_the_post_thumbnail($prev_2, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
	</div>
</section>
<?php
get_footer();
