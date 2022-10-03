const video = {
	play: $videoEl => {
		$videoEl.play()
	},
	pause: $videoEl => {}
}

;($ => {
	jQuery($ => {
		// $videoEl = $('.video-thumb .wp-block-video video')
		const $videoEl = document.querySelector('.wp-block-video > video')
		const $wrapperEl = $('.wp-block-video')

		// $videoEl.controls = false
		if ($videoEl) {
			$videoEl.onplaying = () => {
				$wrapperEl.addClass('playing')
			}
			$videoEl.onpause = () => {
				$wrapperEl.removeClass('playing')
			}
		}
	})
})(jQuery)
