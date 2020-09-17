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
      // Get the Service Area group field
      $service_area = get_sub_field( 'service_area' );

      // Setup our variables
      $area_name = $service_area['kml']['name'];
      $kml_url = ( $service_area['kml']['url'] )? $service_area['kml']['url'] : null ;
      $lat = floatval( $service_area['latitude'] );
      $lng = floatval( $service_area['longitude'] );
      $zoom = ( ! empty( $service_area['zoom'] ) && is_numeric( $service_area['zoom'] ) )? intval( $service_area['zoom'] ) : 15 ;

      // Add the service area to the array
      $service_areas[ $area_name ] = [
        'kml'   => $kml_url,
        'lat'   => $lat,
        'lng'   => $lng,
        'zoom'  => $zoom,
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