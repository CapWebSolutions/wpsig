<?php
/**
 * Plugin Name: WordPress SIG Core Functionality
 * Plugin URI: https://github.com/capwebsolutions/wordpress-sig-core-functionality
 * Description: This contains all your site's core functionality so that it is theme independent. Customized for wpsig.pacsnet.org
 * Version: 1.0.0
 * Author: Matt Ryan [Cap Web Solutions]
 * Author URI: http://www.capwebsolutions.com
 *
 * This program is free software; you can redistribute it and/or modify it under the terms of the GNU
 * General Public License version 2, as published by the Free Software Foundation.  You may NOT assume
 * that you can use any other version of the GPL.
 *
 * This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without
 * even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 */

  // Exit if accessed directly.
defined( 'ABSPATH' ) || exit;

// Plugin Directory. Set constant so we know where we are installed.
$plugin_url = plugin_dir_url( __FILE__ );
if ( is_ssl() ) {
	$plugin_url = str_replace( 'http://', 'https://', $plugin_url );
}
define( 'CORE_FUNCTION_URL', $plugin_url );
define( 'CORE_FUNCTION_DIR', plugin_dir_path( __FILE__ ) );

// General
include_once( CORE_FUNCTION_DIR . '/lib/functions/general.php' );

// Footer customization
include_once( CORE_FUNCTION_DIR . '/lib/functions/core-footer.php' );

// Metaboxes
//include_once( CORE_FUNCTION_DIR . '/lib/functions/post-types.php' );

// Taxonomies
//include_once( CORE_FUNCTION_DIR . '/lib/functions/taxonomies.php' );

// Metaboxes
//include_once( CORE_FUNCTION_DIR . '/lib/functions/metaboxes.php' );





