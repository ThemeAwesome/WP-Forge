/**
 * Theme Customizer enhancements for a better user experience.
 *
 * Contains handlers to make Theme Customizer preview reload changes asynchronously.
 * Things like site title, description, and background color changes.
 * @since WP-Forge 5.5.1.7
 */

( function( $ ) {

/* Start adding */

	// Site title and description.
	wp.customize( 'blogname', function( value ) {
		value.bind( function( to ) {
			$( '.site-title a' ).text( to );
		} );
	} );
	wp.customize( 'blogdescription', function( value ) {
		value.bind( function( to ) {
			$( '.site-description' ).text( to );
		} );
	} );

	// Header Wrap Width
	wp.customize('header_width',function( value ) {
        value.bind(function(to) {
            $('.header_wrap').css('max-width', to ? to : '' );
        });
    });	

	// Header Wrap Background Color
	wp.customize('header_color',function( value ) {
        value.bind(function(to) {
            $('.header_wrap').css('background-color', to ? to : '' );
        });
    });

    // Site Title Link Color
	wp.customize('site_title_link_color',function( value ) {
        value.bind(function(to) {
            $('.site-title a').css('color', to ? to : '' );
        });
    });

    // Site Description Color
	wp.customize('header_textcolor',function( value ) {
        value.bind(function(to) {
            $('h2.site-description').css('color', to ? to : '' );
        });
    });

	// Header Text Display
	wp.customize( 'header_textcolor', function( value ) {
		value.bind( function( to ) {
			if ( 'blank' === to ) {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'rect(1px, 1px, 1px, 1px)',
					'position': 'absolute'
				} );
			} else {
				$( '.site-title, .site-title a, .site-description' ).css( {
					'clip': 'auto',
					'position': 'relative'
				} );
			}
		} );
	} );

	// Nav Wrap Width
	wp.customize('nav_width',function( value ) {
        value.bind(function(to) {
            $('.nav_wrap').css('max-width', to ? to : '' );
        });
    });		

	// Top-Bar Home Link Text
	wp.customize('wpforge_nav_text', function(value) {
		value.bind(function(to) {
			$('.name a').html(to);
		});
	});
	// Top-Bar Colors
	wp.customize('top_bar_main_color',function( value ) {
        value.bind(function(to) {
            $('.top-bar, .top-bar-section ul li, .top-bar-section li:not(.has-form) a:not(.button), .top-bar-section ul li:hover:not(.has-form) > a, .top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button)').css('background-color', to ? to : '' );
        });
    });

	// Off-Canvas Hamburger Icon Text
	wp.customize('wpforge_off_canvas_text', function(value) {
		value.bind(function(to) {
			$('section.tab-bar-section.middle a').html(to);
		});
	});

	// Off-Canvas Main Color
	wp.customize('wpforge_off_canvas_main_color',function( value ) {
        value.bind(function(to) {
            $('.tab-bar, .left-off-canvas-menu, .right-off-canvas-menu').css('background-color', to ? to : '' );
        });
    });

	// Off-Canvas Main Title Color
	wp.customize('wpforge_hamburger_icon_title_color',function( value ) {
        value.bind(function(to) {
            $('section.tab-bar-section.middle a').css('color', to ? to : '' );
        });
    });

	// Off-Canvas Link Color
	wp.customize('wpforge_off_canvas_link_color',function( value ) {
	    value.bind(function(to) {
	        $('ul.off-canvas-list li a').css('color', to ? to : '' );
	    });
	});

	// Off-Canvas Hover Color
	wp.customize('wpforge_off_canvas_hover_color',function( value ) {
	    value.bind(function(to) {
	        $('ul.off-canvas-list li a:hover').css('color', to ? to : '' );
	    });
	});  

	// Off-Canvas Background Hover Color
  	wp.customize('wpforge_off_canvas_background_hover_color',function( value ) {
        value.bind(function(to) {
            $('ul.off-canvas-list li a:hover').css('background-color', to ? to : '' );
        });
    });

    // Off-Canvas Active Color
    wp.customize('wpforge_off_canvas_active_color',function( value ) {
        value.bind(function(to) {
            $('ul.off-canvas-list .active > a').css('background-color', to ? to : '' );
        });
    });

    // Off-Canvas Active Hover Color
    wp.customize('wpforge_off_canvas_active_hover_color',function( value ) {
        value.bind(function(to) {
            $('ul.off-canvas-list .active > a:hover').css('background-color', to ? to : '' );
        });
    });        

	// Hook into background color/image change and adjust body class value as needed.
	wp.customize( 'background_color', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( ( '#ffffff' == to || '#fff' == to ) && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-white' );
			else if ( '' == to && 'none' == body.css( 'background-image' ) )
				body.addClass( 'custom-background-empty' );
			else
				body.removeClass( 'custom-background-empty custom-background-white' );
		} );
	} );
	wp.customize( 'background_image', function( value ) {
		value.bind( function( to ) {
			var body = $( 'body' );

			if ( '' != to )
				body.removeClass( 'custom-background-empty custom-background-white' );
			else if ( 'rgb(255, 255, 255)' == body.css( 'background-color' ) )
				body.addClass( 'custom-background-white' );
			else if ( 'rgb(230, 230, 230)' == body.css( 'background-color' ) && '' == _wpCustomizeSettings.values.background_color )
				body.addClass( 'custom-background-empty' );
		} );
	} );

	// Content Wrapper Width
	wp.customize('content_width',function( value ) {
        value.bind(function(to) {
            $('.content_wrap').css('max-width', to ? to : '' );
        });
    });

	// Content Background Color
	wp.customize('content_color',function( value ) {
        value.bind(function(to) {
            $('.content_wrap').css('background-color', to ? to : '' );
        });
    });

	// Content Font Color
	wp.customize('content_font_color',function( value ) {
        value.bind(function(to) {
            $('#content').css('color', to ? to : '' );
        });
    });

	// Content Link Color
	wp.customize('content_link_color',function( value ) {
        value.bind(function(to) {
            $('#content a').css('color', to ? to : '' );
        });
    });

	// Footer Sidebar Width
	wp.customize('footer_sidebar_width',function( value ) {
        value.bind(function(to) {
            $('.sidebar_wrap').css('max-width', to ? to : '' );
        });
    });    

	// Footer Sidebar Content Background Color
	wp.customize('footer_sidebar_color',function( value ) {
        value.bind(function(to) {
            $('.sidebar_wrap').css('background-color', to ? to : '' );
        });
    });

	// Footer Sidebar Content Background Color
	wp.customize('footer_content_color',function( value ) {
        value.bind(function(to) {
            $('.footer_wrap').css('background-color', to ? to : '' );
        });
    });

	// Footer Content Width
	wp.customize('footer_content_width',function( value ) {
        value.bind(function(to) {
            $('.footer_wrap').css('max-width', to ? to : '' );
        });
    });

	// Footer Text
	wp.customize('wpforge_footer_text', function(value) {
		value.bind(function(to) {
			$('.site-info').html(to);
		});
	});	
	wp.customize('textarea_settings', function(value) {
		value.bind(function(to) {
			$('.site-info').html(to);
		});
	});    

	// Widget Color
	wp.customize('main_widget_title_color',function( value ) {
        value.bind(function(to) {
            $('#secondary .widget-title').css('color', to ? to : '' );
        });
    });

	// Widget Text Color
	wp.customize('main_widget_text_color',function( value ) {
        value.bind(function(to) {
            $('#secondary').css('color', to ? to : '' );
        });
    });
    
	// Widget Links Color
	wp.customize('main_widget_link_color',function( value ) {
        value.bind(function(to) {
            $('#secondary a').css('color', to ? to : '' );
        });
    });

	// Footer Sidebar Widget Title Color
	wp.customize('footer_widget_title_color',function( value ) {
        value.bind(function(to) {
            $('#secondary-sidebar .widget-title').css('color', to ? to : '' );
        });
    });

	// Footer Sidebar Widget Text Color
	wp.customize('footer_widget_text_color',function( value ) {
        value.bind(function(to) {
            $('#secondary-sidebar').css('color', to ? to : '' );
        });
    });    

	// Footer Sidebar Widget Links Color
	wp.customize('footer_widget_link_color',function( value ) {
        value.bind(function(to) {
            $('#secondary-sidebar a').css('color', to ? to : '' );
        });
    });
	// Footer Text Color
	wp.customize('footer_text_color',function( value ) {
        value.bind(function(to) {
            $('footer[role="contentinfo"] p').css('color', to ? to : '' );
        });
    });
	// Footer Link Color
	wp.customize('footer_link_color',function( value ) {
        value.bind(function(to) {
            $('footer[role="contentinfo"] a').css('color', to ? to : '' );
        });
    });

	// Button Color
	wp.customize('button_color',function( value ) {
        value.bind(function(to) {
            $('button, .button').css('background-color', to ? to : '' );
        });
    });
	wp.customize('button_font_color',function( value ) {
        value.bind(function(to) {
            $('button,.button,#content a.button').css('color', to ? to : '' );
        });
    });

/* end adding */

} )( jQuery );
