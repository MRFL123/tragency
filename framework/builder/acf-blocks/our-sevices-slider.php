<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_our_services_slider',
        'title' => 'Our Services Slider',
        'fields' => array(
            array(
                'key' => 'field_services_text',
                'label' => 'Text',
                'name' => 'text',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_services_button',
                'label' => 'Button',
                'name' => 'button',
                'type' => 'link',
                'return_format' => 'array',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_services_selection',
                'label' => 'Service Selection',
                'name' => 'service_selection',
                'type' => 'radio',
                'choices' => array(
                    'latest' => 'Latest Services',
                    'random' => 'Random Services',
                    'select' => 'Select Services',
                ),
                'default_value' => 'latest',
                'layout' => 'vertical',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_selected_services',
                'label' => 'Selected Services',
                'name' => 'selected_services',
                'type' => 'relationship',
                'post_type' => array('services'),
                'post_status' => array('publish'),
                'return_format' => 'object',
                'filters' => array('search', 'post_type', 'taxonomy'),
                'elements' => array('featured_image'),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_services_selection',
                            'operator' => '==',
                            'value' => 'select',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/our-services-slider',
                ),
            ),
        ),
        'active' => true,
    ));
});
