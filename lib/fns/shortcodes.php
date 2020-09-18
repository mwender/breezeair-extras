<?php

namespace breezeair\shortcodes;

function service_areas_map( $atts ){
  $args = shortcode_atts( [
    'map'     => 'wireless-coverage',
    'maptype' => 'roadmap',
  ], $atts );

  wp_enqueue_script('serviceareas' );
  return '<div class="map" id="' . $args['map'] . '" data-maptype="' . $args['maptype'] . '"></div>';
}
add_shortcode( 'service_areas_map', __NAMESPACE__ . '\\service_areas_map' );
