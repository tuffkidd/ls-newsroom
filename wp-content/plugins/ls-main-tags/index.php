<?php
/*
Plugin Name: [LS뉴스룸] 메인페이지 태그 큐레이션
Plugin URI: http://www.i4u.kr
Version: 1.0
Description: 메인페이지의 최신글 우측 태그 그룹을 설정합니다.
Author: Dohoon Lee@i4uworks
Author URI: http://www.i4u.kr
*/

use LSCNS\MainTags\Backend;
use LSCNS\MainTags\Frontend;
// use Newsroom\SearchStats\SearchStatsFrontend;

$page = $_REQUEST['page'] ?? '';

if (!defined('LSMT_DIR'))				define('LSMT_DIR', untrailingslashit(dirname(__FILE__)));
if (!defined('LSMT_URL'))				define('LSMT_URL', untrailingslashit(plugins_url('', __FILE__)));
if (!defined('LSMT_ADMIN_URL'))		define('LSMT_ADMIN_URL', admin_url("admin.php?page=" . $page));

if (!defined('LSMT_VIEW_DIR'))			define('LSMT_VIEW_DIR', LSMT_DIR . '/views');
if (!defined('LSMT_VIEW_URL '))		define('LSMT_VIEW_URL', LSMT_DIR . '/views');
if (!defined('LSMT_CONTROLLERS_DIR'))	define('LSMT_CONTROLLERS_DIR', LSMT_DIR . '/classes');

if (!defined('LSMT_ASSETS_DIR'))		define('LSMT_ASSETS_DIR', LSMT_DIR . '/assets');
if (!defined('LSMT_ASSETS_URL'))		define('LSMT_ASSETS_URL', LSMT_URL . '/assets');

if (!defined('LSMT_FILE'))				define('LSMT_FILE', __FILE__);
if (!defined('LSMT_DB_VERSION'))		define('LSMT_DB_VERSION', '1.0');

require __DIR__ . '/vendor/autoload.php';

if (is_admin()) {
	require(LSMT_CONTROLLERS_DIR . "/Backend.php");
	new Backend();
} else {
	require(LSMT_CONTROLLERS_DIR . "/Frontend.php");
	$mainTagsFrontend = new Frontend;
}
