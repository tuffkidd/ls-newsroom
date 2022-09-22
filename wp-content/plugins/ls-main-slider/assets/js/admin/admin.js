jQuery(function ($) {
	// 붙여넣기 시 URL decoding
	$(document).on('paste', '#post_url', function (e) {
		e.preventDefault()
		var urlstring = ''
		var pastedData = decodeURI(e.originalEvent.clipboardData.getData('text'))
		$(this)
			.val('')
			.val(pastedData)
	})

	$(document).on('paste', '#url', function (e) {
		e.preventDefault()
		var urlstring = ''
		var pastedData = decodeURI(e.originalEvent.clipboardData.getData('text'))
		$(this)
			.val('')
			.val(pastedData)
	})

	// Database Yes No toggle
	$(document).on('click', '.toggleYN', function () {
		var obj = $(this)
		var data = {
			action: 'mainSliderOutput_x',
			field: $(this).data('toggle-field'),
			tid: $(this).data('toggle-tid'),
			nonce: main_slider_admin_js.main_slider_output_nonce
		}

		if ($(this).data('toggle-text')) {
			var yText = $(this)
				.data('toggle-text')
				.split('|')[0]
			var nText = $(this)
				.data('toggle-text')
				.split('|')[1]
		} else {
			var yText = 'YES'
			var nText = 'NO'
		}

		$.post(
			main_slider_admin_js.ajaxurl,
			data,
			function (response) {
				if (response.error != '100') {
					alert(response.msg)
				} else {
					if (response.output == 'Y') {
						$(obj)
							.removeClass('button-default')
							.addClass('button-primary')
							.text(nText)
					} else {
						$(obj)
							.removeClass('button-primary')
							.addClass('button-default')
							.text(yText)
					}
				}
			},
			'json'
		)
		/*
		$.post("/admin/main/toggleYN_x", data, function(response){
			if( response == 'Y' ) {
				$(obj).removeClass('uk-button-danger').addClass('uk-button-primary').text(yText);
			} else {
				$(obj).removeClass('uk-button-primary').addClass('uk-button-danger').text(nText);
			}
		});*/
		return false
	})

	$('#wp_ls_main_slider').tableDnD({
		onDrop: function (table, row) {
			var val = $.tableDnD.serialize()

			var data = {
				action: 'mainSliderSort_x',
				values: $.tableDnD.serialize() + '&table=' + $(table).attr('id'),
				nonce: main_slider_admin_js.main_slider_sort_nonce
			}

			$.post(
				main_slider_admin_js.ajaxurl,
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

	// 타입별 노출
	function switchType (val) {
		if (val == 'P') {
			$('#thumb')
				.val('')
				.prop('disabled', true)
			$('#title')
				.val('')
				.prop('disabled', true)
			$('#url')
				.val('')
				.prop('disabled', true)
			$('.use-media-lib').prop('disabled', true)
			$('#post_url').prop('disabled', false)
		} else {
			$('#thumb').prop('disabled', false)
			$('#title').prop('disabled', false)
			$('#url').prop('disabled', false)
			$('.use-media-lib').prop('disabled', false)

			$('#post_url')
				.val('')
				.prop('disabled', true)
		}
	}

	$(document).on('click', "[name='type']", function (e) {
		switchType($(this).val())
	})

	if ($("[name='type']").length > 0) {
		switchType($("[name='type']:checked").val())
	}

	// 슬라이더 등록
	$(document).on('submit', '#mainSliderAddFrm', function () {
		if ($('[name="type"]:checked', this).val() == 'P') {
			if ($('#post_url').val() == '') {
				alert('포스트 주소를 입력해주세요.')
				$('#post_url').focus()
				return false
			} else if (confirm('등록 하시겠습니까?') == true) {
				var formData = new FormData(this)
				formData.append('action', 'mainSliderAdd_x')
				formData.append('nonce', main_slider_admin_js.main_slider_add_nonce)

				$.ajax({
					url: main_slider_admin_js.ajaxurl,
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function (response) {
						alert(response.msg)
						if (response.error == '100') {
							document.location.reload()
						}
					},
					cache: false,
					contentType: false,
					processData: false
				})
			}
		} else {
			if ($('#thumb', this).val() == '') {
				alert('미디어라이브러리 버튼을 사용하여 이미지를 선택해주세요.')
				$('#thumb', this)
					.siblings('input[type="button"]')
					.focus()
				return false
			} else if ($('#title', this).val() == '') {
				alert('타이틀을 입력하세요.')
				$('#title', this).focus()
				return false
			} else if ($('#url', this).val() == '') {
				alert('링크 URL을 입력하세요.')
				$('#url', this).focus()
				return false
			} else if (confirm('등록 하시겠습니까?') == true) {
				var formData = new FormData(this)
				formData.append('action', 'mainSliderAdd_x')
				formData.append('nonce', main_slider_admin_js.main_slider_add_nonce)

				$.ajax({
					url: main_slider_admin_js.ajaxurl,
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function (response) {
						alert(response.msg)
						if (response.error == '100') {
							document.location.reload()
						}
					},
					cache: false,
					contentType: false,
					processData: false
				})
			}
		}
		return false
	})

	// 슬라이더 수정
	$(document).on('submit', '#mainSliderEditFrm', function () {
		if ($('[name="type"]:checked', this).val() == 'P') {
			if ($('#post_url').val() == '') {
				alert('포스트 주소를 입력해주세요.')
				$('#post_url').focus()
				return false
			} else if (confirm('등록 하시겠습니까?') == true) {
				var formData = new FormData(this)
				formData.append('action', 'mainSliderEdit_x')
				formData.append('nonce', main_slider_admin_js.main_slider_edit_nonce)

				$.ajax({
					url: main_slider_admin_js.ajaxurl,
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function (response) {
						alert(response.msg)
						if (response.error == '100') {
							document.location.reload()
						}
					},
					cache: false,
					contentType: false,
					processData: false
				})
			}
		} else {
			if ($('#thumb', this).val() == '') {
				alert('미디어라이브러리 버튼을 사용하여 이미지를 선택해주세요.')
				$('#thumb', this)
					.siblings('input[type="button"]')
					.focus()
				return false
			} else if ($('#title', this).val() == '') {
				alert('타이틀을 입력하세요.')
				$('#title', this).focus()
				return false
			} else if ($('#url', this).val() == '') {
				alert('링크 URL을 입력하세요.')
				$('#url', this).focus()
				return false
			} else if (confirm('수정 하시겠습니까?') == true) {
				var formData = new FormData(this)
				formData.append('action', 'mainSliderEdit_x')
				formData.append('nonce', main_slider_admin_js.main_slider_edit_nonce)

				$.ajax({
					url: main_slider_admin_js.ajaxurl,
					type: 'POST',
					data: formData,
					dataType: 'json',
					success: function (response) {
						alert(response.msg)
						if (response.error == '100') {
							document.location.reload()
						}
					},
					cache: false,
					contentType: false,
					processData: false
				})
			}
		}
		return false
	})

	/*
	// 포스트 등록
	$(document).on('submit', '#mainSliderAddFrm', function(){
		if( $('#url', this).val() == '' ) {
			alert('포스트 URL을 입력해주세요.');
			$('#url', this).focus();
			return false;
		} else if ( confirm('등록 하시겠습니까?') == true ) {
			var data = {
				'action' : 'mainSliderAdd_x',
				'url' : $('#url').val(),
				'nonce' : main_slider_admin_js.main_slider_add_nonce
			};

			$.post(main_slider_admin_js.ajaxurl, data, function(response){
				alert( response.msg );
				if(response.error=="100") {
					document.location.reload();
				}
			},"json");
		}
		return false;
	});

	// 포스트 임의제목 업데이트
	$(document).on('click', 'a[id^="updateTitle_"]', function(){
		var data = {
			action: 'mainSliderTitleUpdate_x',
			tid: $(this).prop('id').split('_')[1],
			title: $(this).siblings('[name="post_title"]').val(),
			nonce: main_slider_admin_js.main_slider_title_update_nonce
		};

		$.post(main_slider_admin_js.ajaxurl, data, function(response){
			alert( response.msg );
		}, 'json');
		return false;
	});
*/
	// 삭제
	$(document).on('click', '[id^="mainSliderDel_"]', function () {
		if (confirm('정말로 삭제 하시겠습니까?') == true) {
			var tid = $(this)
				.prop('id')
				.split('_')[1]
			var data = {
				action: 'mainSliderDel_x',
				tid: tid,
				nonce: main_slider_admin_js.main_slider_del_nonce
			}

			$.post(
				main_slider_admin_js.ajaxurl,
				data,
				function (response) {
					alert(response.msg)
					if (response.error == '100') {
						document.location.reload()
					}
				},
				'json'
			)
		}
		return false
	})
})
