/**
 * Fix ACF WYSIWYG in Gutenberg: missing tinyMCEPreInit.qtInit.acf_content
 * causes "Cannot read properties of undefined (reading 'buttons')".
 */
(function () {
  var QT_BUTTONS =
    'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close';

  function ensurePreInit() {
    if (typeof window.tinyMCEPreInit === 'undefined') {
      window.tinyMCEPreInit = {
        mceInit: {},
        qtInit: {},
        ref: {},
        load_ext: function () {},
      };
    }

    window.tinyMCEPreInit.mceInit = window.tinyMCEPreInit.mceInit || {};
    window.tinyMCEPreInit.qtInit = window.tinyMCEPreInit.qtInit || {};

    if (!window.tinyMCEPreInit.qtInit.acf_content) {
      window.tinyMCEPreInit.qtInit.acf_content = {
        id: 'acf_content',
        buttons: QT_BUTTONS,
      };
    } else if (!window.tinyMCEPreInit.qtInit.acf_content.buttons) {
      window.tinyMCEPreInit.qtInit.acf_content.buttons = QT_BUTTONS;
    }

    if (!window.tinyMCEPreInit.mceInit.acf_content) {
      var donor = null;
      for (var key in window.tinyMCEPreInit.mceInit) {
        if (
          Object.prototype.hasOwnProperty.call(window.tinyMCEPreInit.mceInit, key) &&
          key !== 'acf_content'
        ) {
          donor = window.tinyMCEPreInit.mceInit[key];
          break;
        }
      }

      window.tinyMCEPreInit.mceInit.acf_content = donor
        ? Object.assign({}, donor, { selector: '#acf_content' })
        : {
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
    }
  }

  function patchAcfTinymce() {
    if (!window.acf || !acf.tinymce) {
      return false;
    }

    // Always return valid defaults.
    acf.tinymce.defaults = function () {
      ensurePreInit();
      return {
        tinymce: window.tinyMCEPreInit.mceInit.acf_content,
        quicktags: window.tinyMCEPreInit.qtInit.acf_content,
      };
    };

    // Guard buildQuicktags against missing settings.
    if (typeof acf.tinymce.buildQuicktags === 'function' && !acf.tinymce._tragencyPatched) {
      var originalBuild = acf.tinymce.buildQuicktags;
      acf.tinymce.buildQuicktags = function (editor) {
        if (!editor || !editor.settings) {
          return;
        }
        if (!editor.settings.buttons) {
          editor.settings.buttons = QT_BUTTONS;
        }
        return originalBuild.call(this, editor);
      };
      acf.tinymce._tragencyPatched = true;
    }

    // Guard initializeQuicktags.
    if (typeof acf.tinymce.initializeQuicktags === 'function' && !acf.tinymce._tragencyQtPatched) {
      var originalQt = acf.tinymce.initializeQuicktags;
      acf.tinymce.initializeQuicktags = function (id, args) {
        ensurePreInit();
        try {
          return originalQt.call(this, id, args);
        } catch (err) {
          console.warn('Tragency: ACF Quicktags init skipped', err);
          return false;
        }
      };
      acf.tinymce._tragencyQtPatched = true;
    }

    return true;
  }

  ensurePreInit();

  var tries = 0;
  var timer = setInterval(function () {
    if (patchAcfTinymce() || ++tries > 100) {
      clearInterval(timer);
    }
  }, 50);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      ensurePreInit();
      patchAcfTinymce();
    });
  } else {
    patchAcfTinymce();
  }
})();
