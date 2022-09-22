<?php
get_header();
?>

<section id="content">
	<div class="container">
		<div class="post-list-wrap">
			<div class="post-list-header">
				<h1>&#8216;<?php single_cat_title(''); ?>&#8217;에 대한 태그 검색결과</h1>
				<span>총 <?php echo $wp_query->found_posts; ?>건의 글이 있습니다</span>
			</div>
			<?php
			if (have_posts()) :
			?>
				<ul class="post-list">
					<?php
					while (have_posts()) : the_post();
						get_template_part('theme-parts/post', 'list');
					endwhile;
					?>
				</ul>
			<?php else : ?>
				<div class="no-posts" style="padding: 40px 0;">
					아직 등록된 글이 없습니다.
				</div>
			<?php endif; ?>
			<?php get_template_part('theme-parts/pagination', ''); ?>
		</div>
	</div>
</section>

<?php get_footer(); ?>