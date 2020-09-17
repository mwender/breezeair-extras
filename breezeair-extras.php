<?php
/**
 * Plugin Name:     BreezeAir Extras
 * Plugin URI:      https://github.com/mwender/breezeair-extras
 * Description:     Additional helpers for the breezeair.net website.
 * Author:          Michael Wender
 * Author URI:      https://mwender.com
 * Text Domain:     breezeair-extras
 * Domain Path:     /languages
 * Version:         1.2.1
 *
 * @package         BreezeAir_Extras
 */
define( 'BREEZE_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BREEZE_DIR_URL', plugin_dir_url( __FILE__ ) );

// Include required files
require_once( 'lib/fns/acf.php' );
require_once( 'lib/fns/enqueues.php' );
require_once( 'lib/fns/shortcodes.php' );

if( ! function_exists( 'uber_log' ) ){
  /**
   * Enhanced logging.
   *
   * @param      string  $message  The log message
   */
  function uber_log( $message = null ){
    static $counter = 1;

    $bt = debug_backtrace();
    $caller = array_shift( $bt );

    if( 1 == $counter )
      error_log( "\n\n" . str_repeat('-', 25 ) . ' STARTING DEBUG [' . date('h:i:sa', current_time('timestamp') ) . '] ' . str_repeat('-', 25 ) . "\n\n" );
    error_log( "\n" . $counter . '. ' . basename( $caller['file'] ) . '::' . $caller['line'] . "\n" . $message . "\n---\n" );
    $counter++;
  }
}