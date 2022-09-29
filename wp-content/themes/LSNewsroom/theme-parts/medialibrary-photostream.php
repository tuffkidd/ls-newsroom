<?php
get_header();

$taxo = 'album';
$post_type = 'multimedia';
$lib = 'medialibrary';
$lb = 'medialib';
?>
<section id="content">
	<div class="container">
		<div class="medialibrary-wrap">
			<div class="medialibrary-header">
				<h1>미디어 라이브러리</h1>
				<span>LS전선의 다양한 이미지와 영상을 검색해보세요.</span>
			</div>
			<div class="medialibrary-control">
				<div class="switch-album">
					<a href="<?php echo site_url($lib . '/albums'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'albums') { ?>selected<?php } ?>">앨범</a>
					<a href="<?php echo site_url($lib . '/photostream'); ?>" class="cj-button button-default <?php if (get_query_var($lb) == 'photostream') { ?>selected<?php } ?>">포토스트림</a>
				</div>
				<div class="medialibrary-search">
					<div class="medialibrary-search-box">
						<form action="<?php echo site_url($lib . '/photostream'); ?>" method="GET">
							<label for="mkeyword" class="hidden-text">검색어를 입력하세요.</label>
							<input type="text" name="mkeyword" id="mkeyword" value="<?php echo $keyword ?? ''; ?>" placeholder="검색어를 입력하세요.">
							<a href="#" id="del-mkeyword" class="hidden-text" title="검색어 삭제">검색어 삭제</a>
							<button type="submit" id="album-search-submit" class="hidden-text">검색</button>
						</form>
					</div>
				</div>
			</div>
			<ul>

			</ul>
		</div>
	</div>
</section>
<?php
get_footer();
