<?php
get_header();
// 최신글
$latest_posts_1 = $Frontend->get_latest_posts([]);

/***********************************************
 * 탭스타일
 */
// 신재생에너지
// $latest_posts_2 = $Frontend->get_latest_posts(['tags' => '지속가능경영']);
// ESG
// $latest_posts_3 = $Frontend->get_latest_posts(['tags' => 'ESG']);
// 세대공감
// $latest_posts_4 = $Frontend->get_latest_posts(['tags' => '세대공감']);
// 보도자료
// $latest_posts_5 = $Frontend->get_latest_posts(['tags' => '보도자료']);

?>
<?php if (is_plugin_active("ls-main-slider/index.php")) { ?>
	<section class="main-slider-section container">
		<div class="swiper" id="main-slider">
			<div class="swiper-wrapper">

				<div class="swiper-slide">
					<a href="#">
						<div class="img">
							<img src="https://picsum.photos/seed/picsum/1200/500">
						</div>
						<div class="meta">
							<div class="cat">언론보도</div>
							<div class="title">[casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공 [casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공 [casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공</div>
							<div class="date">2022. 11. 11</div>
						</div>
					</a>
				</div>

				<div class="swiper-slide">
					<a href="#">
						<div class="img">
							<img src="https://picsum.photos/seed/picsum/1200/500">
						</div>
						<div class="meta">
							<div class="cat">언론보도</div>
							<div class="title">[casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공 [casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공 [casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공</div>
							<div class="date">2022. 11. 11</div>
						</div>
					</a>
				</div>

				<div class="swiper-slide">
					<a href="#">
						<div class="img">
							<img src="https://picsum.photos/seed/picsum/1200/500">
						</div>
						<div class="meta">
							<div class="cat">언론보도</div>
							<div class="title">[casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공</div>
							<div class="date">2022. 11. 11</div>
						</div>
					</a>
				</div>

				<div class="swiper-slide">
					<a href="#">
						<div class="img">
							<img src="https://picsum.photos/seed/picsum/1200/500">
						</div>
						<div class="meta">
							<div class="cat">언론보도</div>
							<div class="title">[casestudy] LG 사이언스 파크 Cat6A & 지능형 솔루션 제공</div>
							<div class="date">2022. 11. 11</div>
						</div>
					</a>
				</div>
			</div>
		</div>
		<div class="swiper-numbers">
			<span class="current"></span> / <span class="total"></span>
			<a href="#" class="button-prev"></a>
			<a href="#" class="button-next"></a>
		</div>
		<div class=" swiper-pagination">
		</div>
	</section>
<?php } ?>
<section class="main-latest">
	<div class="container">
		<div class="latest-tabs">
			<?php /*
			<a href="#" class="latest-tab-link">최신글</a>
			<a href="#" class="latest-tab-link">신재생에너지</a>
			<a href="#" class="latest-tab-link">ESG</a>
			<a href="#" class="latest-tab-link">세대공감</a>
			<a href="#" class="latest-tab-link">보도자료</a>
			*/ ?>
			<span>최신글</span>
			<a href="<?php echo site_url("/tag/신재생에너지/") ?>">신재생에너지</a>
			<a href="<?php echo site_url("/tag/ESG/") ?>">ESG</a>
			<a href="<?php echo site_url("/tag/세대공감/") ?>">세대공감</a>
			<a href="<?php echo site_url("/tag/보도자료/") ?>">보도자료</a>
		</div>
		<div class="latest-content">
			<div id="latest-content-1">
				<?php if ($latest_posts_1) : foreach ($latest_posts_1 as $post) : setup_postdata($post->ID);
						$term = $Frontend->get_post_cat($post->ID, 2, 1); ?>
						<div class="latest-content-1-item">
							<a href="<?php echo get_the_permalink() ?>">
								<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'thumbnail', false)[0]; ?>">

							</a>
							<div class="post-meta">
								<div class="post-title">
									<a href=" <?php echo get_category_link($term[0]->term_id); ?>" class="cat"><?php echo $term[0]->name; ?></a>
									<a href="<?php echo get_the_permalink() ?>" class="title"><?php echo the_title(); ?></a>
								</div>
								<div class="post-date">
									<?php the_date('Y. m. d') ?>
								</div>
							</div>
						</div>
				<?php endforeach;
				endif; ?>
			</div>
		</div>
	</div>
</section>
<section class="main-medialibrary">
	<div class="container-wide">
		<div class="medialibrary-box">
			<div class="img">
				<img src="<?php echo THEME_IMAGE_URI ?>/img-main-medialibrary.png">
			</div>
			<div class="box">
				<div class="title">
					미디어 라이브러리
				</div>
				<div class="desc">
					LS전선 뉴스룸에서 <span>다양한 이미지와<br>영상 데이터</span>를 확인하실 수 있습니다.
				</div>
				<div class="links">
					<a href="#">이미지</a>
					<a href="#">영상</a>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="main-about-lscns">

</section>

<?php
get_footer();
