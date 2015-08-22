<?php
/**
* WP-Forge Theme Customizer
* A Theme Customizer for WP-Forge. Adds the individual, panels, sections, settings, and controls to the theme customizer
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
* @author Otto aka Samuel Wood (@Otto42)
* @see http://ottopress.com/2015/whats-new-with-the-customizer/
*
* @since WP-Forge 5.5.1.7
*
* @version 5.5.2.5
*/

/**
 * Handles the width of the Customizer
 *
 * @see http://ottopress.com/2015/whats-new-with-the-customizer/
 * @since WP-Forge 5.5.2.2
 */
add_action( 'customize_controls_enqueue_scripts', 'themedemo_customizer_style');
function themedemo_customizer_style() {
    wp_add_inline_style( 'customize-controls', '.wp-full-overlay-sidebar { width: 300px } .wp-full-overlay.expanded { margin-left: 300x } ');
}

/**
 * Table of Contents
 *
 * 1.0 - Defaults
 * 2.0 - Panels
 * 3.0 - Sections and Settings
 * 4.0 - Sanitation
 * 5.0 - Callacks
 * 6.0 - Transport
 * 7.0 - CSS
 *
 */

if ( ! function_exists( 'wpforge_customize_register' ) ) {
  function wpforge_customize_register( $wp_customize ) {

  /**
   * 1.0 Defaults
   */
  $wp_customize->get_section('header_image')->panel = 'wpforge_header'; // Add to Header Panel
  $wp_customize->get_section('header_image')->priority = 40; // Shows before site title and tagline
  $wp_customize->get_section('title_tagline')->priority = 50; // Shows after the Header image section
  $wp_customize->get_section('title_tagline')->panel = 'wpforge_header'; // Add to Header Panel
  $wp_customize->get_section('background_image')->panel = 'wpforge_background'; // Add to Background Panel
  $wp_customize->get_section('colors')->panel = 'wpforge_colors'; // Add to Colors Panel
  $wp_customize->get_section('colors')->priority = 10; // Changed priority so it shows first in color panel
  $wp_customize->get_section('colors')->title = __( 'Header &amp; Background Colors', 'wp-forge' ); // Changed title
  $wp_customize->get_section('static_front_page')->panel = 'wpforge_front_page'; // Add to Front Panel
  $wp_customize->get_section('static_front_page')->description = __( 'Set the front page for your theme.', 'wp-forge' ); // Changed description

  /**
   * 2.0 Panels
   */
  $wp_customize->add_panel( 'wpforge_header', array( // Header Panel
      'priority'       => 1,
      'capability'     => 'edit_theme_options',
      'title'          => __('Header Section', 'wp-forge'),
      'description'    => __('Deals with the header portion of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_background', array( // Background Panel
      'priority'       => 2,
      'capability'     => 'edit_theme_options',
      'title'          => __('Background Image Section', 'wp-forge'),
      'description'    => __('Deals with the background of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_navigation', array( // Navigation Panel
      'priority'       => 4,
      'capability'     => 'edit_theme_options',
      'title'          => __('Menu Options', 'wp-forge'),
      'description'    => __('Select the menu type you want to use with your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_colors', array( // Color Panel
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'title'          => __('Colors Section', 'wp-forge'),
      'description'    => __('Deals with the colors of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_front_page', array( // Front Page Panel
      'priority'       => 6,
      'capability'     => 'edit_theme_options',
      'title'          => __('Front Page Section', 'wp-forge'),
      'description'    => __('Deals with setting up the front page of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_content', array( // Content Panel
      'priority'       => 7,
      'capability'     => 'edit_theme_options',
      'title'          => __('Content Section', 'wp-forge'),
      'description'    => __('Deals with the main content area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_footer_sidebar', array( // Footer Sidebar Panel
      'priority'       => 8,
      'capability'     => 'edit_theme_options',
      'title'          => __('Footer Sidebar Section', 'wp-forge'),
      'description'    => __('Deals with the footer sidebar area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_footer', array( // Footer Panel
      'priority'       => 9,
      'capability'     => 'edit_theme_options',
      'title'          => __('Footer Section', 'wp-forge'),
      'description'    => __('Deals with the footer area of your theme.', 'wp-forge'),
  ));

  /**
   * 3.0 Sections and Settings
   */
  $wp_customize->add_section('header_content', array( /* header content section */
    'title' => __('Header Content', 'wp-forge'),
    'description' => __('Main content area of your header, i.e site title, site description and logo.', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_header',
  ));  
  $wp_customize->add_setting('header_width',array( /* header width */
    'default' => '64rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',  
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 15,  
  ));
  $wp_customize->add_control('header_width',array(
    'label' => __('Set width (Default is 64rem)','wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
  )); 
  $wp_customize->add_setting('header_color', array( /* header background color */
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
  $wp_customize->add_section('nav_content', array( /* nav wrapper section */
    'title' => __('Nav Wrapper', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_navigation',
    'description' => __('Change the width and background color of the navigation area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_setting('nav_width',array( /* nav content width */
    'default' => '64rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',    
    'sanitize_callback' => 'wpforge_sanitize_text'
  ));
  $wp_customize->add_control('nav_width',array(
    'label' => __('Nav Width (Default is 64rem)','wp-forge'),
    'section' => 'nav_content',
    'type' => 'text',
    'capability' => 'edit_theme_options',
    'priority' => 10,
  ));  
  $wp_customize->add_setting('nav_wrap_main_color', array( /* nav background color */
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
  $wp_customize->add_section('wpforge_menu_options', array( /* nav wrapper section */
    'title' => __('Menu Selection', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_navigation',
    'description' => __('Select the menu type you want to use with your theme.', 'wp-forge'),
  ));
  $wp_customize->add_setting('wpforge_nav_select',array( /* navigation select */
    'default' => 'topbar',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_nav_select',
    'priority' => 1,  
  ));
  $wp_customize->add_control('wpforge_nav_select',array(
    'type' => 'select',
    'label' => __('Select your menu', 'wp-forge'),
    'section' => 'wpforge_menu_options',
    'choices' => array(
      'topbar'    => __('Top-Bar', 'wp-forge'),
      'offcanvas' => __('Off-Canvas', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('top_bar', array( /* top-bar section */
    'title' => __('Top-Bar Settings', 'wp-forge'),
    'active_callback' => 'wpforge_menu_option_callback',
    'description' => __('Configure the Top-Bar Navigation area of your theme. Set the position and change the text of the Home link.', 'wp-forge'),
    'priority' => 40,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_nav_position',array( /* top-bar position */
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
  $wp_customize->add_setting('wpforge_title_area',array( /* show top-bar title area */
    'default' => 'yes',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_title_area',
    'priority' => 2,  
  ));
  $wp_customize->add_control('wpforge_title_area',array(
    'type' => 'select',
    'active_callback' => 'wpforge_title_callback',
    'label' => __('Show top-bar title area?', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'yes' => __('Yes, show title area', 'wp-forge'),
      'no'  => __('No, hide title area', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_link_position',array( /* show top-bar title area */
    'default' => 'right',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_position',
    'priority' => 4,  
  ));
  $wp_customize->add_control('wpforge_link_position',array(
    'type' => 'select', 
    'active_callback' => 'wpforge_link_position_callback', 
    'label' => __('Top-Bar link position?', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'right' => __('Links to the right', 'wp-forge'),
      'left'  => __('Links to the left', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_nav_text',array( /* top-bar main link anchor text */
    'default' => 'Home',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',    
    'sanitize_callback' => 'wpforge_sanitize_text',   
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_nav_text',array(
    'label' => __('Change text of title area','wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'wpforge_nav_text_callback',
  ));  
  $wp_customize->add_section('off_canvas', array( /* off-canvas section */
    'title' => __('Off-Canvas Settings', 'wp-forge'),
    'active_callback' => 'wpforge_off_canvas_callback',
    'description' => __('Configure Off-Canvas Navigation area of your theme.', 'wp-forge'),
    'priority' => 50,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_text',array( /* off-canvas main link anchor text */
    'default' => 'Home',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',    
    'sanitize_callback' => 'wpforge_sanitize_text',   
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_off_canvas_text',array(
    'label' => __('Change hamburger icon text','wp-forge'),
    'section' => 'off_canvas',
    'type' => 'text',
  )); 
  $wp_customize->add_section('wpforge_mobile_settings', array( /* off-canvas section */
    'title' => __('Mobile Menu View', 'wp-forge'),
    'description' => __('Choose to use Off-Canvas for mobile view and position the hamburger icon.', 'wp-forge'),
    'priority' => 60,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_mobile_position',array( /* hamburger icon position */
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_position',
    'priority' => 1,  
  ));
  $wp_customize->add_control('wpforge_mobile_position',array(
    'type' => 'select',
    'label' => __('Show hamburger icon left or right?', 'wp-forge'),
    'section' => 'wpforge_mobile_settings',
    'choices' => array(
      'left'  => __('Left', 'wp-forge'),
      'right' => __('Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_mobile_display',array( /* off-canvas for mobile */
    'default' => 'no',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_display',
    'priority' => 2,  
  ));
  $wp_customize->add_control('wpforge_mobile_display',array(
    'type' => 'select',
    'label' => __('Use Off-Canvas for Mobile?', 'wp-forge'),
    'section' => 'wpforge_mobile_settings',
    'choices' => array(
      'no'  => __('No', 'wp-forge'),
      'yes' => __('Yes', 'wp-forge'),
    ),
  ));  
  $wp_customize->add_setting('site_title_link_color', array( /* site title link color */
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
  $wp_customize->add_setting('site_title_hover_color', array( /* site title hover color */
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
  $wp_customize->add_section('top_bar_colors', array( /* top-bar colors section */
    'title' => __('Top-Bar Colors', 'wp-forge'),
    'description' => __('Change all colors of the Top-Bar.', 'wp-forge'),
    'priority' => 55,
    'panel' => 'wpforge_colors',
  )); 
  $wp_customize->add_setting('top_bar_main_color', array( /* top-bar main color */
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
  $wp_customize->add_setting('top_bar_divider_color', array( /* top-bar divider color */
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
  $wp_customize->add_setting('top_bar_hover_color', array( /* top-bar hover color */
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
  $wp_customize->add_setting('top_bar_active_color', array( /* top-bar active color */
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
  $wp_customize->add_setting('top_bar_active_hover_color', array( /* top-bar active hover color */
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
  $wp_customize->add_setting('top_bar_font_color', array( /* top-bar font color */
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
  $wp_customize->add_setting('top_bar_font_hover_color', array( /* top-bar font hover color */
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
  $wp_customize->add_section('wpforge_off_canvas_colors', array( /* off-canvas colors section */
    'title' => __('Off-Canvas Colors', 'wp-forge'),
    'description' => __('Change all colors of the Off-Canvas Menu.', 'wp-forge'),
    'priority' => 60,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_main_color', array( /* off-canvas main color */
    'default' => '#333333',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_main_color',array(
    'label' => __('Off-Canvas Main Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_main_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_color', array( /* hamburger icon color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_color',array(
    'label' => __('Hamburger Icon Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_divider_left_color', array( /* hamburger icon left divider color */
    'default' => '#1a1a1a',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_divider_left_color',array(
    'label' => __('Hamburger Icon Left Divider Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'active_callback' => 'wpforge_hamburger_left_callback',    
    'settings' => 'wpforge_off_canvas_divider_left_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_divider_right_color', array( /* hamburger icon right divider color */
    'default' => '#1a1a1a',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_divider_right_color',array(
    'label' => __('Hamburger Icon Right Divider Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'active_callback' => 'wpforge_hamburger_right_callback',    
    'settings' => 'wpforge_off_canvas_divider_right_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_title_color', array( /* hamburger icon title color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_title_color',array(
    'label' => __('Hamburger Icon Title Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_title_color',
  ))); 
  $wp_customize->add_setting('wpforge_off_canvas_link_color', array( /* off-canvas link color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_link_color',array(
    'label' => __('Off-Canvas Link Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_link_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_hover_color', array( /* off-canvas hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_hover_color',array(
    'label' => __('Off-Canvas Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_hover_color',
  ))); 
  $wp_customize->add_setting('wpforge_off_canvas_background_hover_color', array( /* off-canvas background hover color */
    'default' => '#242424',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_background_hover_color',array(
    'label' => __('Off-Canvas Background Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_background_hover_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_divider_color', array( /* off-canvas divider color */
    'default' => '#262626',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_divider_color',array(
    'label' => __('Off-Canvas Divider Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_divider_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_active_color', array( /* off-canvas active color */
    'default' => '#262626',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_active_color',array(
    'label' => __('Off-Canvas Active Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_active_color',
  ))); 
  $wp_customize->add_setting('wpforge_off_canvas_active_hover_color', array( /* off-canvas active hover color */
    'default' => '#242424',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,    
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_active_hover_color',array(
    'label' => __('Off-Canvas Active Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_active_hover_color',
  )));
  $wp_customize->add_section('content_colors', array( /* content color section */
    'title' => __('Content Colors', 'wp-forge'),
    'description' => __('Change text, link and hover colors in the Content section of your theme.', 'wp-forge'),
    'priority' => 65,
    'panel' => 'wpforge_colors',
  )); 
  $wp_customize->add_setting('content_font_color', array( /* content font color */
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
  $wp_customize->add_setting('content_link_color', array( /* content link color */
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
  $wp_customize->add_setting('content_hover_color', array( /*content link hover color */
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
  $wp_customize->add_section('pagination_colors', array( /* pagination color section */
    'title' => __('Pagination Colors', 'wp-forge'),
    'description' => __('Deals with the colors of built-in pagination.', 'wp-forge'),
    'priority' => 70,
    'panel' => 'wpforge_colors',
  ));  
  $wp_customize->add_setting('pagination_current_color', array( /* pagination current color */
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
  $wp_customize->add_setting('pagination_current_font_color', array( /* pagination current font color */
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
  $wp_customize->add_setting('pagination_link_color', array( /* pagination link color */
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
  $wp_customize->add_setting('pagination_hover_color', array( /* pagination background hover color */
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
  $wp_customize->add_setting('pagination_link_hover_color', array( /* pagination link hover color */
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
  $wp_customize->add_section('main_sidebar_colors', array( /* sidebar colors section */
    'title' => __('Main Sidebar Colors', 'wp-forge'),
    'description' => __('Change widget title, link and hover colors of main sidebar.', 'wp-forge'),
    'priority' => 75,
    'panel' => 'wpforge_colors',
  ));  
  $wp_customize->add_setting('main_widget_title_color', array( /* widget title color */
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
  $wp_customize->add_setting('main_widget_text_color', array( /* widget text color */
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
  $wp_customize->add_setting('main_widget_link_color', array( /* widget link color */
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
  $wp_customize->add_setting('main_widget_hover_color', array( /* widget link hover color */
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
  $wp_customize->add_section('footer_sidebar_colors', array( /* footer sidebar colors section */
    'title' => __('Footer Sidebar Colors', 'wp-forge'),
    'description' => __('Change widget title, link and hover colors in Footer sidebar.', 'wp-forge'),
    'priority' => 80,
    'panel' => 'wpforge_colors',
  ));  
  $wp_customize->add_setting('footer_widget_title_color', array( /* footer sidebar widget title color */
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
  $wp_customize->add_setting('footer_widget_text_color', array( /* footer sidebar text color */
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
  $wp_customize->add_setting('footer_widget_link_color', array( /* footer sidebar widget link color */
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
  $wp_customize->add_setting('footer_widget_link_hover_color', array( /* footer sidebar widget link hover color*/
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
  $wp_customize->add_section('footer_colors', array( /* footer colors section */
    'title' => __('Footer Colors', 'wp-forge'),
    'description' => __('Change text, link and hover colors in the Footer.', 'wp-forge'),
    'priority' => 85,
    'panel' => 'wpforge_colors',
  ));  
  $wp_customize->add_setting('footer_text_color', array( /* footer text color */
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
  $wp_customize->add_setting('footer_link_color', array( /* footer link color */
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
  $wp_customize->add_setting('footer_hover_color', array( /* footer hover color */
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
    'priority' => 90,
    'panel' => 'wpforge_colors',
  )); 
  $wp_customize->add_setting('button_color', array( /* button color */
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
  $wp_customize->add_setting('button_hover_color', array( /* button hover color */
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
  $wp_customize->add_setting('button_font_color', array( /* button text color */
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
  $wp_customize->add_setting('button_font_hover_color', array( /* button font hover color */
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
  $wp_customize->add_section('backtotop_colors', array( /* back to top section or btt */
    'title' => __('Back To Top Colors', 'wp-forge'),
    'description' => __('Change the color and hover colors of the back to top button.', 'wp-forge'),
    'priority' => 95,
    'panel' => 'wpforge_colors',
  ));  
  $wp_customize->add_setting('backtotop_color', array( /* btt color */
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
  $wp_customize->add_setting('backtotop_hover_color', array( /* back to top hover color */
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
  $wp_customize->add_setting('backtotop_font_color', array( /* back to top font color */
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
  $wp_customize->add_setting('backtotop_font_hover_color', array( /* btt font hover color */
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
  $wp_customize->add_section('wpforge_social_menu_colors', array( /* social menu section */
    'title' => __('Social Menu Colors', 'wp-forge'),
    'description' => __('Change the color and hover colors of the Social Menu icons.', 'wp-forge'),
    'priority' => 100,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('wpforge_social_feed_color', array( /* feed color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_feed_color',array(
    'label' => __('Feed Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_feed_color',
  )));
  $wp_customize->add_setting('wpforge_social_feed_hover_color', array( /* feed hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_feed_hover_color',array(
    'label' => __('Feed Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_feed_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_codepen_color', array( /* codepen color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_codepen_color',array(
    'label' => __('Codepen Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_codepen_color',
  ))); 
  $wp_customize->add_setting('wpforge_social_codepen_hover_color', array( /* codepen hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_codepen_hover_color',array(
    'label' => __('Codepen Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_codepen_hover_color',
  )));
    $wp_customize->add_setting('wpforge_social_digg_color', array( /* digg color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_digg_color',array(
    'label' => __('Digg Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_digg_color',
  )));
  $wp_customize->add_setting('wpforge_social_digg_hover_color', array( /* digg hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_digg_hover_color',array(
    'label' => __('Digg Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_digg_hover_color',
  ))); 
  $wp_customize->add_setting('wpforge_social_dribble_color', array( /* dribble color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dribble_color',array(
    'label' => __('Dribbble Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dribble_color',
  )));
  $wp_customize->add_setting('wpforge_social_dribble_hover_color', array( /* dribble hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dribble_hover_color',array(
    'label' => __('Dribbble Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dribble_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_dropbox_color', array( /* dropbox color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dropbox_color',array(
    'label' => __('Dropbox Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dropbox_color',
  )));
  $wp_customize->add_setting('wpforge_social_dropbox_hover_color', array( /* dropbox hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dropbox_hover_color',array(
    'label' => __('Dropbox Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dropbox_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_facebook_color', array( /* facebook color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_facebook_color',array(
    'label' => __('Facebook Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_facebook_color',
  )));
  $wp_customize->add_setting('wpforge_social_facebook_hover_color', array( /* facebook hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 12,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_facebook_hover_color',array(
    'label' => __('Facebook Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_facebook_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_flickr_color', array( /* flickr color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 13,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_flickr_color',array(
    'label' => __('Flickr Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_flickr_color',
  )));
  $wp_customize->add_setting('wpforge_social_flickr_hover_color', array( /* flickr hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 14,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_flickr_hover_color',array(
    'label' => __('Flickr Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_flickr_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_foursquare_color', array( /* foursquare color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_foursquare_color',array(
    'label' => __('Foursquare Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_foursquare_color',
  )));
  $wp_customize->add_setting('wpforge_social_foursquare_hover_color', array( /* foursquare hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 16,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_foursquare_hover_color',array(
    'label' => __('Foursquare Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_foursquare_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_google_color', array( /* google color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 17,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_google_color',array(
    'label' => __('Google+ Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_google_color',
  )));
  $wp_customize->add_setting('wpforge_social_google_hover_color', array( /* google hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 18,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_google_hover_color',array(
    'label' => __('Google+ Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_google_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_github_color', array( /* github color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 19,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_github_color',array(
    'label' => __('GitHub Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_github_color',
  )));
  $wp_customize->add_setting('wpforge_social_github_hover_color', array( /* github hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_github_hover_color',array(
    'label' => __('GitHub Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_github_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_instagram_color', array( /* instagram color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 21,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_instagram_color',array(
    'label' => __('Instagram Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_instagram_color',
  )));
  $wp_customize->add_setting('wpforge_social_instagram_hover_color', array( /* instagram hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 22,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_instagram_hover_color',array(
    'label' => __('Instagram Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_instagram_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_linkedin_color', array( /* linkedin color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 23,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_linkedin_color',array(
    'label' => __('LinkedIn Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_linkedin_color',
  )));
  $wp_customize->add_setting('wpforge_social_linkedin_hover_color', array( /* linkedin hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 24,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_linkedin_hover_color',array(
    'label' => __('LinkedIn Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_linkedin_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_pinterest_color', array( /* pinterest color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 25,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pinterest_color',array(
    'label' => __('Pinterest Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pinterest_color',
  )));
  $wp_customize->add_setting('wpforge_social_pinterest_hover_color', array( /* pinterest hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 26,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pinterest_hover_color',array(
    'label' => __('Pinterest Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pinterest_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_pocket_color', array( /* pocket color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 27,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pocket_color',array(
    'label' => __('Pocket Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pocket_color',
  )));
  $wp_customize->add_setting('wpforge_social_pocket_hover_color', array( /* pocket hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 28,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pocket_hover_color',array(
    'label' => __('Pocket Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pocket_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_polldaddy_color', array( /* polldaddy color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 29,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_polldaddy_color',array(
    'label' => __('PollDaddy Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_polldaddy_color',
  )));
  $wp_customize->add_setting('wpforge_social_polldaddy_hover_color', array( /* polldaddy hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_polldaddy_hover_color',array(
    'label' => __('PollDaddy Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_polldaddy_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_reddit_color', array( /* reddit color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 31,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_reddit_color',array(
    'label' => __('Reddit Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_reddit_color',
  )));
  $wp_customize->add_setting('wpforge_social_reddit_hover_color', array( /* reddit hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 32,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_reddit_hover_color',array(
    'label' => __('Reddit Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_reddit_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_stumbleupon_color', array( /* stumbleupon color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 33,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_stumbleupon_color',array(
    'label' => __('Stumbleupon Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_stumbleupon_color',
  )));
  $wp_customize->add_setting('wpforge_social_stumbleupon_hover_color', array( /* stumbleupon hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 34,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_stumbleupon_hover_color',array(
    'label' => __('Stumbleupon Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_stumbleupon_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_tumblr_color', array( /* tumblr color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 35,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_tumblr_color',array(
    'label' => __('Tumblr Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_tumblr_color',
  )));
  $wp_customize->add_setting('wpforge_social_tumblr_hover_color', array( /* tumblr hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 36,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_tumblr_hover_color',array(
    'label' => __('Tumblr Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_tumblr_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitter_color', array( /* twitter color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 37,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitter_color',array(
    'label' => __('Twitter Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitter_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitter_hover_color', array( /* twitter hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 38,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitter_hover_color',array(
    'label' => __('Twitter Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitter_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_vimeo_color', array( /* vimeo color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 39,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_vimeo_color',array(
    'label' => __('Vimeo Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_vimeo_color',
  )));
  $wp_customize->add_setting('wpforge_social_vimeo_hover_color', array( /* vimeo hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_vimeo_hover_color',array(
    'label' => __('Vimeo Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_vimeo_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_wordpress_color', array( /* wordpress color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 41,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_wordpress_color',array(
    'label' => __('WordPress Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_wordpress_color',
  )));
  $wp_customize->add_setting('wpforge_social_wordpress_hover_color', array( /* wordpress hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 42,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_wordpress_hover_color',array(
    'label' => __('WordPress Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_wordpress_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_youtube_color', array( /* youtube color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 43,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_youtube_color',array(
    'label' => __('YouTube Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_youtube_color',
  )));
  $wp_customize->add_setting('wpforge_social_youtube_hover_color', array( /* youtube hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 44,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_youtube_hover_color',array(
    'label' => __('YouTube Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_youtube_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_mailto_color', array( /* mailto color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 45,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_mailto_color',array(
    'label' => __('MailTo Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_mailto_color',
  )));
  $wp_customize->add_setting('wpforge_social_mailto_hover_color', array( /* mailto hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 46,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_mailto_hover_color',array(
    'label' => __('MailTo Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_mailto_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_spotify_color', array( /* spotify color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 47,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_spotify_color',array(
    'label' => __('Spotify Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_spotify_color',
  )));
  $wp_customize->add_setting('wpforge_social_spotify_hover_color', array( /* spotify hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 48,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_spotify_hover_color',array(
    'label' => __('Spotify Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_spotify_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitch_color', array( /* twitch color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 49,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitch_color',array(
    'label' => __('Twitch TV Icon Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitch_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitch_hover_color', array( /* twitch hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 50,   
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitch_hover_color',array(
    'label' => __('Twitch TV Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitch_hover_color',
  )));
$wp_customize->add_section('wpforge_home_page_title', array( /* Home page title section */
'title' => __('Show home page title', 'wp-forge'),
'description' => __('Show or hide the page title of the static page you set as the "Home Page".', 'wp-forge'),
'panel' => 'wpforge_front_page',
));
  $wp_customize->add_setting('wpforge_home_page_title_display',array( /* home page title display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_home_page_display',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_home_page_title_display',array(
    'type' => 'select',
    'active_callback' => 'wpforge_home_page_title_callback',
    'label' => __('Show title on home page?', 'wp-forge'),
    'section' => 'wpforge_home_page_title',
    'choices' => array(
      'yes' => __('Yes, show the title', 'wp-forge'),
      'no'  => __('No, hide the title', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('content_layout', array( /* content section */
    'title' => __('Content Wrapper', 'wp-forge'),
    'description' => __('Change width and background color of main content area.', 'wp-forge'),
    'priority' => 20,
    'panel' => 'wpforge_content',
  ));    
  $wp_customize->add_setting('content_width',array( /* content width */
    'default' => '64rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',    
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
    $wp_customize->add_section('post_layout', array( /* posts section */
    'title' => __('Posts', 'wp-forge'),
    'description' => __('Deals with posts in your theme.', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_cat_display',array( /* show categories */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_cat_display',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_cat_display',array(
    'type' => 'select',
    'label' => __('Show or hide categories?', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, show categories', 'wp-forge'),
      'no'  => __('No, hide categories', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_cat_position',array( /* category position */
    'default' => 'top',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_cat_position',
    'priority' => 10,
  ));
  $wp_customize->add_control('wpforge_cat_position',array(
    'type' => 'select',
    'active_callback' => 'wpforge_cat_callback',
    'label' => __('Where to display categories?', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'top'     => __('Above the post title', 'wp-forge'),
      'bottom'  => __('Above the post tags', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_meta_display',array( /* meta display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_meta_display',
    'priority' => 15,
  ));
  $wp_customize->add_control('wpforge_meta_display',array(
    'type' => 'select',
    'label' => __('Display post meta?', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, display post meta', 'wp-forge'),
      'no'  => __('No, hide post meta', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_display',array( /* full post or excerpt */
    'default' => 'full',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_post_display',
    'priority' => 20,
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
  $wp_customize->add_setting('wpforge_thumb_display',array( /* display thumbs on index page */
    'default' => 'no',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_thumb_display',
    'priority' => 25,
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
  $wp_customize->add_setting('wpforge_single_thumb_display',array( /* display thumbs in single post view */
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
  $wp_customize->add_setting('wpforge_tag_display',array( /* tag display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',   
    'sanitize_callback' => 'wpforge_sanitize_tag_display',
    'priority' => 35,
  ));
  $wp_customize->add_control('wpforge_tag_display',array(
    'type' => 'select',
    'label' => __('Display post tags?', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, display post tags', 'wp-forge'),
      'no'  => __('No, hide post tags', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_nav_display',array( /* post navigation */
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
  $wp_customize->add_section('sidebar_layout', array( /* sidebar section */
    'title' => __('Content Position', 'wp-forge'),
    'description' => __('Adjust the position of the main content area.', 'wp-forge'),
    'priority' => 70,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_content_position',array( /* content position */
    'default' => 'left',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',  
    'sanitize_callback' => 'wpforge_sanitize_content_position',   
  ));
  $wp_customize->add_control('wpforge_content_position',array(
    'type' => 'select',
    'label' => __('Select position', 'wp-forge'),
    'section' => 'sidebar_layout',
    'choices' => array(
      'left' => __('Left', 'wp-forge'),
      'right'  => __('Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('sidebar_content', array( /* fs content section */
    'title' => __('Footer Sidebar Content', 'wp-forge'),
    'description' => __('The main content area of the Footer Sidebar.', 'wp-forge'),
    'priority' => 20,
    'panel' => 'wpforge_footer_sidebar',
  ));
  $wp_customize->add_setting('footer_sidebar_width',array( /* fs content width */
    'default' => '64rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
  ));
  $wp_customize->add_control('footer_sidebar_width',array(
    'label' => __('Set width (Default is 64rem)','wp-forge'),
    'section' => 'sidebar_content',
    'type' => 'text',
    'capability' => 'edit_theme_options',
    'priority' => 10,
  ));  
  $wp_customize->add_setting('footer_sidebar_color', array( /* fs contet background color */ 
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
  $wp_customize->add_section('footer_content', array( /* footer content section */
    'title' => __('Footer Content', 'wp-forge'),
    'description' => __('Deals with the content area of the footer.', 'wp-forge'),
    'priority' => 40,
    'panel' => 'wpforge_footer',
  ));
  $wp_customize->add_setting('footer_content_width',array( /* footer content width */
    'default' => '64rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',    
    'sanitize_callback' => 'wpforge_sanitize_text',
  ));
  $wp_customize->add_control('footer_content_width',array(
    'label' => __('Footer Wrapper Width','wp-forge'),
    'section' => 'footer_content',
    'type' => 'text',
    'capability' => 'edit_theme_options',
    'priority' => 10,
  ));   
  $wp_customize->add_setting('footer_content_color', array( /* footer content background color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,   
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_content_color',array(
    'label' => __('Footer Background Color', 'wp-forge'),
    'section' => 'footer_content',
    'settings' => 'footer_content_color',
  )));
  $wp_customize->add_setting('wpforge_footer_text',array( /* footer text */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 20,
  ));
  $wp_customize->add_control('wpforge_footer_text',array(
    'label' => __('Footer Text','wp-forge'),
    'section' => 'footer_content',
    'type' => 'textarea',
  ));
  $wp_customize->add_setting('wpforge_footer_position',array( /* footer text position */
    'default' => 'center',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_footer_position',
    'priority' => 25, 
  ));
  $wp_customize->add_control('wpforge_footer_position',array(
    'type' => 'select',   
    'label' => __('Footer Content Position', 'wp-forge'),
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
  function wpforge_sanitize_nav_select( $input ) { //navigation select
      $valid = array(
        'topbar'    => __('Top-Bar', 'wp-forge'),
        'offcanvas' => __('Off-Canvas', 'wp-forge'),
      );
    
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
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
  function wpforge_sanitize_title_area( $input ) { // show title area
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
  function wpforge_sanitize_link_position( $input ) { // link position
      $valid = array(
        'right' => __('Links to the right', 'wp-forge'),
        'left'  => __('Links to the left', 'wp-forge'),
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
  function wpforge_sanitize_cat_display( $input ) { // category display
      $valid = array(
        'yes' => __('Yes, show categories', 'wp-forge'),
        'no'  => __('No, hide categories', 'wp-forge'),
      );
    
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  } 
  function wpforge_sanitize_cat_position( $input ) { // category position
      $valid = array(
        'top'     => __('Above the post title', 'wp-forge'),
        'bottom'  => __('Above the post tags', 'wp-forge'),
      );
    
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
    function wpforge_sanitize_meta_display( $input ) { // meta display
      $valid = array(
        'yes' => __('Yes, display post meta', 'wp-forge'),
        'no'  => __('No, hide post meta', 'wp-forge'),
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
    function wpforge_sanitize_tag_display( $input ) { // tag display
      $valid = array(
        'yes' => __('Yes, display post tags', 'wp-forge'),
        'no'  => __('No, hide post tags', 'wp-forge'),
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
  function wpforge_sanitize_home_page_display( $input ) { //home page select
      $valid = array(
        'yes' => __('Yes, show the title', 'wp-forge'),
        'no'  => __('No, hide the title', 'wp-forge'),
      );
    
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }  
  /**
   * 5.0 - Active Callbacks
   *
   * @see http://ottopress.com/2015/whats-new-with-the-customizer/
   * @since WP-Forge 5.5.2.2
   */
  function wpforge_title_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_nav_position')->value() == 'normal' || $control->manager->get_setting('wpforge_nav_position')->value() == 'sticky' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_link_position_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_nav_position')->value() == 'top' || $control->manager->get_setting('wpforge_nav_position')->value() == 'fixed' ) {
          return true;
      } else {
          return false;
      }
  }  
  function wpforge_cat_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_cat_display')->value() == 'yes' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_nav_text_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_title_area')->value() == 'yes' || $control->manager->get_setting('wpforge_nav_position')->value() == 'top' || $control->manager->get_setting('wpforge_nav_position')->value() == 'fixed' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_menu_option_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_nav_select')->value() == 'topbar' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_off_canvas_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_nav_select')->value() == 'offcanvas' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_hamburger_left_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_mobile_position')->value() == 'left' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_hamburger_right_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_mobile_position')->value() == 'right' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_home_page_title_callback( $control ) {
      if ( $control->manager->get_setting('show_on_front')->value() == 'page' ) {
          return true;
      } else {
          return false;
      }
  }  
  /**
   * 6.0 - Transport
   *
   */
    $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'nav_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_nav_text' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_text' )->transport = 'postMessage';
    $wp_customize->get_setting( 'site_title_link_color' )->transport = 'postMessage'; 
    $wp_customize->get_setting( 'top_bar_main_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_main_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_hamburger_icon_title_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_background_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_active_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_active_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_sidebar_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_sidebar_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_widget_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_text' )->transport = 'postMessage';
    $wp_customize->get_setting( 'main_widget_title_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'main_widget_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'main_widget_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_widget_title_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_widget_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_content_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'button_font_color' )->transport = 'postMessage';    
  }
  add_action( 'customize_register', 'wpforge_customize_register' );
}

/**
 * 7.0 CSS
 */

/**
 * Modifies our styles and writes them in the <head> element of the page based on the WP-Forge Theme Customizer
 * options.
 *
 * @see http://codex.wordpress.org/Theme_Customization_API
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_customize_css' ) ) {
function wpforge_customize_css() { ?>
<style type="text/css" id="wpforge-customizer-css">.header_wrap{max-width:<?php echo esc_attr(get_theme_mod('header_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('header_color','#ffffff')); ?>;}.site-title a{color:<?php echo esc_attr(get_theme_mod('site_title_link_color','#444444')); ?>;}.site-title a:hover{color:<?php echo esc_attr(get_theme_mod('site_title_hover_color','#0078a0')); ?>;}.site-description{color:#<?php echo esc_attr(get_theme_mod('header_textcolor','#444444')); ?>;}.nav_wrap{max-width:<?php echo esc_attr(get_theme_mod('nav_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('nav_wrap_main_color','#333333')); ?>;}.contain-to-grid .top-bar{max-width:<?php echo esc_attr(get_theme_mod('nav_width','64rem')); ?>;}.contain-to-grid .top-bar,.top-bar,.top-bar-section ul li,.top-bar-section li:not(.has-form) a:not(.button),.top-bar-section ul li:hover:not(.has-form) > a,.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button),.contain-to-grid {background-color:<?php echo esc_attr(get_theme_mod('top_bar_main_color','#333333')); ?>;}.top-bar-section > ul > .divider,.top-bar-section > ul > [role="separator"] {border-right: solid 1px <?php echo esc_attr(get_theme_mod('top_bar_divider_color','#4e4e4e')); ?>;}.top-bar-section li:not(.has-form) a:not(.button):hover,.top-bar .name:hover,.top-bar-section .dropdown li:not(.has-form):not(.active):hover > a:not(.button) {background-color:<?php echo esc_attr(get_theme_mod('top_bar_hover_color','#272727')); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button){background-color:<?php echo esc_attr(get_theme_mod('top_bar_active_color','#008cba')); ?>;}.top-bar-section li.active:not(.has-form) a:not(.button):hover {background-color:<?php echo esc_attr(get_theme_mod('top_bar_active_hover_color','#0078a0')); ?>;}.top-bar .name a,.top-bar-section ul li > a,.top-bar-section li.active:not(.has-form) a:not(.button),.top-bar-section .dropdown li:not(.has-form):not(.active) > a:not(.button) {color:<?php echo esc_attr(get_theme_mod('top_bar_font_color','#ffffff')); ?>;}.top-bar .name a:hover,.top-bar-section ul li > a:hover, .top-bar-section ul li > a:focus{color:<?php echo esc_attr(get_theme_mod('top_bar_font_hover_color','#ffffff')); ?>!important;}.tab-bar, .left-off-canvas-menu, .right-off-canvas-menu {background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_main_color','#333333')); ?>;}.left-small {border-right: solid 1px <?php echo esc_attr(get_theme_mod('wpforge_off_canvas_divider_left_color','#1a1a1a')); ?>;}.right-small {border-left: solid 1px <?php echo esc_attr(get_theme_mod('wpforge_off_canvas_divider_right_color','#1a1a1a')); ?>;}.tab-bar .menu-icon span::after {box-shadow: 0 0 0 1px <?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_color','#ffffff')); ?>, 0 7px 0 1px <?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_color','#ffffff')); ?>, 0 14px 0 1px <?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_color','#ffffff')); ?>;}section.tab-bar-section.middle a {color:<?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_title_color','#ffffff')); ?>;}ul.off-canvas-list li a {color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_link_color','#ffffff')); ?>;border-bottom:1px solid <?php echo esc_attr(get_theme_mod('wpforge_off_canvas_divider_color','#262626')); ?>;}ul.off-canvas-list li a:hover {color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_hover_color','#ffffff')); ?>;background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_background_hover_color','#242424')); ?>;}ul.off-canvas-list .active > a {background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_active_color','#262626')); ?>;}ul.off-canvas-list .active > a:hover {background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_active_hover_color','#242424')); ?>;}.content_wrap{max-width:<?php echo esc_attr(get_theme_mod('content_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('content_color','#ffffff')); ?>;}#content,#content h1,#content h2,#content h3,#content h4,#content h5,#content h6{color:<?php echo esc_attr(get_theme_mod('content_font_color','#444444')); ?>;}#content a{color:<?php echo esc_attr(get_theme_mod('content_link_color','#008CBA')); ?>;}#content a:hover{color:<?php echo esc_attr(get_theme_mod('content_hover_color','#007095')); ?>;}#content ul.pagination li.current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a{background-color:<?php echo esc_attr(get_theme_mod('pagination_current_color','#008CBA')); ?>;color:<?php echo esc_attr(get_theme_mod('pagination_current_font_color','#ffffff')); ?>;}#content ul.pagination li a,#content ul.pagination li button{color:<?php echo esc_attr(get_theme_mod('pagination_link_color','#999999')); ?>;}#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus{color:<?php echo esc_attr(get_theme_mod('pagination_link_hover_color','#999999')); ?>;background-color:<?php echo esc_attr(get_theme_mod('pagination_hover_color','#e6e6e6')); ?>;}.sidebar_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_sidebar_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_sidebar_color','#ffffff')); ?>;}#content.columns{float:<?php echo esc_attr(get_theme_mod('wpforge_content_position','left')); ?>!important;}#secondary .widget-title{color:<?php echo esc_attr(get_theme_mod('main_widget_title_color','#444444')); ?>;}#secondary{color:<?php echo esc_attr(get_theme_mod('main_widget_text_color','#444444')); ?>}#secondary a{color:<?php echo esc_attr(get_theme_mod('main_widget_link_color','#008CBA')); ?>;}#secondary a:hover{color:<?php echo esc_attr(get_theme_mod('main_widget_hover_color','#007095')); ?>;}.footer_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_content_width','64rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_content_color','#ffffff')); ?>;}#secondary-sidebar .widget-title{color:<?php echo esc_attr(get_theme_mod('footer_widget_title_color','#444444')); ?>;}#secondary-sidebar{color:<?php echo esc_attr(get_theme_mod('footer_widget_text_color','#444444')); ?>;}#secondary-sidebar a{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_color','#008CBA')); ?>;}#secondary-sidebar a:hover{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_hover_color','#007095')); ?>;}footer[role="contentinfo"] p{color:<?php echo esc_attr(get_theme_mod('footer_text_color','#444444')); ?>;}footer[role="contentinfo"] a{color:<?php echo esc_attr(get_theme_mod('footer_link_color','#008CBA')); ?>;}footer[role="contentinfo"] a:hover{color:<?php echo esc_attr(get_theme_mod('footer_hover_color','#007095')); ?>;}button,.button,#content dl.sub-nav dd.active a{background-color:<?php echo esc_attr(get_theme_mod('button_color','#008CBA')); ?>;}button,.button,#content a.button,#content dl.sub-nav dd.active a{color:<?php echo esc_attr(get_theme_mod('button_font_color','#ffffff')); ?>;}button:hover,button:focus,.button:hover,.button:focus,#content dl.sub-nav dd.active a:hover,#content dl.sub-nav dd.active a:focus{background-color:<?php echo esc_attr(get_theme_mod('button_hover_color','#007095')); ?>;}button:hover,button:focus,.button:hover,.button:focus,#content dl.sub-nav dd.active a:hover,#content dl.sub-nav dd.active a:focus{color:<?php echo esc_attr(get_theme_mod('button_font_hover_color','#ffffff')); ?>;}#backtotop{background-color:<?php echo esc_attr(get_theme_mod('backtotop_color','#888888')); ?>;color:<?php echo esc_attr(get_theme_mod('backtotop_font_color','#ffffff')); ?>;}#backtotop:hover,#backtotop:focus{background-color:<?php echo esc_attr(get_theme_mod('backtotop_hover_color','#444444')); ?>;}.social-navigation a[href$="/feed/"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_feed_color','#444444')); ?>;}.social-navigation a[href*="codepen.io"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_codepen_color','#444444')); ?>;}.social-navigation a[href*="digg.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_digg_color','#444444')); ?>;}.social-navigation a[href*="dribbble.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dribble_color','#444444')); ?>;}.social-navigation a[href*="dropbox.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dropbox_color','#444444')); ?>;}.social-navigation a[href*="facebook.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_facebook_color','#444444')); ?>;}.social-navigation a[href*="flickr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_flicker_color','#444444')); ?>;}.social-navigation a[href*="foursquare.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_foursquare_color','#444444')); ?>;}.social-navigation a[href*="google.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_google_color','#444444')); ?>;}.social-navigation a[href*="github.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_github_color','#444444')); ?>;}.social-navigation a[href*="instagram.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_instagram_color','#444444')); ?>;}.social-navigation a[href*="linkedin.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_linkedin_color','#444444')); ?>;}.social-navigation a[href*="pinterest.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pinterest_color','#444444')); ?>;}.social-navigation a[href*="getpocket.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pocket_color','#444444')); ?>;}.social-navigation a[href*="polldaddy.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_polldaddy_color','#444444')); ?>;}.social-navigation a[href*="reddit.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_reddit_color','#444444')); ?>;}.social-navigation a[href*="stumbleupon.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_stumbleupon_color','#444444')); ?>;}.social-navigation a[href*="tumblr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_tumblr_color','#444444')); ?>;}.social-navigation a[href*="twitter.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitter_color','#444444')); ?>;}.social-navigation a[href*="vimeo.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_vimeo_color','#444444')); ?>;}.social-navigation a[href*="wordpress.com"]:before,.social-navigation a[href*="wordpress.org"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_wordpress_color','#444444')); ?>;}.social-navigation a[href*="youtube.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_youtube_color','#444444')); ?>;}.social-navigation a[href*="mailto:"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_mailto_color','#444444')); ?>;}.social-navigation a[href*="spotify.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_spotify_color','#444444')); ?>;}.social-navigation a[href*="twitch.tv"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitch_color','#444444')); ?>;}.social-navigation a:hover[href$="/feed/"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_feed_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="codepen.io"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_codepen_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="digg.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_digg_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="dribbble.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dribble_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="dropbox.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dropbox_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="facebook.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_facebook_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="flickr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_flicker_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="foursquare.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_foursquare_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="google.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_google_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="github.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_github_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="instagram.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_instagram_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="linkedin.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_linkedin_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="pinterest.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pinterest_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="getpocket.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pocket_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="polldaddy.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_polldaddy_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="reddit.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_reddit_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="stumbleupon.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_stumbleupon_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="tumblr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_tumblr_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="twitter.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitter_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="vimeo.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_vimeo_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="wordpress.com"]:before,.social-navigation a:hover[href*="wordpress.org"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_wordpress_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="youtube.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_youtube_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="mailto:"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_mailto_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="spotify.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_spotify_hover_color','#007095')); ?>;}.social-navigation a:hover[href*="twitch.tv"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitch_hover_color','#007095')); ?>;}</style>
<?php }
add_action( 'wp_head', 'wpforge_customize_css', 100);
}

/**
 * Registers our theme customizer preview with WordPress.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_customize_preview_js' ) ) {
  function wpforge_customize_preview_js() {
    wp_enqueue_script( 'wpforge-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '5.5.1.8', true );
  }
  add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );
}