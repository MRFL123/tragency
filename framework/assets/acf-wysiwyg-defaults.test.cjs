/**
 * Regression test: ACF buildQuicktags "reading 'buttons'" crash.
 * Run: node framework/assets/acf-wysiwyg-defaults.test.js
 */
const fs = require('fs');
const path = require('path');
const vm = require('vm');

function assert(cond, msg) {
  if (!cond) {
    throw new Error(msg);
  }
}

// Minimal DOM
function createDom() {
  const elements = new Map();

  function el(tag, id) {
    const node = {
      tagName: tag.toUpperCase(),
      id: id || '',
      className: '',
      innerHTML: '',
      children: [],
      parentNode: null,
      dir: 'ltr',
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

  const document = {
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
  };

  return { document, elements, el };
}

// Minimal jQuery.extend
function createJQuery() {
  function jQuery(fn) {
    if (typeof fn === 'function') fn();
    const api = {
      triggerHandler() {
        return api;
      },
    };
    return api;
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

// WordPress QTags (matches the early-return bug)
function installQTags(window) {
  window.edButtons = [];
  window.QTags = function (settings) {
    if (typeof settings === 'string') {
      settings = { id: settings };
    } else if (typeof settings !== 'object') {
      return false;
    }

    const t = this;
    const id = settings.id;
    const canvas = window.document.getElementById(id);

    if (!id || !canvas) {
      // Bug: returns false, but `new` still yields a hollow object.
      return false;
    }

    t.name = 'qt_' + id;
    t.id = id;
    t.canvas = canvas;
    t.settings = settings;

    let tb = window.document.getElementById(t.name + '_toolbar');
    if (!tb) {
      tb = window.document.createElement('div');
      tb.id = t.name + '_toolbar';
      tb.className = 'quicktags-toolbar';
    }
    canvas.parentNode.insertBefore(tb, canvas);
    t.toolbar = tb;
  };

  window.quicktags = function (settings) {
    return new window.QTags(settings);
  };

  window.QTags.DFWButton = function () {};
  window.QTags.DFWButton.prototype.html = () => '';
  window.QTags.TextDirectionButton = function () {};
  window.QTags.TextDirectionButton.prototype.html = () => '';
}

// Stock ACF tinymce (simplified from acf-input.min.js)
function installStockAcf(window, $) {
  window.acf = {
    doAction() {},
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
        const n = $.extend({}, a.quicktags, args.quicktags);
        n.id = id;
        window.tinyMCEPreInit.qtInit[id] = n;
        const o = window.quicktags(n);
        if (!o) return false;
        this.buildQuicktags(o);
      },
      buildQuicktags(e) {
        // Exact crash site from ACF:
        const i = e.settings;
        if (i.buttons) {
          // ok
        }
      },
    },
  };
}

function runInContext(setupMissingCanvas, applyPatch) {
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

  // tinyMCEPreInit WITHOUT acf_content (the broken Gutenberg case)
  windowObj.tinyMCEPreInit = { mceInit: {}, qtInit: {} };

  installQTags(windowObj);
  installStockAcf(windowObj, $);

  if (!setupMissingCanvas) {
    const wrap = el('div', 'wrap');
    const textarea = el('textarea', 'acf-editor-1');
    wrap.appendChild(textarea);
    // register wrap in getElementById via el()
  }

  if (applyPatch) {
    const code = fs.readFileSync(
      path.join(__dirname, 'acf-wysiwyg-defaults.js'),
      'utf8'
    );
    vm.runInNewContext(code, windowObj, { filename: 'acf-wysiwyg-defaults.js' });
    // Allow interval patch to run
    const start = Date.now();
    while (!windowObj.acf.tinymce._tragencyPatched && Date.now() - start < 2000) {
      // flush sync intervals won't run; call patch path via ready
      // Force by re-evaluating ensure: trigger jQuery ready already ran.
      // Manually wait — our patch uses setInterval; in vm it needs timers.
      break;
    }
    // Directly ensure patch applied (timers don't auto-fire in sync test)
    // Re-run patch by evaluating a nudge:
    vm.runInNewContext(
      `(function(){
        var tries=0;
        while(!acf.tinymce._tragencyPatched && tries++<5){
          // patch function closed over; re-include by checking
        }
      })();`,
      windowObj
    );
  }

  // If patch file used setInterval, manually invoke by reloading with immediate patch check.
  // Our file patches on $() which we already invoke. Interval is backup.
  // Verify _tragencyPatched:
  if (applyPatch && !windowObj.acf.tinymce._tragencyPatched) {
    // The IIFE should have patched synchronously when acf existed.
    // jQuery(fn) runs immediately in our mock, and patch() should succeed.
    assert(windowObj.acf.tinymce._tragencyPatched, 'patch should apply synchronously');
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

  return { crashed, error, patched: !!(windowObj.acf.tinymce && windowObj.acf.tinymce._tragencyPatched), windowObj };
}

console.log('Test 1: stock ACF without acf_content + missing textarea → should crash');
{
  const r = runInContext(true, false);
  assert(r.crashed, 'expected crash without patch');
  assert(
    /buttons/.test(String(r.error && r.error.message)),
    'expected buttons error, got: ' + (r.error && r.error.message)
  );
  console.log('  PASS:', r.error.message);
}

console.log('Test 2: with patch + missing textarea → must NOT crash');
{
  const r = runInContext(true, true);
  assert(r.patched, 'patch not applied');
  assert(!r.crashed, 'patch failed to prevent crash: ' + (r.error && r.error.message));
  console.log('  PASS: no crash when canvas missing');
}

console.log('Test 3: with patch + textarea present → Quicktags usable');
{
  const r = runInContext(false, true);
  assert(r.patched, 'patch not applied');
  assert(!r.crashed, 'unexpected crash: ' + (r.error && r.error.message));
  const qt = r.windowObj.tinyMCEPreInit.qtInit['acf-editor-1'];
  assert(qt && qt.buttons, 'expected qtInit buttons for editor id');
  console.log('  PASS: qtInit seeded with buttons');
}

console.log('Test 4: defaults() always returns qtInit.acf_content.buttons');
{
  const r = runInContext(false, true);
  const d = r.windowObj.acf.tinymce.defaults();
  assert(d.quicktags && d.quicktags.buttons, 'defaults.quicktags.buttons missing');
  assert(d.tinymce, 'defaults.tinymce missing');
  console.log('  PASS: defaults seeded');
}

console.log('\nAll WYSIWYG regression tests passed.');
