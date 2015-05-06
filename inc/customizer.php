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
* @since WP-Forge 5.5.1.7
*/

/**
 * Table of Contents
 *
 * 1.0 - Defaults
 * 2.0 - Panels
 * 3.0 - Sections and Settings
 * 4.0 - Sanitation
 * 5.0 - Transport
 * 6.0 - CSS
 *
 */

function wpforge_customize_register( $wp_customize ) {

/**
 * 1.0 Defaults Site Description Color
 */
$wp_customize->get_section('header_image')->panel = 'wpforge_header'; // Add to Header Panel
$wp_customize->get_section('header_image')->priority = 40; // Shows before site title and tagline
$wp_customize->get_section('title_tagline')->priority = 50; // Shows after the Header image section
$wp_customize->get_section('title_tagline')->panel = 'wpforge_header'; // Add to Header Panel
$wp_customize->get_section('background_image')->panel = 'wpforge_background'; // Add to Background Panel
$wp_customize->get_section('nav')->panel = 'wpforge_navigation'; // Add to Navigation Panel
$wp_customize->get_section('nav')->title = __( 'Main Navigation', 'wp-forge' ); // Changed title of section
$wp_customize->get_section('nav')->priority = 10; // Changed priority so it shows first in the navigation panel
$wp_customize->get_section('colors')->panel = 'wpforge_colors'; // Add to Colors Panel
$wp_customize->get_section('colors')->priority = 10; // Changed priority so it shows first in color panel
$wp_customize->get_section('colors')->title = __( 'Header &amp; Background Colors', 'wp-forge' ); // Changed title
$wp_customize->get_section('static_front_page')->panel = 'wpforge_front_page'; // Add to Front Panel
$wp_customize->get_section('static_front_page')->description = __( 'Set the front page for your theme.', 'wp-forge' ); // Changed description

/**
 * 2.0 Panels
 */
$wp_customize->add_panel( 'wpforge_header', array(// Header Panel
    'priority'       => 1,
    'capability'     => 'edit_theme_options',
    'title'          => __('Header Section', 'wp-forge'),
    'description'    => __('Deals with the header portion of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_background', array(// Background Panel
    'priority'       => 2,
    'capability'     => 'edit_theme_options',
    'title'          => __('Background Image Section', 'wp-forge'),
    'description'    => __('Deals with the background of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_navigation', array(// Navigation Panel
    'priority'       => 3,
    'capability'     => 'edit_theme_options',
    'title'          => __('Navigation Section', 'wp-forge'),
    'description'    => __('Deals with the navigation area of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_colors', array(// Color Panel
    'priority'       => 4,
    'capability'     => 'edit_theme_options',
    'title'          => __('Colors Section', 'wp-forge'),
    'description'    => __('Deals with the colors of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_front_page', array(// Front Page Panel
    'priority'       => 5,
    'capability'     => 'edit_theme_options',
    'title'          => __('Front Page Section', 'wp-forge'),
    'description'    => __('Deals with setting up the front page of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_content', array(// Content Panel
    'priority'       => 6,
    'capability'     => 'edit_theme_options',
    'title'          => __('Content Section', 'wp-forge'),
    'description'    => __('Deals with the main content area of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_footer_sidebar', array(// Footer Sidebar Panel
    'priority'       => 7,
    'capability'     => 'edit_theme_options',
    'title'          => __('Footer Sidebar Section', 'wp-forge'),
    'description'    => __('Deals with the footer sidebar area of your theme.', 'wp-forge'),
));
$wp_customize->add_panel( 'wpforge_footer', array(// Footer Panel
    'priority'       => 8,
    'capability'     => 'edit_theme_options',
    'title'          => __('Footer Section', 'wp-forge'),
    'description'    => __('Deals with the footer area of your theme.', 'wp-forge'),
));

/**
 * 3.0 Sections and Settings
 */
$wp_customize->add_section('header_content', array(/* header content section */
  'title' => __('Header Content', 'wp-forge'),
  'description' => __('Main content area of your header, i.e site title, site description and logo.', 'wp-forge'),
  'priority' => 30,
  'panel' => 'wpforge_header',
));  
$wp_customize->add_setting('header_width',array(/* header width */
  'default' => '64rem',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',  
  'sanitize_callback' => 'wpforge_sanitize_text',
  'priority' => 15,  
));
$wp_customize->add_control('header_width',array(
  'label' => __('Set width (Default is 64rem)','wp-forge'),
  'section' => 'header_content',
  'type' => 'text',
)); 
$wp_customize->add_setting('header_color', array(/* header background color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'header_color',array(
  'label' => __('Header Content Background Color', 'wp-forge'),
  'section' => 'header_content',
  'settings' => 'header_color',
)));
$wp_customize->add_section('site_favicon', array(/* header content section */
  'title' => __('Site Favicon', 'wp-forge'),
  'description' => __('Upload a favicon for your site.', 'wp-forge'),
  'priority' => 35,
  'panel' => 'wpforge_header',
));
$wp_customize->add_setting('wpforge_favicon_url', array(
    'default'        => '',
    'capability'     => 'edit_theme_options',
    'type'           => 'theme_mod',
    'sanitize_callback' => 'wpforge_sanitize_uri',
));
$wp_customize->add_control( new WP_Customize_Image_Control($wp_customize, 'wpforge_favicon_url', array(
    'label'    => __('Favicon', 'wpforge'),
    'section'  => 'site_favicon',
    'settings' => 'wpforge_favicon_url',
)));
$wp_customize->add_section('nav_content', array(/* nav wrapper section */
  'title' => __('Nav Wrapper', 'wp-forge'),
  'priority' => 30,
  'panel' => 'wpforge_navigation',
  'description' => __('Change the width and background color of the navigation area of your theme.', 'wp-forge'),
));
$wp_customize->add_setting('nav_width',array(/* nav content width */
  'default' => '64rem',
  'type' => 'theme_mod',
  'sanitize_callback' => 'wpforge_sanitize_text'
));
$wp_customize->add_control('nav_width',array(
  'label' => __('Nav Width (Default is 64rem)','wp-forge'),
  'section' => 'nav_content',
  'type' => 'text',
  'capability' => 'edit_theme_options',
  'priority' => 10,
));  
$wp_customize->add_setting('nav_wrap_main_color', array(/* nav background color */
  'default' => '#333333',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 5,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'nav_wrap_main_color',array(
  'label' => __('Select Background Color', 'wp-forge'),
  'section' => 'nav_content',
  'settings' => 'nav_wrap_main_color',
)));
$wp_customize->add_section('top_bar', array(/* top-bar section */
  'title' => __('Top-Bar Settings', 'wp-forge'),
  'description' => __('Configure the Top-Bar Navigation area of your theme. Set the position and change the text of the Home link.', 'wp-forge'),
  'priority' => 40,
  'panel' => 'wpforge_navigation',
));
$wp_customize->add_setting('wpforge_nav_position',array(/* top-bar position */
  'default' => 'normal',
  'type'    => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'wpforge_sanitize_nav_position',
  'priority' => 1,  
));
$wp_customize->add_control('wpforge_nav_position',array(
  'type' => 'select',
  'label' => __('Main Menu Position', 'wp-forge'),
  'section' => 'top_bar',
  'choices' => array(
    'normal' => __('Normal Position', 'wp-forge'),
    'top'    => __('Top of Browser - Scroll', 'wp-forge'),
    'fixed'  => __('Top of Browser - Fixed', 'wp-forge'),
    'sticky' => __('Contain-To-Grid-Sticky', 'wp-forge'),
  ),
));
$wp_customize->add_setting('wpforge_nav_text',array(/* top-bar main link anchor text */
  'default' => 'Home',
  'sanitize_callback' => 'wpforge_sanitize_text',
  'transport' => 'postMessage',    
  'priority' => 2,
));
$wp_customize->add_control('wpforge_nav_text',array(
  'label' => __('Change text of Home link?','wp-forge'),
  'section' => 'top_bar',
  'type' => 'text',
));
$wp_customize->add_section('off_canvas', array(/* off-canvas section */
  'title' => __('Off-Canvas Settings', 'wp-forge'),
  'description' => __('Configure Off-Canvas Navigation area of your theme.', 'wp-forge'),
  'priority' => 50,
  'panel' => 'wpforge_navigation',
));
$wp_customize->add_setting('wpforge_mobile_display',array( /* off-canvas or mobile */
  'default' => 'no',
  'type'    => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'wpforge_sanitize_mobile_display',
  'priority' => 4,  
));
$wp_customize->add_control('wpforge_mobile_display',array(
  'type' => 'select',
  'label' => __('Use Off-Canvas for Mobile?', 'wp-forge'),
  'section' => 'off_canvas',
  'choices' => array(
    'no'  => __('No', 'wp-forge'),
    'yes' => __('Yes', 'wp-forge'),
  ),
));
$wp_customize->add_setting('wpforge_mobile_position',array(/* hamburger icon position */
  'default' => 'left',
  'type'    => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'wpforge_sanitize_mobile_position',
  'priority' => 5,  
));
$wp_customize->add_control('wpforge_mobile_position',array(
  'type' => 'select',
  'label' => __('Display Off-Canvas Left or Right?', 'wp-forge'),
  'section' => 'off_canvas',
  'choices' => array(
    'left'  => __('Left', 'wp-forge'),
    'right' => __('Right', 'wp-forge'),
  ),
));
$wp_customize->add_setting('site_title_link_color', array(/* site title link color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 1,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_link_color',array(
  'label' => __('Site Title Link Color', 'wp-forge'),
  'section' => 'colors',
  'settings' => 'site_title_link_color',
)));  
$wp_customize->add_setting('site_title_hover_color', array(/* site title hover color */
  'default' => '#0078a0',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 2,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_hover_color',array(
  'label' => __('Site Title Hover Color', 'wp-forge'),
  'section' => 'colors',
  'settings' => 'site_title_hover_color',
))); 
$wp_customize->add_section('top_bar_colors', array(/* top-bar colors section */
  'title' => __('Top-Bar Colors', 'wp-forge'),
  'description' => __('Change all colors of the Top-Bar.', 'wp-forge'),
  'priority' => 55,
  'panel' => 'wpforge_colors',
)); 
$wp_customize->add_setting('top_bar_main_color', array(/* top-bar main color */
  'default' => '#333333',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 5,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_main_color',array(
  'label' => __('Select Main Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_main_color',
)));  
$wp_customize->add_setting('top_bar_divider_color', array(/* top-bar divider color */
  'default' => '#4e4e4e',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_divider_color',array(
  'label' => __('Select Divider Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_divider_color',
))); 
$wp_customize->add_setting('top_bar_hover_color', array(/* top-bar hover color */
  'default' => '#272727',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 15,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hover_color',array(
  'label' => __('Select Hover Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_hover_color',
))); 
$wp_customize->add_setting('top_bar_active_color', array(/* top-bar active color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_color',array(
  'label' => __('Select Top-Bar Active Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_active_color',
)));
$wp_customize->add_setting('top_bar_active_hover_color', array(/* top-bar active hover color */
  'default' => '#272727',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 25,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_hover_color',array(
  'label' => __('Select Top-Bar Active Hover Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_active_hover_color',
)));
$wp_customize->add_setting('top_bar_font_color', array(/* top-bar active hover color */
  'default' => '#ffffff',
  'type' => 'theme_mod',  
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_color',array(
  'label' => __('Select Top-Bar Font Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_font_color',
)));
$wp_customize->add_setting('top_bar_font_hover_color', array(/* top-bar active hover color */
  'default' => '#ffffff',
  'type' => 'theme_mod',  
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 35,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_hover_color',array(
  'label' => __('Select Top-Bar Font Hover Color', 'wp-forge'),
  'section' => 'top_bar_colors',
  'settings' => 'top_bar_font_hover_color',
)));
$wp_customize->add_section('content_colors', array(/* content color section */
  'title' => __('Content Colors', 'wp-forge'),
  'description' => __('Change text, link and hover colors in the Content section of your theme.', 'wp-forge'),
  'priority' => 60,
  'panel' => 'wpforge_colors',
)); 
$wp_customize->add_setting('content_font_color', array(/* content font color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_font_color',array(
  'label' => __('Select Text Color', 'wp-forge'),
  'section' => 'content_colors',
  'settings' => 'content_font_color',
))); 
$wp_customize->add_setting('content_link_color', array(/* content link color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_link_color',array(
  'label' => __('Select Link Color', 'wp-forge'),
  'section' => 'content_colors',
  'settings' => 'content_link_color',
)));
$wp_customize->add_setting('content_hover_color', array(/*content link hover color */
  'default' => '#007095',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_hover_color',array(
  'label' => __('Select Link Hover Color', 'wp-forge'),
  'section' => 'content_colors',
  'settings' => 'content_hover_color',
)));
$wp_customize->add_section('pagination_colors', array(/* pagination color section */
  'title' => __('Pagination Colors', 'wp-forge'),
  'description' => __('Deals with the colors of built-in pgination.', 'wp-forge'),
  'priority' => 70,
  'panel' => 'wpforge_colors',
));  
$wp_customize->add_setting('pagination_current_color', array(/* pagination current color */
  'default' => '#008cba',
  'type' => 'theme_mod',   
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 5,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_color',array(
  'label' => __('Current Background Color', 'wp-forge'),
  'section' => 'pagination_colors',
  'settings' => 'pagination_current_color',
)));  
$wp_customize->add_setting('pagination_current_font_color', array(/* pagination current font color */
  'default' => '#ffffff',
  'type' => 'theme_mod',   
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_font_color',array(
  'label' => __('Current Font Color', 'wp-forge'),
  'section' => 'pagination_colors',
  'settings' => 'pagination_current_font_color',
))); 
$wp_customize->add_setting('pagination_link_color', array(/* pagination link color */
  'default' => '#999999',
  'type' => 'theme_mod',    
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 15,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_color',array(
  'label' => __('Pagination Link Color', 'wp-forge'),
  'section' => 'pagination_colors',
  'settings' => 'pagination_link_color',
)));  
$wp_customize->add_setting('pagination_hover_color', array(/* pagination background hover color */
  'default' => '#e6e6e6',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_hover_color',array(
  'label' => __('Pagination Background Hover Color', 'wp-forge'),
  'section' => 'pagination_colors',
  'settings' => 'pagination_hover_color',
)));  
$wp_customize->add_setting('pagination_link_hover_color', array(/* pagination link hover color */
  'default' => '#999999',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 25,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_hover_color',array(
  'label' => __('Pagination Link Hover Color', 'wp-forge'),
  'section' => 'pagination_colors',
  'settings' => 'pagination_link_hover_color',
)));
$wp_customize->add_section('main_sidebar_colors', array(/* sidebar colors section */
  'title' => __('Main Sidebar Colors', 'wp-forge'),
  'description' => __('Change widget title, link and hover colors of main sidebar.', 'wp-forge'),
  'priority' => 80,
  'panel' => 'wpforge_colors',
));  
$wp_customize->add_setting('main_widget_title_color', array(/* widget title color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_title_color',array(
  'label' => __('Sidebar Widget Title Color', 'wp-forge'),
  'section' => 'main_sidebar_colors',
  'settings' => 'main_widget_title_color',
))); 
$wp_customize->add_setting('main_widget_text_color', array(/* widget text color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_text_color',array(
  'label' => __('Sidebar Text Color', 'wp-forge'),
  'section' => 'main_sidebar_colors',
  'settings' => 'main_widget_text_color',
)));  
$wp_customize->add_setting('main_widget_link_color', array(/* widget link color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_link_color',array(
  'label' => __('Sidebar Link Color', 'wp-forge'),
  'section' => 'main_sidebar_colors',
  'settings' => 'main_widget_link_color',
)));  
$wp_customize->add_setting('main_widget_hover_color', array(/* widget link hover color */
  'default' => '#007095',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 40,    
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_hover_color',array(
  'label' => __('Sidebar Link Hover Color', 'wp-forge'),
  'section' => 'main_sidebar_colors',
  'settings' => 'main_widget_hover_color',
))); 
$wp_customize->add_section('footer_sidebar_colors', array(/* footer sidebar colors section */
  'title' => __('Footer Sidebar Colors', 'wp-forge'),
  'description' => __('Change widget title, link and hover colors in Footer sidebar.', 'wp-forge'),
  'priority' => 90,
  'panel' => 'wpforge_colors',
));  
$wp_customize->add_setting('footer_widget_title_color', array(/* footer sidebar widget title color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,       
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_title_color',array(
  'label' => __('Footer Sidebar Widget Title Color', 'wp-forge'),
  'section' => 'footer_sidebar_colors',
  'settings' => 'footer_widget_title_color',
))); 
$wp_customize->add_setting('footer_widget_text_color', array(/* footer sidebar text color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,       
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_text_color',array(
  'label' => __('Footer Sidebar Text Color', 'wp-forge'),
  'section' => 'footer_sidebar_colors',
  'settings' => 'footer_widget_text_color',
)));  
$wp_customize->add_setting('footer_widget_link_color', array(/* footer sidebar widget link color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,       
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_color',array(
  'label' => __('Footer Sidebar Link Color', 'wp-forge'),
  'section' => 'footer_sidebar_colors',
  'settings' => 'footer_widget_link_color',
)));   
$wp_customize->add_setting('footer_widget_link_hover_color', array(/* footer sidebar widget link hover color*/
  'default' => '#007095',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 40,        
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_hover_color',array(
  'label' => __('Footer Sidebar Link Hover Color', 'wp-forge'),
  'section' => 'footer_sidebar_colors',
  'settings' => 'footer_widget_link_hover_color',
)));   
$wp_customize->add_section('footer_colors', array(/* footer colors section */
  'title' => __('Footer Colors', 'wp-forge'),
  'description' => __('Change text, link and hover colors in the Footer.', 'wp-forge'),
  'priority' => 100,
  'panel' => 'wpforge_colors',
));  
$wp_customize->add_setting('footer_text_color', array(/* footer text color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_text_color',array(
  'label' => __('Footer Text Color', 'wp-forge'),
  'section' => 'footer_colors',
  'settings' => 'footer_text_color',
)));   
$wp_customize->add_setting('footer_link_color', array(/* footer link color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_link_color',array(
  'label' => __('Footer Link Color', 'wp-forge'),
  'section' => 'footer_colors',
  'settings' => 'footer_link_color',
)));  
$wp_customize->add_setting('footer_hover_color', array(/* footer hover color */
  'default' => '#007095',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_hover_color',array(
  'label' => __('Footer Hover Color', 'wp-forge'),
  'section' => 'footer_colors',
  'settings' => 'footer_hover_color',
)));  
$wp_customize->add_section('button_colors', array( /* button colors section */
  'title' => __('Button Colors', 'wp-forge'),
  'description' => __('Change color and hover colors of default buttons. Affects Magellan and Sub Navs.', 'wp-forge'),
  'priority' => 105,
  'panel' => 'wpforge_colors',
)); 
$wp_customize->add_setting('button_color', array(/* button color */
  'default' => '#008cba',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 10,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_color',array(
  'label' => __('Button Color', 'wp-forge'),
  'section' => 'button_colors',
  'settings' => 'button_color',
)));   
$wp_customize->add_setting('button_hover_color', array(/* button hover color */
  'default' => '#007095',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 20,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_hover_color',array(
  'label' => __('Button Hover Color', 'wp-forge'),
  'section' => 'button_colors',
  'settings' => 'button_hover_color',
)));  
$wp_customize->add_setting('button_font_color', array(/* button text color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',    
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 30,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_font_color',array(
  'label' => __('Button Font Color', 'wp-forge'),
  'section' => 'button_colors',
  'settings' => 'button_font_color',
)));   
$wp_customize->add_setting('button_font_hover_color', array(/* button font hover color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 40,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'button_font_hover_color',array(
  'label' => __('Button Font Hover Color', 'wp-forge'),
  'section' => 'button_colors',
  'settings' => 'button_font_hover_color',
)));
$wp_customize->add_section('backtotop_colors', array(/* back to top section or btt */
  'title' => __('Back To Top Colors', 'wp-forge'),
  'description' => __('Change the color and hover colors of the back to top button.', 'wp-forge'),
  'priority' => 110,
  'panel' => 'wpforge_colors',
));  
$wp_customize->add_setting('backtotop_color', array(/* btt color */
  'default' => '#888888',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 1,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_color',array(
  'label' => __('Back To Top Color', 'wp-forge'),
  'section' => 'backtotop_colors',
  'settings' => 'backtotop_color',
)));  
$wp_customize->add_setting('backtotop_hover_color', array(/* back to top hover color */
  'default' => '#444444',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 2,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_hover_color',array(
  'label' => __('Back To Top Hover Color', 'wp-forge'),
  'section' => 'backtotop_colors',
  'settings' => 'backtotop_hover_color',
)));  
$wp_customize->add_setting('backtotop_font_color', array(/* back to top font color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 3,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_font_color',array(
  'label' => __('Back To Top Font Color', 'wp-forge'),
  'section' => 'backtotop_colors',
  'settings' => 'backtotop_font_color',
)));   
$wp_customize->add_setting('backtotop_font_hover_color', array(/* btt font hover color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 4,   
));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_font_hover_color',array(
  'label' => __('Back To Top Font Hover Color', 'wp-forge'),
  'section' => 'backtotop_colors',
  'settings' => 'backtotop_font_hover_color',
)));
  $wp_customize->add_section('content_layout', array(/* content section */
  'title' => __('Content Wrapper', 'wp-forge'),
  'description' => __('Change width and background color of main content area.', 'wp-forge'),
  'priority' => 20,
  'panel' => 'wpforge_content',
));    
$wp_customize->add_setting('content_width',array(/* content width */
  'default' => '64rem',
  'type' => 'theme_mod',
  'sanitize_callback' => 'wpforge_sanitize_text',
));
$wp_customize->add_control('content_width',array(
  'label' => __('Content Width (Default is 64rem)','wp-forge'),
  'section' => 'content_layout',
  'type' => 'text',
  'priority' => 10,
)); 
$wp_customize->add_setting('content_color', array( /* content background color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 15,   
  ));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_color',array(
  'label' => __('Content Background Color', 'wp-forge'),
  'section' => 'content_layout',
  'settings' => 'content_color',
)));
  $wp_customize->add_section('post_layout', array(/* posts section */
  'title' => __('Posts', 'wp-forge'),
  'description' => __('Deals with posts in your theme.', 'wp-forge'),
  'priority' => 30,
  'panel' => 'wpforge_content',
));
$wp_customize->add_setting('wpforge_post_display',array(/* full post or excerpt */
  'default' => 'full',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',   
  'sanitize_callback' => 'wpforge_sanitize_post_display',
  'priority' => 10,   
));
$wp_customize->add_control('wpforge_post_display',array(
  'type' => 'select',
  'label' => __('Show full post or excerpt?', 'wp-forge'),
  'section' => 'post_layout',
  'choices' => array(
    'full'    => __('Full Post', 'wp-forge'),
    'excerpt' => __('Excerpt', 'wp-forge'),
  ),
));
$wp_customize->add_setting('wpforge_thumb_display',array(/* display thumbs on index page */
  'default' => 'no',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',   
  'sanitize_callback' => 'wpforge_sanitize_thumb_display',
  'priority' => 20,   
));
$wp_customize->add_control('wpforge_thumb_display',array(
  'type' => 'select',
  'label' => __('Display post thumbnails?', 'wp-forge'),
  'section' => 'post_layout',
  'choices' => array(
    'no'  => __('No', 'wp-forge'),
    'yes'   => __('Yes', 'wp-forge'),
  ),
));
$wp_customize->add_setting('wpforge_single_thumb_display',array(/* display thumbs in single post view */
  'default' => 'no',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',   
  'sanitize_callback' => 'wpforge_sanitize_single_thumb_display',
  'priority' => 30,   
));
$wp_customize->add_control('wpforge_single_thumb_display',array(
  'type'    => 'select',
  'label'   => __('Show single post view thumbnail?', 'wp-forge'),
  'section'   => 'post_layout',
  'choices'   => array(
    'no'  => __('No', 'wp-forge'),
    'yes'   => __('Yes', 'wp-forge'),
  ),
));
$wp_customize->add_setting('wpforge_post_nav_display',array(/* post navigation */
  'default' => 'default',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',   
  'sanitize_callback' => 'wpforge_sanitize_wpforge_post_nav_display',
  'priority' => 40,   
));
$wp_customize->add_control('wpforge_post_nav_display',array(
  'type'    => 'select',
  'label'   => __('Default Post Navigation or PageNavi?', 'wp-forge'),
  'section'   => 'post_layout',
  'choices'   => array(
    'default'   => __('Default', 'wp-forge'),
    'pagenavi'  => __('PageNavi', 'wp-forge'),
  ),
));
$wp_customize->add_section('sidebar_layout', array(/* sidebar section */
  'title' => __('Sidebar', 'wp-forge'),
  'description' => __('Adjust the position of the main sidebar.', 'wp-forge'),
  'priority' => 70,
  'panel' => 'wpforge_content',
));
$wp_customize->add_setting('wpforge_content_position',array(/* content position */
  'default' => 'left',
  'type' => 'theme_mod',
  'capability' => 'edit_theme_options',   
  'sanitize_callback' => 'wpforge_sanitize_content_position',   
));
$wp_customize->add_control('wpforge_content_position',array(
  'type' => 'select',
  'label' => __('Content Position', 'wp-forge'),
  'section' => 'sidebar_layout',
  'choices' => array(
    'left' => __('Left', 'wp-forge'),
    'right'  => __('Right', 'wp-forge'),
  ),
));
$wp_customize->add_section('sidebar_content', array(/* fs content section */
  'title' => __('Footer Sidebar Content', 'wp-forge'),
  'description' => __('The main content area of the Footer Sidebar.', 'wp-forge'),
  'priority' => 20,
  'panel' => 'wpforge_footer_sidebar',
));
$wp_customize->add_setting('footer_sidebar_width',array(/* fs content width */
  'default' => '64rem',
  'type' => 'theme_mod',
  'sanitize_callback' => 'wpforge_sanitize_text',
));
$wp_customize->add_control('footer_sidebar_width',array(
  'label' => __('Set width (Default is 64rem)','wp-forge'),
  'section' => 'sidebar_content',
  'type' => 'text',
  'capability' => 'edit_theme_options',
  'priority' => 10,
));  
$wp_customize->add_setting('footer_sidebar_color', array(/* fs contet background color */ 
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 15,   
  ));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_sidebar_color',array(
  'label' => __('Set background color', 'wp-forge'),
  'section' => 'sidebar_content',
  'settings' => 'footer_sidebar_color',
)));  
$wp_customize->add_section('footer_content', array(/* footer content section */
  'title' => __('Footer Content', 'wp-forge'),
  'description' => __('Deals with the content area of the footer.', 'wp-forge'),
  'priority' => 40,
  'panel' => 'wpforge_footer',
));
$wp_customize->add_setting('footer_content_width',array(/* footer content width */
  'default' => '64rem',
  'type' => 'theme_mod',
  'sanitize_callback' => 'wpforge_sanitize_text',
));
$wp_customize->add_control('footer_content_width',array(
  'label' => __('Set Width (Default is 64rem)','wp-forge'),
  'section' => 'footer_content',
  'type' => 'text',
  'capability' => 'edit_theme_options',
  'priority' => 10,
));   
$wp_customize->add_setting('footer_content_color', array(/* footer content background color */
  'default' => '#ffffff',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'sanitize_hex_color',
  'priority' => 15,   
  ));
$wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_content_color',array(
  'label' => __('Set background color', 'wp-forge'),
  'section' => 'footer_content',
  'settings' => 'footer_content_color',
)));
$wp_customize->add_setting('wpforge_footer_text',array(/* footer text */
  'default' => '',
  'type' => 'theme_mod',
  'transport' => 'postMessage',
  'sanitize_callback' => 'wpforge_sanitize_text',
  'priority' => 20,
));
$wp_customize->add_control('wpforge_footer_text',array(
  'label' => __('Footer Text','wp-forge'),
  'section' => 'footer_content',
  'type' => 'textarea',
));
$wp_customize->add_setting('wpforge_footer_position',array(/* footer text position */
  'default' => 'center',
  'type'    => 'theme_mod',
  'capability' => 'edit_theme_options',
  'sanitize_callback' => 'wpforge_sanitize_footer_position',
  'priority' => 25, 
));
$wp_customize->add_control('wpforge_footer_position',array(
  'type' => 'select',   
  'label' => __('Select position', 'wp-forge'),
  'section' => 'footer_content',
  'choices' => array(
    'center'  => __('Text &amp; Nav Centered', 'wp-forge'),      
    'right'   => __('Text Right - Nav Left', 'wp-forge'),
    'left'    => __('Text Left - Nav Right', 'wp-forge'),      
  ),
));

/**
 * 4.0 Sanitation
 *
 */
function wpforge_sanitize_uri($uri) {
  if('' === $uri){
    return '';
  }
  return esc_url_raw($uri);
}
function wpforge_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
function wpforge_sanitize_nav_position( $input ) { // Nav Position
    $valid = array(
      'normal' => __('Normal Position', 'wp-forge'),
      'top'    => __('Top of Browser - Scroll', 'wp-forge'),
      'fixed'  => __('Top of Browser - Fixed', 'wp-forge'),
      'sticky' => __('Contain-To-Grid-Sticky', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_nav_title( $input ) { // Nav Title
    $valid = array(
      'no'  => __('No', 'wp-forge'),
      'yes' => __('Yes', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_mobile_display( $input ) { // Mobile Display
    $valid = array(
      'no'  => __('No', 'wp-forge'),
      'yes' => __('Yes', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_mobile_position( $input ) { // Mobile Position
    $valid = array(
      'left'  => __('Left', 'wp-forge'),
      'right' => __('Right', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_content_position( $input ) { //sidebar position
    $valid = array(
      'left'  => __('Left', 'wp-forge'),
      'right' => __('Right', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_post_display( $input ) { // post display
    $valid = array(
      'full'    => __('Full Post', 'wp-forge'),
      'excerpt' => __('Excerpt', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_thumb_display( $input ) { // Thumb Display
    $valid = array(
      'yes' => __('Yes', 'wp-forge'),
      'no'  => __('No', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_single_thumb_display( $input ) { // Single Thumb Display
    $valid = array(
      'yes' => __('Yes', 'wp-forge'),
      'no'  => __('No', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_wpforge_post_nav_display( $input ) { // Default Post Nav Display
    $valid = array(
      'default'   => __('Default', 'wp-forge'),
      'pagenavi'  => __('PageNavi', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}
function wpforge_sanitize_footer_position( $input ) { // Footer Position
    $valid = array(
      'center'  => __('Text &amp; Nav Centered', 'wp-forge'),      
      'right'   => __('Text Right - Nav Left', 'wp-forge'),
      'left'    => __('Text Left - Nav Right', 'wp-forge'),
    );
  
    if ( array_key_exists( $input, $valid ) ) {
        return $input;
    } else {
        return '';
    }
}

/**
 * 5.0 - Transport
 *
 */
  $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
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
  $wp_customize->get_setting( 'main_widget_title_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'main_widget_link_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'main_widget_text_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'footer_widget_title_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'footer_widget_link_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'footer_text_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'footer_link_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'button_color' )->transport = 'postMessage';
  $wp_customize->get_setting( 'button_font_color' )->transport = 'postMessage';
}
add_action( 'customize_register', 'wpforge_customize_register' );

/**
 * 6.0 CSS
 */

/**
 * Modifies our styles and writes them in the <head> element of the page based on the WP-Forge Theme Customizer
 * options.
 *
 * @see http://codex.wordpress.org/Theme_Customization_API
 * @since WP-Forge 5.5.1.7
 */
function wpforge_customize_css() { ?>
<style type="text/css" id="wpforge-customizer-css">.header_wrap{max-width:<?php echo esc_attr(get_theme_mod('header_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('header_color','#ffffff')); ?>;}.site-title a{color:<?php echo esc_attr(get_theme_mod('site_title_link_color','#444444')); ?>;}.site-title a:hover{color:<?php echo esc_attr(get_theme_mod('site_title_hover_color','#0078a0')); ?>;}.site-description{color:#<?php echo esc_attr(get_theme_mod('header_textcolor','#444444')); ?>;}.nav_wrap,.contain-to-grid .top-bar{max-width:<?php echo esc_attr(get_theme_mod('nav_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('nav_wrap_main_color','#333333')); ?>;}.top-bar,.top-bar-section ul li,.top-bar-section li:not(.has-form) a:not(.button),.top-bar-section ul li:hover:not(.has-form) > a,.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button),.contain-to-grid {background-color:<?php echo esc_attr(get_theme_mod('top_bar_main_color','#333333')); ?>;}.top-bar-section > ul > .divider,.top-bar-section > ul > [role="separator"] {border-right: solid 1px <?php echo esc_attr(get_theme_mod('top_bar_divider_color','#4e4e4e')); ?>;}.top-bar-section li:not(.has-form) a:not(.button):hover,.top-bar .name:hover,.top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button) {background-color:<?php echo esc_attr(get_theme_mod('top_bar_hover_color','#272727')); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button){background-color:<?php echo esc_attr(get_theme_mod('top_bar_active_color','#008cba')); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button):hover {background-color:<?php echo esc_attr(get_theme_mod('top_bar_active_hover_color','#0078a0')); ?>;}.top-bar .name a,.top-bar-section ul li > a,.top-bar-section li.active:not(.has-form) a:not(.button),.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button) {color:<?php echo esc_attr(get_theme_mod('top_bar_font_color','#ffffff')); ?>;}.top-bar .name a:hover,.top-bar-section ul li > a:hover, .top-bar-section ul li > a:focus{color:<?php echo esc_attr(get_theme_mod('top_bar_font_hover_color','#ffffff')); ?>!important;}.content_wrap{max-width:<?php echo esc_attr(get_theme_mod('content_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('content_color','#ffffff')); ?>;}#content,#content h1,#content h2,#content h3,#content h4,#content h5,#content h6{color:<?php echo esc_attr(get_theme_mod('content_font_color','#444444')); ?>;}#content a{color:<?php echo esc_attr(get_theme_mod('content_link_color','#008CBA')); ?>;}#content a:hover{color:<?php echo esc_attr(get_theme_mod('content_hover_color','#007095')); ?>;}#content ul.pagination li.current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a{background-color:<?php echo esc_attr(get_theme_mod('pagination_current_color','#008CBA')); ?>;color:<?php echo esc_attr(get_theme_mod('pagination_current_font_color','#ffffff')); ?>;}#content ul.pagination li a,#content ul.pagination li button{color:<?php echo esc_attr(get_theme_mod('pagination_link_color','#999999')); ?>;}#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus{color:<?php echo esc_attr(get_theme_mod('pagination_link_hover_color','#999999')); ?>;background-color:<?php echo esc_attr(get_theme_mod('pagination_hover_color','#e6e6e6')); ?>;}.sidebar_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_sidebar_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_sidebar_color','#ffffff')); ?>;}#content.columns{float:<?php echo esc_attr(get_theme_mod('wpforge_content_position','left')); ?>!important;}#secondary .widget-title{color:<?php echo esc_attr(get_theme_mod('main_widget_title_color','#444444')); ?>;}#secondary{color:<?php echo esc_attr(get_theme_mod('main_widget_text_color','#444444')); ?>}#secondary a{color:<?php echo esc_attr(get_theme_mod('main_widget_link_color','#008CBA')); ?>;}#secondary a:hover{color:<?php echo esc_attr(get_theme_mod('main_widget_hover_color','#007095')); ?>;}.footer_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_content_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_content_color','#ffffff')); ?>;}#secondary-sidebar .widget-title{color:<?php echo esc_attr(get_theme_mod('footer_widget_title_color','#444444')); ?>;}#secondary-sidebar{color:<?php echo esc_attr(get_theme_mod('footer_widget_text_color','#444444')); ?>;}#secondary-sidebar a{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_color','#008CBA')); ?>;}#secondary-sidebar a:hover{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_hover_color','#007095')); ?>;}footer[role="contentinfo"] p{color:<?php echo esc_attr(get_theme_mod('footer_text_color','#444444')); ?>;}footer[role="contentinfo"] a{color:<?php echo esc_attr(get_theme_mod('footer_link_color','#008CBA')); ?>;}footer[role="contentinfo"] a:hover{color:<?php echo esc_attr(get_theme_mod('footer_hover_color','#007095')); ?>;}button,.button,#content dl.sub-nav dd.active a{background-color:<?php echo esc_attr(get_theme_mod('button_color','#008CBA')); ?>;}button,.button,#content a.button,#content dl.sub-nav dd.active a{color:<?php echo esc_attr(get_theme_mod('button_font_color','#ffffff')); ?>;}button:hover,button:focus,.button:hover,.button:focus,#content dl.sub-nav dd.active a:hover,#content dl.sub-nav dd.active a:focus{background-color:<?php echo esc_attr(get_theme_mod('button_hover_color','#007095')); ?>;}button:hover,button:focus,.button:hover,.button:focus,#content dl.sub-nav dd.active a:hover,#content dl.sub-nav dd.active a:focus{color:<?php echo esc_attr(get_theme_mod('button_font_hover_color','#ffffff')); ?>;}#backtotop{background-color:<?php echo esc_attr(get_theme_mod('backtotop_color','#888888')); ?>;color:<?php echo esc_attr(get_theme_mod('backtotop_font_color','#ffffff')); ?>;}#backtotop:hover,#backtotop:focus{background-color:<?php echo esc_attr(get_theme_mod('backtotop_hover_color','#444444')); ?>;}</style>
<?php }
add_action( 'wp_head', 'wpforge_customize_css', 100);

/**
 * Registers our theme customizer preview with WordPress.
 *
 * @since WP-Forge 5.5.1.7
 */
function wpforge_customize_preview_js() {
  wp_enqueue_script( 'wpforge-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '5.5.1.8', true );
}
add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );