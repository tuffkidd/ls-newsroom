<?php

namespace LSCNS;


class Frontend extends Theme
{
	public $ajax_scheme;
	public $strack_url;
	public $vtrack_url;

	public function __construct()
	{
		parent::__construct();
		self::$instance = &$this;
		$this->ajax_scheme = is_ssl() ? 'https' : 'http';
		add_action('init', 													[&$this, 'init_startup']); // 시작시 실행
		add_action('wp_enqueue_scripts', 						[&$this, 'load_theme_assets']); // CSS JS 로딩
		add_filter('attachment_link', 							[&$this, 'cleanup_attachment_link']); // 첨부파일 페이지 제거
		add_filter('query_vars', 										[&$this, 'add_search_query_vars_filter']); // 검색 시 추가 변수 설정
		// add_filter('the_content', 									[&$this, 'table_wrapper']); // 테이블을 반응형으로
		add_filter('excerpt_more', 									[&$this, 'new_excerpt_more']); // excerpt 발췌 시 ... 제거
		add_filter('the_author',           	        [&$this, 'del_feed_author'], PHP_INT_MAX, 1); // feed 시 이름 제거
	}

	/*******************************************************************
	 * Breadcrumb
	 */
	// helper function to find a menu item in an array of items
	public function wpd_get_menu_item($field, $object_id, $items)
	{
		foreach ($items as $item) {
			if ($item->$field == $object_id) return $item;
		}
		return false;
	}

	// 카테고리 브레드크럼스
	public function wpd_category_breadcrumb($cat)
	{
		$ans = get_ancestors($cat, 'category', 'taxonomy');

		if (is_single()) {
			$breadcrumbs = $this->wpd_nav_menu_breadcrumbs(wp_get_nav_menu_name('primary'), $ans[0]);
			$breadcrumbs .= '&gt;';
			$breadcrumbs .= '<a href="' . get_the_permalink() . '">' . get_the_title() . '</a>';
		} else {
			if ($ans) {
				$breadcrumbs = $this->wpd_nav_menu_breadcrumbs(wp_get_nav_menu_name('primary'), $ans[0]);
				$cat_name = get_cat_name($cat);
				$cat_link = get_category_link($cat);
				$breadcrumbs .= '&gt;';
				$breadcrumbs .= '<a href="' . $cat_link . '">' . $cat_name . '</a>';
			} else {
				$breadcrumbs = $this->wpd_nav_menu_breadcrumbs(wp_get_nav_menu_name('primary'), $cat);
			}
		}
		return $breadcrumbs;
	}

	// 메뉴 브레드크럼스
	public function wpd_nav_menu_breadcrumbs($menu, $object_id = "")
	{
		// get menu items by menu id, slug, name, or object
		$items = \wp_get_nav_menu_items($menu);
		if (false === $items) {
			echo 'Menu not found';
			return;
		}

		// get the menu item for the current page
		if (!$object_id && $object_id == "") {
			$object_id = get_queried_object_id();
		}
		// echo get_queried_object_id();
		$item = $this->wpd_get_menu_item('object_id', $object_id, $items);
		if (false === $item) {
			return;
		}
		// start an array of objects for the crumbs
		$menu_item_objects = array($item);
		// loop over menu items to get the menu item parents
		while (0 != $item->menu_item_parent) {
			$item = $this->wpd_get_menu_item('ID', $item->menu_item_parent, $items);
			array_unshift($menu_item_objects, $item);
		}
		// output crumbs
		$crumbs = array();
		foreach ($menu_item_objects as $menu_item) {
			if ($menu_item->ID == 77) {
				$link = '<a href="%s" class="coming-soon" data-obj-id="' . $menu_item->ID . '">%s</a>';
			} else {
				$link = '<a href="%s" data-obj-id="' . $menu_item->ID . '">%s</a>';
			}
			$crumbs[] = sprintf($link, $menu_item->url, $menu_item->title);
		}
		return join('&gt;', $crumbs);
	}


	/*********************************************************************************************************************************************************************
	 *
	 * 기본 설정
	 *
	 *********************************************************************************************************************************************************************/

	// 시작
	public function init_startup()
	{
		if (!$this->is_login_page() || !is_admin()) {
			// wp_deregister_script('jquery');
		}

		// register_nav_menus(
		// 	[
		// 		'primary'   => __('메인메뉴', '테마 GNB'),
		// 		'footer'	=> __('하단메뉴', '하단 메뉴')
		// 	]
		// );
	}

	// feed 이름 제거
	public function del_feed_author($display_name)
	{
		if (is_feed()) {
			return '';
		}
	}

	// excerpt 발췌 시 ... 제거
	public function new_excerpt_more($more)
	{
		return '';
	}

	// 검색 시 추가 변수 설정
	public function add_search_query_vars_filter($vars)
	{
		$vars[] = "s"; // 키워드
		$vars[] = "d"; // 날짜
		$vars[] = "o"; // 정렬
		$vars[] = "c"; // 카테고리
		$vars[] = "paged"; // 페이지
		return $vars;
	}

	// CSS JS 로딩
	public function load_theme_assets()
	{
		wp_enqueue_script('lscns', THEME_URI  . 'assets/dist/lscns.js', ['jquery'], current_time('Ymdhis'), true);
		wp_enqueue_script('kakao-sdk', '//developers.kakao.com/sdk/js/kakao.min.js', '', '', true);
		wp_enqueue_script("jquery-effects-core");

		wp_localize_script(
			'lscns',
			'lscns',
			[
				'ajaxurl' => admin_url('admin-ajax.php'),
			]
		);

		wp_enqueue_style('lscns', THEME_URI  . 'assets/dist/lscns.css', false, current_time('Ymdhis'));
	}

	// 첨부파일 페이지 제거
	public function cleanup_attachment_link($link)
	{
		return;
	}

	// 테이블을 반응형으로
	// public function table_wrapper($content)
	// {
	// 	return preg_replace_callback('~<table.*?</table>~is', function ($match) {
	// 		return '<div class="responsive-table">' . $match[0] . '</div>';
	// 	}, $content);
	// }

	/***************************************8
	 * 최신 포스트 가져오기
	 */
	public function get_latest_posts($args, $posts_per_page = 9)
	{
		$cats = $args['cats'] ?? '';
		$tags = $args['tags'] ?? '';

		$args = [
			'posts_per_page'	=> $posts_per_page,
			'offset'						=> 0,
			'cat'								=> $cats,
			'tag' 							=> $tags,
			'orderby'						=> 'date',
			'order'							=> 'DESC',
			'include'						=> '',
			'exclude'						=> '',
			'meta_key'					=> '',
			'meta_value'				=> '',
			'post_type'					=> 'post',
			'post_mime_type'		=> '',
			'post_parent'				=> '',
			'author'						=> '',
			'author_name'				=> '',
			'post_status'				=> 'publish',
			'suppress_filters'	=> true,
			'fields'						=> '',
		];

		$latest_posts = new \WP_Query($args);
		// $latest_posts = get_posts($args);

		return $latest_posts->posts;
	}


	public function get_post_cat($post_id, $depth = 1, $limit = 0)
	{
		$terms = get_the_terms($post_id, 'category');
		// depth가 1이면 하위만 찾아서 맨 위 부모들 리턴
		// depth가 2면 하위만 걸러서 리턴
		// $depth=2;
		// print_r2($terms);
		$parents = [];
		$new_terms = [];
		if ($terms) {
			foreach ($terms as $term) {
				if ($depth == 1 && $term->parent != 0 && !array_key_exists($term->parent, $parents)) { //최상위 찾아내기
					$parents[$term->parent] = '';
					$new_terms[] = get_term($term->parent);
				} else if ($depth == 1 && $term->parent == 0 && array_key_exists($term->parent, $parents)) {
					// echo $term->term_id;
					$parents[$term->term_id] = '';
					$new_terms[] = $term;
				} else if ($depth == 2 && $term->parent != 0) { // 하위만 넣기
					$new_terms[] = $term;
				}
			}
			// print_r($new_terms);
			if ($limit > 0) {
				$new_terms = array_slice($new_terms, 0, $limit);
			}
		}
		return $new_terms;
		/*
		if( $depth == 1 ) {
			foreach( $terms as $key => $val ) {
				// print_r2($val);
				if( $val->parent != 0 ) { // 부모가 있는 하위 분류만 가져와서 다시 부모를 찾는다.
					$term_ids[] = get_ancestors( $val->term_id, 'category', 'taxonomy' );
				}
			}
		} else {
			foreach( $terms as $key => $val ) {
				if( $val->parent != 0 ) { // 부모만
					$term_ids[] = $val->term_id;
				}
			}
		}

		foreach ( $term_ids as $term_id ) {
			$term[] = get_term( $term_id[0], 'category', ARRAY_A );
		}

		return (array_unique(array_column($term, 'term_id')));*/
	}


	/***************************************
	 * 연관글 가져오기
	 ****************************************/
	public function get_relevent_posts($post_id, $limit = 3)
	{
		$tags = array_column(wp_get_post_tags($post_id), 'term_id');
		array_shift($tags);
		// 두번째 태그부터

		$post = "";

		if (is_array($tags)) {
			$args = [
				'orderby'			=> 'date',
				'order'				=> 'DESC',
				'post_type'			=> ['post'],
				'post__not_in'		=> [$post_id],
				'paged'				=> 1,
				'offset'			=> 0,
				'posts_per_page'	=> $limit,
				'tag__in'			=> $tags,
				'post_status'		=> 'publish',
				'suppress_filters'	=> false,
				'tax_query' => [
					[
						'taxonomy'  => 'category',
						'field'     => 'slug',
						'terms'     => 'uncategorized',
						'operator'  => 'NOT IN'
					]
				]
			];

			$posts = new \WP_Query($args);
		}

		return $posts;
	}
}
