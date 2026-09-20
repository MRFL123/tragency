/**
 * Fix ACF WYSIWYG in Gutenberg: missing tinyMCEPreInit.qtInit.acf_content
 * causes "Cannot read properties of undefined (reading 'buttons')".
 *
 * WordPress often overwrites tinyMCEPreInit in the footer, so we:
 * 1) seed defaults
 * 2) patch acf.tinymce.defaults / buildQuicktags
 * 3) re-seed after scripts load
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

    acf.tinymce.defaults = function () {
      ensurePreInit();
      return {
        tinymce: window.tinyMCEPreInit.mceInit.acf_content,
        quicktags: window.tinyMCEPreInit.qtInit.acf_content,
      };
    };

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

    if (
      typeof acf.tinymce.initializeQuicktags === 'function' &&
      !acf.tinymce._tragencyQtPatched
    ) {
      var originalQt = acf.tinymce.initializeQuicktags;
      acf.tinymce.initializeQuicktags = function (id, args) {
        ensurePreInit();
        args = args || {};
        args.quicktags = Object.assign(
          { id: id, buttons: QT_BUTTONS },
          window.tinyMCEPreInit.qtInit.acf_content || {},
          args.quicktags || {}
        );
        args.quicktags.id = id;
        if (!args.quicktags.buttons) {
          args.quicktags.buttons = QT_BUTTONS;
        }
        try {
          return originalQt.call(this, id, args);
        } catch (err) {
          console.warn('Tragency: ACF Quicktags init skipped', err);
          return false;
        }
      };
      acf.tinymce._tragencyQtPatched = true;
    }

    if (typeof acf.addAction === 'function' && !acf.tinymce._tragencyActions) {
      acf.addAction('prepare', ensurePreInit);
      acf.addAction('ready', ensurePreInit);
      acf.addAction('append', ensurePreInit);
      acf.addAction('show_field/type=wysiwyg', ensurePreInit);
      acf.tinymce._tragencyActions = true;
    }

    return true;
  }

  ensurePreInit();

  var tries = 0;
  var timer = setInterval(function () {
    ensurePreInit();
    if (patchAcfTinymce() || ++tries > 200) {
      clearInterval(timer);
    }
  }, 50);

  document.addEventListener('DOMContentLoaded', function () {
    ensurePreInit();
    patchAcfTinymce();
  });

  window.addEventListener('load', function () {
    ensurePreInit();
    patchAcfTinymce();
  });
})();
