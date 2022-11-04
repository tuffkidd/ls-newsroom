import tableDragger from 'table-dragger'

jQuery(function ($) {
	$(document).on('submit', '#recommendTagsAddFrm', function () {
		if ($('#tag_name').val() == '') {
			alert('등록할 태그명을 입력해주세요.')
			$('#tag_name').focus()
			return false
		} else {
			var data = {
				action: 'recommendTagsAdd_x',
				tag_name: $('#tag_name').val(),
				location: $('#location').val(),
				nonce: recommend_tags_admin_js.recommend_tags_add_nonce
			}

			$.post(
				recommend_tags_admin_js.ajaxurl,
				data,
				function (response) {
					if (response.error == '100') {
						document.location.reload()
					} else {
						alert(response.msg)
					}
				},
				'json'
			)
			return false
		}
	})

	$('#wp_ls_recommend_tags').tableDnD({
		onDrop: function (table, row) {
			var val = $.tableDnD.serialize()

			var data = {
				action: 'recommendTagsSort_x',
				values: $.tableDnD.serialize() + '&table=' + $(table).attr('id'),
				nonce: recommend_tags_admin_js.recommend_tags_sort_nonce
			}

			$.post(
				recommend_tags_admin_js.ajaxurl,
				data,
				function (response) {
					if (response.error != '100') {
						alert(response.msg)
					}
				},
				'json'
			)
		},
		dragHandle: '.dragHandle',
		onDragClass: 'dragging'
	})

	$(document).on('click', 'a[id^="recommendTagsDel_"]', function () {
		if (confirm('정말로 삭제하시겠습니까?') == true) {
			var data = {
				action: 'recommendTagsDel_x',
				tid: $(this)
					.prop('id')
					.split('_')[1],
				nonce: recommend_tags_admin_js.recommend_tags_del_nonce
			}

			$.post(
				recommend_tags_admin_js.ajaxurl,
				data,
				function (response) {
					if (response.error == '100') {
						document.location.reload()
					} else {
						alert(response.msg)
					}
				},
				'json'
			)
		}
		return false
	})
})
