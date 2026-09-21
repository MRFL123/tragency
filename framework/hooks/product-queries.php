<?php
/**
 * Keep product listings newest-first across the site.
 * Hierarchical product CPT can otherwise fall back to menu_order / oldest-first.
 */

/**
 * Whether a query is asking for product posts.
 */
function tragency_query_is_product($query) {
  $post_type = $query->get('post_type');

  if ($post_type === 'product') {
    return true;
  }

  if (is_array($post_type) && in_array('product', $post_type, true)) {
    return true;
  }

  if ($query->is_post_type_archive('product') || $query->is_tax('product-category')) {
    return true;
  }

  return false;
}

/**
 * Force front-end product queries to date DESC (newest first).
 * Skips random / explicit custom orderby values other than menu_order/title defaults.
 */
add_action('pre_get_posts', function ($query) {
  if (is_admin() || !($query instanceof WP_Query) || !tragency_query_is_product($query)) {
    return;
  }

  $orderby = $query->get('orderby');
  $preserve = ['rand', 'post__in', 'meta_value', 'meta_value_num'];

  if (is_string($orderby) && in_array($orderby, $preserve, true)) {
    return;
  }

  if (is_array($orderby)) {
    $keys = array_keys($orderby);
    if (array_intersect($keys, $preserve) || array_intersect($orderby, $preserve)) {
      return;
    }
  }

  $query->set('orderby', [
    'date' => 'DESC',
    'ID'   => 'DESC',
  ]);
  $query->set('order', 'DESC');
});

/**
 * ACF relationship field: show newest products first when picking products.
 */
add_filter('acf/fields/relationship/query', function ($args, $field) {
  $post_types = $field['post_type'] ?? [];
  if (!is_array($post_types)) {
    $post_types = [$post_types];
  }

  if (!in_array('product', $post_types, true)) {
    return $args;
  }

  $args['orderby'] = [
    'date' => 'DESC',
    'ID'   => 'DESC',
  ];
  $args['order'] = 'DESC';

  return $args;
}, 10, 2);

/**
 * Shared WP_Query args for product listings (newest first).
 *
 * @param array $args Extra/override args.
 * @return array
 */
function tragency_product_query_args(array $args = []) {
  $defaults = [
    'post_type'      => 'product',
    'post_status'    => 'publish',
    'orderby'        => [
      'date' => 'DESC',
      'ID'   => 'DESC',
    ],
    'order'          => 'DESC',
  ];

  return array_merge($defaults, $args);
}
