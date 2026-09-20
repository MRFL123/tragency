/**
 * Regression test: ACF buildQuicktags "reading 'buttons'" crash.
 * Run: node framework/assets/acf-wysiwyg-defaults.test.cjs
 */
const fs = require('fs');
const path = require('path');
const vm = require('vm');

function assert(cond, msg) {
  if (!cond) throw new Error(msg);
}

function createDom() {
  const elements = new Map();
  function el(tag, id) {
    const node = {
      tagName: (tag || 'div').toUpperCase(),
      id: id || '',
      className: '',
      innerHTML: '',
      children: [],
      parentNode: null,
      style: {},
      appendChild(child) {
        child.parentNode = this;
        this.children.push(child);
        return child;
      },
      insertBefore(child, ref) {
        child.parentNode = this;
        const i = this.children.indexOf(ref);
        if (i >= 0) this.children.splice(i, 0, child);
        else this.children.push(child);
        return child;
      },
      getElementsByTagName(name) {
        if (name === 'html') return [{ dir: 'ltr' }];
        return [];
      },
    };
    if (id) elements.set(id, node);
    return node;
  }
  return {
    document: {
      body: { classList: { contains: () => true } },
      getElementById(id) {
        return elements.get(id) || null;
      },
      createElement(tag) {
        return el(tag);
      },
      getElementsByTagName(name) {
        if (name === 'html') return [{ dir: 'ltr' }];
        return [];
      },
      readyState: 'complete',
      addEventListener() {},
    },
    el,
  };
}

function createJQuery() {
  function jQuery(fn) {
    if (typeof fn === 'function') fn();
    return { triggerHandler() {} };
  }
  jQuery.extend = function () {
    const target = arguments[0] || {};
    for (let i = 1; i < arguments.length; i++) {
      const src = arguments[i];
      if (!src || typeof src !== 'object') continue;
      Object.keys(src).forEach((k) => {
        target[k] = src[k];
      });
    }
    return target;
  };
  jQuery.each = function (obj, cb) {
    Object.keys(obj || {}).forEach((k) => cb(k, obj[k]));
  };
  jQuery.fn = { triggerHandler() {} };
  return jQuery;
}

function installQTags(window) {
  window.edButtons = [];
  window.QTags = function (settings) {
    if (typeof settings !== 'object') return false;
    const id = settings.id;
    const canvas = window.document.getElementById(id);
    if (!id || !canvas) return false;
    this.name = 'qt_' + id;
    this.id = id;
    this.canvas = canvas;
    this.settings = settings;
    const tb = window.document.createElement('div');
    tb.id = this.name + '_toolbar';
    canvas.parentNode.insertBefore(tb, canvas);
    this.toolbar = tb;
  };
  window.quicktags = function (settings) {
    return new window.QTags(settings);
  };
}

function installStockAcf(window, $) {
  window.acf = {
    isGutenbergPostEditor() {
      return true;
    },
    doAction() {},
    addAction() {},
    tinymce: {
      defaults() {
        return (
          typeof window.tinyMCEPreInit !== 'undefined' && {
            tinymce: window.tinyMCEPreInit.mceInit.acf_content,
            quicktags: window.tinyMCEPreInit.qtInit.acf_content,
          }
        );
      },
      initialize(id, args) {
        args = Object.assign(
          { tinymce: true, quicktags: true, toolbar: 'full', mode: 'visual', field: false },
          args || {}
        );
        if (args.quicktags) this.initializeQuicktags(id, args);
      },
      initializeQuicktags(id, args) {
        const a = this.defaults();
        if (typeof window.quicktags === 'undefined') return false;
        if (!a) return false;
        const n = $.extend({}, a.quicktags, typeof args.quicktags === 'object' ? args.quicktags : {});
        n.id = id;
        const o = window.quicktags(n);
        if (!o) return false;
        this.buildQuicktags(o);
      },
      buildQuicktags(e) {
        const i = e.settings;
        if (i.buttons) {
          /* ok */
        }
      },
    },
  };
}

function run(applyPatch) {
  const { document, el } = createDom();
  const $ = createJQuery();
  const windowObj = {
    document,
    jQuery: $,
    $: $,
    console,
    setTimeout,
    clearInterval,
    setInterval,
    edButtons: [],
  };
  windowObj.window = windowObj;
  windowObj.tinyMCEPreInit = { mceInit: {}, qtInit: {} };
  installQTags(windowObj);
  installStockAcf(windowObj, $);

  // missing textarea — stock ACF crashes
  if (applyPatch) {
    const code = fs.readFileSync(
      path.join(__dirname, 'acf-wysiwyg-defaults.js'),
      'utf8'
    );
    vm.runInNewContext(code, windowObj, { filename: 'acf-wysiwyg-defaults.js' });
  }

  let crashed = false;
  let error = null;
  try {
    windowObj.acf.tinymce.initialize('acf-editor-1', {
      tinymce: true,
      quicktags: true,
      mode: 'visual',
    });
  } catch (e) {
    crashed = true;
    error = e;
  }

  return {
    crashed,
    error,
    patched: !!(windowObj.acf.tinymce && windowObj.acf.tinymce._tragencyPatched),
    windowObj,
  };
}

console.log('Test 1: stock ACF without canvas → crash');
{
  const r = run(false);
  assert(r.crashed, 'expected crash');
  assert(/buttons/.test(String(r.error && r.error.message)), r.error && r.error.message);
  console.log('  PASS:', r.error.message);
}

console.log('Test 2: with patch → no crash (quicktags disabled in block editor)');
{
  const r = run(true);
  assert(r.patched, 'patch not applied');
  assert(!r.crashed, 'unexpected crash: ' + (r.error && r.error.message));
  console.log('  PASS: no crash');
}

console.log('Test 3: defaults seeded');
{
  const r = run(true);
  const d = r.windowObj.acf.tinymce.defaults();
  assert(d.tinymce, 'defaults.tinymce missing');
  assert(d.quicktags && d.quicktags.buttons, 'defaults.quicktags.buttons missing');
  console.log('  PASS: defaults seeded');
}

console.log('\nAll WYSIWYG regression tests passed.');
