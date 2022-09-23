<?php
get_header();
$paged = get_query_var('paged');

if (get_query_var('heritagelib')) { // 헤리티지 라이브러리
	$taxo = 'heritage-album';
	$post_type = 'heritage';
	$lib = 'heritagelibrary';
	$lb = 'heritagelib';
} else {
	$taxo = 'album';
	$post_type = 'multimedia';
	$lib = 'medialibrary';
	$lb = 'medialib';
}

$albums = $Frontend->get_albums($paged, $taxo);
// $page = get_query_var('page');
// $album_id = get_queried_object()->term_id;
// $medias = $Frontend->get_medias($album_id, $page, 20);
// $albums = $Frontend->get_albums($paged);
?>

<section id="content">
	<div class="container">
		<div class="medialibrary-header">
			<h1>미디어 라이브러리</h1>
			<span>LS전선의 다양한 이미지와 영상을 검색해보세요.</span>
		</div>
		<div class="medialibrary-control">
			<div class="switch-album">
				<a href="<?php echo site_url($lib . '/photostream'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'photostream' || get_query_var('heritagelib' == 'photostream')) { ?>selected<?php } ?>">이미지</a>
				<a href="<?php echo site_url($lib . '/albums'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'albums' || get_query_var('heritagelib') == 'albums') { ?>selected<?php } ?>">영상</a>
			</div>
		</div>
	</div>
</section>

<div class="container">
	<div class="viewtype">
		<a href="<?php echo site_url($lib . '/albums'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'albums' || get_query_var('heritagelib') == 'albums') { ?>selected<?php } ?>">앨범</a>
		<a href="<?php echo site_url($lib . '/photostream'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'photostream' || get_query_var('heritagelib' == 'photostream')) { ?>selected<?php } ?>">포토스트림</a>
	</div>
	<!--
	<h4 class="medialib-title"><?php if (get_query_var($lb) == 'albums' || get_query_var('heritagelib') == 'albums') { ?>앨범(선택됨)<?php } else { ?>포토스트림(선택됨)<?php } ?></h4>
	-->
	<ul class="albums">
		<?php
		if ($albums) :
			foreach ($albums as $album) :
				// count
				$medias = $Frontend->get_medias($album->term_id, 1, -1, $taxo, $post_type)->posts;
				$total_posts = count($medias);
				$img = wp_get_attachment_image_src(attachment_url_to_postid(get_term_meta($album->term_id, "album_img", TRUE)), 'category-list-header-thumb');
		?>
				<li>
					<a href="<?php echo get_category_link($album->term_id); ?>">
						<span class="album-photo-count">
							<img src="<?php echo THEME_IMAGE_URI . '/icon-photo-count.png'; ?>" alt="미디어 수 아이콘"> <?php echo number_format($total_posts); ?>
						</span>
						<div class="album-thumb-wrap">
							<img src="<?php echo $img[0]; ?>" alt="<?php echo $album->name; ?> 앨범 대표 이미지">
						</div>
						<div class="album-gradient-overlay"></div>
						<span class="album-title"><?php echo $album->name; ?></span>
					</a>
				</li>
		<?php
			endforeach;
		endif;
		?>
	</ul>
</div>
<!-- index -->
<?php
get_footer();
