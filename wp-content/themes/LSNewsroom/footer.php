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

	<a href="#" class="go-to-top">맨 위로</a>
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