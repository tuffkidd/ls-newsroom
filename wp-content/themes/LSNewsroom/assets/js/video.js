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
		// $videoEl.controls = false
		$videoEl.onplaying = () => {
			console.log('asldkjf')
		}
		$videoEl.onpause = () => {
			console.log('playing')
		}
	})
})(jQuery)
