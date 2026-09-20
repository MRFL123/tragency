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
 * Block editor assets for ACF block previews.
 * Bootstrap is needed so backend block templates look correct.
 * ACF field resets below undo Bootstrap form styles on field UI only.
 */
function gutenbergtheme_editor_styles() {
  wp_enqueue_style(
    'gutenbergtheme-blocks-style',
    'https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css',
    [],
    null
  );
  wp_enqueue_style(
    'custom/custom-classes',
    get_theme_file_uri() . '/framework/assets/custom-classes.css',
    [],
    null
  );

  $acf_fix = <<<'CSS'
/* Undo Bootstrap form styles on ACF fields only */
.acf-fields input[type="text"],
.acf-fields input[type="password"],
.acf-fields input[type="email"],
.acf-fields input[type="url"],
.acf-fields input[type="number"],
.acf-fields input[type="search"],
.acf-fields input[type="tel"],
.acf-fields input[type="date"],
.acf-fields textarea,
.acf-fields select {
  display: block;
  width: 100%;
  max-width: 100%;
  height: auto;
  min-height: 30px;
  margin: 0;
  padding: 0 8px;
  font-size: 14px;
  line-height: 2;
  color: #2c3338;
  background-color: #fff;
  border: 1px solid #8c8f94;
  border-radius: 4px;
  box-shadow: none;
}
.acf-fields textarea {
  padding: 8px;
  line-height: 1.5;
  min-height: 80px;
}
.acf-fields .acf-label label {
  display: block;
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  margin: 0 0 4px;
  color: #1e1e1e;
}
.acf-fields .select2-container {
  width: 100% !important;
}
.acf-fields .acf-button,
.acf-fields .button {
  font-size: 13px;
  line-height: 2;
  height: auto;
  padding: 0 10px;
  text-transform: none;
}
.acf-fields .form-control,
.acf-fields .form-select {
  display: block;
  width: 100%;
  height: auto;
  padding: 0 8px;
  font-size: 14px;
  line-height: 2;
  color: #2c3338;
  background-color: #fff;
  border: 1px solid #8c8f94;
  border-radius: 4px;
}
.acf-fields .row {
  display: block;
  margin: 0;
}
.acf-fields [class*="col-"] {
  width: 100%;
  max-width: 100%;
  padding: 0;
  float: none;
}
CSS;

  wp_register_style('tragency-acf-field-reset', false, ['gutenbergtheme-blocks-style']);
  wp_enqueue_style('tragency-acf-field-reset');
  wp_add_inline_style('tragency-acf-field-reset', $acf_fix);
}
add_action('enqueue_block_editor_assets', 'gutenbergtheme_editor_styles');

