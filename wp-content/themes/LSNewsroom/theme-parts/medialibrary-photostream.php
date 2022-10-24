<?php
get_header();

$photostream_query_var = get_query_var('medialib');
$taxo = 'album';
$post_type = 'multimedia';
$lib = 'medialibrary';
$lb = 'medialib';

$keyword = get_query_var('s');
$page = get_query_var('paged');

$photostream_medias = $Frontend->get_medias(0, $page, 12, $taxo, $post_type, $keyword);
?>
<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<?php get_template_part('theme-parts/medialibrary', 'header'); ?>

			<div class="media-list">
				<?php

				if ($photostream_medias->have_posts()) :
					while ($photostream_medias->have_posts()) : $photostream_medias->the_post();
				?>
						<div class="media-item-wrap pc">
							<div class="media-item">
								<div class="media-thumb-wrap">
									<div class="media-thumb-overay">
										<a href="<?php echo the_permalink() ?>?type=<?php echo get_query_var('medialib'); ?>&paged=<?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?>" class="media-detail">
											크게 보기
										</a>
										<?php if ($Frontend->is_video_media(get_the_content())) { ?>
											<?php /*<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . $video_id . '&size=full'); ?>" class="media-download">다운로드</a>*/ ?>
										<?php } else { ?>
											<a href="<?php echo site_url('/medialibrary/download/?attach_id=' . get_post_thumbnail_id(get_the_ID()) . '&size=full'); ?>" class="media-download">다운로드</a>
										<?php } ?>
									</div>
									<div class="media-thumb <?php if ($Frontend->is_video_media(get_the_content())) { ?>video<?php } ?>">
										<?php the_post_thumbnail('category-list'); ?>
									</div>
								</div>
								<div class="media-title">
									<?php echo the_title() ?>
								</div>
							</div>
						</div>

						<div class="media-item-wrap mobile">
							<a href="<?php echo the_permalink() ?>?type=<?php echo get_query_var('medialib'); ?>&paged=<?php echo get_query_var('paged') ? get_query_var('paged') : 1; ?>" class="media-item">
								<div class="media-thumb-wrap">
									<div class="media-thumb <?php if ($Frontend->is_video_media(get_the_content())) { ?>video<?php } ?>">
										<?php the_post_thumbnail('category-list'); ?>
									</div>
								</div>
								<div class="media-title">
									<?php echo the_title() ?>
								</div>
							</a>
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
