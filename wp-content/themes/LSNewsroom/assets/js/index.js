import Swiper from 'swiper/bundle'
import 'swiper/css/bundle'
;(function ($) {
	jQuery(function ($) {
		const swiper = new Swiper('#main-slider', {
			speed: 500,
			loop: true,
			autoplay: {
				delay: 3000,
				disableOnInteraction: false
			},
			pagination: {
				el: '.swiper-pagination',
				clickable: true
			},
			navigation: {
				nextEl: '.button-next',
				prevEl: '.button-prev'
			},
			on: {
				init: sp => {
					$('.swiper-numbers .current').text(sp.realIndex + 1)
					$('.swiper-numbers .total').text(sp.slides.length - 2)
				},
				slideChange: sp => {
					$('.swiper-numbers .current').text(sp.realIndex + 1)
				}
			}
		})

		// 태그 탭
		$(document).on('click', '.latest-tabs a', function (e) {
			e.preventDefault()
			const tab_id = $(this).data('tab-id')
			$('.latest-tabs a').removeClass('on')
			$(this).addClass('on')

			$('.latest-item-wrap').removeClass('on')
			$('#' + tab_id).addClass('on')
			return false
		})
	})
})(jQuery)
