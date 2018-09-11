<?php
/**
 * Lifestyle Pro.
 *
 * This file adds the custom CSS to the Lifestyle Pro Theme's custom WooCommerce stylesheet.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

add_filter( 'woocommerce_enqueue_styles', 'lifestyle_woocommerce_styles' );
/**
 * Enqueue the theme's custom WooCommerce styles to the WooCommerce plugin.
 *
 * @since 3.2.0
 *
 * @return array Required values for the theme's WooCommerce stylesheet.
 */
function lifestyle_woocommerce_styles( $enqueue_styles ) {

	$enqueue_styles['lifestyle-woocommerce-styles'] = array(
		'src'     => get_stylesheet_directory_uri() . '/lib/woocommerce/lifestyle-woocommerce.css',
		'deps'    => '',
		'version' => CHILD_THEME_VERSION,
		'media'   => 'screen',
	);

	return $enqueue_styles;

}

add_action( 'wp_enqueue_scripts', 'lifestyle_woocommerce_css' );
/**
 * Add the themes's custom CSS to the WooCommerce stylesheet.
 *
 * @since 3.2.0
 *
 * @return string CSS tag with custom CSS for inline styles.
 */
function lifestyle_woocommerce_css() {

	// If WooCommerce isn't installed, exit early.
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	$color_link = get_theme_mod( 'lifestyle_link_color', lifestyle_customizer_get_default_link_color() );
	$color_accent = get_theme_mod( 'lifestyle_accent_color', lifestyle_customizer_get_default_accent_color() );

	$woo_css = '';

	$woo_css .= ( lifestyle_customizer_get_default_link_color() !== $color_link ) ? sprintf( '

		.woocommerce div.product p.price,
		.woocommerce div.product span.price,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:hover,
		.woocommerce div.product .woocommerce-tabs ul.tabs li a:focus,
		.woocommerce ul.products li.product h3:hover,
		.woocommerce ul.products li.product .price,
		.woocommerce .woocommerce-breadcrumb a:hover,
		.woocommerce .woocommerce-breadcrumb a:focus,
		.woocommerce .widget_layered_nav ul li.chosen a::before,
		.woocommerce .widget_layered_nav_filters ul li a::before {
			color: %s;
		}

	', $color_link ) : '';

	$woo_css .= ( lifestyle_customizer_get_default_accent_color() !== $color_accent ) ? sprintf( '

		.woocommerce a.button,
		.woocommerce a.button.alt,
		.woocommerce button.button,
		.woocommerce button.button.alt,
		.woocommerce input.button,
		.woocommerce input.button.alt,
		.woocommerce input.button[type="submit"],
		.woocommerce span.onsale,
		.woocommerce #respond input#submit,
		.woocommerce #respond input#submit.alt,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-handle,
		.woocommerce.widget_price_filter .ui-slider .ui-slider-range {
			background-color: %1$s;
			color: %2$s;
		}

		.woocommerce-error,
		.woocommerce-info,
		.woocommerce-message {
			border-top-color: %1$s;
		}

		.woocommerce-error::before,
		.woocommerce-info::before,
		.woocommerce-message::before {
			color: %1$s;
		}

	', $color_accent, lifestyle_color_contrast( $color_accent ) ) : '';

	if ( $woo_css ) {
		wp_add_inline_style( 'lifestyle-woocommerce-styles', $woo_css );
	}

}
