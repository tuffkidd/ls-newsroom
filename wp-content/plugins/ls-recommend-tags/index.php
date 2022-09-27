<?php
/*
Plugin Name: [LS뉴스룸] 추천 태그 설정
Plugin URI: http://www.i4u.kr
Version: 1.0
Description: 헤더 검색창의 추천태그 목록입니다.
Author: Dohoon Lee@i4uworks
Author URI: http://www.i4u.kr
*/

use LSCNS\RecommendTags\Backend;
use LSCNS\RecommendTags\Frontend;
// use Newsroom\SearchStats\SearchStatsFrontend;

$page = $_REQUEST['page'] ?? '';

if (!defined('LSRT_DIR'))				define('LSRT_DIR', untrailingslashit(dirname(__FILE__)));
if (!defined('LSRT_URL'))				define('LSRT_URL', untrailingslashit(plugins_url('', __FILE__)));
if (!defined('LSRT_ADMIN_URL'))		define('LSRT_ADMIN_URL', admin_url("admin.php?page=" . $page));

if (!defined('LSRT_VIEW_DIR'))			define('LSRT_VIEW_DIR', LSRT_DIR . '/views');
if (!defined('LSRT_VIEW_URL '))		define('LSRT_VIEW_URL', LSRT_DIR . '/views');
if (!defined('LSRT_CONTROLLERS_DIR'))	define('LSRT_CONTROLLERS_DIR', LSRT_DIR . '/classes');

if (!defined('LSRT_ASSETS_DIR'))		define('LSRT_ASSETS_DIR', LSRT_DIR . '/assets');
if (!defined('LSRT_ASSETS_URL'))		define('LSRT_ASSETS_URL', LSRT_URL . '/assets');

if (!defined('LSRT_FILE'))				define('LSRT_FILE', __FILE__);
if (!defined('LSRT_DB_VERSION'))		define('LSRT_DB_VERSION', '1.0');

require __DIR__ . '/vendor/autoload.php';

if (is_admin()) {
	require(LSRT_CONTROLLERS_DIR . "/Backend.php");
	new Backend();
} else {
	require(LSRT_CONTROLLERS_DIR . "/Frontend.php");
	$recommendTagsFrontend = new Frontend;
}
