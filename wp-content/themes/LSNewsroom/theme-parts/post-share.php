<div class="entry-share pc-share">
	<a href="#" class="post-share copy-url" title="URL 복사">URL 복사</a>
	<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo the_permalink(); ?>" class="post-share email" title="새창에서 이메일 공유">메일</a>
	<a href="#" class="post-share kakaotalk" data-url="<?php echo urldecode(the_permalink()); ?>" data-title="<?php echo the_title(); ?>" data-thumb="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'slider') ?>" title="새창으로 카카오톡 공유">카카오톡</a>
	<a href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>" target="_blank" class="post-share facebook" title="새창으로 페이스북 공유">페이스북</a>
	<a href="#" class="print-page" title="인쇄하기">인쇄</a>
</div>