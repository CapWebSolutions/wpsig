<?php
/**
 * Lifestyle Pro.
 *
 * This file adds the required custom CSS to the Lifestyle Pro Theme.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

add_action( 'wp_enqueue_scripts', 'lifestyle_custom_css' );
/**
 * Check to see if there is a new value for link color or the accent color, and if
 * so, print that value to the theme's main stylesheet.
 *
 * @since 3.2.0
 */
function lifestyle_custom_css() {

	$handle  = defined( 'CHILD_THEME_NAME' ) && CHILD_THEME_NAME ? sanitize_title_with_dashes( CHILD_THEME_NAME ) : 'child-theme';

	$color_link   = get_theme_mod( 'lifestyle_link_color', lifestyle_customizer_get_default_link_color() );
	$color_accent = get_theme_mod( 'lifestyle_accent_color', lifestyle_customizer_get_default_accent_color() );

	$css = '';

	$css .= ( lifestyle_customizer_get_default_link_color() !== $color_link ) ? sprintf( '

		a,
		.archive-pagination li a:focus,
		.archive-pagination li a:hover,
		.archive-pagination li.active a,
		.entry-title a:focus,
		.entry-title a:hover {
			color: %1$s;
		}

		@media only screen and (max-width: 800px) {
			.menu-toggle:focus,
			.menu-toggle:hover,
			.sub-menu-toggle:focus,
			.sub-menu-toggle:hover {
				color: %1$s;
			}
		}

		', $color_link ) : '';

	$css .= ( lifestyle_customizer_get_default_accent_color() !== $color_accent ) ? sprintf( '

		button,
		input[type="button"],
		input[type="reset"],
		input[type="submit"],
		.button,
		.entry-content .button,
		.lifestyle-pro-home .content .widget-title,
		.nav-secondary,
		.site-footer,
		.site-header {
			background-color: %1$s;
			color: %2$s;
		}

		.site-description,
		.site-footer a,
		.site-header .menu-toggle,
		.site-header .sub-menu-toggle,
		.site-header .widget-area a,
		.site-header .widget-area,
		.site-header .widget-title,
		.site-title a,
		.site-title a:focus,
		.site-title a:hover {
			color: %2$s;
		}

		.site-footer a:focus,
		.site-footer a:hover,
		.site-header .menu-toggle:focus,
		.site-header .menu-toggle:hover,
		.site-header .sub-menu-toggle:focus,
		.site-header .sub-menu-toggle:hover {
			color: %3$s;
		}

		@media only screen and (max-width: 767px) {

			.site-header .genesis-nav-menu .current-menu-item > a,
			.site-header .genesis-responsive-menu .sub-menu a {
				color: %2$s;
			}

			.site-header .genesis-responsive-menu a:focus,
			.site-header .genesis-responsive-menu a:hover,
			.site-header .genesis-responsive-menu .current-menu-item > a:hover,
			.site-header .genesis-responsive-menu .sub-menu a:focus,
			.site-header .genesis-responsive-menu .sub-menu a:hover {
				color: %3$s;
			}
		}

		', $color_accent, lifestyle_color_contrast( $color_accent ), lifestyle_change_brightness( $color_accent ) ) : '';

	if ( $css ) {
		wp_add_inline_style( $handle, $css );
	}

}
