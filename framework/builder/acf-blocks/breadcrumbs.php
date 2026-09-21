<?php
add_action( 'acf/include_fields', function() {
	if ( ! function_exists( 'acf_add_local_field_group' ) ) {
		return;
	}

	acf_add_local_field_group( array(
        'key' => 'group_67a87524715e1',
        'title' => 'Breadcrumbs',
        'fields' => array(
            array(
                'key' => 'field_67a87524f52fa',
                'label' => 'Page Name',
                'name' => 'page_name',
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
                'key' => 'field_67a87541f52fb',
                'label' => 'Background Image',
                'name' => 'background_image',
                'aria-label' => '',
                'type' => 'image',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '50',
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
                'key' => 'field_tragency_dynamic_links',
                'label' => 'Dynamic Links',
                'name' => 'dynamic_links',
                'aria-label' => '',
                'type' => 'true_false',
                'instructions' => 'On a single product: Home, Products archive, category (if the product has one), then the product name. Manual links are used when this is off.',
                'required' => 0,
                'conditional_logic' => 0,
                'wrapper' => array(
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ),
                'message' => 'Generate breadcrumb links from the current page',
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'Dynamic',
                'ui_off_text' => 'Manual',
            ),
            array(
                'key' => 'field_67a87564f52fc',
                'label' => 'Links',
                'name' => 'links',
                'aria-label' => '',
                'type' => 'repeater',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'field_tragency_dynamic_links',
                            'operator' => '!=',
                            'value' => '1',
                        ),
                    ),
                ),
                'wrapper' => array(
                    'width' => '50',
                    'class' => '',
                    'id' => '',
                ),
                'layout' => 'table',
                'pagination' => 0,
                'min' => 0,
                'max' => 0,
                'collapsed' => '',
                'button_label' => 'Add New',
                'rows_per_page' => 20,
                'sub_fields' => array(
                    array(
                        'key' => 'field_67a87578f52fd',
                        'label' => 'Link',
                        'name' => 'link',
                        'aria-label' => '',
                        'type' => 'link',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array(
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ),
                        'return_format' => 'array',
                        'allow_in_bindings' => 0,
                        'parent_repeater' => 'field_67a87564f52fc',
                    ),
                ),
            ),
        ),
        'location' => array(
            array(
                array(
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'acf/breadcrumb',
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

/**
 * Breadcrumb items for the current post.
 * Single product: Home → Products archive → category (if any) → product name.
 *
 * @param int $post_id
 * @return array<int, array{title: string, url: string}>
 */
if (!function_exists('tragency_dynamic_breadcrumb_links')) {
  function tragency_dynamic_breadcrumb_links($post_id = 0)
  {
    $post_id = $post_id ?: (int) get_the_ID();
    $home_label = (class_exists('Utilities') && Utilities::language_code() === 'ar')
      ? 'الرئيسية'
      : __('Home', 'sage');

    $links = [[
      'title' => $home_label,
      'url'   => home_url('/'),
    ]];

    if (!$post_id) {
      return $links;
    }

    $post_type = get_post_type($post_id);
    $post_type_object = $post_type ? get_post_type_object($post_type) : null;

    if ($post_type_object && !empty($post_type_object->has_archive)) {
      $archive_url = get_post_type_archive_link($post_type);
      if ($archive_url) {
        $links[] = [
          'title' => $post_type_object->labels->name,
          'url'   => $archive_url,
        ];
      }
    }

    $taxonomies = ($post_type === 'product')
      ? ['product-category']
      : get_object_taxonomies($post_type);

    foreach ($taxonomies as $taxonomy) {
      $taxonomy_object = get_taxonomy($taxonomy);
      if (!$taxonomy_object || empty($taxonomy_object->public) || empty($taxonomy_object->hierarchical)) {
        continue;
      }

      $terms = get_the_terms($post_id, $taxonomy);
      if (empty($terms) || is_wp_error($terms)) {
        continue;
      }

      $term = $terms[0];
      $ancestor_ids = array_reverse(get_ancestors($term->term_id, $taxonomy, 'taxonomy'));

      foreach ($ancestor_ids as $ancestor_id) {
        $ancestor = get_term($ancestor_id, $taxonomy);
        if (!$ancestor || is_wp_error($ancestor)) {
          continue;
        }
        $ancestor_url = get_term_link($ancestor);
        if (is_wp_error($ancestor_url)) {
          continue;
        }
        $links[] = [
          'title' => $ancestor->name,
          'url'   => $ancestor_url,
        ];
      }

      $term_url = get_term_link($term);
      if (!is_wp_error($term_url)) {
        $links[] = [
          'title' => $term->name,
          'url'   => $term_url,
        ];
      }

      break;
    }

    $links[] = [
      'title' => get_the_title($post_id),
      'url'   => get_permalink($post_id),
    ];

    return $links;
  }
}
?>
