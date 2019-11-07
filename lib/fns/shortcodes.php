<?php

namespace breezeair\shortcodes;

function service_areas_map( $atts ){
  $args = shortcode_atts( [
    'foo' => 'bar'
  ], $atts );

  wp_enqueue_script('serviceareas');
  return '<div id="map"></div>';
}
add_shortcode( 'service_areas_map', __NAMESPACE__ . '\\service_areas_map' );
