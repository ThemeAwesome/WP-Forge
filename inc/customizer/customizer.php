<?php
/**
* WP-Forge Theme Customizer
* A Theme Customizer for WP-Forge. Adds the individual sections, settings, and controls to the theme customizer
*
* Built utilizing the following tutorials:
*
* @author Tom McFarlin (@tommcfarlin)
* @see http://wp.tutsplus.com/tutorials/theme-development/a-guide-to-the-wordpress-theme-customizer-what-it-is-why-it-benefits-us/
*
* @author Alex Mansfield (@alexmansfield)
* @see http://themefoundation.com/wordpress-theme-customizer/
*
* @author Slobodan Manic (@slobodanmanic)
* @see http://www.wpexplorer.com/theme-customizer-introduction/
*
* @author Devin Price (@devinsays)
* @see http://wptheming.com/2012/06/add-options-to-theme-customizer-default-sections/
*
* @since WP-Forge 5.4
*/

function wpforge_customizer( $wp_customize ) { // Begin WP-Forge Theme Customizer

// Remove the default sections because we are going to create our own
$wp_customize->remove_section('title_tagline');
$wp_customize->remove_section('colors');
$wp_customize->remove_section('header_image');
$wp_customize->remove_section('background_image');

// Change some of the defaults
$wp_customize->get_section('nav')->priority = 20; // Changed priority so it shows after the Header section
$wp_customize->get_section('static_front_page')->priority = 80; // Changed priority so it shows at the end of the Theme Customizer
$wp_customize->get_section('static_front_page')->description = __( 'Set up a front page for your theme.', 'wpforge' );
 
/*
 * OK, now we can start building our own theme customizer.
 */

// Header Section
    $wp_customize->add_section('wpforge_header', array(
		'title' => __('Header', 'wpforge'),
		'description' => __('Modify the header portion of your theme.', 'wpforge'),
		'priority' => 10,
	));
	// Add Site Logo
	$wp_customize->add_setting('wpforge_logo',array(
		'default' => '',
		'type'    => 'theme_mod',
	));	 
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'wpforge_logo',array(
		'label' => __('Site Logo', 'wpforge'),
		'section' => 'wpforge_header',
		'settings' => 'wpforge_logo',
		'priority' => 1,
	)));
	// Site Title
	$wp_customize->add_setting('blogname', array( 
		'default'    => get_option('blogname'),
		'type'       => 'option',
		'capability' => 'manage_options',
		'sanitize_callback' => 'wpforge_sanitize_site_title',		
		'transport'  => 'postMessage',
	 ) );
		$wp_customize->add_control('blogname', array( 
			'label'    => __('Site Title', 'wpforge'),
			'section'  => 'wpforge_header',
			'priority' => 3,
		 ) );
	// Site Title
	$wp_customize->add_setting('blogdescription', array( 
		'default'    => get_option('blogdescription'),
		'type'       => 'option',
		'capability' => 'manage_options',
		'sanitize_callback' => 'wpforge_sanitize_site_description',		
		'transport'  => 'postMessage',
	 ) );
		$wp_customize->add_control('blogdescription', array( 
			'label'    => __('Tagline', 'wpforge'),
			'section'  => 'wpforge_header',
			'priority' => 4,
		 ) );
	 // Show Site Title/Tagline
	$wp_customize->add_setting('hide_headtxt', array( 
		'default'    => 1,
		'type'       => 'theme_mod',
		'capability' => 'manage_options',
		'sanitize_callback' => 'wpforge_sanitize_headtxt',
		'transport'  => 'postMessage',
	 ));	
	$wp_customize->add_control('hide_headtxt', array( 
		'label'    => __('Show Title &amp; Tagline', 'wpforge'),
		'section'  => 'wpforge_header',
		'type'     => 'checkbox',
		'priority' => 4,
	 ));						

// Top-Bar/Off-Canvas Section
    $wp_customize->add_section('wpforge_off_canvas', array(
		'title' => __('Top-Bar &amp; Off-Canvas', 'wpforge'),
		'description' => __('Configure Top-Bar Navigation and Off-Canvas mobile menu.', 'wpforge'),
		'priority' => 30,
	));
	// Top-Bar Position
	$wp_customize->add_setting('wpforge_nav_position',array(
		'default' => 'normal',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 1,	
	));
	$wp_customize->add_control('wpforge_nav_position',array(
		'type' => 'select',
		'label' => __('Main Menu Position', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices' => array(
			'normal' => __('Nomral Position', 'wpforge'),
			'top'    => __('Top of Browser - Scroll', 'wpforge'),
			'fixed'  => __('Top of Browser - Fixed', 'wpforge'),
			'sticky' => __('Contain-To-Grid-Sticky', 'wpforge'),
		),
	));
	// Top-Bar Main Link Anchor
	$wp_customize->add_setting('wpforge_nav_title',array(
		'default' => 'no',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 2,		
	));
	$wp_customize->add_control('wpforge_nav_title',array(
		'type' => 'select',
		'label' => __('Change text for Home Link?', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices'	=> array(
			'no' 	=> __('No', 'wpforge'),
			'yes'  	=> __('Yes', 'wpforge'),
		),
	));
	// Top-Bar Main Link Text
	$wp_customize->add_setting('wpforge_nav_text',array(
		'default' => '',
		'priority' => 3,
	));
	$wp_customize->add_control('wpforge_nav_text',array(
		'label' => __('If Yes, Add New Anchor Text','wpforge'),
		'section' => 'wpforge_off_canvas',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_navtxt',
	));
	// Use Off-Canvas for Mobile?
	$wp_customize->add_setting('wpforge_mobile_display',array(
		'default' => 'no',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 4,	
	));
	$wp_customize->add_control('wpforge_mobile_display',array(
		'type' => 'select',
		'label' => __('Use Off-Canvas for Mobile?', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices' => array(
			'no'	=> __('No', 'wpforge'),
			'yes'	=> __('Yes', 'wpforge'),
		),
	));
	// Off-Canvas Hamburger Icon Position	
	$wp_customize->add_setting('wpforge_mobile_position',array(
		'default' => 'left',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 5,	
	));
	$wp_customize->add_control('wpforge_mobile_position',array(
		'type' => 'select',
		'label' => __('Display Off-Canvas Left or Right?', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices' => array(
			'left'	=> __('Left', 'wpforge'),
			'right'	=> __('Right', 'wpforge'),
		),
	));	
		
//The Layout Section
    $wp_customize->add_section('wpforge_layout',array(
		'title' => __('Theme Layout', 'wpforge'),
		'description' => __('Modify how certain aspects of your theme are displayed.', 'wpforge'),
		'priority' => 40,
    ));
    // Theme Width
	$wp_customize->add_setting('wpforge_theme_width',array(
		'default' => '64rem',
		'type' => 'theme_mod',
	));
	$wp_customize->add_control('wpforge_theme_width',array(
		'label' => __('Theme Width','wpforge'),
		'section' => 'wpforge_layout',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_theme_width',
		'priority' => 1,
	));
	// Sidebar Position
	$wp_customize->add_setting('wpforge_sidebar_position',array(
		'default' => 'right',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_sidebar_position',
		'priority' => 2,		
	));
	$wp_customize->add_control('wpforge_sidebar_position',array(
		'type' => 'select',
		'label' => __('Sidebar Position', 'wpforge'),
		'section' => 'wpforge_layout',
		'choices' => array(
			'right' => __('Right', 'wpforge'),
			'left' 	=> __('Left', 'wpforge'),
		),
	));
    // Show full post or excerpts
	$wp_customize->add_setting('wpforge_post_display',array(
		'default' => 'full',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_post_display',
		'priority' => 3,		
	));
	$wp_customize->add_control('wpforge_post_display',array(
		'type' => 'select',
		'label' => __('Show full post or excerpt?', 'wpforge'),
		'section' => 'wpforge_layout',
		'choices' => array(
			'full' 		=> __('Full Post', 'wpforge'),
			'excerpt' 	=> __('Excerpt', 'wpforge'),
		),
	));
	// Show thumbnails on index page
	$wp_customize->add_setting('wpforge_thumb_display',array(
		'default' => 'no',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_thumb_display',
		'priority' => 4,		
	));
	$wp_customize->add_control('wpforge_thumb_display',array(
		'type' => 'select',
		'label' => __('Display post thumbnails?', 'wpforge'),
		'section' => 'wpforge_layout',
		'choices' => array(
			'no' 	=> __('No', 'wpforge'),
			'yes' 	=> __('Yes', 'wpforge'),
		),
	));
	// Show thumbnails on single post view
	$wp_customize->add_setting('wpforge_single_thumb_display',array(
		'default' => 'no',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_single_thumb_display',
		'priority' => 5,		
	));
	$wp_customize->add_control('wpforge_single_thumb_display',array(
		'type' 		=> 'select',
		'label' 	=> __('Show single post view thumbnail?', 'wpforge'),
		'section' 	=> 'wpforge_layout',
		'choices' 	=> array(
			'no' 	=> __('No', 'wpforge'),
			'yes' 	=> __('Yes', 'wpforge'),
		),
	));
	// Number of posts to display on sitemap page
	$wp_customize->add_setting('wpforge_sitemap_count',array(
		'default' => '15',
		'priority' => 6,
	));
	$wp_customize->add_control('wpforge_sitemap_count',array(
		'label' => __('Site Map Page: Number of Posts to Display','wpforge'),
		'section' => 'wpforge_layout',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_sitemaptxt',
	));	
				
// The Footer Section
    $wp_customize->add_section('wpforge_footer',array(
		'title' => __('Footer','wpforge'),
		'description' => __('Modify the footer text of your theme.', 'wpforge'),
		'priority' => 50,
    ));
	$wp_customize->add_setting('wpforge_footer_text',array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'priority' => 1,
	));
	$wp_customize->add_control('wpforge_footer_text',array(
		'label' => __('Copyright Text','wpforge'),
		'section' => 'wpforge_footer',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_footer_text',
	));
	$wp_customize->add_setting('wpforge_footer_position',array(
		'default' => 'right',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 2,	
	));
	$wp_customize->add_control('wpforge_footer_position',array(
		'type' => 'select',
		'sanitize_callback' => 'wpforge_sanitize_footer_position',		
		'label' => __('Copyright Position', 'wpforge'),
		'section' => 'wpforge_footer',
		'choices' => array(
			'right'  	=> __('Text Right - Nav Left', 'wpforge'),
			'center' 	=> __('Text &amp; Nav Centered', 'wpforge'),
			'left'   	=> __('Text Left - Nav Right', 'wpforge'),			
		),
	));

// Background Section
    $wp_customize->add_section('wpforge_background', array(
		'title' => __('Background', 'wpforge'),
		'description' => __('Modify the background of your theme.', 'wpforge'),
		'priority' => 60,
     ));
	// Background Color	 
	$wp_customize->add_setting('wpforge_background_color', array(
        'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 1,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_background_color',array(
		'label' => __('Background Color', 'wpforge'),
		'section' => 'wpforge_background',
		'settings' => 'wpforge_background_color',
	)));	 
	// Background Image
	$wp_customize->add_setting('wpforge_background_img',array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'capability' => 'manage_options',
		'priority' => 2,						
	));	 
	$wp_customize->add_control(new WP_Customize_Image_Control($wp_customize,'wpforge_background_img',array(
		'label' => __('Background Image', 'wpforge'),
		'section' => 'wpforge_background',
		'settings' => 'wpforge_background_img',
	)));
	// Background Image Repeat			
	$wp_customize->add_setting( 'wpforge_background_repeat', array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_repeat',
		'capability' => 'manage_options',
		'priority' => 3,			
	));
	$wp_customize->add_control( 'wpforge_background_repeat', array(
		'label'      => __( 'Background Repeat','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'no-repeat'  => __('No Repeat', 'wpforge'),
			'repeat'     => __('Tile', 'wpforge'),
			'repeat-x'   => __('Tile Horizontally', 'wpforge'),
			'repeat-y'   => __('Tile Vertically', 'wpforge'),
		),
	));
	// Background Size
	$wp_customize->add_setting( 'wpforge_background_size', array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_size',
		'capability' => 'manage_options',
		'priority' => 4,			
	));
	$wp_customize->add_control( 'wpforge_background_size', array(
		'label'      => __( 'Background Size','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'cover'  => __('Cover', 'wpforge'),
			'contain'  => __('Contain', 'wpforge'),
		),
	));
	// Background Image Position	
	$wp_customize->add_setting( 'wpforge_background_position', array(
		'default'  => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_position',
		'capability' => 'manage_options',
		'priority' => 5,			
	));
	$wp_customize->add_control( 'wpforge_background_position', array(
		'label'      => __( 'Background Position','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'left'      => __('Left', 'wpforge'),
			'center'    => __('Center', 'wpforge'),
			'right'     => __('Right', 'wpforge'),
			'none'      => __('None', 'wpforge'),
		),
	));
	// Background Image Attachment	
	$wp_customize->add_setting( 'wpforge_background_attachment', array(
		'default'    => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_attachment',
		'capability' => 'manage_options',
		'priority' 	 => 6,			
	));
	$wp_customize->add_control( 'wpforge_background_attachment', array(
		'label'      => __( 'Background Attachment','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'scroll'    => __('Scroll', 'wpforge'),
			'fixed'     => __('Fixed', 'wpforge'),
		),
	));
	
// Colors Section
    $wp_customize->add_section('wpforge_colors', array(
		'title' => __('Colors', 'wpforge'),
		'description' => __('Change some default colors of your theme.', 'wpforge'),
		'priority' => 70,
     )); 	 	 
	// Title Color	 
	$wp_customize->add_setting('wpforge_title_color', array(
        'default' => '#444444',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 4,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_title_color',array(
		'label' => __('Title Color','wpforge'),
		'section' => 'wpforge_colors',
		'settings' => 'wpforge_title_color',
	)));
	// Text Color	 
	$wp_customize->add_setting('wpforge_text_color', array(
        'default' => '#444444',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 5,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_text_color',array(
		'label' => __('Text Color','wpforge'),
		'section' => 'wpforge_colors',
		'settings' => 'wpforge_text_color',
	)));	
	// Link Color	 
	$wp_customize->add_setting('wpforge_link_color', array(
        'default' => '#008cba',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 6,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_link_color',array(
		'label' => __('Link Color','wpforge'),
		'section' => 'wpforge_colors',
		'settings' => 'wpforge_link_color',
	)));
	// Link Hover Color	 
	$wp_customize->add_setting('wpforge_hover_color', array(
        'default' => '#0079a1',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 7,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hover_color',array(
		'label' => __('Link Hover Color','wpforge'),
		'section' => 'wpforge_colors',
		'settings' => 'wpforge_hover_color',
	)));			 
		
/*
 * Sanitation Section - This is where we add our sanitation functions for text inputs, check boxes, radio buttons and select lists
 * I like to keep them all in one area for organization.
 * 
 * @since WP-Forge 5.4
 */
 
/*
 * Header Sanitation Section
 */

 // Sanitize site title
function wpforge_sanitize_site_title( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize site description
function wpforge_sanitize_site_description( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Sanitize the option to show or not show header text
function wpforge_sanitize_headtxt( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

/*
 * Navigation Sanitation Section
 */

// Sanitize the the text input
function wpforge_sanitize_navtxt( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Layout Sanitation Section
function wpforge_sanitize_theme_width( $input ) { //theme width
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_sidebar_position( $input ) { //sidebar position
    $valid = array(
        'right' => 'Right',
		'left' 	=> 'Left',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_post_display( $input ) { // post display
    $valid = array(
        'full' => 'Full Post',
		'excerpt' => 'Excerpt',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_thumb_display( $input ) {
    $valid = array(
        'yes' => 'Yes',
		'no' => 'No',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_single_thumb_display( $input ) {
    $valid = array(
        'yes' => 'Yes',
		'no' => 'No',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_sitemaptxt( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Footer Sanitation Section
function wpforge_sanitize_footer_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_font_size( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
// Background Sanitation Section
function wpforge_sanitize_background_repeat( $input ) {
    $valid = array(
        'no-repeat' => 'No Repeat',
        'repeat' 	=> 'Tile',
		'repeat-x' 	=> 'Title Horizontally',
		'repeat-y' 	=> 'Tile Vertically',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_background_size( $input ) {
    $valid = array(
        'cover' => 'Cover',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_background_position( $input ) {
    $valid = array(
        'left' 	 => 'Left',
        'center' => 'Center',
		'right'  => 'Right',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_background_attachment( $input ) {
    $valid = array(
        'scroll' => 'Scroll',
        'fixed' => 'Fixed',
    );
 
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}	

/**
 * Add postMessage support for some sections of our Theme Customizer.
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 * 
 * @since WP-Forge 5.4
 */
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_setting( 'hide_headtxt' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_footer_text' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_img' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_repeat' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_size' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_position' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_attachment' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_title_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_text_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_hover_color' )->transport = 'postMessage';

}
add_action( 'customize_register', 'wpforge_customizer' ); // End WP-Forge Theme Customizer

/**
 * Modifies our styles and writes them in the <head> element of the page based on the WP-Forge Theme Customizer options
 * @author Anthony Wilhelm (@awshout)
 * @see https://github.com/awtheme/reactor
 *
 * @since WP-Forge 5.4
 */
function wpforge_customizer_css() {
	do_action('wpforge_customizer_css');
		
	$output = ''; $body_css = '';	
	
	if ( get_theme_mod('wpforge_background_color') ) {
	    $body_css .= 'background-color: ' . get_theme_mod('wpforge_background_color') . ';';
	}
	if ( get_theme_mod('wpforge_background_img') ) {
	    $body_css .= 'background-image: url("' . get_theme_mod('wpforge_background_img') . '");';
	}
	if ( get_theme_mod('wpforge_background_repeat') ) {
	    $body_css .= 'background-repeat: ' . get_theme_mod('wpforge_background_repeat') . ';';
	}	
	if ( get_theme_mod('wpforge_background_size') ) {
	    $body_css .= 'background-size: ' . get_theme_mod('wpforge_background_size') . ';';
	}	
	if ( get_theme_mod('wpforge_background_position') ) {
	    $body_css .= 'background-position: ' . get_theme_mod('wpforge_background_position') . ';';
	}	
	if ( get_theme_mod('wpforge_background_attachment') ) {
	    $body_css .= 'background-attachment: ' . get_theme_mod('wpforge_background_attachment') . ';';
	}		
	if ( get_theme_mod('wpforge_text_color') ) {
	    $body_css .= 'color: ' . get_theme_mod('wpforge_text_color') . ';';
	}
	if ( !empty( $body_css ) ) {
	    $output .= "\n" . 'body {' .  $body_css . '}';
	}
	if ( get_theme_mod('wpforge_theme_width') ) {
	    $output .= "\n" . '#wrapper {max-width: ' . get_theme_mod('wpforge_theme_width') . ';}';
	}
	if ( get_theme_mod('wpforge_sidebar_position') == 'left') {
	    $output .= "\n" . '#content.columns {float: right!important;} #secondary.columns {float: left!important;}';
	}
	if ( 0 == get_theme_mod('hide_headtxt', 1) ) {
	    $output .= "\n" . '.site-title, .site-description {display: none;}';
	}	
	if ( get_theme_mod('wpforge_title_color') ) {
	    $output .= "\n" . 'h1,h2,h3,h4,h5,h6 {color: ' . get_theme_mod('wpforge_title_color') . ';}';
	}		
	if ( get_theme_mod('wpforge_link_color') ) {
	    $output .= "\n" . 'a {color: ' . get_theme_mod('wpforge_link_color') . ';}';
	}
	if ( get_theme_mod('wpforge_hover_color') ) {
	    $output .= "\n" . 'a:hover {color: ' . get_theme_mod('wpforge_hover_color') . ';}';
	}
	
	echo ( $output ) ? '<style type="text/css">' . apply_filters('wpforge_customizer_css', $output) . "\n" . '</style>' . "\n" : '';
}
add_action('wp_head', 'wpforge_customizer_css');

/**
 * Registers our theme customizer preview with WordPress.
 *
 * @since WP-Forge 5.4
 */
function wpforge_customize_preview_js() {
	wp_enqueue_script('wpforge-customizer', get_template_directory_uri() . '/inc/customizer/js/theme-customizer.js', array('jquery', 'customize-preview' ),'5.4', true);
}
add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );

?>