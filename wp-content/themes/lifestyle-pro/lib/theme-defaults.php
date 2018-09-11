<?php
/**
 * Lifestyle Pro.
 *
 * This file adds the default theme settings to the Lifestyle Pro Theme.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

add_filter( 'genesis_theme_settings_defaults', 'lifestyle_theme_defaults' );
/**
 * Updates theme settings on reset.
 *
 * @since 3.0.2
 */
function lifestyle_theme_defaults( $defaults ) {

	$defaults['blog_cat_num']              = 5;
	$defaults['content_archive']           = 'full';
	$defaults['content_archive_limit']     = 0;
	$defaults['content_archive_thumbnail'] = 0;
	$defaults['image_alignment']           = 'alignleft';
	$defaults['posts_nav']                 = 'numeric';
	$defaults['site_layout']               = 'content-sidebar';

	return $defaults;

}

add_action( 'after_switch_theme', 'lifestyle_theme_setting_defaults' );
/**
 * Updates theme settings on activation.
 *
 * @since 3.0.2
 */
function lifestyle_theme_setting_defaults() {

	if( function_exists( 'genesis_update_settings' ) ) {

		genesis_update_settings( array(
			'blog_cat_num'              => 5,
			'content_archive'           => 'full',
			'content_archive_limit'     => 0,
			'content_archive_thumbnail' => 0,
			'image_alignment'           => 'alignleft',
			'posts_nav'                 => 'numeric',
			'site_layout'               => 'content-sidebar',
		) );

	}

	update_option( 'posts_per_page', 5 );

}

add_filter( 'simple_social_default_styles', 'lifestyle_social_default_styles' );
/**
 * Updates Simple Social Icon settings on activation.
 *
 * @since 3.0.2
 */
function lifestyle_social_default_styles( $defaults ) {

	$args = array(
		'alignment'              => 'aligncenter',
		'background_color'       => '#eeeee8',
		'background_color_hover' => '#a5a5a3',
		'border_radius'          => 3,
		'icon_color'             => '#a5a5a3',
		'icon_color_hover'       => '#ffffff',
		'size'                   => 32,
		);

	$args = wp_parse_args( $args, $defaults );

	return $args;

}
