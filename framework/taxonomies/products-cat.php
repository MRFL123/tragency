<?php
add_action('init', function() {
    register_taxonomy('product-category', array('product'), array(
        'labels' => array(
            'name' => 'Product Category',
            'singular_name' => 'Product Category',
            'menu_name' => 'Product Category',
            'all_items' => 'All Product Category',
            'edit_item' => 'Edit Product Category',
            'view_item' => 'View Product Category',
            'update_item' => 'Update Product Category',
            'add_new_item' => 'Add New Product Category',
            'new_item_name' => 'New Product Category Name',
            'parent_item' => 'Parent Product Category',
            'parent_item_colon' => 'Parent Product Category:',
            'search_items' => 'Search Product Category',
            'not_found' => 'No product category found',
            'no_terms' => 'No product category',
            'filter_by_item' => 'Filter by product category',
            'items_list_navigation' => 'Product Category list navigation',
            'items_list' => 'Product Category list',
            'back_to_items' => '← Go to product category',
            'item_link' => 'Product Category Link',
            'item_link_description' => 'A link to a product category',
        ),
        'public' => true,
        'hierarchical' => true,
        'show_in_menu' => true,
        'show_in_rest' => true,
        'show_admin_column' => true,
        'rewrite' => array(
            'slug' => 'product-category',
            'with_front' => false,
            'hierarchical' => true,
        ),
    ));
});
?>
