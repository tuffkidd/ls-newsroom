<?php
global $wp_query, $search_posts, $allposts, $photostream_medias, $photostream_query_var;

// print_r2($wp_query);
if (is_search() && 0 === $wp_query->found_posts) {
	$tmp_wp_query = $wp_query;
	$wp_query = $search_posts;
} else if (is_page_template('page-templates/page-latest.php')) {
	$tmp_wp_query = $wp_query;
	$wp_query = $allposts;
} else if (isset($wp_query->query_vars['medialib']) && $wp_query->query_vars['medialib'] == 'photostream') {
	$tmp_wp_query = $wp_query;
	$wp_query = $photostream_medias;
}

// $wp_query = $search_posts;
?>

<div class="pagination">
	<div class="page-links">
		<?php
		// $big = 999999999999999999;
		echo paginate_links([
			// 'base'        		=> '%_%',
			// 'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
			'prev_text'			=> '<span class="pagination-prev">PREV</span>',
			'next_text'			=> '<span class="pagination-next">NEXT</span>',
			'format' 			=> '?paged=%#%',
			// 'total'				=> $wp_query->max_num_pages,
			// 'current' 			=> $paged,
			'end_size'			=> 1,
			'mid_size'			=> 1
		]);
		?>
	</div>
</div>