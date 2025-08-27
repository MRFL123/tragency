<?php
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
        'key' => 'group_68691e7adc96c',
        'title' => 'Our Gallery',
        'fields' => array(
            array(
                'key' => 'field_68692512ac9cf',
                'label' => 'Heading',
                'name' => 'heading',
                'aria-label' => '',
                'type' => 'text',
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
                'key' => 'field_68691e7b45ebf',
                'label' => 'Gallery Type',
                'name' => 'gallery_type',
                'aria-label' => '',
                'type' => 'radio',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'choices' => array(
                    'slider' => 'Slider',
                    'grid' => 'Grid',
                ),
                'default_value' => 'slider',
                'return_format' => 'value',
                'allow_null' => 0,
                'other_choice' => 0,
                'allow_in_bindings' => 0,
                'layout' => 'horizontal',
                'save_other_choice' => 0,
            ),
            array(
                'key' => 'field_68691ef945ec0',
                'label' => 'Images',
                'name' => 'images',
                'aria-label' => '',
                'type' => 'gallery',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min' => '',
                'max' => '',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'insert' => 'append',
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_68691f2145ec1',
                'label' => 'Button',
                'name' => 'button',
                'aria-label' => '',
                'type' => 'link',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_68691e7b45ebf',
                            'operator' => '==',
                            'value' => 'slider',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'allow_in_bindings' => 0,
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/our-gallery',
                ),
            ),
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
?>
