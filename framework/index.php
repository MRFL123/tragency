<?php
 /**
 * Load all custome fields folder
 * Load all page templates
 */

// WPML may be inactive; theme templates historically used ICL_LANGUAGE_CODE.
if (!defined('ICL_LANGUAGE_CODE')) {
  $locale = function_exists('determine_locale') ? determine_locale() : (function_exists('get_locale') ? get_locale() : 'en');
  define('ICL_LANGUAGE_CODE', strtolower(substr((string) $locale, 0, 2)) ?: 'en');
}

add_action('wp_enqueue_scripts', function () {
  wp_enqueue_style('custom/custom-classes', get_theme_file_uri() . '/framework/assets/custom-classes.css', false, null);
}, 100);


 $files = array_merge(
   glob(__DIR__.'/utilities/*.php'),
   glob(__DIR__.'/actions/*.php'),
   glob(__DIR__.'/hooks/*.php'),
   glob(__DIR__.'/filters/*.php'),
   glob(__DIR__.'/custom-fields/*.php'),
   glob(__DIR__.'/post-type/*.php'),
   glob(__DIR__.'/taxonomies/*.php'),
   glob(__DIR__.'/plugins/*.php'),
   glob(__DIR__.'/transients/*.php'),
   glob(__DIR__.'/backend/*.php'),
   glob(__DIR__.'/admin-columns/*.php'),
   glob(__DIR__.'/builder/*.php')

 );
 foreach ($files as $filename)
 {
   include $filename;
 }
