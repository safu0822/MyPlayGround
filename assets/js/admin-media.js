jQuery(function ($) {
  $('.hatatate-image-select').on('click', function () {
    var $field = $(this).closest('.hatatate-image-field');
    var frame = wp.media({
      title: '画像を選択',
      button: { text: 'この画像を使う' },
      library: { type: 'image' },
      multiple: false
    });

    frame.on('select', function () {
      var attachment = frame.state().get('selection').first().toJSON();
      $field.find('input[type="hidden"]').val(attachment.id);
      $field.find('.hatatate-image-preview').attr('src', attachment.url);
    });

    frame.open();
  });

  $('.hatatate-image-clear').on('click', function () {
    var $field = $(this).closest('.hatatate-image-field');
    var $preview = $field.find('.hatatate-image-preview');
    $field.find('input[type="hidden"]').val('');
    $preview.attr('src', $preview.data('default'));
  });
});
