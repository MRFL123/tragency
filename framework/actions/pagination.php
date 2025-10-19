<?php
    add_action('init', function() {
        add_rewrite_rule(
            '^product-category/([^/]+)/page/([0-9]+)/?',
            'index.php?taxonomy=product-category&term=$matches[1]&paged=$matches[2]',
            'top'
        );
    });
    ?>
