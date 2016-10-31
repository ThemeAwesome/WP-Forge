/**
 * Allows the contain-to-grid menu option to work.
 * @since WP-Forge 6.2
 * @version 6.2.4.2
 */

jQuery(document).ready(function() {

	var stickyMenu = jQuery('.contain-to-grid').offset().top;
	jQuery(window).on('load scroll resize orientationChange', function () {
	    if (jQuery(window).scrollTop() > stickyMenu) {
	        jQuery('body').addClass('f-topbar-fixed');
	        jQuery('.contain-to-grid').addClass('fixed');
	    }
	    else {
	    	jQuery('body').removeClass('f-topbar-fixed');
	        jQuery('.contain-to-grid').removeClass('fixed');
	    }
	});

});
