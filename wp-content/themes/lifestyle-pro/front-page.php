<?php
/**
 * Lifestyle Pro.
 *
 * This file adds the front page to the Lifestyle Pro Theme.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

add_action( 'genesis_meta', 'lifestyle_home_genesis_meta' );
/**
 * Add widget support for homepage. If no widgets active, display the default loop.
 *
 * @since 3.0.0
 */
function lifestyle_home_genesis_meta() {

	if ( is_active_sidebar( 'home-top' ) || is_active_sidebar( 'home-middle' ) || is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {

		// Force content-sidebar layout setting.
		add_filter( 'genesis_pre_get_option_site_layout', '__genesis_return_content_sidebar' );

		// Add lifestyle-pro-home body class.
		add_filter( 'body_class', 'lifestyle_body_class' );

		// Remove the default Genesis loop.
		remove_action( 'genesis_loop', 'genesis_do_loop' );

		// Add homepage widgets.
		add_action( 'genesis_loop', 'lifestyle_homepage_widgets' );

	}

}

function lifestyle_body_class( $classes ) {

	$classes[] = 'lifestyle-pro-home';
	
	return $classes;

}

function lifestyle_homepage_widgets() {

	echo '<h2 class="screen-reader-text">' . __( 'Main Content', 'lifestyle-pro' ) . '</h2>';

	genesis_widget_area( 'home-top', array(
		'before' => '<div class="home-top widget-area">',
		'after'  => '</div>',
	) );

	genesis_widget_area( 'home-middle', array(
		'before' => '<div class="home-middle widget-area">',
		'after'  => '</div>',
	) );

	if ( is_active_sidebar( 'home-bottom-left' ) || is_active_sidebar( 'home-bottom-right' ) ) {

		echo '<div class="home-bottom">';

		genesis_widget_area( 'home-bottom-left', array(
			'before' => '<div class="home-bottom-left widget-area">',
			'after'  => '</div>',
		) );

		genesis_widget_area( 'home-bottom-right', array(
			'before' => '<div class="home-bottom-right widget-area">',
			'after'  => '</div>',
		) );

		echo '</div>';

	}

}

// Run the Genesis loop.
genesis();
