<?php

namespace LSCNS\MainTags;

class Frontend
{
	private static $instance;

	public function __construct()
	{
		global $wpdb;

		$this->db = $wpdb;
		self::$instance = &$this;

		if (!isset($this->db->ls_main_tags)) {
			$this->db->ls_main_tags = $this->db->prefix . 'ls_main_tags';
		}

		$this->action = $_REQUEST['action'] ?? "";

		// add_action('init', [&$this, 'enqueueAssets']);
	}

	public function getMainTags()
	{
		$sql = "SELECT * FROM " . $this->db->ls_main_tags . " ORDER BY seq ASC";
		$tags = $this->db->get_results($sql);
		return $tags;
	}
	public function getMainTagPosts($term_id)
	{
		$args = [
			'posts_per_page'	=> 9,
			'offset'						=> 0,
			'tag_id' 							=> $term_id,
			'orderby'						=> 'date',
			'order'							=> 'DESC',
			'post_type'					=> 'post',
			'post_status'				=> 'publish',
			'suppress_filters'	=> true,
			'fields'						=> '',
		];

		$result = new \WP_Query($args);
		return $result->posts;
	}
}
