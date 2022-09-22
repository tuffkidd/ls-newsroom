<?php

namespace LSCNS\RecommendTags;

class Frontend
{
	private static $instance;

	public function __construct()
	{
		global $wpdb;

		$this->db = $wpdb;
		self::$instance = &$this;

		if (!isset($this->db->ls_recommend_tags)) {
			$this->db->ls_recommend_tags = $this->db->prefix . 'ls_recommend_tags';
		}

		$this->action = $_REQUEST['action'] ?? "";

		// add_action('init', [&$this, 'enqueueAssets']);
	}

	public function getRecommendTags()
	{
		$sql = "SELECT * FROM " . $this->db->ls_recommend_tags . " ORDER BY seq ASC";
		$tags = $this->db->get_results($sql);
		return $tags;
	}
}
