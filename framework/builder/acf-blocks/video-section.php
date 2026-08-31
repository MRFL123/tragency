<?php
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
	'key' => 'group_68b5e8f62fe84',
	'title' => 'video section',
	'fields' => array(
		array(
			'key' => 'field_68b5e8f6abd9d',
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
			'key' => 'field_video_source',
			'label' => 'Video source',
			'name' => 'video_source',
			'type' => 'radio',
			'choices' => array(
				'upload' => 'Upload video',
				'youtube' => 'YouTube',
			),
			'default_value' => 'upload',
			'layout' => 'horizontal',
			'return_format' => 'value',
		),
		array(
			'key' => 'field_68b5e907abd9e',
			'label' => 'Video',
			'name' => 'video',
			'aria-label' => '',
			'type' => 'file',
			'instructions' => '',
			'required' => 0,
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_video_source',
						'operator' => '==',
						'value' => 'upload',
					),
				),
			),
			'wrapper' => array(
				'width' => '',
				'class' => '',
				'id' => '',
			),
			'return_format' => 'array',
			'library' => 'all',
			'min_size' => '',
			'max_size' => '',
			'mime_types' => 'mp4,webm,ogg,mov',
			'allow_in_bindings' => 1,
		),
		array(
			'key' => 'field_video_youtube_url',
			'label' => 'YouTube URL',
			'name' => 'youtube_url',
			'type' => 'url',
			'instructions' => 'Paste a YouTube video link',
			'placeholder' => 'https://www.youtube.com/watch?v=...',
			'conditional_logic' => array(
				array(
					array(
						'field' => 'field_video_source',
						'operator' => '==',
						'value' => 'youtube',
					),
				),
			),
		),
		array(
			'key' => 'field_video_play_with_sound',
			'label' => 'Play with sound',
			'name' => 'play_with_sound',
			'type' => 'true_false',
			'instructions' => 'If off, the video starts muted',
			'ui' => 1,
			'ui_on_text' => 'On',
			'ui_off_text' => 'Off',
			'default_value' => 0,
			'wrapper' => array(
				'width' => '50',
			),
		),
		array(
			'key' => 'field_video_show_controls',
			'label' => 'Show controls',
			'name' => 'show_controls',
			'type' => 'true_false',
			'instructions' => 'Show native player controls',
			'ui' => 1,
			'ui_on_text' => 'On',
			'ui_off_text' => 'Off',
			'default_value' => 0,
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
				'value' => 'acf/video-section',
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
) );
} );
