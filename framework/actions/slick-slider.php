<?php
add_action('wp_enqueue_scripts', function () {
    wp_enqueue_script('jquery');

    wp_enqueue_script('slick-carousel', get_template_directory_uri() . '/framework/assets/slick/slick.min.js', ['jquery'], null, true);

    wp_enqueue_style('slick-carousel-css', get_template_directory_uri() . '/framework/assets/slick/slick.css', [], null);

    wp_enqueue_style('slick-carousel-theme', get_template_directory_uri() . '/framework/assets/slick/slick-theme.css', [], null);
});
?>
