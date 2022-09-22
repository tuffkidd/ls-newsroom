<div class="wrap">
	<h1><?php echo $this->actionTitle; ?></h1>

	<div class="descriptions">
		<ul>
			<li>포스트 등록 : 포스트 URL만 입력하세요.
				<ul>
					<li>예1) http://news.lscns.test/ls-세대공감-80년대생의-속마음-talk-직장내-끼인-세대들의/</li>
					<li>예2) http://news.lscns.test/ls-%ec%84%b8%eb%8c%80%ea%b3%b5%ea%b0%90-80%eb%85%84%eb%8c%80%ec%83%9d%ec%9d%98-%ec%86%8d%eb%a7%88%ec%9d%8c-talk-%ec%a7%81%ec%9e%a5%eb%82%b4-%eb%81%bc%ec%9d%b8-%ec%84%b8%eb%8c%80%eb%93%a4%ec%9d%98/</li>
				</ul>
			</li>
			<li>외부 링크 등록 : 이미지 사이즈를 815px X 445px (큰 이미지는 사이즈에 맞게 크롭됩니다.), 타이틀, 링크URL, 새창여부 필수 선택</li>
			<li>등록 시 비활성화 상태로 등록되어 비로그인 사용자에게는 보이지 않으며, 관리자 로그인 상태에서는 확인 가능합니다.</li>
		</ul>
	</div>
	<form novalidate="novalidate" action="" method="post" id="mainSliderAddFrm">
		<table class="form-table">
			<tbody>
				<tr>
					<th>타입선택</th>
					<td>
						<label><input type="radio" name="type" value="P" checked> 포스트</label>, <label><input type="radio" name="type" value="L"> 외부링크</label>
					</td>
				</tr>
				<tr>
					<th>포스트 URL</th>
					<td>
						<input type="text" name="post_url" id="post_url" value="" size="100">
					</td>
				</tr>
				<tr>
					<th>이미지</th>
					<td>
						<input type="text" name="thumb" id="thumb" class="media-url" value="" size="100">
						<input type="button" class="use-media-lib button" value="미디어 라이브러리" data-title="메인 슬라이더 이미지 선택" data-target-id="thumb" />
					</td>
				</tr>
				<tr>
					<th>타이틀</th>
					<td>
						<input type="text" name="title" id="title" value="" size="100">
					</td>
				</tr>
				<tr>
					<th>링크 URL</th>
					<td>
						<input type="text" name="url" id="url" value="" size="100">
					</td>
				</tr>
			</tbody>
			</tbody>
		</table>
		<p class="submit">
			<input type="submit" value="등록완료" class="button button-primary" id="submit" name="submit">
			<a href="<?php echo admin_url("admin.php?page=mainSlider&action=mainSliderList"); ?>" class="button">목록으로</a>
		</p>
	</form>
</div>