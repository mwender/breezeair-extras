<?php

namespace breezeair\enqueues;

function enqueue_scripts(){
  // CSS Customizations
  $css_dir = ( stristr( site_url(), '.local' ) )? 'css' : 'dist' ;
  wp_enqueue_style( 'breezeair-styles', plugin_dir_url( __FILE__ ) . '../' . $css_dir  . '/main.css', ['hello-elementor','elementor-frontend'], plugin_dir_path( __FILE__ ) . '../'. $css_dir .'/main.css' );

  // Google Maps API
  wp_register_script( 'googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY, null, '1.0', true );

  // We can only overlay KMZ files that are hosted on a publically available server:
  $hard_coded_kml_host = 'https://breezeair.net/wp-content/plugins/breezeair-extras/';

  $fileTimeStamp = filemtime( plugin_dir_path(__FILE__) . '../js/serviceareas.js' );
  wp_register_script( 'serviceareas', plugin_dir_url(__FILE__) . '../js/serviceareas.js', ['googlemaps'], $fileTimeStamp, true );
  if( function_exists( 'have_rows') && have_rows( 'service_areas', 'option' ) ){
    $service_areas = [];
    while( have_rows( 'service_areas', 'option' ) ): the_row();
      $area_name = get_sub_field( 'area_name' );
      $latitude = get_sub_field( 'latitude' );
      $longitude = get_sub_field( 'longitude' );
      $zoom = get_sub_field( 'zoom' );
      if( empty( $zoom ) )
        $zoom = 15;
      $service_areas[ $area_name ] = [
        'lat'   => floatval($latitude),
        'lng'   => floatval($longitude),
        'zoom'  => intval( $zoom ),
      ];
    endwhile;
  }
  wp_localize_script( 'serviceareas', 'wpvars', [
      'timeStamp' => $fileTimeStamp,
      'hardCodedUrl' => $hard_coded_kml_host,
      'serviceAreas'  => $service_areas,
    ]
  );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );