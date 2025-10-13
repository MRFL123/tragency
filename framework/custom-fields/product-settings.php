<?php
// Add the options page
add_action('acf/init', function () {
	acf_add_options_page(array(
		'page_title'  => 'Product Settings',
		'menu_slug'   => 'product-settings',
		'parent_slug' => 'edit.php?post_type=product',
		'redirect'    => false,
	));
});

add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

    acf_add_local_field_group( array(
        'key' => 'group_product_b5cdd34e538',
        'title' => 'Brief About Our Products',
        'fields' => array(
            array(
                'key' => 'field_product_b5cdd42f9a5',
                'label' => 'Left Image',
                'name' => 'left_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'allow_in_bindings' => 0,
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_product_b5ce0f2f9a6',
                'label' => 'Right Image',
                'name' => 'right_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'allow_in_bindings' => 0,
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_product_b5ce272f9a7',
                'label' => 'Vector',
                'name' => 'vector',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '33',
                    'class' => '',
                    'id' => '',
                ),
                'return_format' => 'array',
                'library' => 'all',
                'min_width' => '',
                'min_height' => '',
                'min_size' => '',
                'max_width' => '',
                'max_height' => '',
                'max_size' => '',
                'mime_types' => '',
                'allow_in_bindings' => 0,
                'preview_size' => 'medium',
            ),
            array(
                'key' => 'field_product_b5ce482f9a8',
                'label' => 'Text',
                'name' => 'text',
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
                'allow_in_bindings' => 0,
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
                'delay' => 0,
            ),
        ),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'product-settings',
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

add_action('acf/include_fields', function () {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_product_bf048ec521e',
		'title' => 'product Settings',
		'fields' => array(
			array(
				'key' => 'field_product_bf048ffff5c',
				'label' => 'Banner',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_product_bf070efff5d',
				'label' => 'Banner Title',
				'name' => 'banner_product_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_bf0729fff5e',
				'label' => 'Links',
				'name' => 'product_links',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'sub_fields' => array(
					array(
						'key' => 'field_product_bf0735fff5f',
						'label' => 'Link',
						'name' => 'product_link',
						'type' => 'link',
						'return_format' => 'array',
					),
				),
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_bf074afff60',
				'label' => 'Background Image',
				'name' => 'product_background_image',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_product_bf0777fff61',
				'label' => 'Product Page Content',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_product_bf0795fff62',
				'label' => 'Page Title',
				'name' => 'product_page_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_bf0800fff63',
				'label' => 'Search Placeholder',
				'name' => 'product_search_placeholder',
				'type' => 'text',
				'instructions' => '',
				'default_value' => 'Search product...',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_866aaa12345',
				'label' => 'Product Display Mode',
				'name' => 'product_selection',
				'type' => 'radio',
				'choices' => array(
					'Latest' => 'Latest',
					'Random' => 'Random',
				),
				'default_value' => 'Latest',
				'layout' => 'vertical',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'product-settings',
				),
			),
		),
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
        'menu_order' => 1,
	));
});

add_action('acf/include_fields', function () {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_product_list_bf048ec521e',
		'title' => 'Product List Settings',
		'fields' => array(
			array(
				'key' => 'field_product_list_bf048ffff5c',
				'label' => 'Banner',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_product_list_bf070efff5d',
				'label' => 'Banner Title',
				'name' => 'banner_product_list_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_list_bf0729fff5e',
				'label' => 'Links',
				'name' => 'product_list_links',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'sub_fields' => array(
					array(
						'key' => 'field_product_list_bf0735fff5f',
						'label' => 'Link',
						'name' => 'product_list_link',
						'type' => 'link',
						'return_format' => 'array',
					),
				),
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_list_bf074afff60',
				'label' => 'Background Image',
				'name' => 'product_list_background_image',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_product_list_bf0777fff61',
				'label' => 'Product Page Content',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_product_list_bf0795fff62',
				'label' => 'Page Title',
				'name' => 'product_page_list_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_list_bf0800fff63',
				'label' => 'Search Placeholder',
				'name' => 'product_search_list_placeholder',
				'type' => 'text',
				'instructions' => '',
				'default_value' => 'Search product...',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_product_list_866aaa12345',
				'label' => 'Product Display Mode',
				'name' => 'product_list_selection',
				'type' => 'radio',
				'choices' => array(
					'Latest' => 'Latest',
					'Random' => 'Random',
				),
				'default_value' => 'Latest',
				'layout' => 'vertical',
			),
		),
		'location' => array(
			array(
				array(
					'param' => 'options_page',
					'operator' => '==',
					'value' => 'product-settings',
				),
			),
		),
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
        'menu_order' => 2,
	));
});
?>
