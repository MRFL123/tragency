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
 * Resolve a Vite-built CSS URL (must be a real .css file — never .js).
 */
function tragency_vite_css_url($entry) {
  try {
    if (!class_exists(\Illuminate\Support\Facades\Vite::class)) {
      return null;
    }
    $url = \Illuminate\Support\Facades\Vite::asset($entry);
    if (is_string($url) && str_contains($url, '.css') && !str_contains($url, '.js')) {
      return $url;
    }
  } catch (\Throwable $e) {
    // Missing Vite assets should not break the editor.
  }

  return null;
}

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
 * Theme CSS for the iframe canvas (block preview look).
 * editor-preview.css last so WYSIWYG/field overrides beat Bootstrap.
 */
function tragency_block_preview_css_urls() {
  $theme_uri = get_template_directory_uri();
  $theme_dir = get_template_directory();
  $urls = [];

  $app_css = tragency_vite_css_url('resources/css/app.scss');
  if ($app_css) {
    $urls[] = $app_css;
  }

  foreach ([
    'framework/assets/custom-classes.css',
    'framework/assets/slick/slick.css',
    'framework/assets/slick/slick-theme.css',
    'framework/assets/editor-preview.css',
  ] as $relative) {
    $full = $theme_dir . '/' . $relative;
    if (!is_readable($full)) {
      continue;
    }
    $urls[] = $theme_uri . '/' . $relative . '?ver=' . filemtime($full);
  }

  return array_values(array_unique($urls));
}

/**
 * Iframe-safe styles only (correct hook — no admin_head / no sidebar-css handle).
 */
add_action('enqueue_block_assets', function () {
  if (!is_admin()) {
    return;
  }

  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }

  foreach (['acf-global', 'acf-input', 'acf-pro-input', 'editor-buttons', 'wp-edit-blocks'] as $handle) {
    if (wp_style_is($handle, 'registered')) {
      wp_enqueue_style($handle);
    }
  }

  $preview_path = get_theme_file_path('framework/assets/editor-preview.css');
  if (is_readable($preview_path)) {
    wp_enqueue_style(
      'theme-editor-preview',
      get_theme_file_uri('framework/assets/editor-preview.css'),
      ['acf-input'],
      filemtime($preview_path)
    );
  }
});

/**
 * Inject theme CSS into the canvas iframe for block preview layout.
 */
add_filter('block_editor_settings_all', function ($settings) {
  if (!isset($settings['styles']) || !is_array($settings['styles'])) {
    $settings['styles'] = [];
  }

  foreach (tragency_block_preview_css_urls() as $url) {
    $path = is_string($url) ? (parse_url($url, PHP_URL_PATH) ?: '') : '';
    if (!$path || !str_ends_with($path, '.css')) {
      continue;
    }
    $settings['styles'][] = [
      'css' => '@import url("' . esc_url($url) . '");',
    ];
  }

  return $settings;
}, 20);

/**
 * TinyMCE / Quicktags scripts + patch (no CSS here — avoids iframe warnings).
 * Inline patch runs immediately after acf-input so it wins before field init.
 */
add_action('enqueue_block_editor_assets', function () {
  if (function_exists('acf_enqueue_uploader')) {
    acf_enqueue_uploader();
  }
  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }
  if (function_exists('wp_enqueue_editor')) {
    wp_enqueue_editor();
  }
  wp_enqueue_script('quicktags');
  wp_enqueue_script('wplink');

  // Sidebar field chrome: attach protect CSS to acf-input (parent frame).
  $preview_path = get_theme_file_path('framework/assets/editor-preview.css');
  if (is_readable($preview_path) && wp_style_is('acf-input', 'registered')) {
    wp_enqueue_style('acf-input');
    wp_add_inline_style('acf-input', file_get_contents($preview_path));
  }

  $js = get_theme_file_path('framework/assets/acf-wysiwyg-defaults.js');
  if (is_readable($js) && wp_script_is('acf-input', 'registered')) {
    wp_enqueue_script('acf-input');
    wp_add_inline_script('acf-input', file_get_contents($js), 'after');
  }
});

/**
 * Seed tinyMCEPreInit.acf_content early (fixes buildQuicktags "buttons" crash).
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
    if (!window.tinyMCEPreInit.qtInit.acf_content || !window.tinyMCEPreInit.qtInit.acf_content.buttons) {
      window.tinyMCEPreInit.qtInit.acf_content = {
        id: 'acf_content',
        buttons: 'strong,em,link,block,del,ins,img,ul,ol,li,code,more,close'
      };
    }
    if (!window.tinyMCEPreInit.mceInit.acf_content) {
      window.tinyMCEPreInit.mceInit.acf_content = {
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
}, 1);

/**
 * Block-editor WYSIWYG: Visual + delayed click-to-init (Gutenberg-safe).
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

