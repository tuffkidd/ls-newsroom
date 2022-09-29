<?php

namespace LSCNS;


class Backend extends Theme
{
	public function __construct()
	{
		parent::__construct();
		$this->ajax_scheme = is_ssl() ? 'https' : 'http';
		add_action('admin_init', 						[&$this, 'admin_init_startup']); // 시작 시 실행


		add_action('album_add_form_fields', [&$this, 'add_albums_fields'], 10, 1);
		add_action('album_edit_form_fields', [&$this, 'add_albums_fields'], 10, 1);

		add_action('heritage-album_add_form_fields', [&$this, 'add_albums_fields'], 10, 1);
		add_action('heritage-album_edit_form_fields', [&$this, 'add_albums_fields'], 10, 1);

		add_action('created_album', [&$this, 'save_albums_fields'], 10, 2);
		add_action('edited_album', [&$this, 'save_albums_fields'], 10, 2);

		add_action('created_heritage-album', [&$this, 'save_albums_fields'], 10, 2);
		add_action('edited_heritage-album', [&$this, 'save_albums_fields'], 10, 2);
		add_action('restrict_manage_posts', [&$this, 'filter_post_type_by_taxonomy']);
		add_filter('parse_query', [&$this, 'convert_id_to_term_in_query']);


		add_action('wp_ajax_set_album_priority',	[&$this, 'set_album_priority']); // 미디어라이브러리 카테고리 우선순위
		add_action('wp_ajax_change_post_status',	[&$this, 'change_post_status']); // Frontend 비공개
	}

	// 시작 시 실행
	public function admin_init_startup()
	{
		wp_enqueue_script('lscns-backend', THEME_URI  . 'assets/dist/lscnsbackend.js', ['jquery', 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-edit-post'], '', true);

		wp_localize_script('lscns-backend', 'lscns_backend', [
			'ajaxurl' => admin_url('admin-ajax.php'),
			'nonce' => wp_create_nonce('ajax-nonce'),
			'print_nonce' => wp_create_nonce("printNunce")
		]);


		// wp_enqueue_style('lscns-backend', THEME_URI  . 'assets/dist/lscns-backend.css', false,  '');
		wp_enqueue_media();
		wp_enqueue_script('media-upload');
		wp_enqueue_script('thickbox');
		wp_enqueue_style('thickbox');
	}





	public function convert_id_to_term_in_query($query)
	{
		global $pagenow;
		$post_type = 'multimedia';
		$taxonomy  = 'album';
		$q_vars    = &$query->query_vars;
		if ($pagenow == 'edit.php' && isset($q_vars['post_type']) && $q_vars['post_type'] == $post_type && isset($q_vars[$taxonomy]) && is_numeric($q_vars[$taxonomy]) && $q_vars[$taxonomy] != 0) {
			$term = get_term_by('id', $q_vars[$taxonomy], $taxonomy);
			$q_vars[$taxonomy] = $term->slug;
		}
	}
	public function filter_post_type_by_taxonomy()
	{
		global $typenow;
		$post_type = 'multimedia';
		$taxonomy  = 'album';
		if ($typenow == $post_type) {
			$selected      = isset($_GET[$taxonomy]) ? $_GET[$taxonomy] : '';
			$info_taxonomy = get_taxonomy($taxonomy);
			wp_dropdown_categories(array(
				'show_option_all' => sprintf(__('모든 %s', 'channel_cj'), $info_taxonomy->label),
				'taxonomy'        => $taxonomy,
				'name'            => $taxonomy,
				'orderby'         => 'name',
				'selected'        => $selected,
				'show_count'      => true,
				'hide_empty'      => true,
			));
		};
	}

	public function add_albums_fields($term)
	{
		if (is_object($term)) {
			$album_img = get_term_meta($term->term_id, "album_img", TRUE);
		}

		require_once(THEME_TEMPLATE_PATH . '/album-edit-fields.php');
	}

	public function save_albums_fields($term_id)
	{
		if (isset($_POST['album_img']) && '' !== $_POST['album_img']) {
			$image = $_POST['album_img'];
			update_term_meta($term_id, 'album_img', $image);
		} else {
			update_term_meta($term_id, 'album_img', '');
		}
	}
}
