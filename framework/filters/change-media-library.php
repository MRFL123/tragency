<?php
/*
* HTTP error when uploading an image via the WordPress Media Uploader
* https://stackoverflow.com/questions/23343691/http-error-when-uploading-an-image-via-the-wordpress-media-uploader
*/
function change_graphic_lib($array) {
  return array( 'WP_Image_Editor_GD', 'WP_Image_Editor_Imagick' );
}
add_filter( 'wp_image_editors', 'change_graphic_lib' );
