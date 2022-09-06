<footer>
	<?php $host = $_SERVER['HTTP_HOST'];
	if (strpos($host, ".local") !== false || strpos($host, ".test") !== false) { ?>
		<script id="__bs_script__">
			//<![CDATA[
			document.write("<script async src='http://HOST:3003/browser-sync/browser-sync-client.js?v=2.27.9'><\/script>".replace("HOST", location.hostname));
			//]]>
		</script>
	<?php } ?>

	<?php wp_footer(); ?>
	<!-- <div class="dim-screen"></div> -->
	<div id="dim-play">
		<div class="dim-center">
			<a href="#" class="dim-close"></a>
			<div id="player-wrap">
				<div class="youtube-container"></div>
			</div>
		</div>
	</div>
	<a href="#" class="go-to-top">맨 위로</a>
</footer>
</body>

</html>