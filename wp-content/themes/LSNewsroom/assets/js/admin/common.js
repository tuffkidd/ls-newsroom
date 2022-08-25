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

  // 카테고리 우선순위 저장
  $(document).on('change', '[name="_cj_album_priority"]', function (e) {
    var el = this
    var term_id = $(this).data('term')
    var priority = $(this).val()
    var data = {
      term_id: term_id,
      priority: priority,
      action: 'set_album_priority',
      nonce: cjnewsroom_backend.nonce
    }

    $.post(
      cjnewsroom_backend.ajaxurl,
      data,
      function (response) {
        var $note = $(
          "<span class='priority-success'>" + response.msg + '</span>'
        )
        $(el).after($note)
        $note.delay(2000).fadeOut(function () {
          $(this).remove()
        })
      },
      'json'
    )
  })

  // 헤리티지 카테고리 우선순위 저장
  $(document).on('change', '[name="_cj_heritage_album_priority"]', function (
    e
  ) {
    var el = this
    var term_id = $(this).data('term')
    var priority = $(this).val()
    var data = {
      term_id: term_id,
      priority: priority,
      action: 'set_heritage_album_priority',
      nonce: cjnewsroom_backend.nonce
    }

    $.post(
      cjnewsroom_backend.ajaxurl,
      data,
      function (response) {
        var $note = $(
          "<span class='priority-success'>" + response.msg + '</span>'
        )
        $(el).after($note)
        $note.delay(2000).fadeOut(function () {
          $(this).remove()
        })
      },
      'json'
    )
  })
})
