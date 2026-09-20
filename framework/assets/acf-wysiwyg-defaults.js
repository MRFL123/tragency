/**
 * Fix ACF WYSIWYG in Gutenberg sidebar (TinyMCE cannot run inside the iframe).
 * - Seeds tinyMCEPreInit.acf_content (mce + qt)
 * - Skips Quicktags in block editor (avoids "reading 'buttons'" crash)
 * - Keeps Visual TinyMCE toolbar working
 */
(function ($) {
  if (!$ || !$.extend) {
    return;
  }

  var QT_BUTTONS =
    'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close';

  var MCE_FALLBACK = {
    selector: '#acf_content',
    resize: 'vertical',
    menubar: false,
    wpautop: true,
    indent: false,
    toolbar1:
      'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv',
    toolbar2:
      'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help',
  };

  function ensurePreInit() {
    window.tinyMCEPreInit = window.tinyMCEPreInit || {
      mceInit: {},
      qtInit: {},
      ref: {},
      load_ext: function () {},
    };
    window.tinyMCEPreInit.mceInit = window.tinyMCEPreInit.mceInit || {};
    window.tinyMCEPreInit.qtInit = window.tinyMCEPreInit.qtInit || {};

    if (
      !window.tinyMCEPreInit.qtInit.acf_content ||
      !window.tinyMCEPreInit.qtInit.acf_content.buttons
    ) {
      window.tinyMCEPreInit.qtInit.acf_content = {
        id: 'acf_content',
        buttons: QT_BUTTONS,
      };
    }

    if (!window.tinyMCEPreInit.mceInit.acf_content) {
      var donor = null;
      $.each(window.tinyMCEPreInit.mceInit, function (key, value) {
        if (!donor && key !== 'acf_content' && value) {
          donor = value;
        }
      });
      window.tinyMCEPreInit.mceInit.acf_content = donor
        ? $.extend({}, donor, {
            selector: '#acf_content',
            body_class: 'acf_content',
          })
        : $.extend({}, MCE_FALLBACK);
    }
  }

  function inBlockEditor() {
    return !!(window.acf && typeof acf.isGutenbergPostEditor === 'function'
      ? acf.isGutenbergPostEditor()
      : document.body && document.body.classList.contains('block-editor-page'));
  }

  function patch() {
    if (!window.acf || !acf.tinymce || acf.tinymce._tragencyPatched) {
      return !!(window.acf && acf.tinymce && acf.tinymce._tragencyPatched);
    }

    ensurePreInit();

    acf.tinymce.defaults = function () {
      ensurePreInit();
      return {
        tinymce: window.tinyMCEPreInit.mceInit.acf_content,
        quicktags: window.tinyMCEPreInit.qtInit.acf_content,
      };
    };

    var originalInit = acf.tinymce.initialize.bind(acf.tinymce);
    acf.tinymce.initialize = function (id, args) {
      ensurePreInit();
      args = args || {};
      // Gutenberg + ACF: Quicktags frequently crashes (missing settings.buttons).
      // Visual TinyMCE is enough and stable in the sidebar.
      if (inBlockEditor()) {
        args.quicktags = false;
        args.tinymce = true;
      }
      try {
        return originalInit(id, args);
      } catch (err) {
        console.warn('Tragency: TinyMCE init skipped', err);
        return false;
      }
    };

    acf.tinymce.initializeQuicktags = function () {
      // No-op in practice when initialize forces quicktags:false;
      // still guard if something calls this directly.
      return false;
    };

    acf.tinymce.buildQuicktags = function (editor) {
      if (!editor || !editor.settings || !editor.toolbar) {
        return;
      }
    };

    acf.tinymce._tragencyPatched = true;
    return true;
  }

  ensurePreInit();

  var tries = 0;
  var timer = setInterval(function () {
    if (patch() || ++tries > 200) {
      clearInterval(timer);
    }
  }, 25);

  if (window.acf && typeof acf.addAction === 'function') {
    acf.addAction('ready', function () {
      ensurePreInit();
      patch();
    });
    acf.addAction('append', function () {
      ensurePreInit();
      patch();
    });
  }

  $(function () {
    ensurePreInit();
    patch();
  });
})(window.jQuery);
