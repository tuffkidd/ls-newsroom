<div class="wrap">
	<h1 class=""><?php echo $this->actionTitle ?></h1>

	<div class="descriptions">
		<ul>
			<li>메인페이지 최신글 우측 태그를 설정할 수 있습니다.</li>
			<li>등록개수 제한은 없으나, 모바일 화면을 고려하여 설정해주세요.</li>
			<li><span class="dashicons dashicons-move"></span>을 드래그하여 순서를 조정할 수 있습니다.</li>
		</ul>
	</div>

	<div class="clearfix" style="margin: 10px 0;">
		<div class="alignleft actions">
			<form id="mainTagsAddFrm" method="post" action="<?php echo LSMT_ADMIN_URL; ?>">
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
				<th><?php echo __("우선순위", 'main_tags') ?></th>
				<th><?php echo __("태그명", 'main_tags') ?></th>
				<th><?php echo __("포스트 수", 'main_tags') ?></th>
				<th><?php echo __("등록일", 'main_tags') ?></th>
				<th><?php echo __("등록자", 'main_tags') ?></th>
				<th><?php echo __("관리", 'main_tags') ?></th>
			</tr>
		</thead>
		<tbody class="tableDnD" id="wp_ls_main_tags">
			<?php if ($mtags) : ?>
				<?php foreach ($mtags as $mtag) :
					$tag = get_term($mtag->term_id);
				?>
					<tr id="seq_<?php echo $mtag->tid; ?>">
						<td class="dragHandle center"><span class="dashicons dashicons-move"></span></td>
						<td><?php echo $tag->name ?></td>
						<td><?php echo number_format($tag->count) ?></td>
						<td><?php echo $mtag->created_at ?></td>
						<td><?php echo get_user_by('ID', $mtag->created_by)->display_name ?></td>
						<td><a href="#" class="button button-primary" id="mainTagsDel_<?php echo $mtag->tid; ?>">삭제</a></td>
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