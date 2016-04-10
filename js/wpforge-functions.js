/*
 * @since WP-Forge 5.5.1.7
 * @version 6.2.1
 */

/*jslint browser: true*/
/*global $, jQuery, alert*/

jQuery(document).ready(function($) {

	// Add button class submit buttons in the theme
	jQuery('input[type="submit"]').addClass('button');
	
	// Adds flex video to embeded video: http://foundation.zurb.com/docs/components/flex-video.html
	jQuery('iframe[src*="vimeo.com"]').wrap('<div class="flex-video widescreen vimeo" />');
	jQuery('iframe[src*="youtube.com"],iframe[src*="dailymotion.com"]').wrap('<div class="flex-video widescreen" />');
	
	// BackToTop Button: Controls the fade in of the BacktoTop Button
	jQuery(window).load(function() {
		jQuery("#topofpage").hide().removeAttr("href");
		if (jQuery(window).scrollTop() != "0")
			jQuery("#backtotop").fadeIn("slow")
		var scrollDiv = jQuery("#backtotop");
		jQuery(window).scroll(function(){
			if (jQuery(window).scrollTop() == "0")
				jQuery(scrollDiv).fadeOut("slow")
			else
				jQuery(scrollDiv).fadeIn("slow")
		});	
	});	
	// BacktoTop
	jQuery('#backtotop').click(function(){
		jQuery('html, body').animate({
		scrollTop: jQuery('body').offset().top
		}, 1000); // Change this value to control the speed of the scroll back to the top of the page.		   
	});

	// Remove empty P tags created by WP inside of Accordion and Orbit - Thanks to JointsWP - added 6.1.1
    jQuery('.accordion p:empty, .orbit p:empty, .accordion br, .entry-content p:empty, .entry-content br').remove();

    // Add clearfix class to gallery
	jQuery('.gallery').addClass('clearfix');

// end loading all functions  
   
});