<?php

namespace LSCNS;


class Backend extends Theme
{
	public function __construct()
	{
		parent::__construct();
		$this->ajax_scheme = is_ssl() ? 'https' : 'http';
		add_action('admin_init', 						[&$this, 'admin_init_startup']); // 시작 시 실행
	}

	// 시작 시 실행
	public function admin_init_startup()
	{
		wp_enqueue_script('lscns-backend', THEME_URI  . 'assets/dist/lsbackend.js', ['jquery', 'wp-i18n', 'wp-element', 'wp-blocks', 'wp-components', 'wp-editor', 'wp-edit-post'], '', true);

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
}
