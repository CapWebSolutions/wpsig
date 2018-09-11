<?php
/**
 * General
 *
 * This file contains footer setup functions
 *
 * @package      Core_Functionality
 * @since        1.0.0
 * @link         https://github.com/capwebsolutions/wordpress-sig-core-functionality
 * @author       Matt Ryan <matt@capwebsolutions.com>
 * @copyright    Copyright (c) 2018, Matt Ryan
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 */


// Create a shortcode to display our custom Go to top link in footer
add_shortcode( 'footer_custombacktotop', 'cap_web_footer_back_to_top' );
function cap_web_footer_back_to_top( $atts ) {
	return '<a href="#" class="top">Top of page</a>';
}

// Set up split custom footer
// Ref: https://sridharkatakam.com/split-footer-genesis/
add_shortcode( 'sitename', 'capweb_site_name' );
function capweb_site_name() {
	return '<a href="' . get_bloginfo( 'url' ) . '" title="' . get_bloginfo( 'sitename' ) . '">' . get_bloginfo( 'name' ) . '</a>';
}

// * Change the footer text
add_filter( 'genesis_footer_creds_text', 'cap_web_footer_creds_filter' );
function cap_web_footer_creds_filter( $creds ) {
	$rel = is_front_page() ? '' : 'rel="nofollow"';
	
	$creds = '<div class="footer-alignleft">';
	$creds .= '<a href="/privacy-policy/">Privacy Policy</a> &middot; <a href="/terms-conditions/">Terms & Conditions</a><br/>';
	$creds .= 'Copyright [footer_copyright] [sitename] &middot; All Rights Reserved.';
	$creds .= '</div><div class="footer-alignright">';
	$creds .= "Website by <a {$rel} href=\"https://capwebsolutions.com/\" target=\"_blank\" >Cap Web Solutions</a><br>";
	$creds .= '[footer_custombacktotop]';
	$creds .= '</div>';
	return $creds;
}
