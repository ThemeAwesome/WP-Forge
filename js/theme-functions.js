/* @version 6.4.3 */
jQuery(document).foundation();
	// contain-to-grid functionality
	jQuery(window).on('load scroll resize orientationChange', function () { 
		var stickyMenu = jQuery('.header_container').outerHeight(true); 
		if (jQuery(window).scrollTop() > stickyMenu) { 
			jQuery('.contain-to-grid').addClass('fixed'); 
		} 
		else { 
			jQuery('.contain-to-grid').removeClass('fixed'); 
		} 
	});

	// Add button class submit buttons in the theme
	jQuery('input[type="submit"]').addClass('button');
  	jQuery('.comment-reply-link').addClass('secondary label radius');
  	jQuery('#cancel-comment-reply-link').addClass('alert label radius');
	// make sure embedded content maintains its aspect ratio as the width of the screen changes - http://foundation.zurb.com/sites/docs/responsive-embed.html
	jQuery('iframe[src*="youtube.com"],iframe[src*="vimeo.com"],iframe[src*="dailymotion.com"],iframe[src*="videopress.com"]').wrap('<div class="responsive-embed widescreen" />');
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
// end loading all functions