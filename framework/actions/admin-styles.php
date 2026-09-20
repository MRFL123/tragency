<?php
use Roots\Sage\Assets;
/**
* Function Name: Mirrorful Custom Style - Mirrorful_custom_style();
* This Function can Change in backend style
* @param ()
* @return ()
*/
/**
* Customize color of widgets based on its category color
*/
function custom_styles_admin() {
  ?>
  <style>

#wpadminbar .color-orange a.ab-item,
#wpadminbar span.color-orange:before {
    color: #ffa500;
  }

#wpadminbar:not(.mobile) li.color-orange:hover a.ab-item,
#wpadminbar:not(.mobile) li.color-orange:hover span.color-orange:before {
    color: #ad7000;
  }

  #wpadminbar .color-green a.ab-item,
  #wpadminbar span.color-green:before {
    color: #01ab01;
  }

#wpadminbar:not(.mobile) li.color-green:hover a.ab-item,
#wpadminbar:not(.mobile) li.color-green:hover span.color-green:before {
    color: #008000;
  }

  .Mirrorful_admin_bar_stage{
    background: #ffa5001c !important ;
  }
  .Mirrorful_admin_bar_stage a{
    text-transform: capitalize !important ;

  }
  .acf-field-message, .acf-field-object-message{
    background-color : #f1f1f1 ;
  }
  .count_shortcodes, .id_of_textbox_user_typed_in{
    height: 30px;
    border-radius: 5px;
    margin: 0;
  }
  #button_clicked{
    float :right;
  }
  .text-center{
    text-align: center;
  }
  .text-or{
    background-color: #fff;
    width: 10%;
    margin: -19px auto;
  }
  .span-dashicons{
    margin-top: 3px;
  }
  .pre-dd{
    direction: ltr;
    background-color: rgba(128, 128, 128, 0.27);
    padding: 20px 50px;
  }
  .img-responsive {
    display: block;
    max-width: 100%;
    height: auto;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    background: #f9f9f9;
    padding: 10px;
    width: 43%;
    float: left;
    margin: 2% 0.5%;
    box-shadow: 1px 1px 1px #ddd;
  }
  .taxonomy-category.term-php [data-name="category_colors"] ul.acf-radio-list li{
    width: 15%;
  }
  .taxonomy-category [data-name="category_colors"] ul.acf-radio-list li{
    border-bottom: 3px solid;
  }

  /* fix ACF 2select*/
  html[dir="rtl"] .select2-search-choice-close {
    right: auto;
    left: 24px;
  }
  /* fix large image preview of tax meta class */
  .simplePanelImagePreview img {
    max-width: 50%;
  }
  /* notification style */
  .wp-ui-notification.Mirrorful-badge {
    display: inline;
    padding: 1px 4px !important;
    border-radius: 50%;
    color: #fff;
  }

  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df741b3f23fa-results"],
  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df6960ee0d38-results"] {
    display: flex;
    flex-wrap: wrap;
  }

  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df741b3f23fa-results"] li,
  ul.select2-results__options[id^="select2-acf-block"][id$="field_5df6960ee0d38-results"] li{
    width: 10%;
    text-align: center;
  }
  </style>
  <?php
}
add_action('admin_head', 'custom_styles_admin');

/**
 * Whether the current admin screen is the block editor.
 */
function tragency_is_block_editor_screen() {
  if (!function_exists('get_current_screen')) {
    return false;
  }

  $screen = get_current_screen();
  if (!$screen) {
    return false;
  }

  if (method_exists($screen, 'is_block_editor')) {
    return (bool) $screen->is_block_editor();
  }

  return !empty($screen->is_block_editor);
}

/**
 * Resolve a Vite-built CSS URL (must be a real .css file).
 */
function tragency_vite_css_url($entry) {
  try {
    if (!class_exists(\Illuminate\Support\Facades\Vite::class)) {
      return null;
    }
    $url = \Illuminate\Support\Facades\Vite::asset($entry);
    if (is_string($url) && str_contains($url, '.css')) {
      return $url;
    }
  } catch (\Throwable $e) {
    // Missing Vite assets should not break the editor.
  }

  return null;
}

/**
 * Safe CSS for the editor chrome / ACF sidebar (NO Bootstrap / app.css).
 */
function tragency_block_editor_safe_css_urls() {
  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }

  $theme_uri = get_template_directory_uri();
  $theme_dir = get_template_directory();
  $urls = [];

  foreach ([
    'framework/assets/custom-classes.css',
    'framework/assets/editor-preview.css',
  ] as $relative) {
    $full = $theme_dir . '/' . $relative;
    if (!is_readable($full)) {
      continue;
    }
    $urls[] = $theme_uri . '/' . $relative . '?ver=' . filemtime($full);
  }

  foreach (['acf-global', 'acf-input', 'acf-pro-input'] as $handle) {
    if (!isset(wp_styles()->registered[$handle])) {
      continue;
    }
    $src = wp_styles()->registered[$handle]->src;
    if (!$src) {
      continue;
    }
    if (!preg_match('#^https?://#i', $src)) {
      $src = site_url($src);
    }
    $urls[] = $src;
  }

  return array_values(array_unique($urls));
}

/**
 * Full CSS for the Gutenberg canvas iframe (block previews).
 * Includes app.css — iframe only, not the ACF sidebar.
 */
function tragency_block_editor_canvas_css_urls() {
  $urls = [];

  $app_css = tragency_vite_css_url('resources/css/app.scss');
  if ($app_css) {
    $urls[] = $app_css;
  }

  $theme_uri = get_template_directory_uri();
  $theme_dir = get_template_directory();

  foreach ([
    'framework/assets/slick/slick.css',
    'framework/assets/slick/slick-theme.css',
  ] as $relative) {
    $full = $theme_dir . '/' . $relative;
    if (!is_readable($full)) {
      continue;
    }
    $urls[] = $theme_uri . '/' . $relative . '?ver=' . filemtime($full);
  }

  return array_values(array_unique(array_merge($urls, tragency_block_editor_safe_css_urls())));
}

/**
 * Sidebar / editor chrome: ACF styles only (keeps TinyMCE usable).
 * Do NOT load app.css / Bootstrap here — it breaks TinyMCE box-sizing.
 */
add_action('enqueue_block_editor_assets', function () {
  // Force ACF's hidden #acf_content wp_editor (seeds tinyMCEPreInit).
  if (function_exists('acf_enqueue_uploader')) {
    acf_enqueue_uploader();
  }
  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }

  wp_enqueue_editor();
  wp_enqueue_script('quicktags');
  wp_enqueue_script('wplink');
  wp_enqueue_style('editor-buttons');

  foreach (['acf-global', 'acf-input', 'acf-pro-input'] as $handle) {
    if (wp_style_is($handle, 'registered') && !wp_style_is($handle, 'enqueued')) {
      wp_enqueue_style($handle);
    }
  }

  foreach (tragency_block_editor_safe_css_urls() as $index => $url) {
    wp_enqueue_style('tragency-editor-safe-' . $index, $url, [], null);
  }

  $js = get_template_directory() . '/framework/assets/acf-wysiwyg-defaults.js';
  if (is_readable($js)) {
    wp_enqueue_script(
      'tragency-acf-wysiwyg-defaults',
      get_template_directory_uri() . '/framework/assets/acf-wysiwyg-defaults.js',
      ['acf-input', 'editor', 'quicktags'],
      filemtime($js),
      true
    );
  }
});

/**
 * Canvas iframe: full theme CSS for block previews.
 */
add_filter('block_editor_settings_all', function ($settings) {
  if (!isset($settings['styles']) || !is_array($settings['styles'])) {
    $settings['styles'] = [];
  }

  foreach (tragency_block_editor_canvas_css_urls() as $url) {
    $settings['styles'][] = [
      'css' => '@import url("' . esc_url($url) . '");',
    ];
  }

  return $settings;
}, 20);

/**
 * Block-editor WYSIWYG: Visual + delay (click-to-init is more reliable in Gutenberg).
 * Note: ACF JS still enables Quicktags unless we patch it — see acf-wysiwyg-defaults.js.
 */
add_filter('acf/prepare_field/type=wysiwyg', function ($field) {
  if (!tragency_is_block_editor_screen()) {
    return $field;
  }

  $field['tabs'] = 'visual';
  $field['toolbar'] = 'full';
  $field['media_upload'] = 1;
  $field['delay'] = 1;

  return $field;
});

/**
 * Safety-net seed after WP prints tinyMCEPreInit (in case ACF's hidden editor was skipped).
 */
add_action('admin_print_footer_scripts', function () {
  if (!tragency_is_block_editor_screen()) {
    return;
  }
  ?>
  <script id="tragency-acf-wysiwyg-seed">
  (function () {
    window.tinyMCEPreInit = window.tinyMCEPreInit || { mceInit: {}, qtInit: {}, ref: {}, load_ext: function () {} };
    window.tinyMCEPreInit.mceInit = window.tinyMCEPreInit.mceInit || {};
    window.tinyMCEPreInit.qtInit = window.tinyMCEPreInit.qtInit || {};
    if (!window.tinyMCEPreInit.qtInit.acf_content) {
      window.tinyMCEPreInit.qtInit.acf_content = {
        id: 'acf_content',
        buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close'
      };
    }
    if (!window.tinyMCEPreInit.mceInit.acf_content) {
      var donor = null;
      for (var k in window.tinyMCEPreInit.mceInit) {
        if (Object.prototype.hasOwnProperty.call(window.tinyMCEPreInit.mceInit, k) && k !== 'acf_content') {
          donor = window.tinyMCEPreInit.mceInit[k];
          break;
        }
      }
      window.tinyMCEPreInit.mceInit.acf_content = donor
        ? Object.assign({}, donor, { selector: '#acf_content', body_class: 'acf_content' })
        : {
            selector: '#acf_content',
            resize: 'vertical',
            menubar: false,
            wpautop: true,
            indent: false,
            toolbar1: 'formatselect,bold,italic,bullist,numlist,blockquote,alignleft,aligncenter,alignright,link,wp_more,spellchecker,fullscreen,wp_adv',
            toolbar2: 'strikethrough,hr,forecolor,pastetext,removeformat,charmap,outdent,indent,undo,redo,wp_help'
          };
    }
  })();
  </script>
  <?php
}, 5);
