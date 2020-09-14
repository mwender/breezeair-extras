<?php

namespace breezeair\enqueues;

function enqueue_scripts(){
  // CSS Customizations
  $css_dir = ( stristr( site_url(), '.local' ) )? 'css' : 'dist' ;
  wp_enqueue_style( 'breezeair-styles', plugin_dir_url( __FILE__ ) . '../' . $css_dir  . '/main.css', ['hello-elementor','elementor-frontend'], plugin_dir_path( __FILE__ ) . '../'. $css_dir .'/main.css' );

  // Google Maps API
  wp_register_script( 'googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . GOOGLE_MAPS_API_KEY, null, '1.0', true );
  $serviceAreasTimeStamp = filemtime( plugin_dir_path(__FILE__) . '../js/serviceareas.js' );
  wp_register_script( 'serviceareas', plugin_dir_url(__FILE__) . '../js/serviceareas.js', ['googlemaps'], $serviceAreasTimeStamp, true );
  wp_localize_script( 'serviceareas', 'wpvars', [
      'timeStamp' => $serviceAreasTimeStamp,
      'pluginUrl' => BREEZE_DIR_URL,
    ]
  );
}
add_action( 'wp_enqueue_scripts', __NAMESPACE__ . '\\enqueue_scripts' );