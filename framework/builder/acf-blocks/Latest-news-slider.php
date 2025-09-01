<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_latest_news_slider',
        'title' => 'Latest News Slider',
        'fields' => array(
            array(
                'key' => 'field_text',
                'label' => 'Text',
                'name' => 'text',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
            ),
            array(
                'key' => 'field_bg_image',
                'label' => 'Background Image',
                'name' => 'bg_image',
                'type' => 'image',
                'return_format' => 'array',
                'preview_size' => 'medium',
                'library' => 'all',
            ),
            array(
                'key' => 'field_post_selection',
                'label' => 'Post Selection',
                'name' => 'post_selection',
                'type' => 'radio',
                'choices' => array(
                    'Latest' => 'Latest Posts',
                    'Select' => 'Select Posts',
                ),
                'default_value' => 'Latest',
                'layout' => 'vertical',
            ),
            array(
                'key' => 'field_selected_posts',
                'label' => 'Selected Posts',
                'name' => 'selected_posts',
                'type' => 'relationship',
                'post_type' => array('post'),
                'post_status' => array('publish'),
                'return_format' => 'object',
                'filters' => array('search', 'post_type', 'taxonomy'),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_post_selection',
                            'operator' => '==',
                            'value' => 'Select',
                        ),
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/latest-news-slider',
                ),
            ),
        ),
        'active' => true,
    ));
});
?>
