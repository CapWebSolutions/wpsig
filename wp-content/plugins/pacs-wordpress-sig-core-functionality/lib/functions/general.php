<?php
/**
 * General
 *
 * This file contains any general functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/wordpress-sig-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2018, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Don't Update Plugin
 * @since 1.0.0
 *
 * This prevents you being prompted to update if there's a public plugin
 * with the same name.
 *
 * @author Mark Jaquith
 * @link http://markjaquith.wordpress.com/2009/12/14/excluding-your-plugin-or-theme-from-update-checks/
 *
 * @param array $r, request arguments
 * @param string $url, request url
 * @return array request arguments
 */
function be_core_functionality_hidden( $r, $url ) {
	if ( 0 !== strpos( $url, 'http://api.wordpress.org/plugins/update-check' ) )
		return $r; // Not a plugin update request. Bail immediately.
	$plugins = unserialize( $r['body']['plugins'] );
	unset( $plugins->plugins[ plugin_basename( __FILE__ ) ] );
	unset( $plugins->active[ array_search( plugin_basename( __FILE__ ), $plugins->active ) ] );
	$r['body']['plugins'] = serialize( $plugins );
	return $r;
}
add_filter( 'http_request_args', 'be_core_functionality_hidden', 5, 2 );


//
// Enqueue / register needed scripts & styles
add_action( 'wp_enqueue_scripts', 'capweb_enqueue_needed_scripts' );
// add_action( 'admin_enqueue_scripts', 'CORE_FUNCTION_enqueue_needed_scripts' );
function capweb_enqueue_needed_scripts() {
	wp_enqueue_style( 'font-awesome', 'https://use.fontawesome.com/73b396df58.css' );
	wp_enqueue_style( 'core-functionality', CORE_FUNCTION_URL . 'assets/css/core-functionality.css', array(), null, true );
}


// Use shortcodes in widgets
add_filter( 'widget_text', 'do_shortcode' );


// Add the filter and function, returning the widget title only if the first character is not "!"
// Author: Stephen Cronin
// Author URI: http://www.scratch99.com/
add_filter( 'widget_title', 'remove_widget_title' );
function remove_widget_title( $widget_title ) {
	if ( substr ( $widget_title, 0, 1 ) == '!' )
		return;
	else 
		return ( $widget_title );
}

/**
 * Remove Menu Items
 * @since 1.0.0
 *
 * Remove unused menu items by adding them to the array.
 * See the commented list of menu items for reference.
 *
 */
function be_remove_menus () {
	global $menu;
	$restricted = array(__('Links'));
	// Example:
	//$restricted = array(__('Dashboard'), __('Posts'), __('Media'), __('Links'), __('Pages'), __('Appearance'), __('Tools'), __('Users'), __('Settings'), __('Comments'), __('Plugins'));
	end ($menu);
	while (prev($menu)){
		$value = explode(' ',$menu[key($menu)][0]);
		if(in_array($value[0] != NULL?$value[0]:"" , $restricted)){unset($menu[key($menu)]);}
	}
}
add_action( 'admin_menu', 'be_remove_menus' );

//
// * Customize search form input box text
// * Ref: https://my.studiopress.com/snippets/search-form/
add_filter( 'genesis_search_text', 'sp_search_text' );
function sp_search_text( $text ) {
	return esc_attr( 'Search ' . get_bloginfo( $show = '', 'display' ) );
	get_permalink();
}


//Exclude Category from the RSS Feed
function c8d_exclude_category_rss_feed( $query ) {
  if ( $query->is_feed ) {
    $query->set( 'cat', '-48' ); // pacs general news
  }
}
add_action( 'pre_get_posts', 'c8d_exclude_category_rss_feed' );

// display featured post thumbnails in WordPress feeds
function wcs_post_thumbnails_in_feeds( $content ) {
  global $post;
  if( has_post_thumbnail( $post->ID ) ) {
      $content = '<p>' . get_the_post_thumbnail( $post->ID ) . '</p>' . $content;
  }
  return $content;
}
add_filter( 'the_excerpt_rss', 'wcs_post_thumbnails_in_feeds' );
add_filter( 'the_content_feed', 'wcs_post_thumbnails_in_feeds' );


// Dissable core auto update notices if sucessful.
add_filter( 'auto_core_update_send_email', 'capweb_stop_auto_update_emails', 10, 4 );
function capweb_stop_auto_update_emails( $send, $type, $core_update, $result ) {
if ( ! empty( $type ) && $type == 'success' ) {
	return false;
}
return true;
}
// Dissable theme and plugin auto update notices.
add_filter( 'auto_plugin_update_send_email', '__return_false' );
add_filter( 'auto_theme_update_send_email', '__return_false' );

add_shortcode('AffiliateDisclaimer', 'capweb_affiliate_disclaimer');
/**
 * Create shortcode and set content for affiliate disclosure.
 *
 * @author Matt Ryan <http://www.mattryan.co>
 * @since 1.0.0
 */
function capweb_affiliate_disclaimer() {
	    return '<em><small>Disclaimer:  Some of the off-site links referenced on this site are what is referred to as an affiliate link. If you choose to purchase or use the product or service through that link, the post author will get a small referral fee from the service or product provider. Your price is the same whether or not you use the affiliate link. </small></em>';
}
