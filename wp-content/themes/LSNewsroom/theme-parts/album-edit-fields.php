<tr class="form-field">
	<th scope="row" valign="top"><label for="album_img"><?php _e('앨범 표지 설정'); ?></label></th>
	<td>
		<input type="text" name="album_img" id="album_img" class="media-url" size="3" style="width:70%;" value="<?php echo isset($album_img) ? $album_img : ''; ?>">
		<input type="button" class="use-media-lib button" value="미디어라이브러리" data-title="앨범 표지 이미지선택" />
		<p class="description"><?php _e('앨범 표지를 설정하세요.'); ?></p>
	</td>
</tr>