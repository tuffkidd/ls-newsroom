<?php
global $Frontend;
$onPage = '';
if (is_home()) {
	$onPage = 'index';
} else if (is_search()) {
	$onPage = 'search';
} else if (is_single()) {
	$onPage = 'single';
} else if (is_category()) {
	$onPage = 'category';
}
?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?> data-page="<?php echo $onPage; ?>">
	<a id="skip-link" href="#content-wrap"><?php _e('본문 바로가기', 'spc'); ?></a>
	<?php wp_body_open(); ?>
	<header>

		<div id="header-wrap">
			<div class="container" id="header-left">
				<div id="header-logo">
					<a href="<?php echo site_url() ?>" class="hidden-text">홈으로 가기</a>
				</div>
			</div>

			<?php
			wp_nav_menu([
				'container' => 'nav',
				'theme_location' => 'primary',
				'container_id' => 'header-gnb'
			]);
			?>

			<div class="continaer" id="header-right">
				<div class="open-search">
					<a href="#" class="btn-search-toggle hidden-text">검색창 토글</a>
				</div>

				<div class="lscns-link">
					<a href="https://www.lscns.co.kr/" target="_blank" class="hidden-text">LS전선 바로가기</a>
				</div>
			</div>
		</div>
		<?php /*
		<div id="header-search">
			<form id="gnbSearchFrm" method="get" action="<?php echo site_url() ?>">
				<div id="search-options">
					<div class="search-option-wrap">
						<div class="search-option">
							<button class="search-option-label" data-option="d">기간</button>
							<ul class="option-list">
								<li><button type="button" class="option-value" data-value="all">전체</button></li>
								<li><button type="button" class="option-value" data-value="month">최근 1개월</button></li>
								<li><button type="button" class="option-value" data-value="year">최근 1년</button></li>
								<li><button type="button" class="option-value date-picker" data-value="term">직접입력</button></li>
							</ul>
						</div>
						<div class="search-option">
							<button class="search-option-label" data-option="o">정렬</button>
							<ul class="option-list">
								<li><button type="button" class="option-value" data-value="latest">최신순</button></li>
								<li><button type="button" class="option-value" data-value="relevance">관련순</button></li>
							</ul>
						</div>
						<div class="search-option">
							<label for="s"><input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>"></label>
							<a href="#" id="del-keyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
							<button type="submit" id="search-submit" class="hidden-text" title="검색하기">검색하기</button>
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
			</form>
		</div>
		*/ ?>
	</header>