<?php
define('THEME_URI', get_template_directory_uri() . '/');
define('THEME_PATH', get_template_directory() . '/');
define('THEME_TEMPLATE_PATH', get_template_directory() . '/' . 'theme-parts');
define('THEME_IMAGE_URI', THEME_URI . 'assets/images');
define('THEME_IMAGE_PATH', THEME_PATH . 'assets/images');

require __DIR__ . '/vendor/autoload.php';
require __DIR__ . '/functions/default-helper.php';

remove_filter('template_redirect', 'redirect_canonical');


class LSNavWalker extends Walker_Nav_Menu
{
	var $number = 1;

	/* function start_lvl( &$output, $depth = 0, $args = [] ) {
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1);

		$classes = array(
			'sub-menu',
			'menu-depth-' . $display_depth
		);
		$class_names = implode( ' ', $classes );

		// build html
		if ($display_depth == 1) {
			$output .= "\n" . $indent . '<div class="sub-menu__wrapper"><ul class="' . $class_names . '">' . "\n";
		} else {
			$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
		}
	}*/

	function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
	{
		$indent = ($depth) ? str_repeat("\t", $depth) : '';

		$class_names = $value = '';

		$classes = empty($item->classes) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

		$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($classes), $item, $args));
		$class_names = $class_names ? ' class="' . esc_attr($class_names) . '"' : '';

		$id = apply_filters('nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args);
		$id = $id ? ' id="' . esc_attr($id) . '"' : '';

		$output .= $indent . '<li ' . $id . $value . $class_names . '>';
		// add span with number here

		$new_tag = '';

		$fold_tag = '';
		if ($depth == 0) {
			$fold_tag = '<a href="#" class="gnb-fold hidden-text">펼치기</a>';
		}


		$atts = array();
		$atts['title']  = !empty($item->attr_title) ? $item->attr_title : '';
		$atts['target'] = !empty($item->target)     ? $item->target     : '';
		$atts['rel']    = !empty($item->xfn)        ? $item->xfn        : '';
		$atts['href']   = !empty($item->url)        ? $item->url        : '';

		$atts = apply_filters('nav_menu_link_attributes', $atts, $item, $args);

		$attributes = '';

		foreach ($atts as $attr => $value) {
			if (!empty($value)) {
				$value = ('href' === $attr) ? esc_url($value) : esc_attr($value);
				$attributes .= ' ' . $attr . '="' . $value . '"';
			}
		}

		$item_output = $args->before;
		$item_output .= '<a' . $attributes . '>';
		$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after . $new_tag;
		$item_output .= '</a>';
		$item_output .= $fold_tag;
		$item_output .= $args->after;

		$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
	}
}


if (is_admin() || $GLOBALS['pagenow'] === 'wp-login.php') {
	$Backend = new \LSCNS\Backend;
} else {
	$Frontend = new \LSCNS\Frontend;
}
