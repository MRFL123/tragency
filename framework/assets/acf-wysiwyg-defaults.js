/**
 * Fix ACF WYSIWYG in the Gutenberg block editor.
 *
 * ACF always passes quicktags:true even when tabs=visual. If
 * tinyMCEPreInit.qtInit.acf_content is missing (or the textarea isn't
 * in the DOM yet), buildQuicktags crashes on reading `buttons` and
 * the Visual toolbar never becomes usable.
 */
(function () {
  var QT_DEFAULT = {
    id: 'acf_content',
    buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close',
  };

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

    if (
      !window.tinyMCEPreInit.qtInit.acf_content ||
      !window.tinyMCEPreInit.qtInit.acf_content.buttons
    ) {
      window.tinyMCEPreInit.qtInit.acf_content = Object.assign(
        {},
        QT_DEFAULT,
        window.tinyMCEPreInit.qtInit.acf_content || {}
      );
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
        ? Object.assign({}, donor, {
            selector: '#acf_content',
            body_class: 'acf_content',
          })
        : Object.assign({}, MCE_FALLBACK);
    }
  }

  function patchAcf() {
    if (!window.acf || !acf.tinymce) {
      return false;
    }

    ensurePreInit();

    acf.tinymce.defaults = function () {
      ensurePreInit();
      return {
        tinymce: window.tinyMCEPreInit.mceInit.acf_content,
        quicktags: window.tinyMCEPreInit.qtInit.acf_content,
      };
    };

    if (!acf.tinymce._tragencyInitPatched) {
      var originalInit = acf.tinymce.initialize.bind(acf.tinymce);
      acf.tinymce.initialize = function (id, args) {
        ensurePreInit();
        args = args || {};
        // Gutenberg + ACF: Quicktags frequently crashes (missing settings.buttons).
        // Visual TinyMCE is enough for block sidebar fields.
        if (acf.isGutenbergPostEditor && acf.isGutenbergPostEditor()) {
          args.quicktags = false;
        }
        return originalInit(id, args);
      };
      acf.tinymce._tragencyInitPatched = true;
    }

    if (!acf.tinymce._tragencyQtPatched) {
      var originalQt = acf.tinymce.initializeQuicktags.bind(acf.tinymce);
      acf.tinymce.initializeQuicktags = function (id, args) {
        ensurePreInit();
        if (!document.getElementById(id)) {
          return false;
        }
        try {
          return originalQt(id, args);
        } catch (err) {
          console.warn('Tragency: Quicktags skipped', err);
          return false;
        }
      };
      acf.tinymce._tragencyQtPatched = true;
    }

    if (!acf.tinymce._tragencyBuildPatched) {
      var originalBuild = acf.tinymce.buildQuicktags.bind(acf.tinymce);
      acf.tinymce.buildQuicktags = function (editor) {
        if (!editor || !editor.settings || !editor.toolbar) {
          return;
        }
        return originalBuild(editor);
      };
      acf.tinymce._tragencyBuildPatched = true;
    }

    return true;
  }

  ensurePreInit();

  var tries = 0;
  var timer = setInterval(function () {
    ensurePreInit();
    if (patchAcf() || ++tries > 200) {
      clearInterval(timer);
    }
  }, 25);

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', function () {
      ensurePreInit();
      patchAcf();
    });
  } else {
    patchAcf();
  }
})();
