<?php
add_action('acf/include_fields', function () {
    if (! function_exists('acf_add_local_field_group')) {
        return;
    }

    acf_add_local_field_group(array(
        'key' => 'group_680905996f7ab',
        'title' => 'Services',
        'fields' => array(
            array(
                'key' => 'field_68090599ba5c2',
                'label' => 'Heading',
                'name' => 'heading',
                'aria-label' => '',
                'type' => 'wysiwyg',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'default_value' => '',
                'maxlength' => '',
                'allow_in_bindings' => 0,
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
            ),
            array(
                'key' => 'field_68090599ba5ea',
                'label' => 'Services Type',
                'name' => 'services_type',
                'aria-label' => '',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'latest' => 'Latest',
                    'select' => 'Select',
                ),
                'default_value' => 'latest',
                'return_format' => 'value',
                'allow_null' => 0,
                'other_choice' => 0,
                'allow_in_bindings' => 0,
                'layout' => 'vertical',
                'save_other_choice' => 0,
            ),
            array(
                'key' => 'field_68090599ba5f8',
                'label' => 'Items',
                'name' => 'services',
                'aria-label' => '',
                'type' => 'relationship',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_68090599ba5ea',
                            'operator' => '==',
                            'value' => 'select',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'post_type' => array(
                    0 => 'services',
                ),
                'post_status' => array(
                    0 => 'publish',
                ),
                'taxonomy' => '',
                'filters' => array(
                    0 => 'search',
                ),
                'return_format' => 'object',
                'min' => '',
                'max' => '',
                'allow_in_bindings' => 0,
                'elements' => array(
                    0 => 'featured_image',
                ),
                'bidirectional' => 0,
                'bidirectional_target' => array(),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/services-slider',
                ),
            )
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
        'show_in_rest' => 0,
    ));
});
