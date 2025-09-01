<?php
add_action( 'acf/init', function() {
	acf_add_options_page( array(
	'page_title' => 'Post Settings',
	'menu_slug' => 'post-settings',
	'parent_slug' => 'edit.php',
	'position' => '',
	'redirect' => false,
) );
} );
?>
