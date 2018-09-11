<?php
/**
 * Lifestyle Pro.
 *
 * This file adds the functions to the Lifestyle Pro Theme.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

// Start the engine.
include_once( get_template_directory() . '/lib/init.php' );

// Setup Theme.
include_once( get_stylesheet_directory() . '/lib/theme-defaults.php' );

// Set Localization (do not remove).
add_action( 'after_setup_theme', 'lifestyle_localization_setup' );
function lifestyle_localization_setup(){
	load_child_theme_textdomain( 'lifestyle-pro', get_stylesheet_directory() . '/languages' );
}

// Add the theme helper functions.
include_once( get_stylesheet_directory() . '/lib/helper-functions.php' );

// Add Color select to WordPress Theme Customizer.
require_once( get_stylesheet_directory() . '/lib/customize.php' );

// Include Customizer CSS.
include_once( get_stylesheet_directory() . '/lib/output.php' );

// Add WooCommerce support.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-setup.php' );

// Add the WooCommerce customizer CSS.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-output.php' );

// Include notice to install Genesis Connect for WooCommerce.
include_once( get_stylesheet_directory() . '/lib/woocommerce/woocommerce-notice.php' );

// Child theme (do not remove).
define( 'CHILD_THEME_NAME', __( 'Lifestyle Pro', 'lifestyle-pro' ) );
define( 'CHILD_THEME_URL', 'http://my.studiopress.com/themes/lifestyle/' );
define( 'CHILD_THEME_VERSION', '3.2.4' );

// Add HTML5 markup structure.
add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list', 'gallery', 'caption' ) );

// Add Accessibility support.
add_theme_support( 'genesis-accessibility', array( '404-page', 'drop-down-menu', 'headings', 'rems', 'search-form', 'skip-links' ) );

// Add viewport meta tag for mobile browsers.
add_theme_support( 'genesis-responsive-viewport' );

// Enqueue Scripts.
add_action( 'wp_enqueue_scripts', 'lifestyle_load_scripts' );
function lifestyle_load_scripts() {

	wp_enqueue_style( 'dashicons' );

	wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Droid+Sans:400,700|Roboto+Slab:400,300,700', array(), CHILD_THEME_VERSION );

	$suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
	wp_enqueue_script( 'lifestyle-responsive-menu', get_stylesheet_directory_uri() . '/js/responsive-menus' . $suffix . '.js', array( 'jquery' ), CHILD_THEME_VERSION, true );
	wp_localize_script(
		'lifestyle-responsive-menu',
		'genesis_responsive_menu',
		lifestyle_responsive_menu_settings()
	);

}

// Define our responsive menu settings.
function lifestyle_responsive_menu_settings() {

	$settings = array(
		'mainMenu'    => __( 'Menu', 'lifestyle-pro' ),
		'subMenu'     => __( 'Submenu', 'lifestyle-pro' ),
		'menuClasses' => array(
			'combine' => array(
				'.nav-primary',
				'.nav-header',
				'.nav-secondary',
			),
		),
	);

	return $settings;

}

// Add image sizes.
add_image_size( 'home-large', 634, 360, TRUE );
add_image_size( 'home-small', 266, 160, TRUE );

// Add support for custom background.
add_theme_support( 'custom-background', array(
	'default-image' => get_stylesheet_directory_uri() . '/images/bg.png',
	'default-color' => 'efefe9',
) );

// Add support for custom header.
add_theme_support( 'custom-header', array(
	'flex-height'     => true,
	'header_image'    => '',
	'header-selector' => '.site-title a',
	'header-text'     => false,
	'height'          => 220,
	'width'           => 640,
) );

// Rename menus.
add_theme_support( 'genesis-menus', array( 'primary' => __( 'Before Header Menu', 'lifestyle-pro' ), 'secondary' => __( 'After Header Menu', 'lifestyle-pro' ) ) );

// Remove output of primary navigation right extras.
remove_filter( 'genesis_nav_items', 'genesis_nav_right', 10, 2 );
remove_filter( 'wp_nav_menu_items', 'genesis_nav_right', 10, 2 );

// Remove navigation meta box.
add_action( 'genesis_theme_settings_metaboxes', 'lifestyle_remove_genesis_metaboxes' );
function lifestyle_remove_genesis_metaboxes( $_genesis_theme_settings_pagehook ) {
	remove_meta_box( 'genesis-theme-settings-nav', $_genesis_theme_settings_pagehook, 'main' );
}

// Add ID to secondary navigation.
add_filter( 'genesis_attr_nav-secondary', 'lifestyle_add_nav_secondary_id' );
function lifestyle_add_nav_secondary_id( $attributes ) {

	$attributes['id'] = 'genesis-nav-secondary';

	return $attributes;

}

// Remove skip link for primary navigation.
add_filter( 'genesis_skip_links_output', 'lifestyle_skip_links_output' );
function lifestyle_skip_links_output( $links ) {

	if ( isset( $links['genesis-nav-primary'] ) ) {
		unset( $links['genesis-nav-primary'] );
	}

	$new_links = $links;
	array_splice( $new_links, 0 );

	if ( has_nav_menu( 'secondary' ) ) {
		$new_links['genesis-nav-secondary'] = __( 'Skip to secondary menu', 'lifestyle-pro' );
	}

	return array_merge( $new_links, $links );

}

// Open wrap within site-container.
add_action( 'genesis_before_header', 'lifestyle_open_site_container_wrap' );
function lifestyle_open_site_container_wrap() {

	echo '<div class="site-container-wrap">';

}

// Reposition the primary navigation.
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_before_header', 'genesis_do_nav' );

// Modify the size of the Gravatar in the author box.
add_filter( 'genesis_author_box_gravatar_size', 'lifestyle_author_box_gravatar' );
function lifestyle_author_box_gravatar( $size ) {
	return 96;
}

// Modify the size of the Gravatar in the entry comments.
add_filter( 'genesis_comment_list_args', 'lifestyle_comments_gravatar' );
function lifestyle_comments_gravatar( $args ) {

	$args['avatar_size'] = 60;

	return $args;

}

// Close wrap within site-container.
add_action( 'genesis_after_footer', 'lifestyle_close_site_container_wrap' );
function lifestyle_close_site_container_wrap() {
	echo '</div>';
}

// Add support for 3-column footer widgets.
add_theme_support( 'genesis-footer-widgets', 3 );

// Add support for after entry widget.
add_theme_support( 'genesis-after-entry-widget-area' );

// Relocate after entry widget.
remove_action( 'genesis_after_entry', 'genesis_after_entry_widget_area' );
add_action( 'genesis_after_entry', 'genesis_after_entry_widget_area', 5 );

// Register widget areas.
genesis_register_sidebar( array(
	'id'          => 'home-top',
	'name'        => __( 'Home - Top', 'lifestyle-pro' ),
	'description' => __( 'This is the top section of the homepage.', 'lifestyle-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-middle',
	'name'        => __( 'Home - Middle', 'lifestyle-pro' ),
	'description' => __( 'This is the middle section of the homepage.', 'lifestyle-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom-left',
	'name'        => __( 'Home - Bottom Left', 'lifestyle-pro' ),
	'description' => __( 'This is the bottom left section of the homepage.', 'lifestyle-pro' ),
) );
genesis_register_sidebar( array(
	'id'          => 'home-bottom-right',
	'name'        => __( 'Home - Bottom Right', 'lifestyle-pro' ),
	'description' => __( 'This is the bottom right section of the homepage.', 'lifestyle-pro' ),
) );


//* Set the secondary navigation menu to two level depth
add_filter( 'wp_nav_menu_args', 'prefix_generate_secondary_menu_args' );
function prefix_generate_secondary_menu_args( $args ){
	if( 'secondary' != $args['theme_location'] )
	return $args;
	$args['depth'] = 2;
	return $args;
}