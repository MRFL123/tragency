<?php
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
		'key' => 'group_685702f0e3ec3',
		'title' => 'service options',
		'fields' => array(
			// array(
			// 	'key' => 'field_685702f25ad8d',
			// 	'label' => 'Second image',
			// 	'name' => 'second_image',
			// 	'aria-label' => '',
			// 	'type' => 'image',
			// 	'instructions' => '',
			// 	'required' => 0,
			// 	'conditional_logic' => 0,
			// 	'wrapper' => array(
			// 		'width' => '',
			// 		'class' => '',
			// 		'id' => '',
			// 	),
			// 	'return_format' => 'url',
			// 	'library' => 'all',
			// 	'min_width' => '',
			// 	'min_height' => '',
			// 	'min_size' => '',
			// 	'max_width' => '',
			// 	'max_height' => '',
			// 	'max_size' => '',
			// 	'mime_types' => '',
			// 	'allow_in_bindings' => 0,
			// 	'preview_size' => 'medium',
			// ),
			array(
				'key' => 'field_685703button',
				'label' => 'Button',
				'name' => 'button',
				'type' => 'radio',
				'instructions' => 'Show a button under the image?',
				'required' => 0,
				'conditional_logic' => 0,
				'wrapper' => array(
					'width' => '',
					'class' => '',
					'id' => '',
				),
				'choices' => array(
					'yes' => 'Yes',
					'no'  => 'No',
				),
				'default_value' => 'no',
				'layout' => 'horizontal',
				'allow_null' => 0,
				'other_choice' => 0,
				'save_other_choice' => 0,
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'services',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'side',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
		'show_in_rest' => 0,
	) );
} );
