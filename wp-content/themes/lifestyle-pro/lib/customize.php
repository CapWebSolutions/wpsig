<?php
/**
 * Lifestyle Pro.
 *
 * This file adds options to the Customizer for customizing the Lifestyle Pro Theme.
 *
 * @package Lifestyle
 * @author  StudioPress
 * @license GPL-2.0+
 * @link    http://my.studiopress.com/themes/lifestyle/
 */

add_action( 'customize_register', 'lifestyle_customizer_register' );
/**
 * Register settings and controls with the Customizer.
 *
 * @since 3.2.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function lifestyle_customizer_register( $wp_customize ) {

	$wp_customize->add_setting(
		'lifestyle_link_color',
		array(
			'default'           => lifestyle_customizer_get_default_link_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'lifestyle_link_color',
			array(
				'description' => __( 'Change the color for links, the color of post info links, the hover color of linked titles, and more.', 'lifestyle-pro' ),
				'label'       => __( 'Link Color', 'lifestyle-pro' ),
				'section'     => 'colors',
				'settings'    => 'lifestyle_link_color',
			)
		)
	);

	$wp_customize->add_setting(
		'lifestyle_accent_color',
		array(
			'default'           => lifestyle_customizer_get_default_accent_color(),
			'sanitize_callback' => 'sanitize_hex_color',
		)
	);

	$wp_customize->add_control(
		new WP_Customize_Color_Control(
			$wp_customize,
			'lifestyle_accent_color',
			array(
				'description' => __( 'Change the color for the header background, buttons, and more.', 'lifestyle-pro' ),
				'label'       => __( 'Accent Color', 'lifestyle-pro' ),
				'section'     => 'colors',
				'settings'    => 'lifestyle_accent_color',
			)
		)
	);

}
