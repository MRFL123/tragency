<?php

/**
 * Theme setup.
 */

namespace App;

use Illuminate\Support\Facades\Vite;

/**
 * Resolve a Vite CSS asset URL, preferring a real .css file.
 */
function vite_css_url(string $entry): ?string
{
    try {
        $url = Vite::asset($entry);
        $path = parse_url($url, PHP_URL_PATH) ?: $url;

        if ($url && str_ends_with($path, '.css')) {
            return $url;
        }

        $fallback = Vite::asset('resources/css/app.scss');
        $fallbackPath = parse_url($fallback, PHP_URL_PATH) ?: $fallback;

        return ($fallback && str_ends_with($fallbackPath, '.css')) ? $fallback : null;
    } catch (\Throwable $e) {
        return null;
    }
}

/**
 * Load theme CSS into the block editor canvas iframe only (block previews).
 * add_editor_style targets the canvas — not the ACF fields sidebar.
 */
add_action('after_setup_theme', function () {
    add_theme_support('editor-styles');
}, 20);

add_action('admin_init', function () {
    $style = vite_css_url('resources/css/editor.scss');

    if ($style) {
        add_editor_style($style);
    }
});

/**
 * Inject editor scripts.
 */
add_action('enqueue_block_editor_assets', function () {
    try {
        $dependencies = json_decode(Vite::content('editor.deps.json')) ?: [];

        foreach ($dependencies as $dependency) {
            if (! wp_script_is($dependency)) {
                wp_enqueue_script($dependency);
            }
        }

        echo Vite::withEntryPoints([
            'resources/js/editor.js',
        ])->toHtml();
    } catch (\Throwable $e) {
        // Ignore missing Vite assets so the editor still loads.
    }
});

/**
 * Keep ACF field controls looking like default WP admin.
 */
add_action('enqueue_block_editor_assets', function () {
    $css = <<<'CSS'
.acf-block-component .acf-fields,
.acf-block-panel .acf-fields,
.interface-complementary-area .acf-fields,
.edit-post-sidebar .acf-fields {
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen-Sans, Ubuntu, Cantarell, "Helvetica Neue", sans-serif;
  font-size: 13px;
  line-height: 1.4;
  color: #1e1e1e;
}
.acf-block-component .acf-fields *,
.acf-block-panel .acf-fields *,
.interface-complementary-area .acf-fields *,
.edit-post-sidebar .acf-fields * {
  box-sizing: border-box;
}
.acf-block-component .acf-fields .acf-label label,
.acf-block-panel .acf-fields .acf-label label,
.interface-complementary-area .acf-fields .acf-label label,
.edit-post-sidebar .acf-fields .acf-label label {
  display: block;
  font-size: 11px !important;
  font-weight: 600 !important;
  text-transform: uppercase !important;
  line-height: 1.4 !important;
  margin: 0 0 4px !important;
  color: #1e1e1e !important;
}
.acf-block-component .acf-fields input[type="text"],
.acf-block-component .acf-fields input[type="password"],
.acf-block-component .acf-fields input[type="email"],
.acf-block-component .acf-fields input[type="url"],
.acf-block-component .acf-fields input[type="number"],
.acf-block-component .acf-fields input[type="search"],
.acf-block-component .acf-fields input[type="tel"],
.acf-block-component .acf-fields textarea,
.acf-block-component .acf-fields select,
.acf-block-panel .acf-fields input[type="text"],
.acf-block-panel .acf-fields input[type="password"],
.acf-block-panel .acf-fields input[type="email"],
.acf-block-panel .acf-fields input[type="url"],
.acf-block-panel .acf-fields input[type="number"],
.acf-block-panel .acf-fields textarea,
.acf-block-panel .acf-fields select,
.interface-complementary-area .acf-fields input[type="text"],
.interface-complementary-area .acf-fields input[type="password"],
.interface-complementary-area .acf-fields input[type="email"],
.interface-complementary-area .acf-fields input[type="url"],
.interface-complementary-area .acf-fields input[type="number"],
.interface-complementary-area .acf-fields textarea,
.interface-complementary-area .acf-fields select,
.edit-post-sidebar .acf-fields input[type="text"],
.edit-post-sidebar .acf-fields input[type="url"],
.edit-post-sidebar .acf-fields input[type="number"],
.edit-post-sidebar .acf-fields input[type="email"],
.edit-post-sidebar .acf-fields textarea,
.edit-post-sidebar .acf-fields select {
  display: block !important;
  width: 100% !important;
  max-width: 100% !important;
  height: auto !important;
  min-height: 30px !important;
  margin: 0 !important;
  padding: 0 8px !important;
  line-height: 2 !important;
  font-size: 14px !important;
  font-family: inherit !important;
  color: #2c3338 !important;
  background-color: #fff !important;
  border: 1px solid #8c8f94 !important;
  border-radius: 4px !important;
  box-shadow: none !important;
}
.acf-block-component .acf-fields textarea,
.acf-block-panel .acf-fields textarea,
.interface-complementary-area .acf-fields textarea,
.edit-post-sidebar .acf-fields textarea {
  padding: 8px !important;
  line-height: 1.5 !important;
  min-height: 80px !important;
}
.acf-block-component .acf-fields .select2-container,
.acf-block-panel .acf-fields .select2-container,
.interface-complementary-area .acf-fields .select2-container,
.edit-post-sidebar .acf-fields .select2-container {
  width: 100% !important;
}
.acf-block-component .acf-fields .acf-button,
.acf-block-panel .acf-fields .acf-button,
.interface-complementary-area .acf-fields .acf-button,
.edit-post-sidebar .acf-fields .acf-button {
  display: inline-block !important;
  height: auto !important;
  line-height: 1.4 !important;
  padding: 0 10px !important;
  font-size: 13px !important;
  text-transform: none !important;
}
CSS;

    wp_register_style('tragency-acf-editor-fix', false);
    wp_enqueue_style('tragency-acf-editor-fix');
    wp_add_inline_style('tragency-acf-editor-fix', $css);
});

/**
 * Use the generated theme.json file.
 *
 * @return string
 */
add_filter('theme_file_path', function ($path, $file) {
    return $file === 'theme.json'
        ? public_path('build/assets/theme.json')
        : $path;
}, 10, 2);

/**
 * Register the initial theme setup.
 *
 * @return void
 */
add_action('after_setup_theme', function () {
    /**
     * Disable full-site editing support.
     *
     * @link https://wptavern.com/gutenberg-10-5-embeds-pdfs-adds-verse-block-color-options-and-introduces-new-patterns
     */
    remove_theme_support('block-templates');

    /**
     * Register the navigation menus.
     *
     * @link https://developer.wordpress.org/reference/functions/register_nav_menus/
     */
    register_nav_menus([
        'primary_navigation' => __('Primary Navigation', 'sage'),
    ]);

    register_nav_menus([
        'footer_navigation' => __('Footer', 'sage'),
    ]);


    register_nav_menus([
        'footer_navigation_2' => __('Footer 2', 'sage'),
    ]);

    /**
     * Disable the default block patterns.
     *
     * @link https://developer.wordpress.org/block-editor/developers/themes/theme-support/#disabling-the-default-block-patterns
     */
    remove_theme_support('core-block-patterns');

    /**
     * Enable plugins to manage the document title.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#title-tag
     */
    add_theme_support('title-tag');

    /**
     * Enable post thumbnail support.
     *
     * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
     */
    add_theme_support('post-thumbnails');

    /**
     * Enable responsive embed support.
     *
     * @link https://developer.wordpress.org/block-editor/how-to-guides/themes/theme-support/#responsive-embedded-content
     */
    add_theme_support('responsive-embeds');

    /**
     * Enable HTML5 markup support.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#html5
     */
    add_theme_support('html5', [
        'caption',
        'comment-form',
        'comment-list',
        'gallery',
        'search-form',
        'script',
        'style',
    ]);

    /**
     * Enable selective refresh for widgets in customizer.
     *
     * @link https://developer.wordpress.org/reference/functions/add_theme_support/#customize-selective-refresh-widgets
     */
    add_theme_support('customize-selective-refresh-widgets');
}, 20);

/**
 * Register the theme sidebars.
 *
 * @return void
 */
add_action('widgets_init', function () {
    $config = [
        'before_widget' => '<section class="widget %1$s %2$s">',
        'after_widget' => '</section>',
        'before_title' => '<h3>',
        'after_title' => '</h3>',
    ];

    register_sidebar([
        'name' => __('Primary', 'sage'),
        'id' => 'sidebar-primary',
    ] + $config);

    register_sidebar([
        'name' => __('Footer', 'sage'),
        'id' => 'sidebar-footer',
    ] + $config);
});
