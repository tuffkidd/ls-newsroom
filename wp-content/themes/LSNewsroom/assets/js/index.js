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
	})
})(jQuery)
