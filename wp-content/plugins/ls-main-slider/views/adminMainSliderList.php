<div class="wrap">
	<h1 class=""><?php echo $this->actionTitle ?></h1>

	<div class="descriptions">
		<ul>
			<li><a class="button button-default" style="vertical-align: baseline;">노출하기</a> 상태로 등록됩니다. (미 노출 상태)</li>
			<li><a class="button button-default" style="vertical-align: baseline;">노출하기</a> 버튼을 클릭하여 <a class="button button-primary" style="vertical-align: baseline;">노출중지</a>로 변경되면 공개됩니다. (노출하기/노출중지 토글)</li>
		</ul>
	</div>

	<div class="clearfix" style="margin: 10px 0;">
		<div class="alignright">
			<a href="<?php echo LSMS_ADMIN_URL . '&action=mainSliderAdd'; ?>" class="button button-primary">슬라이더 추가</a>
		</div>
	</div>

	<table class="wp-list-table widefat striped">
		<thead>
			<tr>
				<th><?php echo __("우선순위", 'main_slider') ?></th>
				<th><?php echo __("타입", 'main_slider') ?></th>
				<th><?php echo __("썸네일", 'main_slider') ?></th>
				<th><?php echo __("타이틀", 'main_slider') ?></th>
				<th><?php echo __("URL", 'main_slider') ?></th>
				<th><?php echo __("노출여부", 'main_slider') ?></th>
				<th><?php echo __("등록자", 'main_slider') ?></th>
				<th><?php echo __("등록일", 'main_slider') ?></th>
				<th><?php echo __("관리", 'main_slider') ?></th>
			</tr>
		</thead>
		<tbody id="<?php echo $this->db->ls_main_slider; ?>" class="tableDnD">
			<?php if ($mainSliderList) :	foreach ($mainSliderList as $key => $val) : $user = get_user_by('ID', $val->created_by);
					if ($val->type == 'P') {
						$post = get_post($val->post_id, ['title']);
					}
			?>
					<tr id="seq_<?php echo $val->tid; ?>">
						<td class="dragHandle center"><span class="dashicons dashicons-move"></span></td>
						<td><?php echo $val->type == 'P' ? '포스트' : '외부링크'; ?></td>
						<td>
							<?php if ($val->type == 'P') : ?>
								<img width="200" src="<?php echo get_the_post_thumbnail_url($post->ID, 'slider') ?>" alt="<?php echo $post->post_title; ?>">
							<?php else : ?>
								<img width="200" src="<?php echo $val->thumb; ?>">
							<?php endif; ?>
						</td>
						<td>
							<?php if ($val->type == 'P') : ?>
								<?php echo $post->post_title; ?>
							<?php else : ?>
								<?php echo $val->title; ?>
							<?php endif; ?>
						</td>
						<td>
							<?php if ($val->type == 'P') : ?>
								<a href="<?php echo get_the_permalink($post->ID); ?>" target="_blank">열기</a>
							<?php else : ?>
								<a href="<?php echo $val->url; ?>" target="_blank">열기</a>
							<?php endif; ?>
						</td>
						<td>
							<?php if ($val->is_output == 'N') { ?>
								<a class="button button-default toggleYN" data-toggle-table="<?php echo $this->db->ls_main_slider ?>" data-toggle-field="is_output" data-toggle-tid="<?php echo $val->tid; ?>" data-toggle-text="노출하기|노출중지">노출하기</a>
							<?php } else { ?>
								<a class="button button-primary toggleYN" data-toggle-table="<?php echo $this->db->ls_main_slider ?>" data-toggle-field="is_output" data-toggle-tid="<?php echo $val->tid; ?>" data-toggle-text="노출하기|노출중지">노출중지</a>
							<?php } ?>
						</td>
						<td><?php echo $user->display_name; ?></td>
						<td><?php echo $val->created_at; ?></td>
						<td>
							<a href="<?php echo admin_url("admin.php?page=mainSlider&action=mainSliderEdit&tid=" . $val->tid); ?>" class="button button-default">수정</a>
							<a href="#" class="button button-primary" id="mainSliderDel_<?php echo $val->tid; ?>">삭제</a>
						</td>
					</tr>
				<?php endforeach;
			else : ?>
				<tr>
					<td colspan="7">데이터가 존재하지 않습니다.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>

	<?php
	echo paginate_links(array(
		'base' => add_query_arg('cpage', '%#%'),
		'format' => '',
		'prev_text' => __('&laquo;'),
		'next_text' => __('&raquo;'),
		'total' => ceil($total / $items_per_page),
		'current' => $cpage,
		'type' => 'list'
	));
	?>

</div>