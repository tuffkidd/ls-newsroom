<?php
global $wp_query, $search_posts, $allposts;
// print_r($search_posts);

if (is_search()) {
	$tmp_wp_query = $wp_query;
	$wp_query = $search_posts;
} else if (is_page_template('page-templates/page-latest.php')) {
	$tmp_wp_query = $wp_query;
	$wp_query = $allposts;
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