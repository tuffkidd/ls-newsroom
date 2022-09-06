<?php

namespace LSCNS;

class Theme
{
	protected static $instance;
	public $ajax_scheme;

	public function __construct()
	{
		global $wpdb;
		$this->db = $wpdb;
		self::$instance = &$this;
		$this->ajax_scheme = is_ssl() ? 'https' : 'http';

		// $this->register_callback();

		// all actions related to emojis
		remove_action('admin_print_styles', 'print_emoji_styles');
		remove_action('wp_head', 'print_emoji_detection_script', 7);
		remove_action('admin_print_scripts', 'print_emoji_detection_script');
		remove_action('wp_print_styles', 'print_emoji_styles');
		remove_filter('wp_mail', 'wp_staticize_emoji_for_email');
		remove_filter('the_content_feed', 'wp_staticize_emoji');
		remove_filter('comment_text_rss', 'wp_staticize_emoji');
		add_filter('big_image_size_threshold', '__return_false');

		// header 의 <meta name="generator" content="WordPress 5.7" /> 제거
		remove_action('wp_head', 'wp_generator');

		// 테마 셋업 후
		add_action('after_setup_theme', [&$this, 'init_setup']);

		// 이미지 lazy loading 제거 (인쇄 시 문제됨?)
		add_filter('wp_lazy_loading_enabled', '__return_false');

		// 사용자 페이지에서 어드민 바 제거
		add_filter('show_admin_bar', '__return_false');

		// 최대 이미지 제한 해제
		add_filter('big_image_size_threshold', '__return_false');

		// Simple History 기간 설정
		add_filter("simple_history/db_purge_days_interval", function ($days) {
			$days = 180;
			return $days;
		});

		// 커스텀 택소노미
		add_action('init', [&$this, 'ls_custom_taxonomy']);
		add_action('init', [&$this, 'ls_medialibrary_rewrite'], 10, 0);
		add_filter('post_type_link', [&$this, 'ls_album_post_link'], 1, 3);
		add_action('template_redirect', [&$this, 'ls_template_redirect']);
		add_filter('query_vars', [&$this, 'ls_template_query_vars']);


		// 워드프레스 기본 썸네일 삭제
		add_filter('intermediate_image_sizes', [&$this, 'prefix_remove_default_images']);

		// jquery migrate
		add_action('wp_default_scripts', function ($scripts) {
			if (!empty($scripts->registered['jquery'])) {
				$scripts->registered['jquery']->deps = array_diff($scripts->registered['jquery']->deps, ['jquery-migrate']);
			}
		});
	}

	// public function register_callback()
	// {
	// }

	public function is_login_page()
	{
		return in_array($GLOBALS['pagenow'], ['wp-login.php', 'wp-register.php']);
	}


	public function prefix_remove_default_images($sizes)
	{
		unset($sizes['small']); // 150px
		unset($sizes['medium']); // 300px
		return $sizes;
	}


	public function init_setup()
	{
		add_theme_support('title-tag');
		add_theme_support('post-thumbnails');
		add_theme_support(
			'post-formats',
			[
				// 'aside',
				// 'gallery',
				// 'video',
				// 'link',
				// 'image',
				// 'quote',
				// 'status',
				// 'audio'
			]
		);

		add_theme_support('html5', [
			'search-form',
			'comment-form',
			'comment-list',
			'gallery',
			'caption',
		]);

		add_theme_support('align-wide');
		add_theme_support('responsive-embeds');
		add_theme_support('wp-block-styles');
		add_theme_support('editor-styles');

		add_editor_style('assets/dist/gutenberg.css');


		// add_editor_style( array( 'assets/css/editor-style.css', '' ) );

		if (function_exists('add_image_size')) {

			add_image_size('thumbnail', 385, 205, true); // 메인/목록
			// add_image_size('list', 385, 205, true); // 메인/목록
			add_image_size('content', 770, 99999999, true); // 메인 컨텐츠룸
			add_image_size('slider', 815, 446, true); // 메인슬라이더
			add_image_size('media', 840, 99999999, true); // 컨텐츠용
		}

		register_nav_menus(
			array(
				'primary'   => __('메인메뉴', '테마 GNB'),
				'footer'	=> __('하단메뉴', '하단 메뉴')
			)
		);
	}

	/****************************************************
	 * Custom taxonomy
	 */

	public function ls_custom_taxonomy()
	{
		// 미디어 라이브러리
		$labels = array(
			'name'                => _x('LS미디어라이브러리', 'LS MediaLibrary', 'lscns'),
			'singular_name'       => _x('LS미디어라이브러리', 'LS MediaLibrary', 'lscns'),
			'menu_name'           => __('LS미디어라이브러리', 'lscns'),
			'parent_item_colon'   => __('부모 미디어:', 'lscns'),
			'all_items'           => __('모든 미디어', 'lscns'),
			'view_item'           => __('미디어 보기', 'lscns'),
			'add_new_item'        => __('미디어 추가', 'lscns'),
			'add_new'             => __('새 미디어', 'lscns'),
			'edit_item'           => __('미디어 수정', 'lscns'),
			'update_item'         => __('미디어 업데이트', 'lscns'),
			'search_items'        => __('미디어 검색', 'lscns'),
			'not_found'           => __('미디어를 찾을 수 없습니다.', 'lscns'),
			'not_found_in_trash'  => __('휴지통에서 미디어를 찾을 수 없습니다.', 'lscns'),
		);

		$args = array(
			'label'               => __('미디어', 'lscns'),
			'description'         => __('Referable Lessons', 'lscns'),
			'labels'              => $labels,
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_rest'        => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => null,
			'can_export'          => true,
			'has_archive'         => 'multimedia',
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
			'query_var'				=> true,
			'rewrite'               => ['slug' => 'medialibrary/%album%', 'with_front' => false],
			// 'rewrite'               => [
			// 	'slug' => '/%album%/%postname%/',
			// 	'with_front' => true,
			// 	'hierarchical' => true
			// ],
			'supports'				=> [
				'title',
				'editor',
				'thumbnail',
				'comments',
				'post-formats'
			],
		);

		register_post_type('multimedia', $args);


		$labels = array(
			'name'                       => _x('앨범', '앨범', 'lscns'),
			'singular_name'              => _x('앨범', '앨범', 'lscns'),
			'menu_name'                  => __('앨범', 'lscns'),
			'all_items'                  => __('모든 앨범', 'lscns'),
			'parent_item'                => __('부모 앨범', 'lscns'),
			'parent_item_colon'          => __('부모 앨범:', 'lscns'),
			'new_item_name'              => __('새 앨범 이름', 'lscns'),
			'add_new_item'               => __('새 앨범 추가', 'lscns'),
			'edit_item'                  => __('앨범 수정', 'lscns'),
			'update_item'                => __('앨범 업데이트', 'lscns'),
			'separate_items_with_commas' => __('콤마로 구분', 'lscns'),
			'search_items'               => __('앨범 검색', 'lscns'),
			'add_or_remove_items'        => __('앨범 추가 또는 삭제', 'lscns'),
			'choose_from_most_used'      => __('자주 사용하는 앨범에서 선택', 'lscns'),
		);

		$args = array(
			'labels'                     => $labels,
			'hierarchical'               => true,
			'has_archive'         		 => true,
			'public'                     => true,
			'show_ui'                    => true,
			'show_in_rest'               => true,
			'show_admin_column'          => true,
			'show_in_nav_menus'          => true,
			'show_tagcloud'              => false,
			'rewrite'               => [
				'slug' => 'medialibrary',
				'with_front' => false
			],
		);

		register_taxonomy('album', 'multimedia', $args);
	}

	// 커스텀 택소노미 rewrite
	public function ls_medialibrary_rewrite()
	{
		add_rewrite_rule(
			"^medialibrary/albums",
			'index.php?medialib=albums',
			'top'
		);
		add_rewrite_rule(
			"^medialibrary/photostream",
			'index.php?medialib=photostream',
			'top'
		);
		add_rewrite_rule(
			"^medialibrary/download",
			'index.php?medialib=download',
			'top'
		);
	}

	// 커스텀 택소노미 포스트 링크 변경
	public function ls_album_post_link($post_link, $id = 0)
	{
		$post = get_post($id);

		if ($post->post_type == 'multimedia') {
			$term = 'album';
		}

		if (is_object($post)) {
			$terms = wp_get_object_terms($post->ID, $term);
			if ($terms) {
				return str_replace('%album%', $terms[0]->slug, $post_link);
			}
		}
		return $post_link;
	}


	// 쿼리 스트링 추가 등록
	public function ls_template_query_vars($vars)
	{
		$vars[] = 'medialib';
		return $vars;
	}

	// 커스텀 택소노미 파일 분기
	public function ls_template_redirect()
	{
		switch (get_query_var('medialib')) {
			case "albums":
				add_filter('template_include', function () {
					return THEME_TEMPLATE_PATH . "/medialibrary-albums.php";
				});
				break;
			case "photostream":
				add_filter('template_include', function () {
					return THEME_TEMPLATE_PATH . "/medialibrary-photostream.php";
				});
				break;
			case "download":
				add_filter('template_include', function () {
					return THEME_TEMPLATE_PATH . "/medialibrary-download.php";
				});
				break;
		}
	}
}
