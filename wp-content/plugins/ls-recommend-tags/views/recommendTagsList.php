<div class="wrap">
	<h1 class=""><?php echo $this->actionTitle ?></h1>

	<div class="descriptions">
		<ul>
			<li>검색 창 하단과 Hi테크놀러지 카테고리에 추천 태그를 설정하실 수 있습니다.</li>
			<li>Hi테크놀러지 카테고리에 설정하면 분류 내 해당 태그를 가진 글 목록이 표시됩니다.</li>
			<li><span class="dashicons dashicons-move"></span>을 이용하여 순서를 조정할 수 있습니다.</li>

		</ul>
	</div>

	<div class="clearfix" style="margin: 10px 0;">
		<div class="alignleft actions">
			<form id="recommendTagsAddFrm" method="post" action="<?php echo LSRT_ADMIN_URL; ?>">
				<div class="tablenav top">
					<div class="actions">
						<select name="location" id="location">
							<option value="S">헤더 검색창</option>
							<option value="H">Hi테크놀러지 카테고리</option>
						</select>
						<input type="text" name="tag_name" id="tag_name" value="" placeholder="태그명을 입력하세요.">
						<button type="submit" class="button button-primary">확인 및 등록</button>
					</div>
				</div>
			</form>
		</div>
		<div class="alignright">

		</div>
	</div>

	<table class="wp-list-table widefat striped">
		<thead>
			<tr>
				<th><?php echo __("우선순위", 'recommend_tags') ?></th>
				<th><?php echo __("위치", 'recommend_tags') ?></th>
				<th><?php echo __("태그명", 'recommend_tags') ?></th>
				<th><?php echo __("포스트 수", 'recommend_tags') ?></th>
				<th><?php echo __("등록일", 'recommend_tags') ?></th>
				<th><?php echo __("등록자", 'recommend_tags') ?></th>
				<th><?php echo __("관리", 'recommend_tags') ?></th>
			</tr>
		</thead>
		<tbody class="tableDnD" id="wp_ls_recommend_tags">
			<?php if ($rtags) : ?>
				<?php foreach ($rtags as $rtag) :
					$tag = get_term($rtag->term_id);
				?>
					<tr id="seq_<?php echo $rtag->tid; ?>">
						<td class="dragHandle center"><span class="dashicons dashicons-move"></span></td>
						<td><?php echo $rtag->location == 'S' ? '헤더 검색창' : 'Hi테크놀러지' ?></td>
						<td><?php echo $tag->name ?></td>
						<td><?php echo number_format($tag->count) ?></td>
						<td><?php echo $rtag->created_at ?></td>
						<td><?php echo get_user_by('ID', $rtag->created_by)->display_name ?></td>
						<td><a href="#" class="button button-primary" id="recommendTagsDel_<?php echo $rtag->tid; ?>">삭제</a></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr>
					<td colspan="7">데이터가 존재하지 않습니다.</td>
				</tr>
			<?php endif; ?>
		</tbody>
	</table>
</div>