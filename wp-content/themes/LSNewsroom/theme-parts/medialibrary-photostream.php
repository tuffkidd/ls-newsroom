<?php
get_header();

$photostream_query_var = get_query_var('medialib');
$taxo = 'album';
$post_type = 'multimedia';
$lib = 'medialibrary';
$lb = 'medialib';

$keyword = esc_attr(get_query_var('s'));
$page = get_query_var('paged');

$photostream_medias = $Frontend->get_medias(0, $page, 12, $taxo, $post_type, $keyword);

?>
<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<div class="medialibrary-header">
				<h1>미디어 라이브러리</h1>
				<span>LS전선의 다양한 이미지와 영상을 검색해보세요.</span>
			</div>
			<div class="medialibrary-control">
				<div class="switch-album">
					<a href="<?php echo site_url($lib . '/albums'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'albums') { ?>selected<?php } ?>">앨범</a>
					<a href="<?php echo site_url($lib . '/photostream'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'photostream') { ?>selected<?php } ?>">포토스트림</a>
				</div>
				<div class="medialibrary-search">
					<div class="medialibrary-search-box">
						<form action="<?php echo site_url($lib . '/photostream'); ?>" method="GET">
							<label for="s" class="hidden-text">검색어를 입력하세요.</label>
							<input type="text" name="s" id="s" value="<?php echo $keyword; ?>" placeholder="검색어를 입력하세요.">
							<a href="#" id="del-mkeyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
							<button type="submit" id="album-search-submit" class="hidden-text">검색</button>
						</form>
					</div>
				</div>
			</div>
			<div class="media-list">
				<?php

				if ($photostream_medias->have_posts()) :
					while ($photostream_medias->have_posts()) : $photostream_medias->the_post();
				?>
						<div class="media-item-wrap">
							<div class="media-item">
								<div class="media-thumb-wrap">
									<div class="media-thumb-overay">
										<a href="<?php echo the_permalink() ?>?type=<?php echo get_query_var('medialib'); ?>&paged=<?php echo get_query_var('paged'); ?>&s=<?php echo $keyword; ?>" class="media-detail">
											크게 보기
										</a>
										<?php if (isset($video_id)) { ?>
											<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . $video_id . '&size=full'); ?>" class="media-download">다운로드</a>
										<?php } else { ?>
											<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . get_post_thumbnail_id(get_the_ID()) . '&size=full'); ?>" class="media-download">다운로드</a>
										<?php } ?>
									</div>
									<div class="media-thumb">
										<?php the_post_thumbnail('post-list'); ?>
									</div>
								</div>
								<div class="media-title">
									<?php echo the_title() ?>
								</div>
							</div>
						</div>
				<?php
					endwhile;
				endif;
				?>
			</div>
			<?php get_template_part('theme-parts/pagination', ''); ?>
		</div>
	</div>
</section>
<?php
get_footer();
