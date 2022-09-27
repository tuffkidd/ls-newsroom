<?php
/*
Plugin Name: [LS뉴스룸] 메인 슬라이더
Plugin URI: http://www.i4u.kr
Version: 1.0
Description: 메인페이지의 헤더 슬라이더를 관리하는 플러그인 입니다.
Author: Dohoon Lee@i4uworks
Author URI: http://www.i4u.kr
*/

use LSCNS\MainSlider\Backend;
use LSCNS\MainSlider\Frontend;
// use Newsroom\SearchStats\SearchStatsFrontend;

$page = $_REQUEST['page'] ?? '';

if (!defined('LSMS_DIR'))				define('LSMS_DIR', untrailingslashit(dirname(__FILE__)));
if (!defined('LSMS_URL'))				define('LSMS_URL', untrailingslashit(plugins_url('', __FILE__)));
if (!defined('LSMS_ADMIN_URL'))			define('LSMS_ADMIN_URL', admin_url("admin.php?page=" . $page));

if (!defined('LSMS_VIEW_DIR'))			define('LSMS_VIEW_DIR', LSMS_DIR . '/views');
if (!defined('LSMS_VIEW_URL '))			define('LSMS_VIEW_URL', LSMS_DIR . '/views');
if (!defined('LSMS_CONTROLLERS_DIR'))	define('LSMS_CONTROLLERS_DIR', LSMS_DIR . '/classes');

if (!defined('LSMS_ASSETS_DIR'))		define('LSMS_ASSETS_DIR', LSMS_DIR . '/assets');
if (!defined('LSMS_ASSETS_URL'))		define('LSMS_ASSETS_URL', LSMS_URL . '/assets');

if (!defined('LSMS_FILE'))				define('LSMS_FILE', __FILE__);
if (!defined('LSMS_DB_VERSION'))		define('LSMS_DB_VERSION', '1.0');

require __DIR__ . '/vendor/autoload.php';

if (is_admin()) {
	require(LSMS_CONTROLLERS_DIR . "/Backend.php");
	new Backend();
} else {
	require(LSMS_CONTROLLERS_DIR . "/Frontend.php");
	$sliderFrontend = new Frontend();
}
