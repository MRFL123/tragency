/**
 * Fix ACF WYSIWYG Text/Visual switching when Bootstrap/theme CSS is present.
 */
(function ($) {
  function getEditorId($btn) {
    return (
      $btn.data('wp-editor-id') ||
      $btn.attr('data-wp-editor-id') ||
      ($btn.attr('id') || '').replace(/-tmce$|-html$/, '')
    );
  }

  $(document).on('click', '.acf-field-wysiwyg .wp-switch-editor', function (e) {
    if (typeof window.switchEditors === 'undefined' || !window.switchEditors.go) {
      return;
    }

    var $btn = $(this);
    var editorId = getEditorId($btn);
    if (!editorId) {
      return;
    }

    e.preventDefault();
    e.stopPropagation();

    var mode = $btn.hasClass('switch-tmce') ? 'tmce' : 'html';
    window.switchEditors.go(editorId, mode);
  });

  if (window.acf) {
    window.acf.addAction('ready_field/type=wysiwyg', function (field) {
      field.$el.find('.wp-editor-tabs, .wp-switch-editor').css({
        'pointer-events': 'auto',
        'z-index': 100,
        position: 'relative',
      });
    });
  }
})(jQuery);
