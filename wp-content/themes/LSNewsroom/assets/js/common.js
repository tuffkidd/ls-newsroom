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
						$('.header-wrap').addClass('active')
						$('ul.sub-menu').show()
						// console.log('in');
					})

					$(document).on(
						'mouseenter',
						'.open-search .btn-search-open',
						function () {
							window.opensearch_cursor = true
						}
					)
					$(document).on(
						'mouseleave',
						'.open-search .btn-search-open',
						function () {
							window.opensearch_cursor = false
						}
					)

					$(document).on(
						'focusin',
						'.open-search .btn-search-open, #header-logo a',
						function (e) {
							e.preventDefault()
							if (!window.opensearch_cursor) {
								$('.header-wrap').removeClass('active')
								$('ul.sub-menu').hide()
								// console.log('out');
							}
						}
					)
				}
			},

			resetGnb: function () {
				$('#header-gnb').removeClass('active')
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
							$('.header-wrap').removeClass('active')
							$('#header-search').hide()
						}

						if ($('#header-gnb').is(':visible')) {
							$('#header-search').hide()

							$('#header-gnb')
								.stop(true, true)
								.slideUp(400, function () {
									$('.header-wrap').removeClass('active')
									$('#header-gnb > ul > li > a.gnb-fold').removeClass('on')
									$('#header-gnb > ul > li > ul.sub-menu').hide()
								})
							$(this).removeClass('open')
						} else {
							$('.header-wrap').addClass('active')
							$(this).addClass('open')
							$('#header-gnb')
								.stop(true, true)
								.slideDown()
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
							$('.header-wrap').addClass('active')
							$('#header-gnb > ul > li > a').removeClass('on')
							$('.sub-menu').show()
							$(this).addClass('on')

							$('#header-gnb').addClass('active')
							return false
						}
					)

					$(document).on(
						'click.gnb',
						'#header-gnb > ul > li > a.on',
						function () {
							$('.header-wrap').removeClass('active')
							$(this).removeClass('on')
							$('.sub-menu').hide()
							$('#header-gnb').removeClass('active')
							return false
						}
					)
				} else if ($(window).innerWidth() > 1024) {
					$('#header-gnb').removeAttr('style')
					$(document).off('click.mob-gnb')
					$(document).off('click.mob-gnb-fold')

					// $("#header-gnb").show();
					$('#menu-gnb').hover(
						function () {
							$('.header-wrap').addClass('active')
							$('.sub-menu').show()
							$('#header-gnb').addClass('active')
						},
						function () {
							$('.header-wrap').removeClass('active')
							$('.sub-menu').hide()
							$('#header-search').hide()
							$('#header-gnb').removeClass('active')
						}
					)
				}
			},

			search: function () {
				$(document).off('click.tabletsearch')
				$(document).off('click.mobsearch')
				$(document).off('click.pcsearch')

				if ($(window).innerWidth() <= 768) {
					$(document).on('click.mobsearch', '.btn-search-open', function () {
						if ($('#header-gnb').is(':visible')) {
							$('#header-gnb').hide()
							$('#header-gnb > ul > li > a').removeClass('on')
							$('#header-gnb > ul > li > ul.sub-menu').hide()
							$('#btn-mob-menu').removeClass('open')
						}

						if ($('#header-search').is(':visible')) {
							console.log('header search visible')
							$('.header-wrap').removeClass('active')
							$('#header-search').hide()
						} else {
							console.log('header search no')
							$('#header-search').show()
							$('#search-input').focus()
							$('.header-wrap').addClass('active')
						}

						return false
					})
				} else if (
					$(window).innerWidth() <= 1024 &&
					$(window).innerWidth() > 768
				) {
					$(document).off('click.mobsearch')
					$(document).on('click.tabletsearch', '.btn-search-open', function () {
						if ($('#header-search').is(':visible')) {
							$('.header-wrap').removeClass('active')
							$('#header-gnb').show()
							$('#header-gnb > ul > li > a').removeClass('on')
							$('#header-search').hide()
						} else {
							$('.header-wrap').addClass('active')
							$('#header-gnb').hide()
							$('#header-search').show()
							$('.sub-menu').hide()
							// $("#menu-gnb").hide();
							$('#search-input').focus()
						}

						return false
					})
				} else {
					$(document).on('click.pcsearch', '.btn-search-open', function (e) {
						e.preventDefault()
						$('#header-search').toggle()
						$('.header-wrap').toggleClass('active')
						$('#menu-gnb').toggle()
						$('#search-input').focus()

						// $(".header-wrap").toggleClass('active');
						// if( $(".header-wrap").hasClass('active') ) {
						// 	$("#header-search").show();
						// 	$("#search-input").focus();
						// }else {
						// 	$("#header-search").hide();
						// }

						/*if( $("#header-search").is(':visible') ) {
					$(".header-wrap").removeClass('active');
					$("#header-search").hide();
				} else {
					$("#header-search").show();
					$(".header-wrap").addClass('active');
					$("#search-input").focus();
				}*/
					})
				}

				$(document).on('click', '.btn-search-close', function () {
					$('#header-search-open').css({ display: 'inline-block' })
					$('#header-search').hide()
					$('#header-gnb > ul > li > a').removeClass('on') // 메뉴 on 비활성화
					$('#header-gnb ul.sub-menu').hide() // 서브메뉴 비활성화
					// $("#header-gnb").show();
					$('#header-gnb-close').hide()
					$('#header-gnb-open').css({ display: 'inline-block' })
					return false
				})

				$(document).on('click', '.close-search-box', function () {
					$('.header-wrap').removeClass('active')
					$('#header-search').hide()
				})

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

			gnb: function () {
				$(document).on('click', '.btn-gnb-open', function () {
					$('#header-search-open').css({ display: 'inline-block' })
					// $("#header-gnb").show();
					$('#header-gnb-close').css({ display: 'inline-block' })
					$('#header-gnb-open').hide()
				})

				$(document).on('click', '.btn-gnb-close', function () {
					$('#header-search-open').css({ display: 'inline-block' })
					$('#header-search').hide()
					$('#header-gnb > ul > li > a').removeClass('on') // 메뉴 on 비활성화
					$('#header-gnb ul.sub-menu').hide() // 서브메뉴 비활성화
					// $("#header-gnb").hide();
					$('#header-gnb-close').hide()
					$('#header-gnb-open').css({ display: 'inline-block' })
				})
			},

			init: function () {
				this.tabindex()
				this.search()
				this.resetGnb()
				this.resized()
				this.resetAll()
				this.gnb()
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

		$(document).on('click', '.del-keyword', function () {
			$(this)
				.siblings('input[name="s"]')
				.val('')
				.focus()
			return false
		})

		$(document).on('click', '.go-to-top', function () {
			$('body,html').animate(
				{
					scrollTop: 0
				},
				500
			)
			$('#header-logo a').focus()
			return false
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
	})
})(jQuery)
