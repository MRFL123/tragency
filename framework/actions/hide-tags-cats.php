<?php
    function hide_post_taxonomies_metaboxes() {
        // remove_meta_box('categorydiv', 'post', 'side');
        remove_meta_box('tagsdiv-post_tag', 'post', 'side');
    }
    add_action('admin_menu', 'hide_post_taxonomies_metaboxes');

    function remove_post_taxonomies() {
        // unregister_taxonomy_for_object_type('category', 'post');
        unregister_taxonomy_for_object_type('post_tag', 'post');
    }
    add_action('init', 'remove_post_taxonomies');
?>
