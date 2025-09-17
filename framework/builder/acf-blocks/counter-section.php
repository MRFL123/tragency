<?php
add_action( 'acf/include_fields', function() {
    if ( ! function_exists( 'acf_add_local_field_group' ) ) {
        return;
    }

    acf_add_local_field_group( array(
        'key' => 'group_counter_section',
        'title' => 'Counter Section',
        'fields' => array(
            array(
                'key' => 'field_counter_text',
                'label' => 'Text',
                'name' => 'text',
                'type' => 'wysiwyg',
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id'    => '',
                ),
                'tabs' => 'all',
                'toolbar' => 'full',
                'media_upload' => 1,
            ),
            array(
                'key' => 'field_counter_goals',
                'label' => 'Goals Repeater',
                'name' => 'goals_repeater',
                'type' => 'repeater',
                'layout' => 'table',
                'button_label' => 'Add Row',
                'sub_fields' => array(
                    array(
                        'key' => 'field_counter_icon',
                        'label' => 'Icon',
                        'name' => 'icon',
                        'type' => 'image',
                        'return_format' => 'array',
                        'library' => 'all',
                        'preview_size' => 'medium',
                        'parent_repeater' => 'field_counter_goals',
                    ),
                    array(
                        'key' => 'field_counter_number',
                        'label' => 'Number',
                        'name' => 'number',
                        'type' => 'text',
                        'allow_in_bindings' => 1,
                        'parent_repeater' => 'field_counter_goals',
                    ),
                    array(
                        'key' => 'field_counter_symbol',
                        'label' => 'Symbol',
                        'name' => 'symbol',
                        'type' => 'text',
                        'allow_in_bindings' => 1,
                        'parent_repeater' => 'field_counter_goals',
                    ),
                    array(
                        'key' => 'field_counter_text_goal',
                        'label' => 'Text',
                        'name' => 'text',
                        'type' => 'text',
                        'wrapper' => array(
                            'width' => '40',
                            'class' => '',
                            'id'    => '',
                        ),
                        'parent_repeater' => 'field_counter_goals',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/counter-section',
                ),
            ),
        ),
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'active' => true,
    ));
});
?>
