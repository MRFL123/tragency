<?php
// Add the options page
add_action('acf/init', function () {
	acf_add_options_page(array(
		'page_title'  => 'Services Settings',
		'menu_slug'   => 'services-settings',
		'parent_slug' => 'edit.php?post_type=services',
		'redirect'    => false,
	));
});

add_action('acf/include_fields', function () {
	if (! function_exists('acf_add_local_field_group')) {
		return;
	}

	acf_add_local_field_group(array(
		'key' => 'group_68bf048ec521e',
		'title' => 'Services Settings',
		'fields' => array(
			array(
				'key' => 'field_68bf048ffff5c',
				'label' => 'Banner',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_68bf070efff5d',
				'label' => 'Banner Title',
				'name' => 'banner_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_68bf0729fff5e',
				'label' => 'Links',
				'name' => 'links',
				'type' => 'repeater',
				'layout' => 'table',
				'button_label' => 'Add Row',
				'sub_fields' => array(
					array(
						'key' => 'field_68bf0735fff5f',
						'label' => 'Link',
						'name' => 'link',
						'type' => 'link',
						'return_format' => 'array',
					),
				),
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_68bf074afff60',
				'label' => 'Background Image',
				'name' => 'background_image',
				'type' => 'image',
				'return_format' => 'array',
				'preview_size' => 'medium',
				'library' => 'all',
			),
			array(
				'key' => 'field_68bf0777fff61',
				'label' => 'Service Page Content',
				'type' => 'message',
				'new_lines' => 'wpautop',
			),
			array(
				'key' => 'field_68bf0795fff62',
				'label' => 'Page Title',
				'name' => 'page_title',
				'type' => 'text',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_68bf0800fff63',
				'label' => 'Search Placeholder',
				'name' => 'service_search_placeholder',
				'type' => 'text',
				'instructions' => '',
				'default_value' => 'Search services...',
				'wrapper' => array('width' => '50'),
			),
			array(
				'key' => 'field_68866aaa12345',
				'label' => 'Service Display Mode',
				'name' => 'service_selection',
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
					'value' => 'services-settings',
				),
			),
		),
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'active' => true,
	));
});
?>
