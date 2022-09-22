jQuery(function ($) {
	// 미디어 라이브러리
	$(document).on('click', '.use-media-lib', function () {
		var title = $(this).data('title')
		var obj = this

		var media_uploader = wp.media({
			// frame:    "post",
			// state:    "insert",
			title: title,
			multiple: false,
			library: {
				type: ['video/mp4', 'video/webm', 'image']
			}
		})
		media_uploader.on('select', function () {
			var attachment = media_uploader
				.state()
				.get('selection')
				.first()
				.toJSON()
			$(obj)
				.siblings('.media-url')
				.val(attachment.url)
		})

		media_uploader.open()
	})
})
