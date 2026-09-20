/**
 * Fix ACF WYSIWYG in Gutenberg (buttons crash + broken Visual/Text).
 *
 * Root cause: ACF always calls initializeQuicktags. When the textarea is
 * missing (or qtInit.acf_content is incomplete), `new QTags()` still returns
 * an object WITHOUT `.settings`, then buildQuicktags crashes on `.buttons`.
 */
(function ($) {
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

    var qt = window.tinyMCEPreInit.qtInit.acf_content;
    if (!qt || typeof qt !== 'object' || !qt.buttons) {
      window.tinyMCEPreInit.qtInit.acf_content = $.extend(
        { id: 'acf_content', buttons: QT_BUTTONS },
        typeof qt === 'object' && qt ? qt : {}
      );
      if (!window.tinyMCEPreInit.qtInit.acf_content.buttons) {
        window.tinyMCEPreInit.qtInit.acf_content.buttons = QT_BUTTONS;
      }
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

  function isUsableQt(instance) {
    return !!(instance && instance.settings && instance.toolbar && instance.canvas);
  }

  function patch() {
    if (!window.acf || !acf.tinymce || acf.tinymce._tragencyPatched) {
      return !!window.acf && !!acf.tinymce && !!acf.tinymce._tragencyPatched;
    }

    ensurePreInit();

    acf.tinymce.defaults = function () {
      ensurePreInit();
      return {
        tinymce: window.tinyMCEPreInit.mceInit.acf_content,
        quicktags: window.tinyMCEPreInit.qtInit.acf_content,
      };
    };

    acf.tinymce.buildQuicktags = function (editor) {
      var buttons, canvas, name, settings, theButtons, html, id, i, use;

      if (!isUsableQt(editor)) {
        return;
      }

      canvas = editor.canvas;
      name = editor.name;
      settings = editor.settings;
      html = '';
      theButtons = {};
      use = '';
      id = editor.id;

      if (settings.buttons) {
        use = ',' + settings.buttons + ',';
      }

      for (i in window.edButtons) {
        if (!window.edButtons[i]) {
          continue;
        }
        buttons = window.edButtons[i].id;
        if (
          use &&
          ',strong,em,link,block,del,ins,img,ul,ol,li,code,more,close,'.indexOf(
            ',' + buttons + ','
          ) !== -1 &&
          use.indexOf(',' + buttons + ',') === -1
        ) {
          continue;
        }
        if (
          window.edButtons[i].instance &&
          window.edButtons[i].instance !== id
        ) {
          continue;
        }
        theButtons[buttons] = window.edButtons[i];
        if (window.edButtons[i].html) {
          html += window.edButtons[i].html(name + '_');
        }
      }

      if (use && use.indexOf(',dfw,') !== -1) {
        theButtons.dfw = new QTags.DFWButton();
        html += theButtons.dfw.html(name + '_');
      }

      if (document.getElementsByTagName('html')[0].dir === 'rtl') {
        theButtons.textdirection = new QTags.TextDirectionButton();
        html += theButtons.textdirection.html(name + '_');
      }

      editor.toolbar.innerHTML = html;
      editor.theButtons = theButtons;

      if (typeof jQuery !== 'undefined' && jQuery.fn && typeof jQuery.fn.triggerHandler === 'function') {
        jQuery(document).triggerHandler('quicktags-init', [editor]);
      }
    };

    acf.tinymce.initializeQuicktags = function (id, args) {
      var defaults, settings, instance, attempts;

      ensurePreInit();

      if (typeof window.quicktags === 'undefined') {
        return false;
      }

      defaults = this.defaults();
      if (!defaults || !defaults.quicktags) {
        return false;
      }

      settings = $.extend({}, defaults.quicktags);
      if (args && typeof args.quicktags === 'object') {
        settings = $.extend(settings, args.quicktags);
      }
      settings.id = id;
      if (!settings.buttons) {
        settings.buttons = QT_BUTTONS;
      }

      attempts = 0;
      var self = this;
      var tryInit = function () {
        if (!document.getElementById(id)) {
          if (attempts++ < 40) {
            setTimeout(tryInit, 50);
          }
          return false;
        }

        try {
          instance = window.quicktags(settings);
        } catch (err) {
          console.warn('Tragency: quicktags() failed', err);
          return false;
        }

        // `new QTags()` can return a hollow object when canvas is missing.
        if (!isUsableQt(instance)) {
          if (attempts++ < 40) {
            setTimeout(tryInit, 50);
          }
          return false;
        }

        window.tinyMCEPreInit.qtInit[id] = settings;
        self.buildQuicktags(instance);
        acf.doAction(
          'wysiwyg_quicktags_init',
          instance,
          instance.id,
          settings,
          (args && args.field) || false
        );
        return instance;
      };

      return tryInit();
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

  $(ensurePreInit);
  $(function () {
    ensurePreInit();
    patch();
  });
})(window.jQuery || window.$);
