;(function ($) {
	jQuery(function ($) {
		// 키워드 삭제
		$(document).on(
			'click',
			'.medialibrary-search-box #del-mkeyword',
			function () {
				$(this)
					.closest('form')
					.find('input[name="s"]')
					.val('')
					.focus()
				$(this).hide()
				return false
			}
		)

		// 검색어 입력시 모두지우기 버튼
		$(document).on(
			'keyup',
			'.medialibrary-search-box input[name="s"]',
			function () {
				if ($(this).val() != '') {
					$('.medialibrary-search-box #del-mkeyword').show()
				} else {
					$('.medialibrary-search-box #del-mkeyword').hide()
				}
			}
		)
	})
})(jQuery)
