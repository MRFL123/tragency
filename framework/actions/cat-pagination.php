<?php
    add_action('init', function() {
        add_rewrite_rule(
            '^product-category/([^/]+)/page/([0-9]+)/?',
            'index.php?taxonomy=product-category&term=$matches[1]&paged=$matches[2]',
            'top'
        );
    });

    // Temporary: force refresh rewrite rules on page load (only once)
    add_action('init', function() {
        if (!get_option('custom_rewrite_flushed')) {
            flush_rewrite_rules();
            update_option('custom_rewrite_flushed', true);
        }
    });
?>
