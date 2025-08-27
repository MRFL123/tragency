<?php

/**
 *  my_acf_google_map_api Function is used to :
 *  display ACF Google Map
**/

function my_acf_google_map_api( $api ){
    $api['key'] = 'AIzaSyC9_qsnnns_d8gSnDWKx45ag2PPE-HISoo';
    return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');
