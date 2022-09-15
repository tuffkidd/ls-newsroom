<footer>
	<div class="pc container">
		<div class="footer-top">
			<a href="https://www.lscns.co.kr/" class="logo hidden-text">LS전선 바로가기</a>
			<div class="footer-menu">
				<a href="<?php echo site_url("/뉴스룸소개") ?>">뉴스룸소개</a>
				<a href="<?php echo site_url("/운영정책") ?>">운영정책</a>
				<a href="<?php echo site_url("/개인정보처리방침") ?>">개인정보처리방침</a>
				<a href="mailto:help@lscns.co.kr">이메일문의</a>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="info">
				<div class="address">
					경기도 안양시 동안구 LS로 127 LS타워 12~17층 Tel. <a href="tel:0221899114">02-2189-9114</a>
				</div>
				<div class="copy">
					&copy; LS Cable & System Ltd. All rights reserved.
				</div>
			</div>
			<div class="social-links">
				<a href="#" class="home hidden-text">홈으로</a>
				<a href="#" class="youtube hidden-text">유튜브 바로가기</a>
			</div>
		</div>
	</div>

	<div class="mob container">
		<div class="footer-top">
			<a href="https://www.lscns.co.kr/" class="logo hidden-text">LS전선 바로가기</a>
			<div class="social-links">
				<a href="#" class="home hidden-text">홈으로</a>
				<a href="#" class="youtube hidden-text">유튜브 바로가기</a>
			</div>
		</div>
		<div class="footer-bottom">
			<div class="footer-menu">
				<a href="<?php echo site_url("/뉴스룸소개") ?>">뉴스룸소개</a>
				<a href="<?php echo site_url("/운영정책") ?>">운영정책</a>
				<a href="<?php echo site_url("/개인정보처리방침") ?>">개인정보처리방침</a>
				<a href="mailto:help@lscns.co.kr">이메일문의</a>
			</div>

			<div class="info">
				<div class="address">
					경기도 안양시 동안구 LS로 127 LS타워 12~17층 Tel. <a href="tel:0221899114">02-2189-9114</a>
				</div>
				<div class="copy">
					&copy; LS Cable & System Ltd. All rights reserved.
				</div>
			</div>
		</div>
	</div>
	<?php wp_footer(); ?>

	<?php if (is_single()) { ?>
		<div class="utils">
			<div class="mob-util">
				<div class="entry-share">
					<a href="#" class="mob-copy copy-url hidden-text">URL 복사</a>
					<a href="#" class="mob-share-kakaotalk post-share kakaotalk hidden-text" data-url="<?php echo urldecode(the_permalink()); ?>" data-title="<?php echo the_title(); ?>" data-thumb="<?php echo get_the_post_thumbnail_url(get_the_ID(), 'main-tile-1') ?>">카카오톡으로 공유</a>
					<a href="http://www.facebook.com/sharer.php?u=<?php echo the_permalink(); ?>" class="mob-share-facebook post-share facebook hidden-text" title="Share on Facebook" target="_blank">페이스북으로 공유</a>
					<a href="mailto:?subject=<?php the_title(); ?>&amp;body=<?php echo the_permalink(); ?>" class="mob-share-email post-share email hidden-text" title="Send to email">이메일로 공유</a>
				</div>
				<a href="#" class="mob-share-toggle hidden-text">포스트 공유</a>
			</div>
			<a href="#" class="go-to-top">맨 위로</a>
		</div>
	<?php } ?>
</footer>

<!-- <div class="dim-screen"></div> -->

<div id="dim-play">
	<div class="dim-center">
		<a href="#" class="dim-close"></a>
		<div id="player-wrap">
			<div class="youtube-container"></div>
		</div>
	</div>
</div>



<?php $host = $_SERVER['HTTP_HOST'];
if (strpos($host, ".local") !== false || strpos($host, ".test") !== false) { ?>
	<script id="__bs_script__">
		//<![CDATA[
		document.write("<script async src='http://HOST:3003/browser-sync/browser-sync-client.js?v=2.27.9'><\/script>".replace("HOST", location.hostname));
		//]]>
	</script>
<?php } ?>

</body>

</html>