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
 * CSS URLs needed for ACF block previews in the Gutenberg canvas.
 * Same approach as mefic: theme CSS + ACF input CSS + editor-preview fixes.
 */
function tragency_block_editor_css_urls() {
  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }

  $theme_uri = get_template_directory_uri();
  $theme_dir = get_template_directory();
  $urls = [];

  $app_css = tragency_vite_css_url('resources/css/app.scss');
  if ($app_css) {
    $urls[] = $app_css;
  } else {
    // Fallback if Vite manifest is unavailable.
    $urls[] = 'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css';
  }

  $static_paths = [
    'framework/assets/custom-classes.css',
    'framework/assets/slick/slick.css',
    'framework/assets/slick/slick-theme.css',
    'framework/assets/editor-preview.css',
  ];

  foreach ($static_paths as $relative) {
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
 * Enqueue theme + ACF styles for the block editor (mefic pattern).
 */
function tragency_enqueue_block_editor_theme_styles() {
  if (!is_admin()) {
    return;
  }

  if (function_exists('acf_enqueue_scripts')) {
    acf_enqueue_scripts();
  }

  foreach (['acf-global', 'acf-input', 'acf-pro-input'] as $handle) {
    if (wp_style_is($handle, 'registered') && !wp_style_is($handle, 'enqueued')) {
      wp_enqueue_style($handle);
    }
  }

  foreach (tragency_block_editor_css_urls() as $index => $url) {
    wp_enqueue_style('tragency-editor-theme-' . $index, $url, [], null);
  }
}
add_action('enqueue_block_assets', 'tragency_enqueue_block_editor_theme_styles');

/**
 * Also load editor-preview resets on the editor chrome (sidebar ACF fields / WYSIWYG).
 */
function tragency_enqueue_block_editor_sidebar_fixes() {
  $path = get_template_directory() . '/framework/assets/editor-preview.css';
  if (!is_readable($path)) {
    return;
  }

  $deps = [];
  if (wp_style_is('acf-input', 'registered')) {
    $deps[] = 'acf-input';
  }

  wp_enqueue_style(
    'tragency-editor-preview-sidebar',
    get_template_directory_uri() . '/framework/assets/editor-preview.css',
    $deps,
    filemtime($path)
  );
}
add_action('enqueue_block_editor_assets', 'tragency_enqueue_block_editor_sidebar_fixes');

/**
 * Also inject the same CSS into the editor iframe styles list.
 */
add_filter('block_editor_settings_all', function ($settings) {
  if (!isset($settings['styles']) || !is_array($settings['styles'])) {
    $settings['styles'] = [];
  }

  foreach (tragency_block_editor_css_urls() as $url) {
    $settings['styles'][] = [
      'css' => '@import url("' . esc_url($url) . '");',
    ];
  }

  return $settings;
}, 20);

