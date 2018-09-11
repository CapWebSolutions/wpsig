/**
 * This script adds notice dismissal to the Lifestyle Pro theme.
 *
 * @package Lifestyle\JS
 * @author StudioPress
 * @license GPL-2.0+
 */

jQuery(document).on( 'click', '.lifestyle-woocommerce-notice .notice-dismiss', function() {

	jQuery.ajax({
		url: ajaxurl,
		data: {
			action: 'lifestyle_dismiss_woocommerce_notice'
		}
	});

});