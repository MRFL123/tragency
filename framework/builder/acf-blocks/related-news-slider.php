<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_related_news_slider',
        'title' => 'Related News Slider',
        'fields' => array(
            array(
                'key' => 'field_related_title',
                'label' => 'Title',
                'name' => 'title',
                'type' => 'text',
            ),
            array(
                'key' => 'field_related_post_selection',
                'label' => 'Post Selection',
                'name' => 'post_selection',
                'type' => 'radio',
                'choices' => array(
                    'Random' => 'Random',
                    'Select' => 'Select',
                ),
                'default_value' => 'Random',
                'layout' => 'vertical',
            ),
            array(
                'key' => 'field_related_selected_posts',
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
                            'field' => 'field_related_post_selection',
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
                    'value' => 'acf/related-news-slider',
                ),
            ),
        ),
        'active' => true,
    ));
});
?>
