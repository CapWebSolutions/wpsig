<?php
/**
 * Gravity Forms Tweaks
 *
 * This file includes any custom Gravity Forms settings 
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/wordpress-sig-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2018, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */

/**
 * Fix Gravity Form Tabindex Conflicts
 * http://gravitywiz.com/fix-gravity-form-tabindex-conflicts/
 */
add_filter( 'gform_tabindex', 'gform_tabindexer', 10, 2 );
function gform_tabindexer( $tab_index, $form = false ) {
	$starting_index = 1000; // if you need a higher tabindex, update this number
	if ( $form ) {
		add_filter( 'gform_tabindex_' . $form['id'], 'gform_tabindexer' );
	}
	return GFCommon::$tab_index >= $starting_index ? GFCommon::$tab_index : $starting_index;
}

// Enable Gravity Forms Visibility Setting
// Ref: https://www.gravityhelp.com/gravity-forms-v1-9-placeholders/
add_filter( 'gform_enable_field_label_visibility_settings', '__return_true' );

// Move submit button on form & add a little following comment.
//add_filter( 'gform_submit_button_10', 'add_paragraph_below_submit', 10, 2 );
function add_paragraph_below_submit( $button, $form ) {
    return $button .= "<small>By joining the WordPress SIG newsletter, you agree to a basic  <a href=\"privacy-policy/\">Privacy Policy</a>. Got questions? <a href=\"contact/\">Get in touch.</a>.</small>";
}
