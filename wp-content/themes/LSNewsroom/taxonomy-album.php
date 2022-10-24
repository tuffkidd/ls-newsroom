<?php
global $wp_query;
get_header();
$paged = get_query_var('paged');


$albums = $Frontend->get_albums(get_queried_object_id(), $paged);
?>

<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<?php get_template_part('theme-parts/medialibrary', 'header'); ?>

			<div class="album-list">
				<?php
				if ($albums) :
					foreach ($albums as $album) :
						// $medias = $Frontend->get_medias($album->term_id, 1, -1, 'album', 'multimedia')->posts;
						// print_r2($medias);
						// print_r2($album);
						// $count = $category->category_count;
						// $total_posts = count($medias);
						$img = wp_get_attachment_image_src(attachment_url_to_postid(get_term_meta($album->term_id, "album_img", TRUE)), 'category-list');
				?>
						<?php if (isset($album->post)) : ?>
							<div class="album-item-wrap">
								<a href="<?php echo get_the_permalink($album->post->ID); ?>?type=<?php echo get_query_var('album'); ?>&paged=<?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?>">
									<?php /* 앨범 내 컨텐츠 카운트 시 주석 제거
									<span class="album-photo-count">
										<img src="<?php echo THEME_IMAGE_URI . '/icon-photo-count.png'; ?>" alt="미디어 수 아이콘"> <?php echo number_format($album->count); ?>
									</span>
									*/ ?>
									<div class="album-thumb-wrap">
										<div class="album-thumb-overlay"></div>
										<img src="<?php echo $img[0]; ?>" alt="<?php echo $album->name; ?> 앨범 대표 이미지">
									</div>
									<span class="album-title"><?php echo $album->name; ?></span>
								</a>
							</div>
						<?php endif; ?>
				<?php
					endforeach;
				endif;
				?>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
