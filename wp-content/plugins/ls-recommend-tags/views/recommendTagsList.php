<div class="wrap">
	<h1 class=""><?php echo $this->actionTitle ?></h1>

	<div class="descriptions">
		<ul>
			<li>검색 창 하단의 추천 태그를 설정하실 수 있습니다.</li>
			<li>추천 태그가 없는 경우 해당 영역은 노출되지 않습니다.</li>
			<li><span class="dashicons dashicons-move"></span>을 이용하여 순서를 조정할 수 있습니다.</li>
		</ul>
	</div>

	<div class="clearfix" style="margin: 10px 0;">
		<div class="alignleft actions">
			<form id="recommendTagsAddFrm" method="post" action="<?php echo LSRT_ADMIN_URL; ?>">
				<input type="text" name="tag_name" id="tag_name" value="" placeholder="태그명을 입력하세요.">
				<button type="submit" class="button button-primary">확인 및 등록</button>
			</form>
		</div>
		<div class="alignright">

		</div>
	</div>

	<table class="wp-list-table widefat striped">
		<thead>
			<tr>
				<th><?php echo __("우선순위", 'recommend_tags') ?></th>
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