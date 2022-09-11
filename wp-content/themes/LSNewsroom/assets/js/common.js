// window.addEventListener("orientationchange", function() {
//   document.location.reload();
// }, false);
;(function ($) {
	jQuery(function ($) {
		var Layout = {
			tabindex: function () {
				if ($(window).innerWidth() > 1024) {
					$(document).on('focusin', '#header-gnb>ul>li>a', function (e) {
						e.preventDefault()
						$('header').addClass('menu-opened')
						$('header').removeClass('search-opened')
					})

					$(document).on(
						'focusin',
						'.open-search .btn-search-toggle, #header-logo a',
						function (e) {
							e.preventDefault()
							if (!window.opensearch_cursor) {
								$('header').removeClass('menu-opened')
								$('header').removeClass('search-opened')
							}
						}
					)

					$(document).on(
						'mouseenter',
						'.open-search .btn-search-toggle',
						function () {
							window.opensearch_cursor = true
						}
					)
					$(document).on(
						'mouseleave',
						'.open-search .btn-search-toggle',
						function () {
							window.opensearch_cursor = false
						}
					)
				}
			},

			resetGnb: function () {
				$('header').removeClass('menu-opened')
				$('header').removeClass('search-opened')
				$('#header-gnb > ul > li > a').removeClass('on')
				$(document).off('click.gnb')
				$(document).off('click.mob-gnb')
				$(document).off('click.mob-gnb-fold')

				if ($(window).innerWidth() <= 768) {
					// 1024 이하일때 한줄씩만 노출하도록

					/**
					 * 모바일
					 */
					// 폴드 열기 닫기
					$(document).on(
						'click.mob-gnb-fold',
						'#header-gnb > ul > li > a.gnb-fold:not(.on)',
						function () {
							$('#header-gnb > ul > li > a.gnb-fold').removeClass('on')
							$('ul.sub-menu').hide()
							$(this)
								.siblings('ul.sub-menu')
								.show()
							$(this).addClass('on')
							return false
						}
					)

					$(document).on(
						'click.mob-gnb-fold',
						'#header-gnb > ul > li > a.gnb-fold.on',
						function () {
							$(this)
								.siblings('ul.sub-menu')
								.hide()
							$(this).removeClass('on')
							return false
						}
					)

					// 모바일 삼선 바 클릭
					// 모두 닫고 다시 연다.
					// console.log("reseted");
					$(document).on('click.mob-gnb', '#btn-mob-menu', function (e) {
						// e.preventDefault();
						if ($('#header-search').is(':visible')) {
							$('#header-wrap').removeClass('active')
							$('#header-search').hide()
						}

						if ($('#header-gnb').is(':visible')) {
							$('#header-search').hide()

							$('#header-gnb')
								.stop(true, true)
								.slideUp(300, 'easeInQuad', function () {
									$('#header-wrap').removeClass('active')
									$('#header-gnb > ul > li > a.gnb-fold').removeClass('on')
									$('#header-gnb > ul > li > ul.sub-menu').hide()
								})
							$(this).removeClass('open')
						} else {
							$('#header-wrap').addClass('active')
							$(this).addClass('open')
							$('#header-gnb')
								.stop(true, true)
								.slideDown(300, 'easeOutQuad')
						}
						return false
					})
				} else if (
					$(window).innerWidth() <= 1024 &&
					$(window).innerWidth() > 768
				) {
					$('#header-gnb').removeAttr('style')
					$(document).on(
						'click.gnb',
						'#header-gnb > ul > li > a:not(.on)',
						function () {
							$('header').addClass('menu-opened')
							$('#header-gnb > ul > li > a').removeClass('on')
							$(this).addClass('on')
							return false
						}
					)

					$(document).on(
						'click.gnb',
						'#header-gnb > ul > li > a.on',
						function () {
							$('header').removeClass('menu-opened')
							$(this).removeClass('on')
							return false
						}
					)
				} else if ($(window).innerWidth() > 1024) {
					// $('#header-gnb').removeAttr('style')
					$(document).off('click.mob-gnb')
					$(document).off('click.mob-gnb-fold')

					// $("#header-gnb").show();
					$('#menu-gnb').hover(
						function () {
							$('header').addClass('menu-opened')
							$('header').removeClass('search-opened')
						},
						function () {
							$('header').removeClass('menu-opened')
						}
					)
				}
			},

			search: function () {
				$(document).off('click.tabletsearch')
				$(document).off('click.mobsearch')
				$(document).off('click.pcsearch')

				if ($(window).innerWidth() <= 768) {
					// 모바일
					$(document).on('click.mobsearch', '.btn-search-toggle', function () {
						if ($('#header-gnb').is(':visible')) {
							$('header').removeClass('search-opened')
							$('#header-gnb > ul > li > a').removeClass('on')
						}

						if ($('#header-search-box').is(':visible')) {
							$('header').removeClass('search-opened')
						} else {
							$('header').addClass('search-opened')
						}

						return false
					})
				} else if (
					$(window).innerWidth() <= 1024 &&
					$(window).innerWidth() > 768
				) {
					// 태블릿
					$(document).off('click.mobsearch')
					$(document).on(
						'click.tabletsearch',
						'.btn-search-toggle',
						function () {
							if ($('#header-search-box').is(':visible')) {
								$('header').removeClass('search-opened')
								$('#header-gnb > ul > li > a').removeClass('on')
							} else {
								$('header').addClass('search-opened')
							}

							return false
						}
					)
				} else {
					// PC
					$(document).on('click.pcsearch', '.btn-search-toggle', function (e) {
						e.preventDefault()
						$('header').removeClass('menu-opened')
						$('header').toggleClass('search-opened')
					})
				}

				$(document).on('submit', '#gnbSearchFrm', function () {
					if ($("#gnbSearchFrm input[name='s']").val() == '') {
						alert('검색어를 입력하세요.')
						$("#gnbSearchFrm input[name='s']").focus()
						return false
					}
				})
			},

			resized: function () {
				$(window).on('resize', function () {
					Layout.resetGnb()
					Layout.search()
				})
			},

			resetAll: function () {
				$(document).on('click', '.dim-screen', function () {
					// $("#header-gnb").hide(); // 메뉴 비활성화
					$('#header-gnb > ul > li > a').removeClass('on') // 메뉴 on 비활성화
					$('#header-gnb ul.sub-menu').hide() // 서브메뉴 비활성화
					$('#header-gnb-close').hide() // 메뉴 닫기 버튼 비활성화
					$('#header-gnb-open').show() // 메뉴 오픈 버튼 활성화
					$('#header-search-open').show() // 검색 오픈 버튼 활성화
					$('#header-search').hide() // 검색 폼 비활성화
					$('.search-date-picker-wrap').hide() // 검색 시 모바일 달력 제거
					$(this).hide() // 자신 비활성화
				})
			},

			init: function () {
				this.tabindex()
				this.search()
				this.resetGnb()
				this.resized()
				this.resetAll()
				// this.gnb()
			}
		}

		function qs (key) {
			key = key.replace(/[*+?^$.\[\]{}()|\\\/]/g, '\\$&') // escape RegEx meta chars
			var match = location.search.match(
				new RegExp('[?&]' + key + '=([^&]+)(&|$)')
			)
			return match && decodeURIComponent(match[1].replace(/\+/g, ' '))
		}

		Layout.init()

		// 맨 위로
		$(document).on('click', '.go-to-top', function () {
			$('html, body').animate({ scrollTop: 0 }, 400)
			$('#header-logo a').focus()
			return false
		})

		$(window).scroll(function () {
			if ($(window).innerWidth() > 768) {
				if ($(window).scrollTop() > 500) {
					$('.go-to-top').fadeIn()
				} else {
					$('.go-to-top').fadeOut()
				}
			} else if ($(window).innerWidth() <= 768) {
				if ($(window).scrollTop() > 300) {
					$('.go-to-top').fadeIn()
					var scrollBottom =
						$(document).height() - $(window).height() - $(window).scrollTop()

					if (scrollBottom <= 120) {
						// $('.go-to-top').css({ bottom: '210px' })
						$('.go-to-top').addClass('regen')
					} else {
						// $('.go-to-top').css({ bottom: '110px' })
						$('.go-to-top').removeClass('regen')
					}
				} else {
					$('.go-to-top').fadeOut()
				}
			} else {
				$('.go-to-top').fadeOut()
			}
		})

		// 카카오톡 공유
		$(document).on('click', '.entry-share .kakaotalk', function (e) {
			e.preventDefault()
			Kakao.init('c5578fc29e2d18395a59d77d9792d9c2')
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

		/*****************************************************************
		 *
		 * 헤더 검색
		 *
		 */

		// 검색 옵션 라벨 클릭 시 하위 리스트 열기
		$(document).on(
			'click',
			'#header-search-box .search-option-label',
			function () {
				if ($(this).hasClass('active')) {
					$(this).removeClass('active')
				} else {
					$(this).addClass('active')
				}

				$(this)
					.siblings('.option-list')
					.toggle()

				$('.search-date-picker-wrap').hide()
			}
		)

		// 옵션 클릭 시
		$(document).on(
			'click',
			'#header-search-box .option-value:not(.date-picker)',
			function () {
				var text = $(this).text()
				var option_value = $(this).data('value')
				var option_key = $(this)
					.closest('.search-option')
					.find('.search-option-label')
					.data('option')

				// 라벨 변경
				$(this)
					.closest('.search-option')
					.find('.search-option-label')
					.text(text)

				// 폼에 값 입력
				$('#gnbSearchFrm [name=' + option_key + ']').val(option_value)

				// 현재 목록 닫자.
				$(this)
					.closest('.option-list')
					.toggle()
			}
		)

		// 키워드 삭제
		$(document).on('click', '#header-search-box #del-keyword', function () {
			$(this)
				.siblings('label')
				.find('input[name="s"]')
				.val('')
				.focus()
			$(this).hide()
			return false
		})

		// 검색어 입력시 모두지우기 버튼
		$(document).on('keyup', '#header-search-box input[name="s"]', function () {
			if ($(this).val() != '') {
				$('#header-search-box #del-keyword').show()
			} else {
				$('#header-search-box #del-keyword').hide()
			}
		})

		// 기간 설정 클릭시
		$(document).on(
			'click',
			'#header-search-box .option-value.date-picker',
			function () {
				$(this)
					.closest('.search-option-wrap')
					.find('.option-list')
					.hide()
				$('.search-date-picker-wrap').show()
				if ($(window).innerWidth() <= 768) {
					$('.dim-screen').show()
				}
			}
		)

		// 달력
		var lastmonth = new Date()
		lastmonth.setMonth(lastmonth.getMonth() - 1)

		var search_date_from = flatpickr(
			'.search-date-picker-wrap .calendar-wrap .date-from #date_from',
			{
				altFormat: 'y.n.j',
				dateFormat: 'y.n.j',
				inline: true,
				defaultDate: lastmonth,
				onChange: function (selectedDates, dateStr, instance) {
					search_date_to.set('minDate', dateStr)
				}
			}
		)

		var search_date_to = flatpickr(
			'.search-date-picker-wrap .calendar-wrap .date-to #date_to',
			{
				// altInput: true,
				altFormat: 'y.n.j',
				dateFormat: 'y.n.j',
				maxDate: 'today',
				defaultDate: 'today',
				inline: true
			}
		)

		// 모바일용 달력

		var search_date_range = flatpickr(
			'.search-date-picker-wrap .calendar-wrap .date-range #date_range',
			{
				mode: 'range',
				altFormat: 'y.n.j',
				dateFormat: 'y.n.j',
				maxDate: 'today',
				inline: true,
				disableMobile: false,
				onChange: function (selectedDates, dateStr, instance) {
					dateStr.replace(' to ', '~')
					// console.log(dateStr.replace(' to ', '~'));
					$(
						'.search-date-picker-wrap .calendar-wrap .date-range #date_range'
					).val(dateStr.replace(' to ', '~'))
					return false
				}
			}
		)

		// 날짜 설정 완료
		$(document).on('click', '#header-search-box #select-date', function () {
			var date_from = $('#date_from').val()
			var date_to = $('#date_to').val()
			var date_range = $('#date_range').val()

			if (date_range == '') {
				$("#gnbSearchFrm [name='d']").val(date_from + '~' + date_to)
				$(".search-option .search-option-label[data-option='d']").text(
					date_from + '~' + date_to
				)
				$('.search-date-picker-wrap').hide()
			} else {
				$("#gnbSearchFrm [name='d']").val(date_range)
				$(".search-option .search-option-label[data-option='d']").text(
					date_range
				)
				$('.search-date-picker-wrap').hide()
			}

			if ($(window).innerWidth() <= 768) {
				$('.dim-screen').hide()
			}

			// $(this)
			// 	.closest('.search-option')
			// 	.find('.search-option-label')
			// 	.removeClass('active')
			// $('#gnbSearchFrm').trigger('submit')
		})

		$(document).on('click', '#select-date-cancel', function () {
			$('.search-date-picker-wrap').hide()
			if ($(window).innerWidth() <= 768) {
				$('.dim-screen').hide()
			}
			$(this)
				.closest('.search-option')
				.find('.search-option-label')
				.removeClass('active')
		})
	})
})(jQuery)
