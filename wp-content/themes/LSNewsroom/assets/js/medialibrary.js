;(function ($) {
	jQuery(function ($) {
		// 키워드 삭제
		$(document).on(
			'click',
			'.medialibrary-search-box #del-mkeyword',
			function () {
				$(this).closest('form').find('input[name="s"]').val('').focus()
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

	// 미디어라이브러리 선택 다운로드 전체 선택
	$(document).on('click', '#checkAllMedia', function (e) {
		if ($(this).is(':checked')) {
			$('.media-checkbox').prop('checked', true)
		} else {
			$('.media-checkbox').prop('checked', false)
		}
	})

	// 선택 다운로드
	$(document).on('click', '.downloadSelected', function (e) {
		e.preventDefault()
		var $form = $('<form></form>')
		$form.attr('method', 'POST')
		$form.attr('action', '/medialibrary/download/')
		$form.append($('<input/>', { type: 'hidden', name: 'type', value: 'all' }))

		var cnt = $('.media-checkbox:checked').length
		if (cnt > 0) {
			$.each($('.media-checkbox'), function (i, e) {
				if ($(e).prop('checked')) {
					$form.append(
						'<input type="hidden" name="medias[]" value="' + $(e).val() + '">'
					)
				}
			})
		} else {
			alert(
				'다운로드 받을 미디어의 좌측 상단 체크박스를 최소 1개 이상 체크하세요.'
			)
			return false
		}

		$form.appendTo('body')

		$form.submit()

		// return false
	})

	// 전체 다운로드
	$(document).on('click', '.downloadAll', function (e) {
		e.preventDefault()
		var $form = $('<form></form>')
		$form.attr('method', 'POST')
		$form.attr('action', '/medialibrary/download/')
		$form.append($('<input/>', { type: 'hidden', name: 'type', value: 'all' }))

		var cnt = $('.media-checkbox').length
		if (cnt > 0) {
			$.each($('.media-checkbox'), function (i, e) {
				// if ($(e).prop('checked')) {
				$form.append(
					'<input type="hidden" name="medias[]" value="' + $(e).val() + '">'
				)
				// }
			})
		} else {
			alert(
				'다운로드 받을 미디어의 좌측 상단 체크박스를 최소 1개 이상 체크하세요.'
			)
			return false
		}

		$form.appendTo('body')

		$form.submit()
	})
})(jQuery)
