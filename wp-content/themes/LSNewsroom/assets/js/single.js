;(function ($) {
	jQuery(function ($) {
		$(document).on('click', '.print-page', function () {
			window.print()
		})

		function copy_text () {
			var succeed = undefined
			var copyText = $('#content-url').val()
			var textArea = document.createElement('textarea')
			textArea.value = copyText
			document.body.appendChild(textArea)

			if (navigator.userAgent.match(/ipad|ipod|iphone/i)) {
				var editable = textArea.contentEditable
				var readOnly = textArea.readOnly
				textArea.contentEditable = true
				textArea.readOnly = false
				var range = document.createRange()
				range.selectNodeContents(textArea)
				var sel = window.getSelection()
				sel.removeAllRanges()
				sel.addRange(range)
				textArea.focus()
				textArea.setSelectionRange(0, 999999)
				textArea.contentEditable = editable
				textArea.readOnly = readOnly
			} else {
				textArea.select()
			}
			try {
				succeed = document.execCommand('Copy')
			} catch (err) {
				succeed = false
			}
			// document.execCommand('copy');
			document.body.removeChild(textArea)
			if (succeed) {
				alert(
					'URL이 클립보드에 복사되었습니다.\n원하시는 곳에서 붙여넣기 해주세요.'
				)
			} else {
				// alert("URL이 클립보드에 복사되었습니다.\n원하시는 곳에서 붙여넣기 해주세요.");
			}
			return false
		}

		$(document).on('click', '.copy-url', function () {
			copy_text()
			return false
		})

		// 카카오톡 공유

		Kakao.init('89d9be92ba7c1269084967c644fd8882')
		$(document).on('click', '.entry-share .kakaotalk', function (e) {
			e.preventDefault()
			var mobileWebUrl = $(this).data('url')
			var webUrl = $(this).data('url')
			var title = $(this).data('title')
			var thumb = $(this).data('thumb')

			Kakao.Link.sendDefault({
				objectType: 'feed',
				content: {
					title: title,
					// description: '#케익 #딸기 #삼평동 #카페 #분위기 #소개팅',
					imageUrl: thumb,
					link: {
						mobileWebUrl: mobileWebUrl,
						webUrl: webUrl
					}
				},
				// social: {
				// 	likeCount: 286,
				// 	commentCount: 45,
				// 	sharedCount: 845
				// },
				buttons: [
					{
						title: '웹으로 보기',
						link: {
							mobileWebUrl: mobileWebUrl,
							webUrl: webUrl
						}
					}
				]
			})
			return false
		})

		// 비디오 자막 보기
		$(document).on('click', 'a.toggle-video-subtitle', function () {
			// console.log($(this).siblings('p.video-subtitle').is(':visible'));
			const is_visible = $(this).siblings('p.video-subtitle').is(':visible')
			if (is_visible == false) {
				$(this).addClass('arrow-up').removeClass('arrow-down')
				$(this).text('자막 닫기')
			} else {
				$(this).addClass('arrow-down').removeClass('arrow-up')
				$(this).text('자막 보기')
			}

			$(this).siblings('p.video-subtitle').toggle()
			return false
		})
	})

	/**************
	 * 모바일 쉐어
	 */
	// 모바일 쉐어
	$(document).on('click', '.mob-share-toggle', function () {
		if ($('.mob-util').hasClass('on')) {
			$('.mob-share-dim').remove()
			$('.mob-util').removeClass('on')
		} else {
			$('body').append('<div class="mob-share-dim"></div>')
			$('.mob-util').addClass('on')
		}
		return false
	})
})(jQuery)
