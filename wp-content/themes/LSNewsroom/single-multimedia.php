<?php
global $Frontend, $wp_query, $post;
get_header();

$tax_name = get_query_var('album');
$taxo = 'album';
$lib = 'medialibrary';

// Term
$term = get_term_by('slug', $tax_name, $taxo);
$album_id = $term->term_id;

$type = isset($_GET['type']) ? esc_attr($_GET['type']) : 'photo';

if ($type == 'photostream') {
	$back_url = site_url('/medialibrary/photostream?paged=' .  get_query_var('paged'));
} else if ($type == 'photo') {
	$back_url = site_url('/medialibrary/photo/');
} else if ($type == 'video') {
	$back_url = site_url('/medialibrary/video/');
}

/**************************************************
 * 슬라이더 처리
 * 중단: 나열형태로 변경 20221207
 */
/*
if ($type == 'photostream') {
	$current_post = $post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_previous_post(false, '', 'album');


		if ($post) {
			${'prev_' . $i} = $post;
			// 비디오인가
			$content = $post->post_content;
			$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
			preg_match($pattern, $content, $matches);

			if (isset($matches[0])) {
				${'prev_' . $i}->media_type = 'video';
			}

			setup_postdata($post);
		}
	}
	$post = $current_post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_next_post(false, '', 'album');

		if ($post) {
			${'next_' . $i} = $post;
			// 비디오인가
			$content = $post->post_content;
			$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
			preg_match($pattern, $content, $matches);

			if (isset($matches[0])) {
				${'next_' . $i}->media_type = 'video';
			}
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
			// 비디오인가
			$content = $post->post_content;
			$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
			preg_match($pattern, $content, $matches);

			if (isset($matches[0])) {
				${'prev_' . $i}->media_type = 'video';
			}
			setup_postdata($post);
		}
	}

	$post = $current_post;
	for ($i = 1; $i <= 2; $i++) {
		$post = get_next_post(true, '', 'album');
		if ($post) {
			${'next_' . $i} = $post;
			// 비디오인가
			$content = $post->post_content;
			$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
			preg_match($pattern, $content, $matches);

			if (isset($matches[0])) {
				${'next_' . $i}->media_type = 'video';
			}
			setup_postdata($post);
		}
	}
	$post = $current_post;
	setup_postdata($post);
}
*/

/***************************************************
 * 미디어 나열 album-medias 20221207
 */
$album_medias = $Frontend->get_medias($album_id, 1, 999999)->posts;

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
	if (isset($match[0])) {
		$subtitle = $match[0];
	}
}


?>

<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<div class="medialibrary-header">
				<h1>미디어 라이브러리</h1>
				<span>LS전선의 다양한 사진과 영상을 검색해보세요.</span>
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
						<p>영상에 마우스 우-클릭 후 '동영상을 다른 이름으로 저장'을 클릭해서 다운로드하실 수 있습니다.</p>
						<!-- <a href="<?php echo $video_src; ?>" class="download-media" target="_blank">다운로드</a> -->
					<?php } else { ?>
						<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . get_post_thumbnail_id(get_the_ID()) . '&size=full'); ?>" class="download-media">다운로드</a>
					<?php } ?>
				</div>
				<div class="media-slider">
					<div id="media-prev">
						<?php if (isset($next_1)) { ?>
							<a href="<?php echo get_permalink($next_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" class="hidden-text">이전 미디어</a>
						<?php } ?>
					</div>
					<?php if (isset($video_src)) : ?>
						<div class="video-thumb">
							<?php echo $video_content ?>
							<?php if (isset($subtitle)) {
								echo $subtitle;
							} ?>
						</div>
					<?php else : ?>
						<div class="media-thumb">
							<?php the_post_thumbnail('large'); ?>
						</div>
					<?php endif; ?>
					<div id="media-next">
						<?php if (isset($prev_1)) { ?>
							<a href="<?php echo get_permalink($prev_1); ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" class="hidden-text">다음 미디어</a>
						<?php } ?>
					</div>
				</div>






				<?php if ($album_medias) : ?>
					<div class="album-media-wrap">
						<?php if (get_query_var('type') == 'photo') : ?>
							<div class="album-media-action">
								<div>
									<div class="ww-checkbox">
										<input type="checkbox" name="checkAll" id="checkAllMedia">
										<label for="checkAllMedia"> 전체 선택</label>
									</div>
								</div>
								<div>
									<a href="<?php echo site_url('/medialibrary/download/?type=all'); ?>" class="media-download-btn downloadSelected">선택 다운로드</a>
									<a href="<?php echo site_url('/medialibrary/download/?type=all'); ?>" class="media-download-btn downloadAll">전체 다운로드</a>
								</div>
							</div>
						<?php endif; ?>
						<div class="album-medias">
							<?php foreach ($album_medias as $post) : setup_postdata($post); ?>
								<div class="album-media-item">
									<a href="<?php the_permalink() ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>">
										<div>
											<?php if (get_query_var('type') == 'photo') : ?>
												<div class="ww-checkbox">
													<input type="checkbox" name="downloadChecked[]" class="media-checkbox" id="media_<?php the_ID(); ?>" value="<?php echo get_post_thumbnail_id($post->ID); ?>">
												</div>
											<?php endif; ?>
											<?php the_post_thumbnail('category-list') ?>
										</div>
										<p><?php the_title() ?></p>
									</a>
								</div>
							<?php endforeach; ?>
						</div>
					</div>
				<?php endif; ?>
				<input type="hidden" id="content-url" value="<?php echo the_permalink(); ?>">

				<?php /* 중단: 나열형태로 변경 20221207
				<div class="media-thumbs">
					<div id="media-thumb-prev">
						<?php if (isset($next_1)) { ?>
							<a href="<?php echo get_permalink($next_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" class="hidden-text">이전 미디어</a>
						<?php } ?>
					</div>
					<div id="media-next-2" class="media-thumb-item">
						<?php if (isset($next_2)) : ?>
							<a href="<?php echo get_the_permalink($next_2) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" title="<?php echo get_the_title($next_2) ?>">
								<div class="img <?php echo $next_2->media_type; ?>">
									<?php echo get_the_post_thumbnail($next_2, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div id="media-next-1" class="media-thumb-item">
						<?php if (isset($next_1)) : ?>
							<a href="<?php echo get_the_permalink($next_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" title="<?php echo get_the_title($next_1) ?>">
								<div class="img <?php echo $next_1->media_type; ?>">
									<?php echo get_the_post_thumbnail($next_1, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div class="media-thumb-item">
						<span class="media-current">
							<div class="img  <?php if (isset($video_src)) { ?>video<?php } ?>">
								<?php echo the_post_thumbnail('category-list'); ?>
							</div>
						</span>
					</div>
					<div id="media-prev-1" class="media-thumb-item">
						<?php if (isset($prev_1)) : ?>
							<a href="<?php echo get_the_permalink($prev_1) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" title="<?php echo get_the_title($prev_1) ?>">
								<div class="img <?php echo $prev_1->media_type; ?>">
									<?php echo get_the_post_thumbnail($prev_1, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div id="media-prev-2" class="media-thumb-item">
						<?php if (isset($prev_2)) : ?>
							<a href="<?php echo get_the_permalink($prev_2) ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" title="<?php echo get_the_title($prev_2) ?>">
								<div class="img <?php echo $prev_2->media_type; ?>">
									<?php echo get_the_post_thumbnail($prev_2, 'category-list'); ?>
								</div>
							</a>
						<?php endif; ?>
					</div>
					<div id="media-thumb-next">
						<?php if (isset($prev_1)) { ?>
							<a href="<?php echo get_permalink($prev_1); ?>?type=<?php echo $type; ?>&paged=<?php echo get_query_var('paged'); ?>" class="hidden-text">다음 미디어</a>
						<?php } ?>
					</div>
				</div>
				*/ ?>
			</div>
		</div>
	</div>
	</div>
</section>
<?php
get_footer();
