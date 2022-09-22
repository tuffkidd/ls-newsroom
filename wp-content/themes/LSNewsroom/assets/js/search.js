jQuery(function ($) {
	// console.log('serarch.js');
	// 키워드 삭제
	$(document).on('click', '#search-result #del-keyword', function () {
		$(this)
			.siblings('label')
			.find('input[name="s"]')
			.val('')
			.focus()
		return false
	})

	// 달력
	var lastmonth = new Date()
	lastmonth.setMonth(lastmonth.getMonth() - 1)

	var search_date_from = flatpickr(
		'#search-result .search-date-picker-wrap .calendar-wrap .date-from #date_from',
		{
			altFormat: 'Y-m-d',
			dateFormat: 'Y-m-d',
			inline: true,
			defaultDate: lastmonth,
			onChange: function (selectedDates, dateStr, instance) {
				search_date_to.set('minDate', dateStr)
			}
		}
	)

	var search_date_to = flatpickr(
		'#search-result .search-date-picker-wrap .calendar-wrap .date-to #date_to',
		{
			// altInput: true,
			altFormat: 'Y-m-d',
			dateFormat: 'Y-m-d',
			maxDate: 'today',
			defaultDate: 'today',
			inline: true
		}
	)

	// 모바일용 달력

	var search_date_range = flatpickr(
		'#search-result .search-date-picker-wrap .calendar-wrap .date-range #date_range',
		{
			mode: 'range',
			altFormat: 'Y-m-d',
			dateFormat: 'Y-m-d',
			maxDate: 'today',
			inline: true,
			disableMobile: false,
			onChange: function (selectedDates, dateStr, instance) {
				dateStr.replace(' to ', '~')
				// console.log(dateStr.replace(' to ', '~'));
				$(
					'#search-result .search-date-picker-wrap .calendar-wrap .date-range #date_range'
				).val(dateStr.replace(' to ', '~'))
				return false
			}
		}
	)

	// 검색 옵션 라벨 클릭 시
	$(document).on('click', '#search-result .search-option-label', function () {
		if ($(this).hasClass('active')) {
			$(this).removeClass('active')
		} else {
			$(this).addClass('active')
		}

		$(this)
			.siblings('.option-list')
			.toggle()

		$('#search-result .search-date-picker-wrap').hide()
	})

	// 옵션 클릭 시
	$(document).on(
		'click',
		'#search-result .option-value:not(.date-picker)',
		function () {
			var text = $(this).text()
			var option_value = $(this).data('value')
			var option_key = $(this)
				.closest('.search-option')
				.find('.search-option-label')
				.data('option')

			$(this)
				.closest('.search-option')
				.find('.search-option-label')
				.text(text)
			$('#search-result [name=' + option_key + ']').val(option_value)
			$(this)
				.closest('.option-list')
				.toggle()

			$(this)
				.closest('.search-option')
				.find('.search-option-label')
				.removeClass('active')
			$('#search-result').trigger('submit')
		}
	)

	// 기간 설정 클릭시
	$(document).on(
		'click',
		'#search-result .option-value.date-picker',
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

	// 날짜 설정 완료
	$(document).on('click', '#search-result #select-date', function () {
		var date_from = $('#date_from').val()
		var date_to = $('#date_to').val()
		var date_range = $('#date_range').val()

		if (date_range == '') {
			$("#search-result [name='d']").val(date_from + '~' + date_to)
			$(".search-option .search-option-label[data-option='d']").text(
				date_from + '~' + date_to
			)
			$('.search-date-picker-wrap').hide()
		} else {
			$("#search-result [name='d']").val(date_range)
			$(".search-option .search-option-label[data-option='d']").text(date_range)
			$('.search-date-picker-wrap').hide()
		}

		if ($(window).innerWidth() <= 768) {
			$('.dim-screen').hide()
		}

		$(this)
			.closest('.search-option')
			.find('.search-option-label')
			.removeClass('active')
		$('#search-result').trigger('submit')
	})

	$(document).on('click', '#search-result #select-date-cancel', function () {
		$('.search-date-picker-wrap').hide()
		if ($(window).innerWidth() <= 768) {
			$('.dim-screen').hide()
		}
		$(this)
			.closest('.search-option')
			.find('.search-option-label')
			.removeClass('active')
	})

	$(document).on('mouseleave', '#search-result .search-option', function () {
		$('.option-list').hide()
		$(this)
			.closest('.search-option')
			.find('.search-option-label')
			.removeClass('active')
	})

	$(document).on('click', '#search-result #do-search', function () {
		if ($("#search-result [name='s']").val() == '') {
			alert('검색어를 입력하세요.')
		} else {
		}
	})

	$(document).on('keydown', '#search-result #s', function (e) {
		if ($(this).val() != '') {
			$('#search-result #del-keyword').show()
		} else {
			$('#search-result #del-keyword').hide()
		}
	})

	if ($('#search-result #s').val() != '') {
		$('#search-result #del-keyword').show()
	} else {
		$('#search-result #del-keyword').hide()
	}
})
