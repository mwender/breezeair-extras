<?php

namespace breezeair\acf;

if( function_exists( 'acf_add_options_page' ) ){
  acf_add_options_page([
    'page_title'  => 'BreezeAir General Settings',
    'menu_title'  => 'BreezeAir Settings',
    'menu_slug'   => 'breezeair-general-settings',
  ]);
}

function acf_json_save_point( $path ) {
  // update path
  $path = BREEZE_DIR_PATH . 'lib/acf-json';

  // return
  return $path;
}
add_filter('acf/settings/save_json', __NAMESPACE__ . '\\acf_json_save_point');

function acf_json_load_point( $paths ) {
    // remove original path
    unset($paths[0]);

    // append path
    $paths[] = BREEZE_DIR_PATH . 'lib/acf-json';

    // return
    return $paths;
}
add_filter('acf/settings/load_json', __NAMESPACE__ . '\\acf_json_load_point');