<?php

namespace LSCNS\MainSlider;

class Frontend
{
	private static $instance;

	public function __construct()
	{
		global $wpdb;

		$this->db = $wpdb;
		self::$instance = &$this;

		$this->action = $_REQUEST['action'] ?? "";

		if (!isset($this->db->ls_main_slider)) {
			$this->db->ls_main_slider = $this->db->prefix . 'ls_main_slider';
		}

		add_action('init', [&$this, 'enqueueMainSliderAssets']);
		add_shortcode('mainSlider', [&$this, 'mainSliderList']);
	}

	public function enqueueMainSliderAssets()
	{
		// wp_enqueue_style( 'cj-main-slider', 			LSMS_ASSETS_URL . '/dist/frontend.css', false);
	}

	public function mainSliderList($atts)
	{
	}

	public function get_sliders()
	{
		if (is_user_logged_in()) {
			$sql = "SELECT * FROM " . $this->db->ls_main_slider . " ORDER BY seq ASC";
		} else {
			$sql = "SELECT * FROM " . $this->db->ls_main_slider . " WHERE is_output = 'Y' ORDER BY seq ASC";
		}
		$sliders = $this->db->get_results($sql);

		if (isset($sliders)) {
			$return = $sliders;
		} else {
		}
		return $return;
	}
}
