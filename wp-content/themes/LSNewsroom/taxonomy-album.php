<?php
get_header();

// $paged = get_query_var( 'paged' );
$page = get_query_var('page');
$album_id = get_queried_object()->term_id;
$medias = $Frontend->get_medias($album_id, $page, 20);
$albums = $Frontend->get_albums($paged);
// print_r2($medias);
?>

<div id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<div class="medialibrary-header">
				<h1>미디어 라이브러리</h1>
				<span>LS전선의 다양한 이미지와 영상을 검색해보세요.</span>
			</div>

			<div class="album-wrap">
				<div class="album-header">
					<div class="album-wrap">
						<a href="<?php echo site_url('/medialibrary/albums'); ?>" class="go-to-albums">앨범</a>
						<div class="">
							<button><?php single_cat_title(); ?></button>
							<ul>
								<?php if ($albums) : ?>
									<?php foreach ($albums as $key => $album) : ?>
										<li><a href="<?php echo get_category_link($album->term_id); ?>" <?php if ($album->term_id == get_queried_object()->term_id) { ?>class="active" <?php } ?>><?php echo $album->name; ?></a></li>
									<?php endforeach; ?>
								<?php endif; ?>
							</ul>
						</div>
					</div>
				</div>
				<?php /* 주의 지우지 말것 ::::::::: 선택 다운로드
		<div class="album-header clearfix">
			<div class="album-name float-left">
				<?php single_cat_title(); ?>
			</div>
			<div class="album-func float-right">
				<a href="<?php echo site_url();?>" class="go-back">상위메뉴로 가기</a>
				<!-- <a href="<?php echo site_url();?>" class="cj-button go-back">
					<span class="button-icon icon-go-back"></span>
					상위메뉴로 가기
				</a>
				-->

				<a href="#" class="cj-button downloadSelected">
					<span class="button-icon icon-download"></span>
					다운로드
				</a>
			</div>
		</div>
		*/
				?>
				<div class="media-wrap">
					<div class="media-justified">
						<?php
						if ($medias->have_posts()) :
							while ($medias->have_posts()) : $medias->the_post();
								get_template_part('theme-parts/media', 'list');
							endwhile;
						endif;
						?>
					</div>
				</div>
				<?php get_template_part('theme-parts/medialibrary-pagination', ''); ?>
			</div>
		</div>
	</div>
	<?php
	get_footer();
