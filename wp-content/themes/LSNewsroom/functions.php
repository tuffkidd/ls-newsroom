<?php
define('THEME_URI', get_template_directory_uri() . '/');
define('THEME_PATH', get_template_directory() . '/');
define('THEME_TEMPLATE_PATH', get_template_directory() . '/' . 'theme-templates');
define('THEME_IMAGE_URI', THEME_URI . 'assets/images');
define('THEME_IMAGE_PATH', THEME_PATH . 'assets/images');

require_once('vendor/autoload.php');
require_once('functions/default-helper.php');

remove_filter('template_redirect', 'redirect_canonical');


if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
	$Backend = new \LSCNS\Backend;
} else {
	$Frontend = new \LSCNS\Frontend;
}
