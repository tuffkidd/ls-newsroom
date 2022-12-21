jQuery(function ($) {
	// 키워드 삭제
	$(document).on('click', '.category-search #del-ckey', function () {
		$(this).siblings('input[name="ckey"]').val('').focus()
		$(this).hide()
		return false
	})

	$(document).on('keydown', '.category-search #ckey', function (e) {
		if ($(this).val() != '') {
			$('.category-search #del-ckey').show()
		} else {
			$('.category-search #del-ckey').hide()
		}
	})

	if ($('.category-search #ckey').val() != '') {
		$('.category-search #del-ckey').show()
	} else {
		$('.category-search #del-ckey').hide()
	}
})
