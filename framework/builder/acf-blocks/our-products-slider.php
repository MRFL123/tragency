<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_our_products_slider',
        'title' => 'Our products Slider',
        'fields' => array(
            array(
                'key' => 'field_products_text',
                'label' => 'Text',
                'name' => 'text',
                'type' => 'wysiwyg',
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 0,
                'wrapper' => array(
                    'width' => '',
                ),
            ),
            array(
                'key' => 'field_products_button',
                'label' => 'Button',
                'name' => 'button',
                'type' => 'link',
                'return_format' => 'array',
                'wrapper' => array(
                    'width' => '',
                ),
            ),
            array(
                'key' => 'field_products_selection',
                'label' => 'products Selection',
                'name' => 'products_selection',
                'type' => 'radio',
                'choices' => array(
                    'latest' => 'Latest products',
                    'random' => 'Random products',
                    'select' => 'Select products',
                ),
                'default_value' => 'latest',
                'layout' => 'vertical',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_selected_products',
                'label' => 'Selected products',
                'name' => 'selected_products',
                'type' => 'relationship',
                'post_type' => array('product'),
                'post_status' => array('publish'),
                'return_format' => 'id',
                'filters' => array('search', 'post_type', 'taxonomy'),
                'elements' => array('featured_image'),
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_products_selection',
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
                    'value' => 'acf/our-products-slider',
                ),
            ),
        ),
        'active' => true,
    ));
});
