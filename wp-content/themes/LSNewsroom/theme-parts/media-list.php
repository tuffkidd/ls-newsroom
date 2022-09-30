<?php
$pattern = '/(?:<video[^>]+src=\")(?<src>[^"]+)/';
$content = get_the_content();

preg_match($pattern, $content, $matches);
if ($matches) {
	$src = $matches['src'];
	$video_id = attachment_url_to_postid($src);

	$pattern = "'<figure class=\"wp-block-video\">(.*?)</figure>'si";
	$content = get_the_content();

	preg_match($pattern, $content, $matches);
	$video_content = $matches[0];
}

if (isset($video_id) && $video_id > 0) {
	$attached_id = $video_id;
} else {
	$attached_id = get_post_thumbnail_id($post->ID);
}
// $url = get_term_link( get_queried_object() ) . $post->post_name; // the_permalink 대신
$url = get_the_permalink();

?>
<div class="media-item">
	<?php /* 선택 다운로드 if( !is_page('photostream') ) {?>
		<?php if( !isset($video_id) || $video_id <= 0 ) { ?>
	<label for="media_<?php the_id()?>">미디어 선택</label>
	<input type="checkbox" name="downloadChecked[]" class="media-checkbox" id="media_<?php the_id()?>" value="<?php echo $attached_id; ?>">
		<?php } ?>
	<?php } */ ?>

	<a href="<?php echo $url ?>" class="media-item-wrap">
		<?php the_post_thumbnail('post-list', ['alt' => get_the_title()]); ?>
		<span class="media-title"><?php echo get_the_title(); ?></span>
		<div class="media-bg"></div>
		<div class="media-gradient-overlay"></div>
	</a>

</div>