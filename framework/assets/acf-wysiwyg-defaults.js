/**
 * Ensure ACF WYSIWYG has the dummy TinyMCE/Quicktags config Gutenberg often misses.
 * Fixes: Cannot read properties of undefined (reading 'buttons') in buildQuicktags.
 */
(function () {
  function ensureAcfEditorDefaults() {
    if (typeof window.tinyMCEPreInit === 'undefined') {
      window.tinyMCEPreInit = {
        mceInit: {},
        qtInit: {},
        ref: {},
        load_ext: function (url, lang) {
          /* no-op fallback */
        },
      };
    }

    window.tinyMCEPreInit.mceInit = window.tinyMCEPreInit.mceInit || {};
    window.tinyMCEPreInit.qtInit = window.tinyMCEPreInit.qtInit || {};

    if (!window.tinyMCEPreInit.qtInit.acf_content) {
      window.tinyMCEPreInit.qtInit.acf_content = {
        id: 'acf_content',
        buttons:
          'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close',
      };
    }

    if (!window.tinyMCEPreInit.mceInit.acf_content) {
      var src = null;
      for (var key in window.tinyMCEPreInit.mceInit) {
        if (
          Object.prototype.hasOwnProperty.call(window.tinyMCEPreInit.mceInit, key) &&
          key !== 'acf_content'
        ) {
          src = window.tinyMCEPreInit.mceInit[key];
          break;
        }
      }

      if (src) {
        window.tinyMCEPreInit.mceInit.acf_content = Object.assign({}, src, {
          selector: '#acf_content',
        });
      } else {
        window.tinyMCEPreInit.mceInit.acf_content = {
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
  }

  ensureAcfEditorDefaults();

  if (window.acf && typeof window.acf.addAction === 'function') {
    window.acf.addAction('prepare', ensureAcfEditorDefaults);
    window.acf.addAction('ready', ensureAcfEditorDefaults);
    window.acf.addAction('append', ensureAcfEditorDefaults);
  }

  document.addEventListener('DOMContentLoaded', ensureAcfEditorDefaults);
})();
