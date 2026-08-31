<?php
add_action('acf/include_fields', function () {
    if (!function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_our_product_categories_slider',
        'title' => 'Our Product Categories Slider',
        'fields' => array(
            array(
                'key' => 'field_product_categories_text',
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
                'key' => 'field_product_categories_button',
                'label' => 'Button',
                'name' => 'button',
                'type' => 'link',
                'return_format' => 'array',
                'wrapper' => array(
                    'width' => '',
                ),
            ),
            array(
                'key' => 'field_product_categories_selection',
                'label' => 'Categories Selection',
                'name' => 'categories_selection',
                'type' => 'radio',
                'choices' => array(
                    'latest' => 'Latest categories',
                    'random' => 'Random categories',
                    'select' => 'Select categories',
                ),
                'default_value' => 'latest',
                'layout' => 'vertical',
                'wrapper' => array(
                    'width' => '50',
                ),
            ),
            array(
                'key' => 'field_selected_product_categories',
                'label' => 'Selected categories',
                'name' => 'selected_product_categories',
                'type' => 'taxonomy',
                'taxonomy' => 'product-category',
                'field_type' => 'multi_select',
                'return_format' => 'id',
                'multiple' => 1,
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'allow_null' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_product_categories_selection',
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
                    'value' => 'acf/our-product-categories-slider',
                ),
            ),
        ),
        'active' => true,
    ));
});
