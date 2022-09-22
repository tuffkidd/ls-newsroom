<?php

namespace LSCNS\MainSlider;

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

		if (!isset($this->db->ls_main_slider)) {
			$this->db->ls_main_slider = $this->db->prefix . 'ls_main_slider';
		}

		$this->in_plugin = (!is_null($this->page) && ($this->page) === 'mainSlider');



		add_action('admin_head', [&$this, 'enqueueMainSliderAssets']);
		add_action('admin_menu', [&$this, 'mainSliderMenus']);

		add_action('wp_ajax_mainSliderAdd_x',			[&$this, 'mainSliderAdd_x']);
		add_action('wp_ajax_mainSliderEdit_x',			[&$this, 'mainSliderEdit_x']);
		add_action('wp_ajax_mainSliderDel_x',			[&$this, 'mainSliderDel_x']);
		add_action('wp_ajax_mainSliderSort_x',			[&$this, 'mainSliderSort_x']);
		add_action('wp_ajax_mainSliderOutput_x',			[&$this, 'mainSliderOutput_x']);
		add_action('wp_ajax_mainSliderTitleUpdate_x',			[&$this, 'mainSliderTitleUpdate_x']);

		register_activation_hook(LSMS_FILE, [&$this, 'mainSliderInit']);
	}

	public function enqueueMainSliderAssets()
	{
		wp_enqueue_script('jquery');
		wp_enqueue_script('jquery-ui');
		wp_enqueue_script('jquery-ui-sortable');
		wp_enqueue_script('jquery-ui-tabs');
		wp_enqueue_style('jquery-ui-css', 'https://ajax.googleapis.com/ajax/libs/jqueryui/1.8/themes/base/jquery.ui.all.css');

		wp_enqueue_script('main-slider-vendor-js', 		LSMS_ASSETS_URL . "/dist/ls-main-slider-vendors.js", 				array('jquery'), '', false);
		wp_enqueue_script('main-slider-admin-js', 		LSMS_ASSETS_URL . "/dist/ls-main-slider-backend.js", 				array('jquery'), '', false);
		wp_localize_script(
			'main-slider-admin-js',
			'main_slider_admin_js',
			[
				'ajaxurl' => admin_url('admin-ajax.php'),
				'admin_url' => admin_url(),
				'main_slider_add_nonce' => wp_create_nonce('mainSliderAddX'),
				'main_slider_edit_nonce' => wp_create_nonce('mainSliderEditX'),
				'main_slider_del_nonce' => wp_create_nonce('mainSliderDelX'),
				'main_slider_sort_nonce' => wp_create_nonce('mainSliderSortX'),
				'main_slider_output_nonce' => wp_create_nonce('mainSliderOutputX'),
				'main_slider_title_update_nonce' => wp_create_nonce('mainSliderTitleUpdateX'),
			]
		);

		wp_enqueue_style('ls-main-slider-admin', 			LSMS_ASSETS_URL . '/dist/ls-main-slider-backend.css', false);
	}
	/*
	public function mainSliderTitleUpdate_x()
	{
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'mainSliderTitleUpdateX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			$clean['post_title'] = $_POST['title'];

			if ($this->db->update($this->db->ls_main_slider, $clean, ['tid' => $_POST['tid']]) !== false) {
				$return = [
					'error' => '100',
					'msg' => '업데이트 했습니다.'
				];
			} else {
				$return = [
					'error' => '201',
					'msg' => 'DB업데이트 실패: 유지보수 담당자에게 문의해주세요.'
				];
			}
		}

		echo json_encode($return);
		wp_die();
	}
 */
	public function mainSliderInit()
	{
		require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
		$tableprefix = $this->db->prefix . "ls_";
		$table_name = $tableprefix . 'main_slider';
		$sql = "CREATE TABLE " . $table_name . " (
			tid INT UNSIGNED NOT NULL AUTO_INCREMENT,
			type ENUM('P','L') NOT NULL DEFAULT 'P',
			post_id INT UNSIGNED NOT NULL,
			thumb VARCHAR(191) NOT NULL,
			title VARCHAR(191) NOT NULL,
			url VARCHAR(191) NOT NULL,
			seq INT NOT NULL,
			is_blank ENUM('Y', 'N') NOT NULL DEFAULT 'N',
			is_output ENUM('Y', 'N') NOT NULL DEFAULT 'N',
			created_at DATETIME NOT NULL,
			created_by INT NOT NULL,
			PRIMARY  KEY (tid)
		);";
		dbDelta($sql);
		update_option('ls_main_slider_db_version', LSMS_DB_VERSION);
	}


	public function mainSliderMenus()
	{
		add_menu_page(__('메인 슬라이더 설정', 'mainSlider'), __('메인 슬라이더 설정', 'mainSlider'), 'manage_options', 'mainSlider', [&$this, 'mainSliderActions'], "dashicons-welcome-widgets-menus");
	}

	public function mainSliderActions()
	{
		$this->actionTitle = __('메인 슬라이더 목록');
		if (!$this->action || $this->action == "") {
			$this->action = $this->page . "List";
		}

		$this->{$this->action}($this->action);
	}

	public function mainSliderList()
	{
		$items_per_page = 20;
		$start = 0;
		$cpage = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
		$start = ($cpage - 1) * $items_per_page;
		$keyword = $this->keyword;
		$where = "";
		$order = 'ORDER BY seq ASC';

		$total_query = "SELECT count(1) FROM " . $this->db->ls_main_slider  . " $where ";
		$total = $this->db->get_var($total_query);

		$sql = "
			SELECT
				*
			FROM
				" . $this->db->ls_main_slider . "
			$where
			$order
			LIMIT
				$start, $items_per_page
		";

		$mainSliderList = $this->db->get_results($sql);
		require_once LSMS_VIEW_DIR . "/adminMainSliderList.php";
	}

	public function mainSliderAdd()
	{
		$this->actionTitle = "메인 슬라이더 등록";
		require_once LSMS_VIEW_DIR . "/adminMainSliderAdd.php";
	}

	public function mainSliderAdd_x()
	{
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'mainSliderAddX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			if ($_POST['type'] == 'P') {
				$post_id = url_to_postid(trim($_POST['post_url']));

				if ($post_id <= 0) {
					$return = [
						'error' => '201',
						'msg' => '포스트 주소가 올바르지 않습니다. 정확히 복사하여 붙여넣어주세요.'
					];
				} else {
					// 이미 존재하는가?
					$sql = "SELECT count(1) FROM " . $this->db->ls_main_slider . " WHERE post_id = '$post_id'";
					$cnt = $this->db->get_var($sql);
					if ($cnt > 0) {
						$return = [
							'error' => '201',
							'msg' => '이미 등록된 포스트 입니다.'
						];
					} else {
						$clean['post_id'] = $post_id;
						$clean['thumb'] = '';
						$clean['title'] = '';
						$clean['url'] = '';
						$clean['is_blank'] = 'N';
						$clean['is_output'] = 'N';
						$clean['created_at'] = current_time('Y-m-d H:i:s');
						$clean['created_by'] = get_current_user_id();

						if ($this->db->insert($this->db->ls_main_slider, $clean) !== false) {
							$return = [
								'error' => '100',
								'msg' => '등록했습니다.'
							];
						} else {
							$return = [
								'error' => '201',
								'msg' => '등록실패: DB저장 실패. 유지보수 담당자에게 문의해주세요.'
							];
						}
					}
				}
			} else { // 외부링크
				// 이미 존재하는가?
				$sql = "SELECT count(1) FROM " . $this->db->ls_main_slider . " WHERE url = '" . trim($_POST['url']) . "'";
				$cnt = $this->db->get_var($sql);
				if ($cnt > 0) {
					$return = [
						'error' => '201',
						'msg' => '이미 등록된 외부 링크 입니다.'
					];
				} else {
					$clean['post_id'] = '';
					$clean['type'] = 'L';
					$clean['thumb'] = $_POST['thumb'];
					$clean['title'] = htmlspecialchars($_POST['title']);
					$clean['url'] = urldecode($_POST['url']);
					$clean['is_blank'] = 'Y';
					$clean['is_output'] = 'N';
					$clean['created_at'] = current_time('Y-m-d H:i:s');
					$clean['created_by'] = get_current_user_id();

					if ($this->db->insert($this->db->ls_main_slider, $clean) !== false) {
						$return = [
							'error' => '100',
							'msg' => '등록했습니다.'
						];
					} else {
						$return = [
							'error' => '201',
							'msg' => '등록실패: DB저장 실패. 유지보수 담당자에게 문의해주세요.'
						];
					}
				}
			}
		}

		wp_die(json_encode($return));
	}

	public function mainSliderEdit()
	{
		$this->actionTitle = "메인 슬라이더 수정";
		$tid = $_REQUEST['tid'];
		$sql = "SELECT * FROM " . $this->db->ls_main_slider . " WHERE tid = '" . $tid . "'";
		$slide = $this->db->get_row($sql);
		require_once LSMS_VIEW_DIR . "/adminMainSliderEdit.php";
	}

	public function mainSliderEdit_x()
	{
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'mainSliderEditX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			if ($_POST['type'] == 'P') {
				$post_id = url_to_postid(trim($_POST['post_url']));

				if ($post_id <= 0) {
					$return = [
						'error' => '201',
						'msg' => '포스트 주소가 올바르지 않습니다. 정확히 복사하여 붙여넣어주세요.'
					];
				} else {
					// 이미 존재하는가?
					$sql = "SELECT count(1) FROM " . $this->db->ls_main_slider . " WHERE post_id = '$post_id'";
					$cnt = $this->db->get_var($sql);
					if ($cnt > 0) {
						$return = [
							'error' => '201',
							'msg' => '이미 등록된 포스트 입니다.'
						];
					} else {
						$clean['post_id'] = $post_id;
						$clean['thumb'] = '';
						$clean['title'] = '';
						$clean['url'] = '';

						if ($this->db->update($this->db->ls_main_slider, $clean, ['tid' => $_POST['tid']]) !== false) {
							$return = [
								'error' => '100',
								'msg' => '수정했습니다.'
							];
						} else {
							$return = [
								'error' => '201',
								'msg' => '수정실패: DB수정 실패. 유지보수 담당자에게 문의해주세요.'
							];
						}
					}
				}
			} else { // 외부링크
				// 이미 존재하는가?
				$sql = "SELECT count(1) FROM " . $this->db->ls_main_slider . " WHERE url = '" . trim($_POST['url']) . "' AND tid <> '" . $_POST['tid'] . "'";
				$cnt = $this->db->get_var($sql);
				if ($cnt > 0) {
					$return = [
						'error' => '201',
						'msg' => '입력하신 외부 링크가 이미 존재합니다.'
					];
				} else {
					$clean['post_id'] = '';
					$clean['type'] = 'L';
					$clean['thumb'] = $_POST['thumb'];
					$clean['title'] = htmlspecialchars($_POST['title']);
					$clean['url'] = urldecode($_POST['url']);

					if ($this->db->update($this->db->ls_main_slider, $clean, ['tid' => $_POST['tid']]) !== false) {
						$return = [
							'error' => '100',
							'msg' => '수정했습니다.'
						];
					} else {
						$return = [
							'error' => '201',
							'msg' => '수정실패: DB수정 실패. 유지보수 담당자에게 문의해주세요.'
						];
					}
				}
			}
		}

		wp_die(json_encode($return));
	}

	public function mainSliderSort_x()
	{
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
		echo json_encode($return);
		wp_die();
	}

	public function mainSliderOutput_x()
	{
		// nonce 체크
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'mainSliderOutputX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			$field = $_POST['field'];
			$tid = $_POST['tid'];

			$sql = "SELECT title FROM " . $this->db->ls_main_slider . " WHERE tid = '" . $_POST['tid'] . "'";
			$title = $this->db->get_var($sql);

			$sql = "UPDATE " . $this->db->ls_main_slider . " SET $field = IF($field = 'Y', 'N', 'Y') WHERE tid ='$tid'";

			if ($this->db->query($sql) !== false) {
				$sql = "SELECT is_output FROM " . $this->db->ls_main_slider . " WHERE tid = '$tid'";
				$is_output = $this->db->get_var($sql);
				if ($is_output == 'Y') {
					$return = [
						'output' => 'Y',
						'error' => '100',
						'msg' => '정상적으로 노출했습니다.'
					];
				} else {
					$return = [
						'output' => 'N',
						'error' => '100',
						'msg' => '노출을 중지했습니다.'
					];
				}
			} else {
				$return = [
					'error' => '201',
					'msg' => '노출실패: DB업데이트 실패. 유지보수 담당자에게 문의해주세요.'
				];
			}
		}

		echo json_encode($return);
		wp_die();
	}

	public function mainSliderDel_x()
	{
		// nonce 체크
		$nonce = $_POST['nonce'];
		if (!wp_verify_nonce($nonce, 'mainSliderDelX')) {
			$return = [
				'error' => '201',
				'msg' => '정상적으로 접근해주세요.'
			];
		} else {
			$clean['tid'] = $_POST['tid'];
			$sql = "SELECT title, is_output FROM " . $this->db->ls_main_slider . " WHERE tid = '" . $clean['tid'] . "'";
			$r = $this->db->get_row($sql);

			if ($this->db->delete($this->db->ls_main_slider, $clean) !== false) {
				$return = [
					'error' => '100',
					'msg' => '정상적으로 삭제했습니다.'
				];
			} else {
				$return = [
					'error' => '201',
					'msg' => '삭제실패: DB삭제실패. 유지보수 담당자에게 문의해주세요.'
				];
			}
		}

		echo json_encode($return);
		wp_die();
	}
}
