(function($) {
jQuery(document).foundation()

	// Joyride: Add java script to footer so all Foundation scripts will work
	.foundation('joyride', 'start');
	
	// Reaveal: Move content of the reveal-modal class to just above the closing body tag
	jQuery( ".reveal-modal" ).appendTo( 'body' );

	// Add button class to all submit buttons
	jQuery('input[type="submit"]').addClass('button');
	
	// Adds flex video to embeded video: http://foundation.zurb.com/docs/components/flex-video.html
	jQuery('iframe').wrap('<div class="flex-video widescreen" />');	
	
// end loading all functions   
   
})(jQuery);