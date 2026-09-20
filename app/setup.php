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

        // Fallback: CSS entry may share the built app stylesheet.
        $fallback = Vite::asset('resources/css/app.scss');
        $fallbackPath = parse_url($fallback, PHP_URL_PATH) ?: $fallback;

        return ($fallback && str_ends_with($fallbackPath, '.css')) ? $fallback : null;
    } catch (\Throwable $e) {
        return null;
    }
}

/**
 * Inject theme styles into the block editor canvas iframe only
 * (preview of blocks — not the ACF fields sidebar).
 *
 * @return array
 */
add_filter('block_editor_settings_all', function ($settings) {
    $style = vite_css_url('resources/css/editor.scss');

    if ($style) {
        $settings['styles'][] = [
            'css' => "@import url('{$style}')",
        ];
    }

    return $settings;
});

/**
 * Inject scripts into the block editor.
 *
 * @return void
 */
add_filter('admin_head', function () {
    if (! get_current_screen()?->is_block_editor()) {
        return;
    }

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
 * Protect ACF field UI from any leaked frontend utility styles.
 */
add_action('enqueue_block_editor_assets', function () {
    $css = <<<'CSS'
.acf-block-component .acf-fields,
.acf-block-panel .acf-fields,
.interface-complementary-area .acf-fields {
  box-sizing: border-box;
}
.acf-block-component .acf-fields input[type="text"],
.acf-block-component .acf-fields input[type="url"],
.acf-block-component .acf-fields input[type="number"],
.acf-block-component .acf-fields input[type="email"],
.acf-block-component .acf-fields textarea,
.acf-block-component .acf-fields select,
.acf-block-panel .acf-fields input[type="text"],
.acf-block-panel .acf-fields input[type="url"],
.acf-block-panel .acf-fields input[type="number"],
.acf-block-panel .acf-fields input[type="email"],
.acf-block-panel .acf-fields textarea,
.acf-block-panel .acf-fields select,
.interface-complementary-area .acf-fields input[type="text"],
.interface-complementary-area .acf-fields input[type="url"],
.interface-complementary-area .acf-fields input[type="number"],
.interface-complementary-area .acf-fields input[type="email"],
.interface-complementary-area .acf-fields textarea,
.interface-complementary-area .acf-fields select {
  width: 100%;
  max-width: 100%;
  height: auto;
  min-height: 30px;
  padding: 0 8px;
  line-height: 1.4;
  font-size: 14px;
  border: 1px solid #8c8f94;
  border-radius: 4px;
  background: #fff;
  color: #2c3338;
  box-shadow: none;
}
.acf-block-component .acf-fields textarea,
.acf-block-panel .acf-fields textarea,
.interface-complementary-area .acf-fields textarea {
  padding: 8px;
  min-height: 80px;
}
.acf-block-component .acf-fields .acf-label label,
.acf-block-panel .acf-fields .acf-label label,
.interface-complementary-area .acf-fields .acf-label label {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  color: #1e1e1e;
}
.acf-block-component .acf-fields .select2-container,
.acf-block-panel .acf-fields .select2-container,
.interface-complementary-area .acf-fields .select2-container {
  width: 100% !important;
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
