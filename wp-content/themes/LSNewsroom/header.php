<?php
global $Frontend, $recommendTagsFrontend;
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

$r_tags = $recommendTagsFrontend->getRecommendTags();


$custom_taxo_page = "";
if (is_tax('album') || get_query_var('medialib') || get_query_var('post_type') == 'multimedia') {
	$custom_taxo_page = "multimedia";
}

if ($custom_taxo_page == 'multimedia') {
	$onPage = 'medialibrary';
	$body_class = "medialibrary";
}


?>
<!DOCTYPE html>
<html lang="ko">

<head>
	<meta charset="<?php bloginfo('charset'); ?>" />
	<!-- <meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1, user-scalable=no" /> -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-XC67PP4EXT"></script>
	<script>
		window.dataLayer = window.dataLayer || [];

		function gtag() {
			dataLayer.push(arguments);
		}
		gtag('js', new Date());
		gtag('config', 'G-XC67PP4EXT');
	</script>

	<?php wp_head(); ?>
	<link rel="apple-touch-icon" sizes="180x180" href="<?php echo THEME_IMAGE_URI ?>/favicon/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="<?php echo THEME_IMAGE_URI ?>/favicon/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="<?php echo THEME_IMAGE_URI ?>/favicon/favicon-16x16.png">
	<link rel="manifest" href="<?php echo THEME_IMAGE_URI ?>/favicon/site.webmanifest">
	<link rel="mask-icon" href="<?php echo THEME_IMAGE_URI ?>/favicon/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">

</head>

<body <?php body_class(); ?> data-page="<?php echo $onPage; ?>">
	<a id="skip-link" href="#content"><?php _e('본문 바로가기', 'spc'); ?></a>
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
				'container_id' => 'header-gnb',
				'walker' => new LSNavWalker,
			]);
			?>



			<div class="container" id="header-right">
				<div class="open-search">
					<a href="#" class="btn-search-toggle hidden-text">검색창 토글</a>
				</div>

				<a href="#" id="btn-mob-menu">
					<span></span>
					<span></span>
					<span></span>
				</a>

				<div class="lscns-link">
					<a href="https://www.lscns.co.kr/" target="_blank" class="hidden-text">LS전선 바로가기</a>
				</div>
			</div>
		</div>
		<div id="header-search-box">
			<form id="gnbSearchFrm" method="get" action="<?php echo site_url() ?>">
				<div class="container-small">
					<div class="search-box-wrap">
						<div id="search-box">
							<div class="search-option">
								<button type="button" class="search-option-label daterange" data-option="d">전체</button>
								<ul class="option-list">
									<li><button type="button" class="option-value" data-value="all">전체</button></li>
									<li><button type="button" class="option-value" data-value="month">최근 1개월</button></li>
									<li><button type="button" class="option-value" data-value="year">최근 1년</button></li>
									<li><button type="button" class="option-value date-picker" data-value="term">직접입력</button></li>
								</ul>
							</div>
							<div class="search-option">
								<button type="button" class="search-option-label sort" data-option="o">최신순</button>
								<ul class="option-list">
									<li><button type="button" class="option-value" data-value="latest">최신순</button></li>
									<li><button type="button" class="option-value" data-value="relevance">관련순</button></li>
								</ul>
							</div>
						</div>
						<div class="search-keyword">
							<div class="search-keyword-wrap">
								<label for="s" class="hidden-text">검색어를 입력하세요.</label>
								<input type="text" name="s" value="<?php echo get_search_query(); ?>" placeholder="검색어를 입력하세요.">
								<a href="#" id="del-keyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
								<button type="submit" id="search-submit" class="hidden-text" title="검색하기">검색하기</button>
							</div>
						</div>
					</div>
					<?php if ($r_tags) : ?>
						<div class="tags">
							<?php foreach ($r_tags as $t) : $ta = get_term_by('id', $t->term_id, 'post_tag'); ?>
								<a href="<?php echo site_url('/tag/' . $ta->slug) ?>"><?php echo $ta->name; ?></a>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>
					<div class="search-date-picker-wrap">
						<div class="calendar-wrap">
							<div class="pc">
								<div class="date-from">
									<label for="date_from">검색시작일을 선택하세요. (예: 20220808)<input type="text" id="date_from" placeholder="검색시작일을 선택하세요." class="numeric" maxlength="10" /></label>
								</div>
								<div class="date-to">
									<label for="date_to">검색종료일을 선택하세요. (예: 20220825)<input type="text" id="date_to" placeholder="검색종료일을 선택하세요." class="numeric" maxlength="10" /></label>
								</div>
							</div>
							<div class="mobile hide">
								<div class="date-range">
									<label for="date_range">검색 기간을 선택하세요<input type="text" id="date_range" placeholder="검색 기간을 선택하세요." class="numeric" maxlength="20" /></label>
								</div>
							</div>
						</div>
						<div class="button-wrap">
							<button type="button" class="btn_ok" id="select-date">선택완료</button>
							<button type="button" class="btn_cancel" id="select-date-cancel">선택취소</button>
						</div>
					</div>
					<input type="hidden" name="d" value="">
					<input type="hidden" name="o" value="">
				</div>
			</form>
		</div>

	</header>