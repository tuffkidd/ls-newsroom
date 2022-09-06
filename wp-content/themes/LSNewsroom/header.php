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
			<div id="header-left">
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

			<div id="header-right">
				<div class="open-search">
					<a href="#" class="btn-search-toggle hidden-text">검색창 토글</a>
				</div>

				<div class="lscns-link">
					<a href="https://www.lscns.co.kr/" target="_blank" class="hidden-text">LS전선 바로가기</a>
				</div>
			</div>
	</header>