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
* @since WP-Forge 5.5.0.1
*/

function wpforge_customize_register( $wp_customize ) {

// Change some of the defaults
$wp_customize->get_section('header_image')->panel = 'header'; // Add to Header Panel
$wp_customize->get_section('header_image')->priority = 40; // Shows before site title and tagline
$wp_customize->get_section('title_tagline')->priority = 50; // Shows after the Header image section
$wp_customize->get_section('title_tagline')->panel = 'header'; // Add to Header Panel
$wp_customize->get_section('background_image')->panel = 'background'; // Add to Background Panel
$wp_customize->get_section('nav')->panel = 'navigation'; // Add to Navigation Panel
$wp_customize->get_section('nav')->title = __( 'Main Navigation', 'wpforge' ); // Changed title of section
$wp_customize->get_section('nav')->priority = 10; // Changed priority so it shows first in the navigation panel
$wp_customize->get_section('colors')->panel = 'colors_panel'; // Add to Colors Panel
$wp_customize->get_section('colors')->priority = 10; // Changed priority so it shows first in color panel
$wp_customize->get_section('colors')->title = __( 'Default Colors', 'wpforge' ); // Changed title
$wp_customize->get_section('colors')->description = __( 'These are the default color settings for the custom header and custom background portion of your theme. These are standard in the customizer, meaning part of WordPress core.', 'wpforge' ); // chanhed description
$wp_customize->get_section('static_front_page')->panel = 'front'; // Add to Front Panel
$wp_customize->get_section('static_front_page')->description = __( 'Set up a front page for your theme.', 'wpforge' ); // Changed description


// Header Panel
$wp_customize->add_panel( 'header', array(
   'priority'       => 10,
   'capability'     => 'edit_theme_options',
   'theme_supports' => '',
   'title'          => __('Header Section', 'wpforge'),
   'description'    => __('In this section you can modify different aspects of the Header portion of your theme.', 'wpforge'),
));
	// Header Content Section
  $wp_customize->add_section('header_content', array(
		'title' => __('Header Wrapper', 'wpforge'),
		'description' => __('This is the main content area of your header. It is the area that contains the site title, site description and logo.You can change the width and background color of this area.', 'wpforge'),
		'priority' => 30,
		'panel' => 'header',
	));		
  // Header Width
  $wp_customize->add_setting('header_width',array(
    'default' => '64rem',
		'type' => 'theme_mod',
		'sanitize_callback' => 'wpforge_sanitize_text',
	));
	$wp_customize->add_control('header_width',array(
		'label' => __('Set width','wpforge'),
		'section' => 'header_content',
		'type' => 'text',
		'priority' => 10,
	));
	// Header Background Color	 
	$wp_customize->add_setting('header_color', array(
    'default' => '#ffffff',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 15,		
  ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'header_color',array(
		'label' => __('Set background color', 'wpforge'),
		'section' => 'header_content',
		'settings' => 'header_color',
	)));


// Background Image Panel
$wp_customize->add_panel( 'background', array(
  'priority'       => 20,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __('Background Section', 'wpforge'),
  'description'    => __( 'This is the default section of the customizer where you can upload an image to use for your themes background image. This section is also available via Appearance - Background. This section is standard in the customizer (part of WordPress core).', 'wpforge' ),
));

// Navigation Panel
$wp_customize->add_panel( 'navigation', array(
  'priority'       => 30,
  'capability'     => 'edit_theme_options',
  'theme_supports' => '',
  'title'          => __('Navigation Section', 'wpforge'),
  'description'    => __('The default Navigation section of the WordPress Customizer.', 'wpforge'),
));
  // Nav Wrapper Section
    $wp_customize->add_section('nav_content', array(
    'title' => __('Nav Wrapper', 'wpforge'),
    'priority' => 30,
    'panel' => 'navigation',
  ));
  // Nav Content Width
  $wp_customize->add_setting('nav_width',array(
    'default' => '64rem',
    'type' => 'theme_mod',
    'sanitize_callback' => 'wpforge_sanitize_text'
  ));
 $wp_customize->add_control('nav_width',array(
    'label' => __('Nav Width','wpforge'),
    'section' => 'nav_content',
    'type' => 'text',
    'capability' => 'manage_options',   
    'description' => __('Change the width of the navigation area of your theme.', 'wpforge'),
    'priority' => 10,
  ));
  // Nav Background Color  
  $wp_customize->add_setting('nav_wrap_main_color', array(
    'default' => '#333333',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'nav_wrap_main_color',array(
    'label' => __('Select Background Color', 'wpforge'),
    'section' => 'nav_content',
    'settings' => 'nav_wrap_main_color',
  )));
  // Top-Bar Section
  $wp_customize->add_section('top_bar', array(
    'title' => __('Top-Bar Settings', 'wpforge'),
    'description' => __('Configure the Top-Bar Navigation area of your theme.', 'wpforge'),
    'priority' => 40,
    'panel' => 'navigation',
  ));
  // Top-Bar Position
  $wp_customize->add_setting('wpforge_nav_position',array(
    'default' => 'normal',
    'type'    => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'wpforge_sanitize_nav_position',
    'priority' => 1,  
  ));
  $wp_customize->add_control('wpforge_nav_position',array(
    'type' => 'select',
    'label' => __('Main Menu Position', 'wpforge'),
    'section' => 'top_bar',
    'choices' => array(
      'normal' => __('Normal Position', 'wpforge'),
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
    'sanitize_callback' => 'wpforge_sanitize_nav_title',
    'priority' => 2,    
  ));
  $wp_customize->add_control('wpforge_nav_title',array(
    'type' => 'select',
    'label' => __('Change text for Home Link?', 'wpforge'),
    'section' => 'top_bar',
    'choices' => array(
      'no'  => __('No', 'wpforge'),
      'yes'   => __('Yes', 'wpforge'),
    ),
  ));
  // Top-Bar Main Link Text
  $wp_customize->add_setting('wpforge_nav_text',array(
    'default' => '',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'transport' => 'postMessage',    
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_nav_text',array(
    'label' => __('If Yes, Add New Anchor Text','wpforge'),
    'section' => 'top_bar',
    'type' => 'text',
  ));
  // Off-Canvas Section
    $wp_customize->add_section('off_canvas', array(
    'title' => __('Off-Canvas Settings', 'wpforge'),
    'description' => __('Configure Off-Canvas Navigation area of your theme.', 'wpforge'),
    'priority' => 50,
    'panel' => 'navigation',
  ));
  // Use Off-Canvas for Mobile?
  $wp_customize->add_setting('wpforge_mobile_display',array(
    'default' => 'no',
    'type'    => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_display',
    'priority' => 4,  
  ));
  $wp_customize->add_control('wpforge_mobile_display',array(
    'type' => 'select',
    'label' => __('Use Off-Canvas for Mobile?', 'wpforge'),
    'section' => 'off_canvas',
    'choices' => array(
      'no'  => __('No', 'wpforge'),
      'yes' => __('Yes', 'wpforge'),
    ),
  ));
  // Off-Canvas Hamburger Icon Position 
  $wp_customize->add_setting('wpforge_mobile_position',array(
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_position',
    'priority' => 5,  
  ));
  $wp_customize->add_control('wpforge_mobile_position',array(
    'type' => 'select',
    'label' => __('Display Off-Canvas Left or Right?', 'wpforge'),
    'section' => 'off_canvas',
    'choices' => array(
      'left'  => __('Left', 'wpforge'),
      'right' => __('Right', 'wpforge'),
    ),
  ));  

// Color Panel
	$wp_customize->add_panel( 'colors_panel', array(
	    'priority'       => 40,
	    'capability'     => 'edit_theme_options',
	    'theme_supports' => '',
	    'title'          => __('Colors Section', 'wpforge'),
	    'description'    => __('The default Colors section of the WordPress Customizer.', 'wpforge'),
	));
  // Header Link Colors Section
  $wp_customize->add_section('site_title_colors', array(
    'title' => __('Header Link Colors', 'wpforge'),
    'description' => __('Change the link and hover colors of the Site Title section of your theme.', 'wpforge'),
    'priority' => 50,
    'panel' => 'colors_panel',
  ));
  // Site Title Link Color  
  $wp_customize->add_setting('site_title_link_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 55,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_link_color',array(
    'label' => __('Site Title Link Color', 'wpforge'),
    'section' => 'site_title_colors',
    'settings' => 'site_title_link_color',
  )));
  // Site Title Hover Color  
  $wp_customize->add_setting('site_title_hover_color', array(
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 60,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_hover_color',array(
    'label' => __('Site Title Hover Color', 'wpforge'),
    'section' => 'site_title_colors',
    'settings' => 'site_title_hover_color',
  )));
    // Top-Bar Colors Section
  $wp_customize->add_section('top_bar_colors', array(
    'title' => __('Top-Bar Colors', 'wpforge'),
    'description' => __('Change the overall color, link, hover and active colors in the Top-Bar portion of your theme.', 'wpforge'),
    'priority' => 55,
    'panel' => 'colors_panel',
  ));
  // Top-Bar Main Color  
  $wp_customize->add_setting('top_bar_main_color', array(
    'default' => '#333333',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_main_color',array(
    'label' => __('Select Main Color', 'wpforge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_main_color',
  )));
  // Top-Bar Divider Color  
  $wp_customize->add_setting('top_bar_divider_color', array(
    'default' => '#4e4e4e',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_divider_color',array(
    'label' => __('Select Divider Color', 'wpforge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_divider_color',
  )));
  // Top-Bar Hover Color  
  $wp_customize->add_setting('top_bar_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hover_color',array(
    'label' => __('Select Hover Color', 'wpforge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_hover_color',
  )));
  // Top-Bar Active Color  
  $wp_customize->add_setting('top_bar_active_color', array(
    'default' => '#008cba',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_color',array(
    'label' => __('Select Active Color', 'wpforge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_active_color',
  )));
  // Top-Bar Active Hover Color  
  $wp_customize->add_setting('top_bar_active_hover_color', array(
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 25,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_hover_color',array(
    'label' => __('Select Active Hover Color', 'wpforge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_active_hover_color',
  )));

  // Content Colors Section
  $wp_customize->add_section('content_colors', array(
    'title' => __('Content Colors', 'wpforge'),
    'description' => __('Change text, link and hover colors in the Content section of your theme.', 'wpforge'),
    'priority' => 60,
    'panel' => 'colors_panel',
  ));
  // Content Font Color  
  $wp_customize->add_setting('content_font_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_font_color',array(
    'label' => __('Select Text Color', 'wpforge'),
    'section' => 'content_colors',
    'settings' => 'content_font_color',
  )));
  // Content Link Color  
  $wp_customize->add_setting('content_link_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_link_color',array(
    'label' => __('Select Link Color', 'wpforge'),
    'section' => 'content_colors',
    'settings' => 'content_link_color',
  )));
  // Content Link Hover Color  
  $wp_customize->add_setting('content_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_hover_color',array(
    'label' => __('Select Link Hover Color', 'wpforge'),
    'section' => 'content_colors',
    'settings' => 'content_hover_color',
  )));

  // Pagination Colors Section
  $wp_customize->add_section('pagination_colors', array(
    'title' => __('Pagination Colors', 'wpforge'),
    'description' => __('Change the current, link and hover colors of the pagination area of your theme.', 'wpforge'),
    'priority' => 70,
    'panel' => 'colors_panel',
  ));
  // Pagination Current Color  
  $wp_customize->add_setting('pagination_current_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',   
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_color',array(
    'label' => __('Current Background Color', 'wpforge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_color',
  )));
  // Pagination Current Font Color  
  $wp_customize->add_setting('pagination_current_font_color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod',   
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_font_color',array(
    'label' => __('Current Font Color', 'wpforge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_font_color',
  )));
  // Pagination Link Color  
  $wp_customize->add_setting('pagination_link_color', array(
    'default' => '#999999',
    'type' => 'theme_mod',    
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_color',array(
    'label' => __('Pagination Link Color', 'wpforge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_color',
  )));
  // Pagination Background Hover Color  
  $wp_customize->add_setting('pagination_hover_color', array(
    'default' => '#e6e6e6',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_hover_color',array(
    'label' => __('Pagination Background Hover Color', 'wpforge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_hover_color',
  )));
  // Pagination Link Hover Color  
  $wp_customize->add_setting('pagination_link_hover_color', array(
    'default' => '#999999',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 25,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_hover_color',array(
    'label' => __('Pagination Link Hover Color', 'wpforge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_hover_color',
  )));  

  // Sidebar Colors Section
  $wp_customize->add_section('sidebar_colors', array(
    'title' => __('Sidebar Colors', 'wpforge'),
    'description' => __('Change widget title, link and hover colors in the main sidebar area of your theme.', 'wpforge'),
    'priority' => 80,
    'panel' => 'colors_panel',
  ));
  // Widget Title Color  
  $wp_customize->add_setting('widget_title_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'widget_title_color',array(
    'label' => __('Sidebar Widget Title Color', 'wpforge'),
    'section' => 'sidebar_colors',
    'settings' => 'widget_title_color',
  )));
  // Widget Text Color  
  $wp_customize->add_setting('widget_text_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'widget_text_color',array(
    'label' => __('Sidebar Text Color', 'wpforge'),
    'section' => 'sidebar_colors',
    'settings' => 'widget_text_color',
  )));
  // Widget Link Color   
  $wp_customize->add_setting('widget_link_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'widget_link_color',array(
    'label' => __('Sidebar Link Color', 'wpforge'),
    'section' => 'sidebar_colors',
    'settings' => 'widget_link_color',
  )));
  // Widget Link Hover Color   
  $wp_customize->add_setting('widget_link_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'widget_link_hover_color',array(
    'label' => __('Sidebar Link Hover Color', 'wpforge'),
    'section' => 'sidebar_colors',
    'settings' => 'widget_link_hover_color',
  )));
  // Footer Sidebar Colors Section   
  $wp_customize->add_section('footer_sidebar_colors', array(
    'title' => __('Footer Sidebar Colors', 'wpforge'),
    'description' => __('Change widget title, link and hover colors in the Footer sidebar area of your theme.', 'wpforge'),
    'priority' => 90,
    'panel' => 'colors_panel',
  ));
  // Footer Sidebar Widget Title Color  
  $wp_customize->add_setting('footer_widget_title_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,       
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_title_color',array(
    'label' => __('Footer Sidebar Widget Title Color', 'wpforge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_title_color',
  )));
  // Footer Sidebar Text Color  
  $wp_customize->add_setting('footer_widget_text_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,       
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_text_color',array(
    'label' => __('Footer Sidebar Text Color', 'wpforge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_text_color',
  )));
  // Footer Sidebar Widget Link Color   
  $wp_customize->add_setting('footer_widget_link_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,       
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_color',array(
    'label' => __('Footer Sidebar Link Color', 'wpforge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_link_color',
  )));
  // Footer Sidebar Widget Link Hover Color   
  $wp_customize->add_setting('footer_widget_link_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,        
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_hover_color',array(
    'label' => __('Footer Sidebar Link Hover Color', 'wpforge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_link_hover_color',
  )));

  // Footer Colors Section   
  $wp_customize->add_section('footer_colors', array(
    'title' => __('Footer Colors', 'wpforge'),
    'description' => __('Change normal text, link and hover colors in the Footer section of your theme.', 'wpforge'),
    'priority' => 100,
    'panel' => 'colors_panel',
  ));
  // Footer Text Color   
  $wp_customize->add_setting('footer_text_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_text_color',array(
    'label' => __('Footer Text Color', 'wpforge'),
    'section' => 'footer_colors',
    'settings' => 'footer_text_color',
  )));
  // Footer Link Color   
  $wp_customize->add_setting('footer_link_color', array(
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_link_color',array(
    'label' => __('Footer Link Color', 'wpforge'),
    'section' => 'footer_colors',
    'settings' => 'footer_link_color',
  )));
  // Footer Hover Color   
  $wp_customize->add_setting('footer_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_hover_color',array(
    'label' => __('Footer Hover Color', 'wpforge'),
    'section' => 'footer_colors',
    'settings' => 'footer_hover_color',
  )));
  // Button Colors Section   
  $wp_customize->add_section('button_colors', array(
    'title' => __('Button Colors', 'wpforge'),
    'description' => __('Change the color and hover colors of submit buttons of your theme.', 'wpforge'),
    'priority' => 105,
    'panel' => 'colors_panel',
  ));
  // Button Color   
  $wp_customize->add_setting('button_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_color',array(
    'label' => __('Button Color', 'wpforge'),
    'section' => 'button_colors',
    'settings' => 'button_color',
  )));
    // Button Border Color   
  $wp_customize->add_setting('button_border_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_border_color',array(
    'label' => __('Button Border Color', 'wpforge'),
    'section' => 'button_colors',
    'settings' => 'button_border_color',
  )));
  // Button Hover Color   
  $wp_customize->add_setting('button_hover_color', array(
    'default' => '#272727',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_hover_color',array(
    'label' => __('Button Hover Color', 'wpforge'),
    'section' => 'button_colors',
    'settings' => 'button_hover_color',
  )));
  // Button Text Color   
  $wp_customize->add_setting('button_font_color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',    
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_font_color',array(
    'label' => __('Button Font Color', 'wpforge'),
    'section' => 'button_colors',
    'settings' => 'button_font_color',
  )));
  // Button Font Hover Color   
  $wp_customize->add_setting('button_font_hover_color', array(
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 50,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_font_hover_color',array(
    'label' => __('Button Font Hover Color', 'wpforge'),
    'section' => 'button_colors',
    'settings' => 'button_font_hover_color',
  )));  

// Front Page Panel
$wp_customize->add_panel( 'front', array(
    'priority'       => 50,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Front Page Section', 'wpforge'),
    'description'    => __('The default Front Page section of the WordPress Customizer.', 'wpforge'),
));

// Layout Panel
$wp_customize->add_panel( 'layout_panel', array(
    'priority'       => 70,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Content Section', 'wpforge'),
    'description'    => __('In this section you can modify different aspects of the cont portion of your theme.', 'wpforge'),
));
	// Content Section
    $wp_customize->add_section('content_layout', array(
		'title' => __('Content Wrapper', 'wpforge'),
		'description' => __('Change the width and the background color of the content area of your theme.', 'wpforge'),
		'priority' => 20,
		'panel' => 'layout_panel',
	));    
  // Content Width
	$wp_customize->add_setting('content_width',array(
		'default' => '64rem',
		'type' => 'theme_mod',
		'sanitize_callback' => 'wpforge_sanitize_text',
	));
	$wp_customize->add_control('content_width',array(
		'label' => __('Content Width','wpforge'),
		'section' => 'content_layout',
		'type' => 'text',
		'priority' => 10,
	));
	// Content Background Color	 
	$wp_customize->add_setting('content_color', array(
    'default' => '#ffffff',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 15,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_color',array(
		'label' => __('Content Background Color', 'wpforge'),
		'section' => 'content_layout',
		'settings' => 'content_color',
	)));
	// Posts Section
    $wp_customize->add_section('post_layout', array(
		'title' => __('Posts', 'wpforge'),
		'description' => __('Adjust certain aspects of posts in your theme.', 'wpforge'),
		'priority' => 30,
		'panel' => 'layout_panel',
	));    
    // Show full post or excerpts
	$wp_customize->add_setting('wpforge_post_display',array(
		'default' => 'full',
		'type' => 'theme_mod',
		'capability' => 'manage_options',		
		'sanitize_callback' => 'wpforge_sanitize_post_display',
		'priority' => 10,		
	));
	$wp_customize->add_control('wpforge_post_display',array(
		'type' => 'select',
		'label' => __('Show full post or excerpt?', 'wpforge'),
		'section' => 'post_layout',
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
		'priority' => 20,		
	));
	$wp_customize->add_control('wpforge_thumb_display',array(
		'type' => 'select',
		'label' => __('Display post thumbnails?', 'wpforge'),
		'section' => 'post_layout',
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
		'priority' => 30,		
	));
	$wp_customize->add_control('wpforge_single_thumb_display',array(
		'type' 		=> 'select',
		'label' 	=> __('Show single post view thumbnail?', 'wpforge'),
		'section' 	=> 'post_layout',
		'choices' 	=> array(
			'no' 	=> __('No', 'wpforge'),
			'yes' 	=> __('Yes', 'wpforge'),
		),
	));
	// Sidebar Section
    $wp_customize->add_section('sidebar_layout', array(
		'title' => __('Sidebar', 'wpforge'),
		'description' => __('Adjust the position of the main sidebar.', 'wpforge'),
		'priority' => 70,
		'panel' => 'layout_panel',
	));
  // Content Position
  $wp_customize->add_setting('wpforge_content_position',array(
    'default' => 'left',
    'type' => 'theme_mod',
    'capability' => 'manage_options',   
    'sanitize_callback' => 'wpforge_sanitize_content_position',   
  ));
  $wp_customize->add_control('wpforge_content_position',array(
    'type' => 'select',
    'label' => __('Content Position', 'wpforge'),
    'section' => 'sidebar_layout',
    'choices' => array(
      'left' => __('Left', 'wpforge'),
      'right'  => __('Right', 'wpforge'),
    ),
  ));

  // Site Map Section
    $wp_customize->add_section('site_map', array(
		'title' => __('Site Map', 'wpforge'),
		'description' => __('Select how many posts you want displayed on your Site Map page.', 'wpforge'),
		'priority' => 100,
		'panel' => 'layout_panel',
	));    
	// Number of posts to display on sitemap page
	$wp_customize->add_setting('wpforge_sitemap_count',array(
		'default' => '15',
		'type' => 'theme_mod',
		'capability' => 'manage_options',
		'sanitize_callback' => 'wpforge_sanitize_text',
	));
	$wp_customize->add_control('wpforge_sitemap_count',array(
		'label' => __('Number of posts to display?','wpforge'),
		'section' => 'site_map',
		'type' => 'text',
	));

// Footer Sidebar Panel
$wp_customize->add_panel( 'footer_sidebar_panel', array(
    'priority'       => 80,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Footer Sidebar Section', 'wpforge'),
    'description'    => __('In this section you can modify different aspects of the footer sidebar portion of your theme. This includes changing widget title colors as well as link and hover colors.', 'wpforge'),
));	
  $wp_customize->add_section('sidebar_content', array(
		'title' => __('Footer Sidebar Wrapper', 'wpforge'),
		'description' => __('Change the width and the background color of the Footer Sidebar content area.', 'wpforge'),
		'priority' => 20,
		'panel' => 'footer_sidebar_panel',
	));		
  // Footer Sidebar Content Width
	$wp_customize->add_setting('footer_sidebar_width',array(
		'default' => '64rem',
		'type' => 'theme_mod',
		'sanitize_callback' => 'wpforge_sanitize_text',
	));
	$wp_customize->add_control('footer_sidebar_width',array(
		'label' => __('Set width','wpforge'),
		'section' => 'sidebar_content',
		'type' => 'text',
		'capability' => 'manage_options',
		'priority' => 10,
	));
	// Footer Sidebar Background Color	 
	$wp_customize->add_setting('footer_sidebar_color', array(
        'default' => '#ffffff',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
        'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 15,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_sidebar_color',array(
		'label' => __('Set background color', 'wpforge'),
		'section' => 'sidebar_content',
		'settings' => 'footer_sidebar_color',
	)));
// Footer Panel
$wp_customize->add_panel( 'footer', array(
    'priority'       => 90,
    'capability'     => 'edit_theme_options',
    'theme_supports' => '',
    'title'          => __('Footer Section', 'wpforge'),
    'description'    => __('Modify different aspects of the Footer portion of your theme. This section deals with the Footer Sidebar area as well as the main Footer area of your theme.', 'wpforge'),
));
	// Footer Content Section	 
    $wp_customize->add_section('footer_content', array(
		'title' => __('Footer Wrapper', 'wpforge'),
		'description' => __('Change the width and the background color of the Footer content area.', 'wpforge'),
		'priority' => 40,
		'panel' => 'footer',
	));		
    // Footer Content Width
	$wp_customize->add_setting('footer_content_width',array(
		'default' => '64rem',
		'type' => 'theme_mod',
		'sanitize_callback' => 'wpforge_sanitize_text',
	));
	$wp_customize->add_control('footer_content_width',array(
		'label' => __('Set Width','wpforge'),
		'section' => 'footer_content',
		'type' => 'text',
		'capability' => 'manage_options',
		'priority' => 10,
	));
	// Footer Content Background Color	 
	$wp_customize->add_setting('footer_content_color', array(
    'default' => '#ffffff',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'capability' => 'manage_options',
    'sanitize_callback' => 'sanitize_hex_color',
		'priority' => 15,		
    ));
	$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_content_color',array(
		'label' => __('Set background color', 'wpforge'),
		'section' => 'footer_content',
		'settings' => 'footer_content_color',
	)));		
	// Footer Content Section
  $wp_customize->add_section('wpforge_footer',array(
  	'title' => __('Footer Content','wpforge'),
  	'description' => __('Change the footer text of your theme and select the position in which you want it to appear. ', 'wpforge'),
  	'priority' => 50,
  	'panel' => 'footer',
  ));
	$wp_customize->add_setting('wpforge_footer_text',array(
		'default' => '',
		'type' => 'theme_mod',
		'transport' => 'postMessage',
		'sanitize_callback' => 'wpforge_sanitize_text',
		'priority' => 1,
	));
	$wp_customize->add_control('wpforge_footer_text',array(
		'label' => __('Footer Text','wpforge'),
		'section' => 'wpforge_footer',
		'type' => 'textarea',
	));
  //Footer Text Position
	$wp_customize->add_setting('wpforge_footer_position',array(
		'default' => 'center',
		'type'    => 'theme_mod',
		'capability' => 'manage_options',
		'sanitize_callback' => 'wpforge_sanitize_footer_position',
		'priority' => 2,	
	));
	$wp_customize->add_control('wpforge_footer_position',array(
		'type' => 'select',
		'sanitize_callback' => 'wpforge_sanitize_footer_position',		
		'label' => __('Select position', 'wpforge'),
		'section' => 'wpforge_footer',
		'choices' => array(
			'right'  	=> __('Text Right - Nav Left', 'wpforge'),
			'center' 	=> __('Text &amp; Nav Centered', 'wpforge'),
			'left'   	=> __('Text Left - Nav Right', 'wpforge'),			
		),
	));		

/*
 * Sanitation Section - This is where we add our sanitation functions for text inputs, check boxes, radio buttons and select lists
 * I like to keep them all in one area for organization.
 * 
 * @since WP-Forge 5.5.0.1
 */

// Sanitize the the text input
function wpforge_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_nav_position( $input ) { // Nav Position
    $valid = array(
		'normal' => 'Normal Position',
		'top'    => 'Top of Browser - Scroll',
		'fixed'  => 'Top of Browser - Fixed',
		'sticky' => 'Contain-To-Grid-Sticky',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_nav_title( $input ) { // Nav Title
    $valid = array(
		'no' 	=> 'No',
		'yes' 	=> 'Yes',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_mobile_display( $input ) { // Mobile Display
    $valid = array(
		'no' => 'No',
		'yes'    => 'Yes',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_mobile_position( $input ) { // Mobile Position
    $valid = array(
		'left' 	=> 'Left',
		'right' => 'Right',
    );
	
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_content_position( $input ) { //sidebar position
    $valid = array(
    'left' => 'Left',
    'right'  => 'Right',
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
function wpforge_sanitize_thumb_display( $input ) { // Thumb Display
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
function wpforge_sanitize_single_thumb_display( $input ) { // Single Thumb Display
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
function wpforge_sanitize_footer_position( $input ) { // Footer Position
    $valid = array(
			'right'  	=> 'Text Right - Nav Left',
			'center' 	=> 'Text &amp; Nav Centered',
			'left'   	=> 'Text Left - Nav Right',
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
 * @since WP-Forge 5.5.0.1
 */
$wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_nav_text' )->transport = 'postMessage';
$wp_customize->get_setting( 'site_title_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'top_bar_main_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'content_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'content_font_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'content_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_sidebar_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_widget_text_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'wpforge_footer_text' )->transport = 'postMessage';
$wp_customize->get_setting( 'widget_title_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'widget_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_widget_title_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_widget_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_text_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'footer_link_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'button_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'button_border_color' )->transport = 'postMessage';
$wp_customize->get_setting( 'button_font_color' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wpforge_customize_register' );

/**
 * Modifies our styles and writes them in the <head> element of the page based on the WP-Forge Theme Customizer options
 *
 * @author Anthony Wilhelm (@awshout)
 * @see https://github.com/awtheme/reactor
 *
 * @since WP-Forge 5.5.0.1
 */
function wpforge_customize_css()
{
    ?>
<style type="text/css" id="wpforge-customizer-css">
  .header_wrap {max-width:<?php echo get_theme_mod('header_width','64rem'); ?>;background-color:<?php echo get_theme_mod('header_color','#ffffff'); ?>;width:100%;}.header-info h1 a {color:<?php echo get_theme_mod('site_title_link_color','#444444'); ?>;}.header-info a:hover {color:<?php echo get_theme_mod('site_title_hover_color','#0078a0'); ?>;}.nav_wrap {max-width:<?php echo get_theme_mod('nav_width','64rem'); ?>;background-color:<?php echo get_theme_mod('nav_wrap_main_color','#333333'); ?>;width:100%;}.top-bar,.top-bar-section ul li,.top-bar-section li:not(.has-form) a:not(.button),.top-bar-section ul li:hover:not(.has-form) > a,.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button) {background-color:<?php echo get_theme_mod('top_bar_main_color','#333333'); ?>;}.top-bar-section > ul > .divider, .top-bar-section > ul > [role="separator"] {border-right: solid 1px <?php echo get_theme_mod('top_bar_divider_color','#4e4e4e'); ?>;}.top-bar-section li:not(.has-form) a:not(.button):hover,.top-bar .name:hover,.top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button) {background-color:<?php echo get_theme_mod('top_bar_hover_color','#272727'); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button) {background-color:<?php echo get_theme_mod('top_bar_active_color','#008cba'); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button):hover {background-color:<?php echo get_theme_mod('top_bar_active_hover_color','#0078a0'); ?>;}.content_wrap {max-width:<?php echo get_theme_mod('content_width','64rem'); ?>; background-color:<?php echo get_theme_mod('content_color','#ffffff'); ?>;width:100%;}#content,#content h1,#content h2,#content h3,#content h4,#content h5,#content h6 {color:<?php echo get_theme_mod('content_font_color','#444444'); ?>;}#content a {color:<?php echo get_theme_mod('content_link_color','#444444'); ?>;}#content a:hover {color:<?php echo get_theme_mod('content_hover_color','#272727'); ?>;}#content ul.pagination li.current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a {background-color:<?php echo get_theme_mod('pagination_current_color','#444444'); ?>;color:<?php echo get_theme_mod('pagination_current_font_color','#ffffff'); ?>;}#content ul.pagination li a, #content ul.pagination li button {color:<?php echo get_theme_mod('pagination_link_color','#999999'); ?>;}#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus {color:<?php echo get_theme_mod('pagination_link_hover_color','#999999'); ?>;background-color:<?php echo get_theme_mod('pagination_hover_color','#e6e6e6'); ?>;}.sidebar_wrap {max-width:<?php echo get_theme_mod('footer_sidebar_width','64rem'); ?>;background-color:<?php echo get_theme_mod('footer_sidebar_color','#ffffff'); ?>;width:100%;}#content.columns {float:<?php echo get_theme_mod('wpforge_content_position','left'); ?>!important;}#secondary .widget-title {color:<?php echo get_theme_mod('widget_title_color','#444444'); ?>;}#secondary {color:<?php echo get_theme_mod('widget_text_color','#444444'); ?>}#secondary a {color:<?php echo get_theme_mod('widget_link_color','#444444'); ?>;}#secondary a:hover {color:<?php echo get_theme_mod('widget_link_hover_color','#272727'); ?>;}.footer_wrap {max-width:<?php echo get_theme_mod('footer_content_width','64rem'); ?>; background-color:<?php echo get_theme_mod('footer_content_color','#ffffff'); ?>;width:100%}#secondary-sidebar .widget-title {color:<?php echo get_theme_mod('footer_widget_title_color','#444444'); ?>;}#secondary-sidebar {color:<?php echo get_theme_mod('footer_widget_text_color','#444444'); ?>;}#secondary-sidebar a {color:<?php echo get_theme_mod('footer_widget_link_color','#444444'); ?>;}#secondary-sidebar a:hover {color:<?php echo get_theme_mod('footer_widget_link_hover_color','#272727'); ?>;}footer[role="contentinfo"] p {color:<?php echo get_theme_mod('footer_text_color','#444444'); ?>;}footer[role="contentinfo"] a {color:<?php echo get_theme_mod('footer_link_color','#444444'); ?>;}footer[role="contentinfo"] a:hover {color:<?php echo get_theme_mod('footer_hover_color','#272727'); ?>;}button, .button {background-color:<?php echo get_theme_mod('button_color','#333333'); ?>;}button,.button,#content a.button {border-color:<?php echo get_theme_mod('button_border_color','#333333'); ?>;}button,.button,#content a.button {color:<?php echo get_theme_mod('button_font_color','#ffffff'); ?>;}button:hover,button:focus,.button:hover,.button:focus {background-color:<?php echo get_theme_mod('button_hover_color','#272727'); ?>;}button:hover,button:focus,.button:hover,.button:focus {color:<?php echo get_theme_mod('button_font_hover_color','#ffffff'); ?>;}
</style>
    <?php
}
add_action( 'wp_head', 'wpforge_customize_css', 100);

/**
 * Registers our theme customizer preview with WordPress.
 *
 * @since WP-Forge 5.5.0.1
 */
function wpforge_customize_preview_js() {
	wp_enqueue_script( 'wpforge-customizer', get_template_directory_uri() . '/inc/customizer/js/theme-customizer.js', array( 'customize-preview' ), '5.5.0.1', true );
}
add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );

?>