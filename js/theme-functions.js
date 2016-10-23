/*
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4
 */

jQuery(document).ready(function() {

	// Add button class submit buttons in the theme
	jQuery('input[type="submit"]').addClass('button');

  	jQuery('.comment-reply-link').addClass('secondary label radius');

  	jQuery('#cancel-comment-reply-link').addClass('alert label radius');

	// Adds flex video to embeded video: http://foundation.zurb.com/docs/components/flex-video.html
	jQuery('iframe[src*="vimeo.com"]').wrap('<div class="flex-video widescreen vimeo" />');
	jQuery('iframe[src*="youtube.com"],iframe[src*="dailymotion.com"],iframe[src*="videopress.com"]').wrap('<div class="flex-video widescreen" />');

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
	jQuery('.accordion p:empty, .accordion br, .orbit p:empty, .orbit br').remove();

	// Add clearfix class to gallery
	jQuery('.gallery').addClass('clearfix');

	// Performs a smooth page scroll to an anchor on the same page: see https://css-tricks.com/snippets/jquery/smooth-scrolling/
	jQuery('a[href*="#"]:not([href="#"])').click(function() {
		if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
		  var target = jQuery(this.hash);
		  target = target.length ? target : jQuery('[name=' + this.hash.slice(1) +']');
		  if (target.length) {
		    jQuery('html, body').animate({
		      scrollTop: target.offset().top
		    }, 1000);
		    return false;
		  }
		}
	});

// end loading all functions

});
