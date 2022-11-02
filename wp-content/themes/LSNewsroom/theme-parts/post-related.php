<?php
global $Frontend, $wp_query;

// 연관글
$relevents = $Frontend->get_relevent_posts(get_the_ID(), 3);
?>

<?php if ($relevents->posts) : ?>
	<div class="related-posts">
		<h3>연관 콘텐츠</h3>
		<div class="related-posts-wrap">
			<?php foreach ($relevents->posts as $relevent) :  ?>
				<div class="related-post-item">
					<a href="<?php echo get_permalink($relevent->ID) ?>">
						<div class="post-thumb">
							<?php
							$att_id = get_post_thumbnail_id($relevent->ID);
							$att_img = wp_get_attachment_image_src($att_id, 'post-list');
							$att_alt = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);
							?>
							<img src="<?php echo $att_img[0] ?>" width="<?php echo $att_img[1] ?>" height="<?php echo $att_img[2] ?>" alt="<?php echo $att_alt ?>">
						</div>

						<div class="post-title">
							<?php echo $relevent->post_title; ?>
						</div>
					</a>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>