(function($) {
jQuery(document).foundation()

	// Joyride: Add java script to footer so all Foundation scripts will work
	.foundation('joyride', 'start');
	
	// Reaveal: Move content of the reveal-modal class to just above the closing body tag
	jQuery( ".reveal-modal" ).appendTo( 'body' );

	// Add button class to all submit buttons
	jQuery('input[type="submit"]').addClass('button');
	
	// Adds flex video to embeded video: http://foundation.zurb.com/docs/components/flex-video.html
	jQuery('iframe').wrap('<div class="flex-video" />');	
	
	// BackToTop: make it fades in
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
		scrollTop: jQuery("#header").offset().top
		}, 2000);				   
	});	
	
// end loading all functions   
   
})(jQuery);