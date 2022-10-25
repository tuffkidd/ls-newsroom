<?php
global $wp_query;

if (get_query_var('medialib') == 'photostream') {
} else {
	$ancs = get_ancestors(get_queried_object()->term_id, 'album', 'taxonomy');

	if ($ancs) {
		$top_term_id = $ancs[count($ancs) - 1];
	} else {
		$top_term_id = get_queried_object_id();
	}
	$current_top_term = get_term($top_term_id);
}

$top_terms = get_terms([
	'parent' => 0,
	'taxonomy' => 'album',
	'hide_empty' => true
]);

$keyword = esc_attr(get_query_var('s'));
?>
<div class="medialibrary-header">
	<h1>미디어 라이브러리</h1>
	<span>LS전선의 다양한 사진과 영상을 검색해보세요.</span>
</div>
<div class="medialibrary-control">
	<div class="switch-album">
		<?php if ($top_terms) :
			foreach ($top_terms as $top_term) :
				if (get_query_var('medialib') == 'photostream') {
					$term_class = '';
					$stream_class = ' class="selected"';
				} else {
					$stream_class = '';
					if ($current_top_term->slug == $top_term->slug) {
						$term_class = ' class="selected"';
					} else {
						$term_class = '';
					}
				}
		?>
				<a href="<?php echo get_term_link($top_term); ?>" <?php echo $term_class; ?>><?php echo $top_term->name; ?></a>
		<?php endforeach;
		endif; ?>
		<a href="<?php echo site_url('/medialibrary/photostream') ?>" <?php echo $stream_class; ?>>전체보기</a>
	</div>

	<div class="medialibrary-search">
		<div class="medialibrary-search-box">
			<form action="<?php echo site_url('/medialibrary/photostream'); ?>" method="GET">
				<label for="s" class="hidden-text">검색어를 입력하세요.</label>
				<input type="text" name="s" id="s" value="<?php echo $keyword; ?>" placeholder="검색어를 입력하세요.">
				<a href="#" id="del-mkeyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
				<button type="submit" id="album-search-submit" class="hidden-text">검색</button>
			</form>
		</div>
	</div>

</div>