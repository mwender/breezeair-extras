<?php
/**
 * Plugin Name:     BreezeAir Extras
 * Plugin URI:      PLUGIN SITE HERE
 * Description:     Additional helpers for the breezeair.net website.
 * Author:          Michael Wender
 * Author URI:      https://mwender.com
 * Text Domain:     breezeair-extras
 * Domain Path:     /languages
 * Version:         1.0.0
 *
 * @package         BreezeAir_Extras
 */
define( 'BREEZE_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'BREEZE_DIR_URL', plugin_dir_url( __FILE__ ) );

// Include required files
require_once( 'lib/fns/enqueues.php' );
require_once( 'lib/fns/shortcodes.php' );
