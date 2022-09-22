<?php
global $Frontend;
get_header();
$s = get_search_query(true);
$d = esc_attr(get_query_var('d'));
$o = esc_attr(get_query_var('o'));
$c = esc_attr(get_query_var('c'));

$page = isset($_GET['page']) ? $_GET['page'] : 1;
$mpage = isset($_GET['mpage']) ? $_GET['mpage'] : 1;
$hpage = isset($_GET['hpage']) ? $_GET['hpage'] : 1;


if (strlen($d) == 21) {
	$d_text = $d;
} else {
	switch ($d) {
		case "all":
			$d_text = "모든 날짜";
			break;
		case "week";
			$d_text = "1주일전";
			break;
		case "month":
			$d_text = "1개월전";
			break;
		case "year":
			$d_text = "1년전";
			break;
		default:
			$d_text = "모든 날짜";
			break;
	}
}


switch ($o) {
	case "latest":
		$o_text = "최신순";
		break;
	case "popular";
		$o_text = "인기순";
		break;
	case "relevance":
		$o_text = "관련순";
		break;
	default:
		$o_text = "최신순";
		break;
}

$top_menus = $Frontend->get_top_menu();

// $c_text = $top_menus[0]->title;
$c_text = '모든 카테고리';

if ($top_menus) {
	foreach ($top_menus as $key => $val) {
		if ($val->object_id == $c) {
			$c_text = $val->title;
		}
	}
}

$search_posts = $Frontend->get_search_posts($s, $d, $o, $c, $page);

// $big = 999999999999999999;
$post_pagination = paginate_links([
	// 'base'        		=> '%_%',
	// 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'prev_text'			=> '<span class="pagination-prev">PREV</span>',
	'next_text'			=> '<span class="pagination-next">NEXT</span>',
	'format' 			=> '?page=%#%',
	'total'				=> $search_posts->max_num_pages,
	'current' 			=> $page,
	'end_size'			=> 1,
	'mid_size'			=> 1
]);


$search_media = $Frontend->get_search_medias($s, $d, $o, $c, $mpage);

$media_pagination = paginate_links([
	// 'base'        		=> '%_%',
	// 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
	'prev_text'			=> '<span class="pagination-prev">PREV</span>',
	'next_text'			=> '<span class="pagination-next">NEXT</span>',
	'format' 			=> '?mpage=%#%',
	'total'				=> $search_media->max_num_pages,
	'current' 			=> $mpage,
	'end_size'			=> 1,
	'mid_size'			=> 1
]);

?>
<section id="content">
	<div class="container">
		<div id="search-result">
			<div id="search-header">
				<form id="searchPageFrm" method="get" action="<?php echo site_url() ?>">
					<div class="search-input-box">
						<label for="s"><input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>"></label>
						<a href="#" id="del-keyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
						<button type="submit" id="search-submit" class="hidden-text" title="검색하기">검색하기</button>
					</div>
					<input type="hidden" name="d" value="<?php echo $d; ?>">
					<input type="hidden" name="o" value="<?php echo $o; ?>">
					<input type="hidden" name="c" value="<?php echo $c; ?>">
				</form>
			</div>
			<div id="search-options">
				<div class="search-option-wrap">
					<div class="search-option">
						<button class="search-option-label" data-option="o"><?php echo $o_text; ?></button>
						<ul class="option-list">
							<li><button type="button" class="option-value" data-value="latest">최신순</button></li>
							<li><button type="button" class="option-value" data-value="relevance">관련순</button></li>
							<!-- <button type="button" class="option-value" data-value="popular">인기순</button> -->
						</ul>
					</div>
					<div class="search-option">
						<button class="search-option-label" data-option="d"><?php echo $d_text; ?></button>
						<ul class="option-list">
							<li><button type="button" class="option-value" data-value="all">모든 날짜</button></li>
							<li><button type="button" class="option-value" data-value="week">1주일전</button></li>
							<li><button type="button" class="option-value" data-value="month">1개월전</button></li>
							<li><button type="button" class="option-value" data-value="year">1년전</button></li>
							<li><button type="button" class="option-value date-picker" data-value="term">기간설정</button></li>
						</ul>
					</div>
					<div class="search-option">
						<button class="search-option-label" data-option="c"><?php echo $c_text; ?></button>
						<ul class="option-list">
							<li><button type="button" class="option-value" data-value="all">모든 카테고리</button></li>
							<?php if ($top_menus) : foreach ($top_menus as $key => $val) : ?>
									<li><button type="button" class="option-value" data-value="<?php echo $val->object_id; ?>"><?php echo $val->title; ?></button></li>
							<?php endforeach;
							endif; ?>
						</ul>
					</div>
					<div class="search-date-picker-wrap">
						<div class="calendar-wrap">
							<div class="pc">
								<div class="date-from">
									<label for="date_from">검색시작일을 입력하세요. (예: 20170410)<input type="text" id="date_from" placeholder="검색시작일을 선택하세요." class="numeric" maxlength="10" /></label>
								</div><!-- .lt-date -->
								<div class="date-to">
									<label for="date_to">검색종료일을 입력하세요. (예: 20170420)<input type="text" id="date_to" placeholder="검색종료일을 선택하세요." class="numeric" maxlength="10" /></label>
								</div><!-- .rt-date -->
							</div>
							<div class="mobile hide">
								<div class="date-range">
									<label for="date_range">검색 기간을 선택하세요<input type="text" id="date_range" placeholder="검색 기간을 선택하세요." class="numeric" maxlength="20" /></label>
								</div>
							</div>
						</div><!-- .dateWrap -->
						<div class="button-wrap">
							<button type="button" class="btn_ok" id="select-date">선택완료</button>
							<button type="button" class="btn_cancel" id="select-date-cancel">선택취소</button>
						</div>
					</div><!-- .datepickerBox -->
				</div>
			</div>
		</div>
		<div class="keyword-found" id="cj-content-wrap">
			<h3>
				&#8216;<?php echo $s ?>&#8217;에 대한 검색결과
			</h3>
		</div>
		<div class="post-list-wrap">
			<div class="post-list-header">
				<h1>
					포스트
				</h1>
				<span>총 <?php echo $search_posts->found_posts ?>건의 글이 있습니다</span>
			</div>
			<ul class="post-list">
				<?php
				if ($search_posts->have_posts()) :
					while ($search_posts->have_posts()) : $search_posts->the_post();
						get_template_part('theme-parts/post', 'list');
					endwhile;
				endif;
				?>
			</ul>

			<div class="pagination">
				<div class="page-links">
					<?php echo $post_pagination; ?>
				</div>
			</div>
		</div>


		<div class="post-list-wrap">
			<div class="post-list-header">
				<h1>
					미디어라이브러리
				</h1>
				<span>총 <?php echo $search_media->found_posts ?>건의 미디어가 있습니다</span>
			</div>
			<div class="media-wrap">
				<div class="media-justified">
					<?php
					if ($search_media->have_posts()) :
						while ($search_media->have_posts()) : $search_media->the_post();
							get_template_part('theme-parts/media', 'list');
						endwhile;
					endif;
					?>
				</div>
			</div>

			<div class="pagination">
				<div class="page-links <?php if ($wp_query->max_num_pages <= 1) { ?>media-empty<?php } ?>">
					<?php echo $media_pagination; ?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php
get_footer();
