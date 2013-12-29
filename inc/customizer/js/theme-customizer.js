/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make the WP-Forge Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 */

( function( $ ) {
	
	// Header
	wp.customize('blogname', function(value) {
		value.bind(function(to) {
			$('.site-title a').html(to);
		});
	});
	wp.customize('blogdescription', function(value) {
		value.bind(function(to) {
			$('.site-description').html(to);
		});
	});
    wp.customize('hide_headtxt', function(value) {
        value.bind(function(to) {
            if( to == '' ) {
				$('.site-title, .site-description').css('display', 'none');
			}
			else if( to == 1 ) {
				$('.site-title, .site-description').css('display', 'block');
			};
        });
    });
	// Footer
	wp.customize('wpforge_footer_text', function(value) {
		value.bind(function(to) {
			$('.site-info').html(to);
		});
	});	
	// Background
	wp.customize('wpforge_background_color', function(value) {
		value.bind(function(to) {
			$('body').css('background-color', to);
			if( to == '' ){
				$('body').css('background-color', '');
			}
		});
	});
	wp.customize('wpforge_background_img', function(value) {
		value.bind(function(to) {
			$('body').css('background-image', 'url("'+to+'")');
			if( to == '' ){
				$('body').css('background-image', '');
			}
		});
	});
	wp.customize('wpforge_background_repeat', function(value) {
		value.bind(function(to) {
			$('body').css('background-repeat', to);
			if( to == '' ){
				$('body').css('background-repeat', '');
			}
		});
	});
	wp.customize('wpforge_background_position', function(value) {
		value.bind(function(to) {
			$('body').css('background-position', to);
			if( to == '' ){
				$('body').css('background-position', '');
			}
		});
	});
	wp.customize('wpforge_background_attachment', function(value) {
		value.bind(function(to) {
			$('body').css('background-attachment', to);
			if( to == '' ){
				$('body').css('background-attachment', '');
			}
		});
	});	
	// Fonts & Colors
    wp.customize('wpforge_title_color', function(value) {
        value.bind(function(to) {
            $('h1,h2,h3,h4,h5,h6').css('color', to);
			if( to == '' ){
				$('h1,h2,h3,h4,h5,h6').css('color', '');
			}
        });
    });
	wp.customize('wpforge_text_color', function(value) {
		value.bind(function(to) {
			$('body').css('color', to);
			if( to == '' ){
				$('body').css('color', '');
			}
		});
	});
	wp.customize('wpforge_link_color', function(value) {
		value.bind(function(to) {
			$('a').css('color', to);
			if( to == '' ){
				$('a').css('color', '');
			}
		});
	});	
	wp.customize('wpforge_hover_color', function(value) {
		value.bind(function(to) {
			$('a:hover').css('color', to);
			if( to == '' ){
				$('a:hover').css('color', '');
			}
		});
	});	

} )( jQuery );