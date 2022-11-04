<?php

namespace LSCNS\RecommendTags;

class Backend
{
	private static $instance;

	public function __construct()
	{
		global $wpdb;

		$this->db = $wpdb;
		self::$instance = &$this;

		$this->page 		= $_REQUEST['page'] ?? '';
		$this->keyword 		= $_REQUEST['keyword'] ?? '';
		$this->action 		= $_REQUEST['action'] ?? '';
		$this->view 		= $_REQUEST['view'] ?? '';

		if (!isset($this->db->ls_recommend_tags)) {
			$this->db->ls_recommend_tags = $this->db->prefix . 'ls_recommend_tags';
		}

		add_action('admin_head', [&$this, 'enqueueAssets']);
		add_action('admin_menu', [&$this, 'set_menu']);

		add_action('wp_ajax_recommendTagsAdd_x', [&$this, 'recommendTagsAdd_x']);
		add_action('wp_ajax_recommendTagsSort_x', [&$this, 'recommendTagsSort_x']);
		add_action('wp_ajax_recommendTagsDel_x', [&$this, 'recommendTagsDel_x']);

		register_activation_hook(LSRT_FILE, [&$this, 'init']);
	}

	public function enqueueAssets()
	{
		wp_enqueue_script('recommend-tags-vendor-js', 		LSRT_ASSETS_URL . "/dist/ls-recommendtags-vendors.js", 				array('jquery'), '', false);
		wp_enqueue_script('recommend-tags-admin-js', 		LSRT_ASSETS_URL . "/dist/ls-recommendtags-backend.js", 				array('jquery'), '', false);
		wp_localize_script(
			'recommend-tags-admin-js',
			'recommend_tags_admin_js',
			[
				'ajaxurl' => admin_url('admin-ajax.php'),
				'admin_url' => admin_url(),
				'recommend_tags_add_nonce' => wp_create_nonce('recommendTagsAddX'),
				'recommend_tags_sort_nonce' => wp_create_nonce('recommendTagsSortX'),
				'recommend_tags_del_nonce' => wp_create_nonce('recommendTagsDelX'),
			]
		);
		// wp_enqueue_style('recommend-tags-admin', 			LSRT_ASSETS_URL . '/css/backend.css', false);
	}

	public function init()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$tableprefix = $this->db->prefix . "ls_";
		$table_name = $tableprefix . 'recommend_tags';
		$sql = "CREATE TABLE " . $table_name . " (
			tid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			term_id INT NOT NULL,
			seq INT NOT NULL,
			location ENUM('S', 'H') DEFAULT 'S',
			created_at DATETIME NOT NULL,
			created_by INT NOT NULL,
			PRIMARY  KEY (tid),
			UNIQUE KEY post_id (term_id)
		);";
		dbDelta($sql);
		update_option('ls_recommend_tags_db_version', LSMS_DB_VERSION);
	}

	public function set_menu()
	{
		add_menu_page(__('추천 태그 설정', 'recommendTags'), __('추천 태그 설정', 'recommendTags'), 'manage_options', 'recommendTags', [&$this, 'recommendTagsActions'], "dashicons-tag");
	}

	public function recommendTagsActions()
	{
		$this->actionTitle = __('추천 태그 목록');
		if (!$this->action || $this->action == "") {
			$this->action = $this->page . "List";
		}

		$this->{$this->action}($this->action);
	}

	public function recommendTagsList()
	{
		// $tags = get_tags(array(
		// 	'hide_empty' => false
		// ));

		$sql = "SELECT * FROM " . $this->db->ls_recommend_tags . " ORDER BY seq ASC";
		$rtags = $this->db->get_results($sql);

		require_once LSRT_VIEW_DIR . "/recommendTagsList.php";
	}

	public function recommendTagsAdd_x()
	{
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'recommendTagsAddX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			// 해당 태그가 존재하는가?
			$tag_name = $_POST['tag_name'];
			$tag = get_term_by('name', $tag_name, 'post_tag');

			if (!$tag) {
				$return = [
					'error' => '301',
					'msg' => '해당 태그가 존재하지 않습니다.'
				];
			} else {
				$clean['location'] = $_POST['location'];
				$clean['term_id'] = $tag->term_id;
				$clean['created_at'] = current_time('Y-m-d H:i:s');
				$clean['created_by'] = get_current_user_id();


				$sql = "SELECT count(tid) AS cnt FROM " . $this->db->ls_recommend_tags . " WHERE term_id = '" . $clean['term_id'] . "'";
				$cnt = $this->db->get_var($sql);

				// $sql = "SELECT count(tid) AS cnt FROM " . $this->db->ls_recommend_tags;
				// $tcnt = $this->db->get_var($sql);


				// 이미 등록되어있는가?
				if ($cnt > 0) {
					$return = [
						'error' => '201',
						'msg' => '이미 등록된 태그 입니다.'
					];
					// } else if ($tcnt >= 3) {
					// 	$return = [
					// 		'error' => '301',
					// 		'msg' => '최대 3개까지 등록이 가능합니다.'
					// 	];
				} else {
					if ($this->db->insert($this->db->ls_recommend_tags, $clean) !== false) {
						$return = [
							'error' => '100',
							'msg' => '등록했습니다.'
						];
						$title = get_term($clean['term_id'])->name;
					} else {
						$return = [
							'error' => '101',
							'msg' => 'DB등록실패: 정상적으로 DB에 등록요청 하였으나 실패해습니다. 유지보수 관리자에게 문의해주세요.'
						];
					}
				}
			}
		}

		echo json_encode($return);
		wp_die();
	}

	public function recommendTagsSort_x()
	{
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'recommendTagsSortX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			parse_str($_POST['values'], $formData);
			$cnt = 0;
			$error_cnt = 0;
			foreach ($formData[$formData['table']] as $key => $val) {
				$tid = str_replace("seq_", "", $val);

				if ($tid != "" && $tid > 0) {
					$cond['seq'] = $cnt + 1;
					if ($this->db->update($formData['table'], $cond, ['tid' => $tid]) === false) {
						$error_cnt++;
					}
				}
				$cnt++;
			}

			if ($error_cnt <= 0) {
				$return = [
					'error' => '100',
					'msg' => '순서를 변경했습니다.'
				];
			} else {
				$return = [
					'error' => '201',
					'msg' => '순서변경실패: DB업데이트 실패. 유지보수 담당자에게 문의해주세요.'
				];
			}
		}

		echo json_encode($return);
		wp_die();
	}

	public function recommendTagsDel_x()
	{
		$nonce = $_POST['nonce'];

		if (!wp_verify_nonce($nonce, 'recommendTagsDelX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			$tid = $_POST['tid'];
			$sql = "SELECT term_id FROM " . $this->db->ls_recommend_tags . " WHERE tid = '$tid'";
			$term_id = $this->db->get_var($sql);
			$title = get_term($term_id)->name;

			$sql = "DELETE FROM " . $this->db->ls_recommend_tags . " WHERE tid = '$tid'";
			if ($this->db->query($sql) !== false) {
				$return = [
					'error' => '100',
					'msg' => '삭제했습니다.'
				];
			} else {
				$return = [
					'error' => '201',
					'msg' => '삭제실패: DB삭제 실패. 유지보수 담당자에게 문의해주세요.'
				];
			}
		}

		echo json_encode($return);
		wp_die();
	}
}
