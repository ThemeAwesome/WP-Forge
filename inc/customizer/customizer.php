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
* @since WP-Forge 5.2.0
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
$wp_customize->get_section('static_front_page')->description = __( 'Set up a front page of WP-Forge.', 'wpforge' );
 
/*
 * OK, now we can start building our own theme customizer.
 */

// Header Section
    $wp_customize->add_section('wpforge_header', array(
		'title' => __('Header', 'wpforge'),
		'description' => __('Modify the header portion of WP-Forge', 'wpforge'),
		'priority' => 10,
	));
	// Add Site Logo
	$wp_customize->add_setting('wpforge_logo',array(
		'default' => '',
		'type'           => 'theme_mod',
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
			'label'    => __('Site Title', 'reactor'),
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
			'label'    => __('Tagline', 'reactor'),
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
	 
// Navigation Section
	// Main Menu Position
	$wp_customize->add_setting('wpforge_nav_position',array(
		'default' => 'normal',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 110,	
	));
	$wp_customize->add_control('wpforge_nav_position',array(
		'type' => 'select',
		'label' => __('Main Menu Position', 'wpforge'),
		'section' => 'nav',
		'choices' => array(
			'normal' => 'Normal Position',
			'top'    => 'Top of Browser',
			'sticky'   => 'Contain-To-Grid Sticky',
		),
	));
	// Main Menu Display Type
	$wp_customize->add_setting('wpforge_nav_display',array(
		'default' => 'scroll',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
			'priority' => 120,		
	));
	$wp_customize->add_control('wpforge_nav_display',array(
		'type' => 'select',
		'label' => __('If Top of Browser, scroll or fixed?', 'wpforge'),
		'section' => 'nav',
		'choices' => array(
			'scroll' => 'Scroll',
			'fixed'  => 'Fixed',
		),
	));
	// Main Menu Main Link Anchor
	$wp_customize->add_setting('wpforge_nav_title',array(
		'default' => 'no',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 130,		
	));
	$wp_customize->add_control('wpforge_nav_title',array(
		'type' => 'select',
		'label' => __('Change text for Home Link?', 'wpforge'),
		'section' => 'nav',
		'choices' => array(
			'no' => 'No',
			'yes'  => 'Yes',
		),
	));
	// Main Menu Main Link Text
	$wp_customize->add_setting('wpforge_nav_text',array(
		'default' => '',
		'priority' => 140,
	));
	$wp_customize->add_control('wpforge_nav_text',array(
		'label' => __('If Yes, Add New Anchor Text','wpforge'),
		'section' => 'nav',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_navtxt',
	));	 						

// Off-Canvas Section
    $wp_customize->add_section('wpforge_off_canvas', array(
		'title' => __('Off-Canvas', 'wpforge'),
		'description' => __('Configure Off-Canvas mobile menu.', 'wpforge'),
		'priority' => 30,
	));
	// Use Off-Canvas for Mobile?
	$wp_customize->add_setting('wpforge_mobile_display',array(
		'default' => 'no',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 10,	
	));
	$wp_customize->add_control('wpforge_mobile_display',array(
		'type' => 'select',
		'label' => __('Use Off-Canvas for Mobile?', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices' => array(
			'no'	=> 'No',
			'yes'	=> 'Yes',
		),
	));
	// Off-Canvas Position	
	$wp_customize->add_setting('wpforge_mobile_position',array(
		'default' => 'left',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'priority' => 20,	
	));
	$wp_customize->add_control('wpforge_mobile_position',array(
		'type' => 'select',
		'label' => __('Display Off-Canvas Left or Right?', 'wpforge'),
		'section' => 'wpforge_off_canvas',
		'choices' => array(
			'left'	=> 'Left',
			'right'	=> 'Right',
		),
	));	
		
//The Post Section 
    $wp_customize->add_section('wpforge_posts',array(
		'title' => __('Posts', 'wpforge'),
		'description' => __('Modify how posts appear in WP-Forge.', 'wpforge'),
		'priority' => 40,
    ));
	$wp_customize->add_setting('wpforge_post_display',array(
		'default' => 'full',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_post_display',
		'priority' => 1,		
	));
	$wp_customize->add_control('wpforge_post_display',array(
		'type' => 'select',
		'label' => __('Display Full Post or Excerpt?', 'wpforge'),
		'section' => 'wpforge_posts',
		'choices' => array(
			'full' => 'Full Post',
			'excerpt' => 'Excerpt',
		),
	));
	$wp_customize->add_setting('wpforge_thumb_display',array(
		'default' => 'no',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_thumb_display',
		'priority' => 2,		
	));
	$wp_customize->add_control('wpforge_thumb_display',array(
		'type' => 'select',
		'label' => __('Display Post Thumbnails?', 'wpforge'),
		'section' => 'wpforge_posts',
		'choices' => array(
			'no' => 'No',
			'yes' => 'Yes',
		),
	));	
				
//The Footer Section
    $wp_customize->add_section('wpforge_footer',array(
		'title' => __('Footer','wpforge'),
		'description' => __('Modify the footer text of WP-Forge.', 'wpforge'),
		'priority' => 50,
    ));
	$wp_customize->add_setting('wpforge_footer_text',array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
	));
	$wp_customize->add_control('wpforge_footer_text',array(
		'label' => __('Copyright Text','wpforge'),
		'section' => 'wpforge_footer',
		'type' => 'text',
		'sanitize_callback' => 'wpforge_sanitize_footer_text',
	));

// Background Section
    $wp_customize->add_section('wpforge_background', array(
		'title' => __('Background', 'wpforge'),
		'description' => __('Modify the background of WP-Forge.', 'wpforge'),
		'priority' => 60,
     ));
	// Background Color	 
	$wp_customize->add_setting('wpforge_background_color', array(
        'default' => '#e6e6e6',
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
		'default' => 'repeat',
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
	// Background Image Position	
	$wp_customize->add_setting( 'wpforge_background_position', array(
		'default'  => 'left',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_position',
		'capability' => 'manage_options',
		'priority' => 4,			
	));
	$wp_customize->add_control( 'wpforge_background_position', array(
		'label'      => __( 'Background Position','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'left'       => __('Left', 'wpforge'),
			'center'     => __('Center', 'wpforge'),
			'right'      => __('Right', 'wpforge'),
		),
	));
	// Background Image Attachment	
	$wp_customize->add_setting( 'wpforge_background_attachment', array(
		'default'    => 'scroll',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'theme_supports' => 'wpforge-backgrounds',
		'sanitize_callback' => 'wpforge_sanitize_background_attachment',
		'capability' => 'manage_options',
		'priority' 	 => 5,			
	));
	$wp_customize->add_control( 'wpforge_background_attachment', array(
		'label'      => __( 'Background Attachment','wpforge' ),
		'section'    => 'wpforge_background',
		'type'       => 'select',
		'choices'    => array(
			'scroll'      => __('Scroll', 'wpforge'),
			'fixed'     => __('Fixed', 'wpforge'),
		),
	));
	
// Colors Section
    $wp_customize->add_section('wpforge_colors', array(
		'title' => __('Colors', 'wpforge'),
		'description' => __('Change some default colors of WP-Forge.', 'wpforge'),
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
		'label' => __('Hover Color','wpforge'),
		'section' => 'wpforge_colors',
		'settings' => 'wpforge_hover_color',
	)));			 
		
/*
 * Sanitize - Add a sanitation functions section for text inputs, check boxes, radio buttons and select lists
 * I like to keep them all in one area for organization.
 * 
 * @since WP-Forge 5.2.0
 */
 
 // Header Sanitation
function wpforge_sanitize_site_title( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_site_description( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_headtxt( $input ) {
    if ( $input == 1 ) {
        return 1;
    } else {
        return '';
    }
}

// Navigation Sanitation
function wpforge_sanitize_navtxt( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Post Sanitation
function wpforge_sanitize_post_display( $input ) {
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

// Footer Sanitation
function wpforge_sanitize_footer_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

// Background Sanitation
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
function wpforge_sanitize_background_position( $input ) {
    $valid = array(
        'left' => 'Left',
        'center' => 'Center',
		'right' => 'Right',
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
 * @since WP-Forge 5.2.0
 */
$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
$wp_customize->get_setting( 'hide_headtxt' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_footer_text' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_img' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_background_repeat' )->transport = 'postMessage';
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
 * @since WP-Forge 5.2.0
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
	if ( get_theme_mod('wpforge_background_repeat') && get_theme_mod('wpforge_background_repeat') != 'repeat') {
	    $body_css .= 'background-repeat: ' . get_theme_mod('wpforge_background_repeat') . ';';
	}
	if ( get_theme_mod('wpforge_background_position') && get_theme_mod('wpforge_background_position') != 'left') {
	    $body_css .= 'background-position: ' . get_theme_mod('wpforge_background_position') . ';';
	}
	if ( get_theme_mod('wpforge_background_attachment') && get_theme_mod('wpforge_background_attachment') != 'scroll') {
	    $body_css .= 'background-attachment: ' . get_theme_mod('wpforge_background_attachment') . ';';
	}	
	if ( get_theme_mod('wpforge_text_color') ) {
	    $body_css .= 'color: ' . get_theme_mod('wpforge_text_color') . ';';
	}
	if ( !empty( $body_css ) ) {
	    $output .= "\n" . 'body { ' .  $body_css . ' }';
	}
	if ( 0 == get_theme_mod('hide_headtxt', 1) ) {
	    $output .= "\n" . '.site-title, .site-description { display: none; }';
	}	
	if ( get_theme_mod('wpforge_title_color') ) {
	    $output .= "\n" . 'h1,h2,h3,h4,h5,h6 { color: ' . get_theme_mod('wpforge_title_color') . '; }';
	}		
	if ( get_theme_mod('wpforge_link_color') ) {
	    $output .= "\n" . 'a { color: ' . get_theme_mod('wpforge_link_color') . '; }';
	}
	if ( get_theme_mod('wpforge_hover_color') ) {
	    $output .= "\n" . 'a:hover { color: ' . get_theme_mod('wpforge_hover_color') . '; }';
	}			
	
	echo ( $output ) ? '<style>' . apply_filters('wpforge_customizer_css', $output) . "\n" . '</style>' . "\n" : '';
}
add_action('wp_head', 'wpforge_customizer_css');

/**
 * Registers WP-Forge Theme Customizer Preview with WordPress.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_customize_preview_js() {
	wp_enqueue_script('wpforge-customizer', get_template_directory_uri() . '/inc/customizer/js/theme-customizer.js', array('jquery', 'customize-preview' ),'1.0.0', true);
}
add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );

?>