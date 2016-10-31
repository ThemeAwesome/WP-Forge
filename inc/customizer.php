<?php
/**
* WP-Forge Theme Customizer
* A Theme Customizer for WP-Forge. Adds the individual, panels, sections, settings, and controls to the theme customizer
* @since WP-Forge 5.5.1.7
* @version 6.2.4.2
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
      'title'          => __('Header Settings', 'wp-forge'),
      'description'    => __('Deals with the header portion of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_background', array( // Background Panel
      'priority'       => 2,
      'capability'     => 'edit_theme_options',
      'title'          => __('Background Image Settings', 'wp-forge'),
      'description'    => __('Deals with the background of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_navigation', array( // Navigation Panel
      'priority'       => 4,
      'capability'     => 'edit_theme_options',
      'title'          => __('Main Menu Settings', 'wp-forge'),
      'description'    => __('Select the menu type you want to use with your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_colors', array( // Color Panel
      'priority'       => 5,
      'capability'     => 'edit_theme_options',
      'title'          => __('Color Settings', 'wp-forge'),
      'description'    => __('Deals with the colors of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_front_page', array( // Front Page Panel
      'priority'       => 6,
      'capability'     => 'edit_theme_options',
      'title'          => __('Front Page Settings', 'wp-forge'),
      'description'    => __('Deals with setting up the front page of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_content', array( // Content Panel
      'priority'       => 7,
      'capability'     => 'edit_theme_options',
      'title'          => __('Content Settings', 'wp-forge'),
      'description'    => __('Deals with the main content area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_main_sidebar', array( // Content Panel
      'priority'       => 8,
      'capability'     => 'edit_theme_options',
      'title'          => __('Main Sidebar Settings', 'wp-forge'),
      'description'    => __('Deals with the main sidebar area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_footer_sidebar', array( // Footer Sidebar Panel
      'priority'       => 9,
      'capability'     => 'edit_theme_options',
      'title'          => __('Footer Sidebar Settings', 'wp-forge'),
      'description'    => __('Deals with the footer sidebar area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_footer', array( // Footer Panel
      'priority'       => 10,
      'capability'     => 'edit_theme_options',
      'title'          => __('Footer Settings', 'wp-forge'),
      'description'    => __('Deals with the footer area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_panel( 'wpforge_buttons', array( // Foundation Button Panel
      'priority'       => 11,
      'capability'     => 'edit_theme_options',
      'title'          => __('Foundation Buttons', 'wp-forge'),
      'description'    => __('Deals with the different Foundation buttons available in your theme.', 'wp-forge'),
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
    'default' => '75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 15,
  ));
  $wp_customize->add_control('header_width',array(
    'label' => __('Header Content Width','wp-forge'),
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
  $wp_customize->add_setting('wpforge_site_title_font_size',array( /* site title font size */
    'default' => '3rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 25,
  ));
  $wp_customize->add_control('wpforge_site_title_font_size',array(
    'label' => __('Site Title Font Size','wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
    'priority' => 25,
  ));
  $wp_customize->add_setting('wpforge_site_desc_font_size',array( /* site description font size */
    'default' => '1.6875rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 30,
  ));
  $wp_customize->add_control('wpforge_site_desc_font_size',array(
    'label' => __('Site Description Font Size','wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
  ));
  $wp_customize->add_section('nav_content', array( /* nav wrapper section */
    'title' => __('Nav Content Area', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_navigation',
    'description' => __('Change the width and background color of the navigation area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_setting('nav_width',array( /* nav content width */
    'default' => '75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('nav_width',array(
    'label' => __('Nav Content Width','wp-forge'),
    'section' => 'nav_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('nav_wrap_main_color', array( /* nav background color */
    'default' => '#333333',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'nav_wrap_main_color',array(
    'label' => __('Nav Content Background Color', 'wp-forge'),
    'section' => 'nav_content',
    'settings' => 'nav_wrap_main_color',
  )));
  $wp_customize->add_section('wpforge_menu_options', array( /* nav wrapper section */
    'title' => __('Menu Selection', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_navigation',
    'description' => __('Select the menu type you want to use with your theme. If you select Off-Canvas, please be sure to set "Use Off-Canvas for Mobile?" to "No" under "Mobile Menu Settings".', 'wp-forge'),
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
    'label' => __('Select Main Menu Type', 'wp-forge'),
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
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_nav_position',array(
    'type' => 'select',
    'label' => __('Top-Bar Position', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'normal' => __('Normal Position', 'wp-forge'),
      'scroll' => __('Top of Browser - Scroll', 'wp-forge'),
      'fixed'  => __('Top of Browser - Fixed', 'wp-forge'),
      'sticky' => __('Contain-To-Grid-Sticky', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_title_area',array( /* show top-bar title area */
    'default' => 'yes',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_title_area',
    'priority' => 10,
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
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_position',
    'priority' => 15,
  ));
  $wp_customize->add_control('wpforge_link_position',array(
    'type' => 'select',
    'active_callback' => 'wpforge_link_position_callback',
    'label' => __('Top-Bar link position?', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'left'  => __('Links to the left', 'wp-forge'),
      'right' => __('Links to the right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_nav_text',array( /* top-bar main link anchor text */
    'default' => 'Home',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 20,
  ));
  $wp_customize->add_control('wpforge_nav_text',array(
    'label' => __('Change text of title area','wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'wpforge_title_callback',
  ));
  $wp_customize->add_setting('wpforge_top_bar_font_size',array( /* top-bar font size */
    'default' => '0.825rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 25,
  ));
  $wp_customize->add_control('wpforge_top_bar_font_size',array(
    'label' => __('Top-Bar Font Size','wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
  ));
     $wp_customize->add_setting('wpforge_top_bar_arrow_position',array( /* top-bar arrow position */
    'default' => '-0.3125rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 30,
  ));
  $wp_customize->add_control('wpforge_top_bar_arrow_position',array(
    'label' => __('Top-Bar Dropdown Arrow Position','wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
  ));
  $wp_customize->add_section('wpforge_off_canvas', array( /* off-canvas section */
    'title' => __('Off-Canvas Settings', 'wp-forge'),
    'active_callback' => 'wpforge_off_canvas_callback',
    'description' => __('Configure the Off-Canvas Navigation area of your theme. You can change the size of links in the menu.', 'wp-forge'),
    'priority' => 45,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_title_font_size',array( /* off-canvas title font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_off_canvas_title_font_size',array(
    'label' => __('Off-Canvas Title Bar Font Size','wp-forge'),
    'section' => 'wpforge_off_canvas',
    'type' => 'text',
  ));

  $wp_customize->add_setting('wpforge_off_canvas_font_size',array( /* off-canvas font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_off_canvas_font_size',array(
    'label' => __('Off-Canvas Link Font Size','wp-forge'),
    'section' => 'wpforge_off_canvas',
    'type' => 'text',
  ));





  $wp_customize->add_section('wpforge_mobile_settings', array( /* mobile menu section */
    'title' => __('Mobile Menu Settings', 'wp-forge'),
    'description' => __('Choose to use Off-Canvas for mobile view, change the hamburger icon text and position the hamburger icon.', 'wp-forge'),
    'priority' => 60,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_mobile_display',array( /* off-canvas for mobile */
    'default' => 'no',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_display',
    'priority' => 1,
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
  $wp_customize->add_setting('wpforge_off_canvas_text',array( /* off-canvas main link anchor text */
    'default' => 'Home',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_off_canvas_text',array(
    'label' => __('Change hamburger icon text','wp-forge'),
    'section' => 'wpforge_mobile_settings',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_mobile_position',array( /* hamburger icon position */
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_position',
    'priority' => 3,
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
    'description' => __('Change all the colors of the Top-Bar, including the Hamburger icon and title link in mobile view.', 'wp-forge'),
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
    'label' => __('Top-Bar Main Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_main_color',
  )));
  $wp_customize->add_setting('top_bar_hover_color', array( /* top-bar hover color */
    'default' => '#242424',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hover_color',array(
    'label' => __('Top-Bar Link Background Hover Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_hover_color',
  )));
  $wp_customize->add_setting('top_bar_active_color', array( /* top-bar active color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_color',array(
    'label' => __('Top-Bar Active Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_active_color',
  )));
  $wp_customize->add_setting('top_bar_font_color', array( /* top-bar font color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_color',array(
    'label' => __('Top-Bar Link Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_font_color',
  )));
  $wp_customize->add_setting('top_bar_font_hover_color', array( /* top-bar font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_hover_color',array(
    'label' => __('Top-Bar Link Hover Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_font_hover_color',
  )));
  $wp_customize->add_setting('top_bar_dropdown_arrow_color', array( /* top-bar dropdown arrow color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_dropdown_arrow_color',array(
    'label' => __('Top-Bar Dropdown Arrow Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_dropdown_arrow_color',
  )));
  $wp_customize->add_setting('top_bar_hamburger_color', array( /* top-bar hamburger icon color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hamburger_color',array(
    'label' => __('Hamburger Icon Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_hamburger_color',
  )));
  $wp_customize->add_setting('top_bar_hamburger_hover_color', array( /* top-bar hamburger icon hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 12,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hamburger_hover_color',array(
    'label' => __('Hamburger Icon Hover Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_hamburger_hover_color',
  )));
      $wp_customize->add_setting('top_bar_home_link_color', array( /* top-bar home link color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 13,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_home_link_color',array(
    'label' => __('Top-Bar Title Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_home_link_color',
  )));
  $wp_customize->add_setting('top_bar_home_link_hover_color', array( /* top-bar home link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 14,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_home_link_hover_color',array(
    'label' => __('Top-Bar Title Hover Color', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_home_link_hover_color',
  )));
  $wp_customize->add_section('wpforge_off_canvas_colors', array( /* off-canvas colors section */
    'title' => __('Off-Canvas Colors', 'wp-forge'),
    'description' => __('Change colors of the Off-Canvas Menu.', 'wp-forge'),
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
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_color',array(
    'label' => __('Hamburger Icon Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_hover_color', array( /* hamburger icon hover color */
    'default' => '#e6e6e6',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_hover_color',array(
    'label' => __('Hamburger Icon Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_hover_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_title_color', array( /* hamburger icon title color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_title_color',array(
    'label' => __('Hamburger Icon Title Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_title_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_title_hover_color', array( /* hamburger icon title hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_title_hover_color',array(
    'label' => __('Hamburger Icon Title Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_title_hover_color',
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
    'default' => '#e6e6e6',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_hover_color',array(
    'label' => __('Off-Canvas Link Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_hover_color',
  )));
  $wp_customize->add_setting('wpforge_off_dropdown_arrow_color', array( /* off-canvas dropdown arrow color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_dropdown_arrow_color',array(
    'label' => __('Off-Canvas Dropdown Arrow Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_dropdown_arrow_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_background_hover_color', array( /* off-canvas background hover color */
    'default' => '#242424',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_background_hover_color',array(
    'label' => __('Off-Canvas Link Background Hover Color', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_background_hover_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_active_color', array( /* off-canvas active color */
    'default' => '#008CBA',
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
  $wp_customize->add_section('content_colors', array( /* content color section */
    'title' => __('Post Colors', 'wp-forge'),
    'description' => __('Change text, link and hover colors in the Content section of your theme.', 'wp-forge'),
    'priority' => 65,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('category_link_color', array( /* category link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'category_link_color',array(
    'label' => __('Category Link Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'category_link_color',
  )));
  $wp_customize->add_setting('category_link_hover_color', array( /* category link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'category_link_hover_color',array(
    'label' => __('Category Link Hover Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'category_link_hover_color',
  )));
  $wp_customize->add_setting('post_title_link_color', array( /* post title link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'post_title_link_color',array(
    'label' => __('Post Title Link Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'post_title_link_color',
  )));
  $wp_customize->add_setting('post_title_link_hover_color', array( /* post title link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'post_title_link_hover_color',array(
    'label' => __('Post Title Link Hover Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'post_title_link_hover_color',
  )));
  $wp_customize->add_setting('single_post_title_color', array( /* single post title color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'single_post_title_color',array(
    'label' => __('Single Post View Title Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'single_post_title_color',
  )));
  $wp_customize->add_setting('meta_header_link_color', array( /* meta header link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'meta_header_link_color',array(
    'label' => __('Post Meta Link Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'meta_header_link_color',
  )));
  $wp_customize->add_setting('meta_header_link_hover_color', array( /* meta header link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'meta_header_link_hover_color',array(
    'label' => __('Post Meta Link Hover Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'meta_header_link_hover_color',
  )));
  $wp_customize->add_setting('content_font_color', array( /* content font color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_font_color',array(
    'label' => __('Post Text Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_font_color',
  )));
  $wp_customize->add_setting('content_link_color', array( /* content link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_link_color',array(
    'label' => __('Post Link Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_link_color',
  )));
  $wp_customize->add_setting('content_hover_color', array( /*content link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_hover_color',array(
    'label' => __('Post Link Hover Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_hover_color',
  )));
  $wp_customize->add_setting('tag_link_color', array( /* tag link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tag_link_color',array(
    'label' => __('Tag Link Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'tag_link_color',
  )));
  $wp_customize->add_setting('tag_link_hover_color', array( /* tag link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 12,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tag_link_hover_color',array(
    'label' => __('Tag Link Hover Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'tag_link_hover_color',
  )));
  $wp_customize->add_setting('wpforge_content_h1_color', array( /* content h1 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 13,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h1_color',array(
    'label' => __('Post Content H1 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h1_color',
  )));
  $wp_customize->add_setting('wpforge_content_h2_color', array( /* content h2 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 14,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h2_color',array(
    'label' => __('Post Content H2 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h2_color',
  )));
  $wp_customize->add_setting('wpforge_content_h3_color', array( /* content h3 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h3_color',array(
    'label' => __('Post Content H3 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h3_color',
  )));
  $wp_customize->add_setting('wpforge_content_h4_color', array( /* content h4 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 16,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h4_color',array(
    'label' => __('Post Content H4 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h4_color',
  )));
  $wp_customize->add_setting('wpforge_content_h5_color', array( /* content h5 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 17,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h5_color',array(
    'label' => __('Post Content H5 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h5_color',
  )));
  $wp_customize->add_setting('wpforge_content_h6_color', array( /* content h6 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 18,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h6_color',array(
    'label' => __('Post Content H6 Color', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h6_color',
  )));
    $wp_customize->add_section('wpforge_page_colors', array( /* page color section */
    'title' => __('Page Colors', 'wp-forge'),
    'description' => __('Change the colors of text, links and hover colors in the page content of your theme.', 'wp-forge'),
    'priority' => 70,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('wpforge_page_title_color', array( /* page title color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_title_color',array(
    'label' => __('Page Title Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_title_color',
  )));
  $wp_customize->add_setting('wpforge_page_link_color', array( /* page link color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_link_color',array(
    'label' => __('Page Link Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_link_color',
  )));
  $wp_customize->add_setting('wpforge_page_link_hover_color', array( /* page link hover color */
    'default' => '#0078a0',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_link_hover_color',array(
    'label' => __('Page Link Hover Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_link_hover_color',
  )));
  $wp_customize->add_setting('wpforge_page_h1_color', array( /* page h1 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h1_color',array(
    'label' => __('Page H1 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h1_color',
  )));
  $wp_customize->add_setting('wpforge_page_h2_color', array( /* page h2 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h2_color',array(
    'label' => __('Page H2 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h2_color',
  )));
  $wp_customize->add_setting('wpforge_page_h3_color', array( /* page h3 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h3_color',array(
    'label' => __('Page H3 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h3_color',
  )));
  $wp_customize->add_setting('wpforge_page_h4_color', array( /* page h4 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h4_color',array(
    'label' => __('Page H4 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h4_color',
  )));
  $wp_customize->add_setting('wpforge_page_h5_color', array( /* page h5 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h5_color',array(
    'label' => __('Page H5 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h5_color',
  )));
  $wp_customize->add_setting('wpforge_page_h6_color', array( /* page h6 color */
    'default' => '#444444',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h6_color',array(
    'label' => __('Page H6 Color', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h6_color',
  )));
  $wp_customize->add_section('pagination_colors', array( /* pagination color section */
    'title' => __('Pagination Colors', 'wp-forge'),
    'description' => __('Deals with the colors of the built-in pagination.', 'wp-forge'),
    'priority' => 75,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('pagination_current_color', array( /* pagination current color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_color',array(
    'label' => __('Active Background Color', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_color',
  )));
  $wp_customize->add_setting('pagination_current_font_color', array( /* pagination current font color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_font_color',array(
    'label' => __('Active Font Color', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_font_color',
  )));
  $wp_customize->add_setting('pagination_link_color', array( /* pagination link color */
    'default' => '#999999',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_color',array(
    'label' => __('Pagination Link Color', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_color',
  )));
  $wp_customize->add_setting('pagination_link_hover_color', array( /* pagination link hover color */
    'default' => '#999999',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_hover_color',array(
    'label' => __('Pagination Link Hover Color', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_hover_color',
  )));
  $wp_customize->add_setting('pagination_hover_color', array( /* pagination background hover color */
    'default' => '#e6e6e6',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_hover_color',array(
    'label' => __('Pagination Background Hover Color', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_hover_color',
  )));
  $wp_customize->add_section('main_sidebar_colors', array( /* sidebar colors section */
    'title' => __('Main Sidebar Colors', 'wp-forge'),
    'description' => __('Change widget title, link and hover colors of main sidebar.', 'wp-forge'),
    'priority' => 80,
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
    'default' => '#0078a0',
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
    'priority' => 85,
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
    'default' => '#0078a0',
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
    'priority' => 90,
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
    'default' => '#0078a0',
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
  $wp_customize->add_section('backtotop_colors', array( /* back to top section or btt */
    'title' => __('Back To Top Colors', 'wp-forge'),
    'description' => __('Change the color and hover colors of the back to top button.', 'wp-forge'),
    'priority' => 100,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('backtotop_color', array( /* btt color */
    'default' => '#333333',
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
    'default' => '#242424',
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
    'priority' => 105,
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
    'default' => '#0078a0',
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
  $wp_customize->add_setting('wpforge_home_page_title_display',array( /* home page title display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_home_page_display',
    'priority' => 10,
  ));
  $wp_customize->add_control('wpforge_home_page_title_display',array(
    'type' => 'select',
    'active_callback' => 'wpforge_home_page_title_callback',
    'label' => __('Show title on home page?', 'wp-forge'),
    'section' => 'static_front_page',
    'choices' => array(
      'yes' => __('Yes, show the title', 'wp-forge'),
      'no'  => __('No, hide the title', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('wpforge_foundation_css_settings', array( /* foundation css settings */
    'title' => __('Foundation CSS Settings', 'wp-forge'),
    'description' => __('This section allows you to choose which Foundation CSS system, float or flex, you want to use.', 'wp-forge'),
    'priority' => 1,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_select_css',array( /* select the css you want to use */
    'default' => 'float',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_css_selection',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_select_css',array(
    'type' => 'select',
    'label' => __('Which system to use?', 'wp-forge'),
    'section' => 'wpforge_foundation_css_settings',
    'choices' => array(
      'float'   => __('Float', 'wp-forge'),
      'flex'    => __('Flex', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('content_layout', array( /* content section */
    'title' => __('Main Content Area', 'wp-forge'),
    'description' => __('Change width and background color of main content area.', 'wp-forge'),
    'priority' => 20,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('content_width',array( /* content width */
    'default' => '75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('content_width',array(
    'label' => __('Content Width (Default is 75rem)','wp-forge'),
    'section' => 'content_layout',
    'type' => 'text',
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
  $wp_customize->add_section('sidebar_layout', array( /* sidebar section */
    'title' => __('Content Position', 'wp-forge'),
    'description' => __('Adjust the position of the main content area.', 'wp-forge'),
    'priority' => 20,
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
    'label' => __('Main Content Positon', 'wp-forge'),
    'section' => 'sidebar_layout',
    'choices' => array(
      'left' => __('Left', 'wp-forge'),
      'right'  => __('Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('post_layout', array( /* posts section */
    'title' => __('Post Configuration', 'wp-forge'),
    'description' => __('Configure the appearance of certain post elements in your theme.', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_cat_display',array( /* show categories */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_cat_display',
    'priority' => 1,
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
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_cat_position',array(
    'type' => 'select',
    'active_callback' => 'wpforge_cat_callback',
    'label' => __('Where to display categories?', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'top'     => __('Above post title', 'wp-forge'),
      'bottom'  => __('Above post tags', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_category_font_size',array( /* category font size */
    'default' => '0.75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_category_font_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_cat_position_callback_top',
    'label' => __('Categories Above Title Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_category_tag_font_size',array( /* category above tags font size */
    'default' => '0.75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_category_tag_font_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_cat_position_callback_bottom',
    'label' => __('Categories Above Tags Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
     $wp_customize->add_setting('wpforge_category_gen_font_size',array( /* category genericon font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_category_gen_font_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_cat_position_callback_bottom',
    'label' => __('Categories Displayed Above Tags Genericon Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_post_title_font_size',array( /* post title font size */
    'default' => '3rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_post_title_font_size',array(
    'type' => 'text',
    'label' => __('Post Title Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_meta_display',array( /* meta display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_meta_display',
    'priority' => 7,
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
  $wp_customize->add_setting('wpforge_postmeta_font_size',array( /* postmeta font size */
    'default' => '0.75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 8,
  ));
  $wp_customize->add_control('wpforge_postmeta_font_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_postmeta_callback',
    'label' => __('Post Meta Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_postmeta_gen_font_size',array( /* postmeta genericon font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 9,
  ));
  $wp_customize->add_control('wpforge_postmeta_gen_font_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_postmeta_callback',
    'label' => __('Post Meta Genericon Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_post_display',array( /* full post or excerpt */
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
  $wp_customize->add_setting('wpforge_thumb_display',array( /* display thumbs on index page */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_thumb_display',
    'priority' => 11,
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
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_single_thumb_display',
    'priority' => 12,
  ));
  $wp_customize->add_control('wpforge_single_thumb_display',array(
    'type'    => 'select',
    'label'   => __('Show single view post thumbnail?', 'wp-forge'),
    'section'   => 'post_layout',
    'choices'   => array(
      'no'  => __('No', 'wp-forge'),
      'yes'   => __('Yes', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_font_size',array( /* post font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 13,
  ));
  $wp_customize->add_control('wpforge_post_font_size',array(
    'type' => 'text',
    'label' => __('Post Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_change_tag_settings',array( /* meta display */
    'default' => 'select',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_change_tag_settings',
    'priority' => 14,
  ));
  $wp_customize->add_control('wpforge_change_tag_settings',array(
    'type' => 'select',
    'label' => __('Change Font Size of Content Headings', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'select' => __('Select a Heading Tag', 'wp-forge'),
      'change_h1'  => __('H1 Heading Tag', 'wp-forge'),
      'change_h2'  => __('H2 Heading Tag', 'wp-forge'),
      'change_h3'  => __('H3 Heading Tag', 'wp-forge'),
      'change_h4'  => __('H4 Heading Tag', 'wp-forge'),
      'change_h5'  => __('H5 Heading Tag', 'wp-forge'),
      'change_h6'  => __('H6 Heading Tag', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_h1_size',array( /* Post H1 font size */
    'default' => '3rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 15,
  ));
  $wp_customize->add_control('wpforge_post_h1_size',array(
    'label' => __('Post H1 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h1_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h2_size',array( /* Post H2 font size */
    'default' => '2.5rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 16,
  ));
  $wp_customize->add_control('wpforge_post_h2_size',array(
    'label' => __('Post H2 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h2_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h3_size',array( /* Post H3 font size */
    'default' => '1.9375rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 17,
  ));
  $wp_customize->add_control('wpforge_post_h3_size',array(
    'label' => __('Post H3 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h3_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h4_size',array( /* Post H4 font size */
    'default' => '1.5625rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 18,
  ));
  $wp_customize->add_control('wpforge_post_h4_size',array(
    'label' => __('Post H4 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h4_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h5_size',array( /* Post H5 font size */
    'default' => '1.25rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 19,
  ));
  $wp_customize->add_control('wpforge_post_h5_size',array(
    'label' => __('Post H5 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h5_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h6_size',array( /* Post H6 font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 20,
  ));
  $wp_customize->add_control('wpforge_post_h6_size',array(
    'label' => __('Post H6 Font Size','wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h6_tag',
  ));
  $wp_customize->add_setting('wpforge_tag_display',array( /* tag display */
    'default' => 'yes',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_tag_display',
    'priority' => 21,
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
  $wp_customize->add_setting('wpforge_post_tag_size',array( /* post tag size */
    'default' => '0.75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 22,
  ));
  $wp_customize->add_control('wpforge_post_tag_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_post_tag_callback',
    'label' => __('Tag Font Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_tag_gen_size',array( /* post tag size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 23,
  ));
  $wp_customize->add_control('wpforge_tag_gen_size',array(
    'type' => 'text',
    'active_callback' => 'wpforge_tag_gen_callback',
    'label' => __('Tag Genericon Size','wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_post_link_decoration',array( /* post link decoration */
    'default' => 'none',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 24,
  ));
  $wp_customize->add_control('wpforge_post_link_decoration',array(
    'type' => 'select',
    'label' => __('Post Link Decoration', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'none'          => __('none', 'wp-forge'),
      'underline'     => __('underline', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_link_hover_decoration',array( /* post link hover decoration */
    'default' => 'none',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 25,
  ));
  $wp_customize->add_control('wpforge_post_link_hover_decoration',array(
    'type' => 'select',
    'label' => __('Post Link Hover Decoration', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'none'          => __('none', 'wp-forge'),
      'underline'     => __('underline', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_link_weight',array( /* post link weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 26,
  ));
  $wp_customize->add_control('wpforge_post_link_weight',array(
    'type' => 'select',
    'label' => __('Post Link Font Weight', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_nav_display',array( /* post navigation */
    'default' => 'default',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_wpforge_post_nav_display',
    'priority' => 27,
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
  $wp_customize->add_setting('wpforge_comment_layout',array( /* comment form layout */
    'default' => 'new',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_wpforge_comment_layout',
    'priority' => 28,
  ));
  $wp_customize->add_control('wpforge_comment_layout',array(
    'type'    => 'select',
    'label'   => __('Change Comment Form Layout?', 'wp-forge'),
    'section'   => 'post_layout',
    'choices'   => array(
      'new'  => __('New Comment Layout', 'wp-forge'),
      'old'  => __('Old Comment Layout', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('page_layout', array( /* page section */
    'title' => __('Page Configuration', 'wp-forge'),
    'description' => __('Configure the appearance of certain page elements in your theme.', 'wp-forge'),
    'priority' => 40,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_page_title_font_size',array( /* page title font size */
    'default' => '3rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_page_title_font_size',array(
    'type' => 'text',
    'label' => __('Page Title Font Size','wp-forge'),
    'section' => 'page_layout',
  ));
  $wp_customize->add_setting('wpforge_page_content_font_size',array( /* page content font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_page_content_font_size',array(
    'type' => 'text',
    'label' => __('Page Content Font Size','wp-forge'),
    'section' => 'page_layout',
  ));
  $wp_customize->add_setting('wpforge_page_link_decoration',array( /* page link decoration */
    'default' => 'none',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_page_link_decoration',array(
    'type' => 'select',
    'label' => __('Page Link Decoration', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'none'          => __('none', 'wp-forge'),
      'underline'     => __('underline', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_page_link_hover_decoration',array( /* page link hover decoration */
    'default' => 'underline',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_page_link_hover_decoration',array(
    'type' => 'select',
    'label' => __('Page Link Hover Decoration', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'underline'     => __('underline', 'wp-forge'),
      'none'          => __('none', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_page_link_weight',array( /* page link weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_page_link_weight',array(
    'type' => 'select',
    'label' => __('Page Link Font Weight', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_change_page_tag_settings',array( /* change page heading sizes */
    'default' => 'select',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_change_page_tag_settings',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_change_page_tag_settings',array(
    'type' => 'select',
    'label' => __('Change Font Size of Page Headings', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'select' => __('Select a Heading Tag', 'wp-forge'),
      'change_page_h1'  => __('H1 Heading Tag', 'wp-forge'),
      'change_page_h2'  => __('H2 Heading Tag', 'wp-forge'),
      'change_page_h3'  => __('H3 Heading Tag', 'wp-forge'),
      'change_page_h4'  => __('H4 Heading Tag', 'wp-forge'),
      'change_page_h5'  => __('H5 Heading Tag', 'wp-forge'),
      'change_page_h6'  => __('H6 Heading Tag', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_page_h1_size',array( /* page h1 font size */
    'default' => '3rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 7,
  ));
  $wp_customize->add_control('wpforge_page_h1_size',array(
    'label' => __('Page H1 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h1_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h2_size',array( /* page h2 font size */
    'default' => '2.5rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 8,
  ));
  $wp_customize->add_control('wpforge_page_h2_size',array(
    'label' => __('Page H2 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h2_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h3_size',array( /* page h3 font size */
    'default' => '1.9375rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 9,
  ));
  $wp_customize->add_control('wpforge_page_h3_size',array(
    'label' => __('Page H3 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h3_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h4_size',array( /* page h4 font size */
    'default' => '1.5625rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('wpforge_page_h4_size',array(
    'label' => __('Page H4 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h4_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h5_size',array( /* page h5 font size */
    'default' => '1.25rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 11,
  ));
  $wp_customize->add_control('wpforge_page_h5_size',array(
    'label' => __('Page H5 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h5_tag',
  ));
  $wp_customize->add_setting('wpforge_page_h6_size',array( /* page h6 font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 12,
  ));
  $wp_customize->add_control('wpforge_page_h6_size',array(
    'label' => __('Page H6 Font Size','wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h6_tag',
  ));
  $wp_customize->add_section('wpforge_sidebar_content', array( /* main sidebar content section */
    'title' => __('Main Sidebar Content', 'wp-forge'),
    'description' => __('Deals with various settings of the main sidebar of your theme.', 'wp-forge'),
    'priority' => 1,
    'panel' => 'wpforge_main_sidebar',
  ));
  $wp_customize->add_setting('wpforge_sidebar_widget_title',array( /* sidebar widget title size */
    'default' => '0.875rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_sidebar_widget_title',array(
    'label' => __('Sidebar Widget Title Font Size','wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_sidebar_widget_title_transform',array( /* sidebar widget title transform */
    'default' => 'uppercase',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_widget_transform',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_sidebar_widget_title_transform',array(
    'type' => 'select',
    'label' => __('Sidebar Widget Title Text Transform', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'uppercase'   => __('Uppercase', 'wp-forge'),
      'none'        => __('None', 'wp-forge'),
      'capitalize'  => __('Capitalize', 'wp-forge'),
      'lowercase'   => __('Lowercase', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_sidebar_widget_title_weight',array( /* sidebar widget title weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_sidebar_widget_title_weight',array(
    'type' => 'select',
    'label' => __('Sidebar Widget Title Weight', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_sidebar_font_size',array( /* sidebar font size */
    'default' => '0.875rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_sidebar_font_size',array(
    'label' => __('Sidebar Font Size','wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_sidebar_link_decoration',array( /* sidebar link decoration */
    'default' => 'none',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_sidebar_link_decoration',array(
    'type' => 'select',
    'label' => __('Sidebar Link Decoration', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'none'          => __('none', 'wp-forge'),
      'underline'     => __('underline', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_sidebar_link_hover_decoration',array( /* sidebar link hover decoration */
    'default' => 'underline',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_sidebar_link_hover_decoration',array(
    'type' => 'select',
    'label' => __('Sidebar Link Hover Decoration', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'underline'     => __('underline', 'wp-forge'),
      'none'          => __('none', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_sidebar_link_weight',array( /* sidebar link weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 7,
  ));
  $wp_customize->add_control('wpforge_sidebar_link_weight',array(
    'type' => 'select',
    'label' => __('Sidebar Link Font Weight', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('wpforge_footer_sidebar_content', array( /* footer sidebar content section */
    'title' => __('Footer Sidebar Content', 'wp-forge'),
    'description' => __('Change settings for the Footer Sidebar area of your theme.', 'wp-forge'),
    'priority' => 20,
    'panel' => 'wpforge_footer_sidebar',
  ));
  $wp_customize->add_setting('footer_sidebar_width',array( /* footer sidebar content width */
    'default' => '75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('footer_sidebar_width',array(
    'label' => __('Footer Sidebar Content Width','wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('footer_sidebar_color', array( /* footer sidebar contet background color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_sidebar_color',array(
    'label' => __('Footer Sidebar Background Color', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'settings' => 'footer_sidebar_color',
  )));
  $wp_customize->add_setting('wpforge_footer_sidebar_widget_title',array( /* footer sidebar widget title size */
    'default' => '0.875rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_widget_title',array(
    'label' => __('Footer Sidebar Widget Title Font Size','wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_widget_title_transform',array( /* footer sidebar widget title transform */
    'default' => 'uppercase',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_widget_transform',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_widget_title_transform',array(
    'type' => 'select',
    'label' => __('Footer Sidebar Widget Title Transform', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'uppercase'   => __('Uppercase', 'wp-forge'),
      'none'        => __('None', 'wp-forge'),
      'capitalize'  => __('Capitalize', 'wp-forge'),
      'lowercase'   => __('Lowercase', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_widget_title_weight',array( /* footer sidebar widget title weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_widget_title_weight',array(
    'type' => 'select',
    'label' => __('Footer Sidebar Widget Title Weight', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_font_size',array( /* footer sidebar font size */
    'default' => '0.875rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_font_size',array(
    'label' => __('Footer Sidebar Font Size','wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_link_decoration',array( /* footer sidebar link decoration */
    'default' => 'none',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 7,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_link_decoration',array(
    'type' => 'select',
    'label' => __('Footer Sidebar Link Decoration', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'none'          => __('none', 'wp-forge'),
      'underline'     => __('underline', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_link_hover_decoration',array( /* footer sidebar link hover decoration */
    'default' => 'underline',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_decoration',
    'priority' => 8,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_link_hover_decoration',array(
    'type' => 'select',
    'label' => __('Footer Sidebar Link Hover Decoration', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'underline'     => __('underline', 'wp-forge'),
      'none'          => __('none', 'wp-forge'),
      'overline'      => __('overline', 'wp-forge'),
      'line-through'  => __('line-through', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_link_weight',array( /* footer sidebar link weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 9,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_link_weight',array(
    'type' => 'select',
    'label' => __('Footer Sidebar Link Font Weight', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('footer_content', array( /* footer content section */
    'title' => __('Footer Content', 'wp-forge'),
    'description' => __('Deals with the content area of the footer.', 'wp-forge'),
    'priority' => 40,
    'panel' => 'wpforge_footer',
  ));
  $wp_customize->add_setting('footer_content_width',array( /* footer content width */
    'default' => '75rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('footer_content_width',array(
    'label' => __('Footer Content Width','wp-forge'),
    'section' => 'footer_content',
    'type' => 'text',
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
    'label' => __('Footer Content Background Color', 'wp-forge'),
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
  $wp_customize->add_setting('wpforge_footer_txt_size',array( /* footer text font size */
    'default' => '1rem',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 30,
  ));
  $wp_customize->add_control('wpforge_footer_txt_size',array(
    'label' => __('Footer Font Size','wp-forge'),
    'section' => 'footer_content',
    'type' => 'text',
  ));
  $wp_customize->add_section('primary_button_settings', array( /* primary button settings */
    'title' => __('Primary Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Primary Button.', 'wp-forge'),
    'priority' => 1,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('primary_button_color', array( /* primary button color */
    'default' => '#008cba',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_color',array(
    'label' => __('Primary Button Color', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_color',
  )));
  $wp_customize->add_setting('primary_button_hover_color', array( /* primary button hover color */
    'default' => '#007095',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_hover_color',array(
    'label' => __('Primary Button Hover Color', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_hover_color',
  )));
  $wp_customize->add_setting('primary_button_font_color', array( /* primary button text color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_font_color',array(
    'label' => __('Primary Button Font Color', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_font_color',
  )));
  $wp_customize->add_setting('primary_button_font_hover_color', array( /* primary button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_font_hover_color',array(
    'label' => __('Primary Button Font Hover Color', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_font_hover_color',
  )));
  $wp_customize->add_setting('primary_button_font_weight',array( /* primary button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('primary_button_font_weight',array(
    'type' => 'select',
    'label' => __('Primary Button Font Weight', 'wp-forge'),
    'section' => 'primary_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('secondary_button_settings', array( /* secondary button settings */
    'title' => __('Secondary Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Secondary Button.', 'wp-forge'),
    'priority' => 2,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('secondary_button_color', array( /* secondary button color */
    'default' => '#777777',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_color',array(
    'label' => __('Secondary Button Color', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_color',
  )));
  $wp_customize->add_setting('secondary_button_hover_color', array( /* secondary button hover color */
    'default' => '#5f5f5f',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_hover_color',array(
    'label' => __('secondary Button Hover Color', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_hover_color',
  )));
  $wp_customize->add_setting('secondary_button_font_color', array( /* secondary button text color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_font_color',array(
    'label' => __('Secondary Button Font Color', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_font_color',
  )));
  $wp_customize->add_setting('secondary_button_font_hover_color', array( /* secondary button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_font_hover_color',array(
    'label' => __('Secondary Button Font Hover Color', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_font_hover_color',
  )));
  $wp_customize->add_setting('secondary_button_font_weight',array( /* secondary button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('secondary_button_font_weight',array(
    'type' => 'select',
    'label' => __('Secondary Button Font Weight', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('success_button_settings', array( /* success button settings */
    'title' => __('Success Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Success Button.', 'wp-forge'),
    'priority' => 3,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('success_button_color', array( /* success button color */
    'default' => '#3adb76',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_color',array(
    'label' => __('Success Button Color', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_color',
  )));
  $wp_customize->add_setting('success_button_hover_color', array( /* success button hover color */
    'default' => '#22bb5b',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_hover_color',array(
    'label' => __('Success Button Hover Color', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_hover_color',
  )));
  $wp_customize->add_setting('success_button_font_color', array( /* success button text color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_font_color',array(
    'label' => __('Success Button Font Color', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_font_color',
  )));
  $wp_customize->add_setting('success_button_font_hover_color', array( /* success button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_font_hover_color',array(
    'label' => __('Success Button Font Hover Color', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_font_hover_color',
  )));
  $wp_customize->add_setting('success_button_font_weight',array( /* success button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('success_button_font_weight',array(
    'type' => 'select',
    'label' => __('Success Button Font Weight', 'wp-forge'),
    'section' => 'success_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('warning_button_settings', array( /* Warning Button settings */
    'title' => __('Warning Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Warning Button.', 'wp-forge'),
    'priority' => 4,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('warning_button_color', array( /* Warning Button color */
    'default' => '#ffae00',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_color',array(
    'label' => __('Warning Button Color', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_color',
  )));
  $wp_customize->add_setting('warning_button_hover_color', array( /* Warning Button hover color */
    'default' => '#cc8b00',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_hover_color',array(
    'label' => __('Warning Button Hover Color', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_hover_color',
  )));
  $wp_customize->add_setting('warning_button_font_color', array( /* Warning Button text color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_font_color',array(
    'label' => __('Warning Button Font Color', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_font_color',
  )));
  $wp_customize->add_setting('warning_button_font_hover_color', array( /* Warning Button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_font_hover_color',array(
    'label' => __('Warning Button Font Hover Color', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_font_hover_color',
  )));
  $wp_customize->add_setting('warning_button_font_weight',array( /* Warning Button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('warning_button_font_weight',array(
    'type' => 'select',
    'label' => __('Warning Button Font Weight', 'wp-forge'),
    'section' => 'warning_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('alert_button_settings', array( /* Alert Button settings */
    'title' => __('Alert Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Alert Button.', 'wp-forge'),
    'priority' => 5,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('alert_button_color', array( /* Alert Button color */
    'default' => '#ec5840',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_color',array(
    'label' => __('Alert Button Color', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_color',
  )));
  $wp_customize->add_setting('alert_button_hover_color', array( /* Alert Button hover color */
    'default' => '#da3116',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_hover_color',array(
    'label' => __('Alert Button Hover Color', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_hover_color',
  )));
  $wp_customize->add_setting('alert_button_font_color', array( /* Alert Button text color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_font_color',array(
    'label' => __('Alert Button Font Color', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_font_color',
  )));
  $wp_customize->add_setting('alert_button_font_hover_color', array( /* Alert Button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_font_hover_color',array(
    'label' => __('Alert Button Font Hover Color', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_font_hover_color',
  )));
  $wp_customize->add_setting('alert_button_font_weight',array( /* Alert Button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('alert_button_font_weight',array(
    'type' => 'select',
    'label' => __('Alert Button Font Weight', 'wp-forge'),
    'section' => 'alert_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('info_button_settings', array( /* Info Button settings */
    'title' => __('Info Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of the Info Button.', 'wp-forge'),
    'priority' => 6,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('info_button_color', array( /* Info Button color */
    'default' => '#a0d3e8',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_color',array(
    'label' => __('Info Button Color', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_color',
  )));
  $wp_customize->add_setting('info_button_hover_color', array( /* Info Button hover color */
    'default' => '#61b6d9',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_hover_color',array(
    'label' => __('Info Button Hover Color', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_hover_color',
  )));
  $wp_customize->add_setting('info_button_font_color', array( /* Info Button text color */
    'default' => '#333333',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_font_color',array(
    'label' => __('Info Button Font Color', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_font_color',
  )));
  $wp_customize->add_setting('info_button_font_hover_color', array( /* Info Button font hover color */
    'default' => '#ffffff',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_font_hover_color',array(
    'label' => __('Info Button Font Hover Color', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_font_hover_color',
  )));
  $wp_customize->add_setting('info_button_font_weight',array( /* Info Button font weight */
    'default' => 'normal',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_link_weight',
    'priority' => 5,
  ));
  $wp_customize->add_control('info_button_font_weight',array(
    'type' => 'select',
    'label' => __('Info Button Font Weight', 'wp-forge'),
    'section' => 'info_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
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
        'scroll' => __('Top of Browser - Scroll', 'wp-forge'),
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
        'left'  => __('Links to the left', 'wp-forge'),
        'right' => __('Links to the right', 'wp-forge'),
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
  function wpforge_sanitize_wpforge_comment_layout( $input ) { // Comment Form Layout
      $valid = array(
        'new'   => __('New Comment Layout', 'wp-forge'),
        'old'  => __('Old Comment Layout', 'wp-forge'),
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
  function wpforge_sanitize_home_page_display( $input ) { // home page select
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
  function wpforge_sanitize_widget_transform( $input ) { // widget transform
      $valid = array(
        'uppercase'   => __('Uppercase', 'wp-forge'),
        'none'        => __('None', 'wp-forge'),
        'capitalize'  => __('Capitalize', 'wp-forge'),
        'lowercase'   => __('Lowercase', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_link_decoration( $input ) { // link hover decoration
      $valid = array(
        'underline'     => __('underline', 'wp-forge'),
        'none'          => __('none', 'wp-forge'),
        'overline'      => __('overline', 'wp-forge'),
        'line-through'  => __('line-through', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_link_weight( $input ) { // link weight
      $valid = array(
        'normal'   => __('Normal', 'wp-forge'),
        'bold'     => __('Bold', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_css_selection( $input ) { // select the css you want to use
      $valid = array(
        'float'   => __('Float', 'wp-forge'),
        'flex'    => __('Flex', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
    function wpforge_sanitize_change_tag_settings( $input ) { // tag display
      $valid = array(
        'select' => __('Select a Heading Tag', 'wp-forge'),
        'change_h1'  => __('H1 Heading Tag', 'wp-forge'),
        'change_h2'  => __('H2 Heading Tag', 'wp-forge'),
        'change_h3'  => __('H3 Heading Tag', 'wp-forge'),
        'change_h4'  => __('H4 Heading Tag', 'wp-forge'),
        'change_h5'  => __('H5 Heading Tag', 'wp-forge'),
        'change_h6'  => __('H6 Heading Tag', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
    function wpforge_sanitize_change_page_tag_settings( $input ) { // change page heading settings
      $valid = array(
        'select' => __('Select a Heading Tag', 'wp-forge'),
        'change_page_h1'  => __('H1 Heading Tag', 'wp-forge'),
        'change_page_h2'  => __('H2 Heading Tag', 'wp-forge'),
        'change_page_h3'  => __('H3 Heading Tag', 'wp-forge'),
        'change_page_h4'  => __('H4 Heading Tag', 'wp-forge'),
        'change_page_h5'  => __('H5 Heading Tag', 'wp-forge'),
        'change_page_h6'  => __('H6 Heading Tag', 'wp-forge'),
      );

      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_post_header_color_settings( $input ) { // change post header color settings
    $valid = array(
    'select'         => __('Select a Heading Tag', 'wp-forge'),
    'post_h1_color'  => __('Post H1 Color', 'wp-forge'),
    'post_h2_color'  => __('Post H2 Color', 'wp-forge'),
    'post_h3_color'  => __('Post H3 Color', 'wp-forge'),
    'post_h4_color'  => __('Post H4 Color', 'wp-forge'),
    'post_h5_color'  => __('Post H5 Color', 'wp-forge'),
    'post_h6_color'  => __('Post H6 Color', 'wp-forge'),
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
      if ( $control->manager->get_setting('wpforge_nav_position')->value() == 'scroll' || $control->manager->get_setting('wpforge_nav_position')->value() == 'fixed' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_link_position_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_nav_position')->value() == 'top' || $control->manager->get_setting('wpforge_nav_position')->value() == 'scroll' || $control->manager->get_setting('wpforge_nav_position')->value() == 'fixed' ) {
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
  function wpforge_cat_position_callback_top( $control ) {
      if ( $control->manager->get_setting('wpforge_cat_position')->value() == 'top' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_cat_position_callback_bottom( $control ) {
      if ( $control->manager->get_setting('wpforge_cat_position')->value() == 'bottom' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_postmeta_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_meta_display')->value() == 'yes' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_post_tag_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_tag_display')->value() == 'yes' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_tag_gen_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_tag_display')->value() == 'yes' ) {
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
  function wpforge_change_h1_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h1' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_h2_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h2' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_h3_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h3' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_h4_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h4' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_h5_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h5' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_h6_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_tag_settings')->value() == 'change_h6' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h1_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h1' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h2_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h2' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h3_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h3' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h4_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h4' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h5_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h5' ) {
          return true;
      } else {
          return false;
      }
  }
  function wpforge_change_page_h6_tag( $control ) {
      if ( $control->manager->get_setting('wpforge_change_page_tag_settings')->value() == 'change_page_h6' ) {
          return true;
      } else {
          return false;
      }
  }
  /**
   * 6.0 - Transport
   *
   */
    $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';$wp_customize->get_setting( 'header_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_content_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'nav_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_nav_text' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_text' )->transport = 'postMessage';
    $wp_customize->get_setting( 'site_title_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_top_bar_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_top_bar_arrow_position' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_main_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_active_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_dropdown_arrow_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_hamburger_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_hamburger_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_home_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'top_bar_home_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_main_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_hamburger_icon_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_hamburger_icon_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_hamburger_icon_title_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_hamburger_icon_title_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_dropdown_arrow_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_background_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_active_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_title_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_category_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_postmeta_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_postmeta_gen_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_title_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_tag_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_category_tag_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_category_gen_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_tag_gen_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_title_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'content_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h1_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h2_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h3_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h4_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h5_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_h6_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h1_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h2_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h3_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h4_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h5_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_h6_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_title_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_link_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_link_hover_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_link_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_link_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_link_hover_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_link_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h1_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h2_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h3_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h4_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h5_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h6_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h1_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h2_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h3_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h4_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h5_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_h6_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_widget_title' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_widget_title_transform' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_widget_title_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_link_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_link_hover_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_sidebar_link_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_sidebar_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_sidebar_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_widget_title' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_widget_title_transform' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_widget_title_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_font_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_link_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_link_hover_decoration' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_footer_sidebar_link_weight' )->transport = 'postMessage';
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
    $wp_customize->get_setting( 'wpforge_footer_txt_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'primary_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'primary_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'primary_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'primary_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'primary_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'secondary_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'secondary_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'secondary_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'secondary_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'secondary_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'success_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'success_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'success_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'success_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'success_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'warning_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'warning_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'warning_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'warning_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'warning_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'alert_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'alert_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'alert_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'alert_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'alert_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'info_button_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'info_button_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'info_button_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'info_button_font_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'info_button_font_weight' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_select_css' )->transport = 'postMessage';
    $wp_customize->get_setting( 'pagination_current_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'pagination_current_font_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'pagination_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'pagination_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'pagination_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'post_title_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'category_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'category_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'tag_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'tag_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'meta_header_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'meta_header_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'single_post_title_color' )->transport = 'postMessage';
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
<style type="text/css" id="wpforge-customizer-css">

.header_wrap{max-width:<?php echo esc_attr(get_theme_mod('header_width','75rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('header_color','#ffffff')); ?>;}

.site-title{font-size:<?php echo esc_attr(get_theme_mod('wpforge_site_title_font_size','3rem')); ?>;}

.site-title a{color:<?php echo esc_attr(get_theme_mod('site_title_link_color','#444444')); ?>;}

.site-title a:hover{color:<?php echo esc_attr(get_theme_mod('site_title_hover_color','#0078a0')); ?>;}

.site-description{color:#<?php echo esc_attr(get_theme_mod('header_textcolor','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_site_desc_font_size','1.6875rem')); ?>;}

.nav_wrap{max-width:<?php echo esc_attr(get_theme_mod('nav_width','75rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('nav_wrap_main_color','#333333')); ?>;}

.contain-to-grid .top-bar{max-width:<?php echo esc_attr(get_theme_mod('nav_width','75rem')); ?>;}

.contain-to-grid .top-bar,.top-bar,.top-bar ul,.top-bar ul li,.contain-to-grid,.title-bar {background-color:<?php echo esc_attr(get_theme_mod('top_bar_main_color','#333333')); ?>;}

.top-bar{font-size:<?php echo esc_attr(get_theme_mod('wpforge_top_bar_font_size','0.825rem')); ?>;}

.dropdown.menu .is-dropdown-submenu-parent a::after{margin-top:<?php echo esc_attr(get_theme_mod('wpforge_top_bar_arrow_position','-0.3125rem')); ?>;}

.top-bar-left .menu > li.name:hover,.top-bar-right .menu > li.name:hover,.top-bar .menu > li:not(.menu-text) > a:hover,.top-bar .menu > .active:hover {background-color:<?php echo esc_attr(get_theme_mod('top_bar_hover_color','#242424')); ?>;}

.top-bar .menu > .active {background-color:<?php echo esc_attr(get_theme_mod('top_bar_active_color','#008cba'));?>;}

.top-bar .name a,.top-bar ul li a,.menu .active > a{color:<?php echo esc_attr(get_theme_mod('top_bar_font_color','#ffffff')); ?>;}

.top-bar .name a:hover,.top-bar ul li a:hover,.menu .active > a:hover{color:<?php echo esc_attr(get_theme_mod('top_bar_font_hover_color','#ffffff')); ?>!important;}

.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after{border-color:<?php echo esc_attr(get_theme_mod('top_bar_dropdown_arrow_color','#ffffff')); ?> transparent transparent;}

.is-drilldown-submenu-parent > a::after{border-color: transparent transparent transparent <?php echo esc_attr(get_theme_mod('top_bar_dropdown_arrow_color','#ffffff')); ?>;}

.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after{border-color:transparent transparent transparent <?php echo esc_attr(get_theme_mod('top_bar_dropdown_arrow_color','#ffffff')); ?>;}

.is-dropdown-submenu{border:1px solid <?php echo esc_attr(get_theme_mod('top_bar_main_color','#333333')); ?>;}

.js-drilldown-back > a::before{border-color:transparent <?php echo esc_attr(get_theme_mod('top_bar_dropdown_arrow_color','#ffffff')); ?> transparent transparent;}

.title-bar button{color:<?php echo esc_attr(get_theme_mod('top_bar_hamburger_color','#ffffff')); ?>;}

.title-bar button:hover{color:<?php echo esc_attr(get_theme_mod('top_bar_hamburger_hover_color','#0078a0')); ?>;}

.title-bar-title a.hmn{color:<?php echo esc_attr(get_theme_mod('top_bar_home_link_color','#ffffff')); ?>;}

.title-bar-title a.hmn:hover{color:<?php echo esc_attr(get_theme_mod('top_bar_home_link_hover_color','#0078a0')); ?>;}

.title-bar-left button,.title-bar-right button{color:<?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_color','#ffffff')); ?>;}

.title-bar-left button:hover,.title-bar-right button:hover{color:<?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_hover_color','#e6e6e6')); ?>;}

.title-bar-title a{color:<?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_title_color','#ffffff')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_title_font_size','1rem')); ?>;}

.title-bar-title a:hover{color:<?php echo esc_attr(get_theme_mod('wpforge_hamburger_icon_title_hover_color','#0078a0')); ?>;}

.off-canvas{background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_main_color','#333333')); ?>;}

.off-canvas{font-size:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_font_size','1rem')); ?>;}

.off-canvas .menu > li:not(.menu-text) > a {color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_link_color','#ffffff')); ?>;}

.off-canvas .menu > li:not(.menu-text) > a:hover,.off-canvas .menu > .active a:hover{color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_hover_color','#e6e6e6')); ?>;background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_background_hover_color','#242424')); ?>;}

.is-accordion-submenu-parent > a::after {border-top-color:<?php echo esc_attr(get_theme_mod('wpforge_off_dropdown_arrow_color','#ffffff')); ?>;}

.off-canvas .menu > .active a{background-color:<?php echo esc_attr(get_theme_mod('wpforge_off_canvas_active_color','#008CBA')); ?>;}

.content_wrap{max-width:<?php echo esc_attr(get_theme_mod('content_width','75rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('content_color','#ffffff')); ?>;}

span.categories-links a{color:<?php echo esc_attr(get_theme_mod('category_link_color','#008cba')); ?>;}

span.categories-links a:hover{color:<?php echo esc_attr(get_theme_mod('category_link_hover_color','#0078a0')); ?>;}

h1.entry-title-post a{color:<?php echo esc_attr(get_theme_mod('post_title_link_color','#008cba')); ?>;}

h1.entry-title-post a:hover{color:<?php echo esc_attr(get_theme_mod('post_title_link_hover_color','#0078a0')); ?>;}

h1.entry-title-post{color:<?php echo esc_attr(get_theme_mod('single_post_title_color','#444444')); ?>;}

.entry-meta-header a{color:<?php echo esc_attr(get_theme_mod('meta_header_link_color','#008cba')); ?>;}

.entry-meta-header a:hover{color:<?php echo esc_attr(get_theme_mod('meta_header_link_hover_color','#0078a0')); ?>;}

span.tags-links a{color:<?php echo esc_attr(get_theme_mod('tag_link_color','#008cba')); ?>;}

span.tags-links a:hover{color:<?php echo esc_attr(get_theme_mod('tag_link_hover_color','#0078a0')); ?>;}

.entry-meta-categories{font-size:<?php echo esc_attr(get_theme_mod('wpforge_category_font_size','0.75rem')); ?>;}

.entry-meta-header,span.edit-link a{font-size:<?php echo esc_attr(get_theme_mod('wpforge_postmeta_font_size','0.75rem')); ?>;}

.entry-meta-header .genericon,.entry-meta-categories .genericon,span.edit-link .genericon{font-size:<?php echo esc_attr(get_theme_mod('wpforge_postmeta_gen_font_size','1rem')); ?>;}

.entry-meta-tags{font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_tag_size','0.75rem')); ?>;}

.entry-meta-tags .genericon{font-size:<?php echo esc_attr(get_theme_mod('wpforge_tag_gen_size','1rem')); ?>;}

.entry-meta-categories_bottom{font-size:<?php echo esc_attr(get_theme_mod('wpforge_category_tag_font_size','0.75rem')); ?>;}

.entry-meta-categories_bottom .genericon{font-size:<?php echo esc_attr(get_theme_mod('wpforge_category_gen_font_size','1rem')); ?>;}

h1.entry-title-post{font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_title_font_size','3rem')); ?>;}

.entry-content-post p,.entry-content-post ul li,.entry-content-post ol li,.entry-content-post table,.comment-content table,.entry-content-post address,.comment-content address,.entry-content-post pre,.comment-content pre,.comments-area article header cite,#comments,.entry-content-post dl,.entry-content-post dt{color:<?php echo esc_attr(get_theme_mod('content_font_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_font_size','1rem')); ?>;}

.entry-content-post a{color:<?php echo esc_attr(get_theme_mod('content_link_color','#008CBA')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_post_link_weight','normal')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_post_link_decoration','none')); ?>;}

.entry-content-post a:hover{color:<?php echo esc_attr(get_theme_mod('content_hover_color','#0078a0')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_post_link_hover_decoration','underline')); ?>;}

.entry-content-post h1{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h1_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h1_size','3rem')); ?>;}

.entry-content-post h2{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h2_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h2_size','2.5rem')); ?>;}

.entry-content-post h3{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h3_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h3_size','1.9375rem')); ?>;}

.entry-content-post h4{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h4_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h4_size','1.5625rem')); ?>;}

.entry-content-post h5{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h5_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h5_size','1.25rem')); ?>;}

.entry-content-post h6{color:<?php echo esc_attr(get_theme_mod('wpforge_content_h6_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_post_h6_size','1rem')); ?>;}

h1.entry-title-page{color:<?php echo esc_attr(get_theme_mod('wpforge_page_title_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_title_font_size','3rem')); ?>;}

.entry-content-page p,.entry-content-page ul li,.entry-content-page ol li,.entry-content-page table,.entry-content-page table th,.entry-content-page .comment-content table,.entry-content-page address,.entry-content-page .comment-content address,.entry-content-page pre,.entry-content-page .comment-content pre,.comments-area article header cite,.entry-content-page #comments,.entry-content-page dl,.entry-content-page dt{font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_content_font_size','1rem')); ?>;}

.entry-content-page a{color:<?php echo esc_attr(get_theme_mod('wpforge_page_link_color','#008cba')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_page_link_weight','normal')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_page_link_decoration','none')); ?>;}

.entry-content-page a:hover{color:<?php echo esc_attr(get_theme_mod('wpforge_page_link_hover_color','#0078a0')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_page_link_hover_decoration','underline')); ?>;}

.entry-content-page h1{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h1_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h1_size','3rem')); ?>;}

.entry-content-page h2{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h2_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h2_size','2.5rem')); ?>;}

.entry-content-page h3{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h3_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h3_size','1.9375rem')); ?>;}

.entry-content-page h4{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h4_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h4_size','1.5625rem')); ?>;}

.entry-content-page h5{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h5_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h5_size','1.25rem')); ?>;}

.entry-content-page h6{color:<?php echo esc_attr(get_theme_mod('wpforge_page_h6_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_page_h6_size','1rem')); ?>;}

#content ul.pagination .current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a{background-color:<?php echo esc_attr(get_theme_mod('pagination_current_color','#008CBA')); ?>;color:<?php echo esc_attr(get_theme_mod('pagination_current_font_color','#ffffff')); ?>;}

#content ul.pagination li a,#content ul.pagination li button{color:<?php echo esc_attr(get_theme_mod('pagination_link_color','#999999')); ?>;}

#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus{color:<?php echo esc_attr(get_theme_mod('pagination_link_hover_color','#999999')); ?>;background-color:<?php echo esc_attr(get_theme_mod('pagination_hover_color','#e6e6e6')); ?>;}

.sidebar_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_sidebar_width','75rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_sidebar_color','#ffffff')); ?>;}

#content.columns{float:<?php echo esc_attr(get_theme_mod('wpforge_content_position','left')); ?>!important;}

.widget-title{color:<?php echo esc_attr(get_theme_mod('main_widget_title_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_widget_title','0.875rem')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_widget_title_weight','normal')); ?>;text-transform:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_widget_title_transform','uppercase')); ?>;}

#secondary p,#secondary li,#secondary .widget.widget_text{color:<?php echo esc_attr(get_theme_mod('main_widget_text_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_font_size','0.875rem')); ?>;}

#secondary a{color:<?php echo esc_attr(get_theme_mod('main_widget_link_color','#008CBA')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_link_decoration','none')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_link_weight','normal')); ?>;}

#secondary a:hover{color:<?php echo esc_attr(get_theme_mod('main_widget_hover_color','#0078a0')); ?>!important;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_sidebar_link_hover_decoration','underline')); ?>;}

.footer_wrap{max-width:<?php echo esc_attr(get_theme_mod('footer_content_width','75rem')); ?>;background-color:<?php echo esc_attr(get_theme_mod('footer_content_color','#ffffff')); ?>;}

#secondary-sidebar .widget-title{color:<?php echo esc_attr(get_theme_mod('footer_widget_title_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title','0.875rem')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_weight','normal')); ?>;text-transform:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_transform','uppercase')); ?>;}

#secondary-sidebar p,#secondary-sidebar li,#secondary-sidebar .widget.widget_text{color:<?php echo esc_attr(get_theme_mod('footer_widget_text_color','#444444')); ?>;font-size:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_font_size','0.875rem')); ?>;}

#secondary-sidebar a{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_color','#008CBA')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_link_weight','normal')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_link_decoration','none')); ?>;}

#secondary-sidebar a:hover{color:<?php echo esc_attr(get_theme_mod('footer_widget_link_hover_color','#0078a0')); ?>;text-decoration:<?php echo esc_attr(get_theme_mod('wpforge_footer_sidebar_link_hover_decoration','underline')); ?>;}

footer[role="contentinfo"] p,footer[role="contentinfo"]{color:<?php echo esc_attr(get_theme_mod('footer_text_color','#444444')); ?>;}

footer[role="contentinfo"] a,#footer .menu .active > a{color:<?php echo esc_attr(get_theme_mod('footer_link_color','#008CBA')); ?>;}

footer[role="contentinfo"] a:hover,#footer .menu .active > a:hover{color:<?php echo esc_attr(get_theme_mod('footer_hover_color','#0078a0')); ?>!important;}

.footer_wrap p,.footer_wrap a{font-size:<?php echo esc_attr(get_theme_mod('wpforge_footer_txt_size','1rem')); ?>;}

a.button,.button,button{background-color:<?php echo esc_attr(get_theme_mod('primary_button_color','#008cba')); ?>;color:<?php echo esc_attr(get_theme_mod('primary_button_font_color','#ffffff')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('primary_button_font_weight','normal')); ?>;text-decoration:none;}

a.button:hover,a.button:focus,.button:hover,.button:focus,button:hover,button:focus{background-color:<?php echo esc_attr(get_theme_mod('primary_button_hover_color','#007095')); ?>;color:<?php echo esc_attr(get_theme_mod('primary_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

a.button.secondary{background-color:<?php echo esc_attr(get_theme_mod('secondary_button_color','#777777')); ?>;color:<?php echo esc_attr(get_theme_mod('secondary_button_font_color','#ffffff')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('secondary_button_font_weight','normal')); ?>;text-decoration:none;}

a.button.secondary:hover,a.button.secondary:focus{background-color:<?php echo esc_attr(get_theme_mod('secondary_button_hover_color','#5f5f5f')); ?>;color:<?php echo esc_attr(get_theme_mod('secondary_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

a.button.success{background-color:<?php echo esc_attr(get_theme_mod('success_button_color','#3adb76')); ?>;color:<?php echo esc_attr(get_theme_mod('success_button_font_color','#ffffff')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('success_button_font_weight','normal')); ?>;text-decoration:none;}

a.button.success:hover,a.button.success:focus{background-color:<?php echo esc_attr(get_theme_mod('success_button_hover_color','#22bb5b')); ?>;color:<?php echo esc_attr(get_theme_mod('success_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

a.button.warning{background-color:<?php echo esc_attr(get_theme_mod('warning_button_color','#ffae00')); ?>;color:<?php echo esc_attr(get_theme_mod('warning_button_font_color','#ffffff')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('warning_button_font_weight','normal')); ?>;text-decoration:none;}

a.button.warning:hover,a.button.warning:focus{background-color:<?php echo esc_attr(get_theme_mod('warning_button_hover_color','#cc8b00')); ?>;color:<?php echo esc_attr(get_theme_mod('warning_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

a.button.alert{background-color:<?php echo esc_attr(get_theme_mod('alert_button_color','#ec5840')); ?>;color:<?php echo esc_attr(get_theme_mod('alert_button_font_color','#ffffff')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('alert_button_font_weight','normal')); ?>;text-decoration:none;}

a.button.alert:hover,a.button.alert:focus{background-color:<?php echo esc_attr(get_theme_mod('alert_button_hover_color','#da3116')); ?>;color:<?php echo esc_attr(get_theme_mod('alert_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

a.button.info{background-color:<?php echo esc_attr(get_theme_mod('info_button_color','#a0d3e8')); ?>;color:<?php echo esc_attr(get_theme_mod('info_button_font_color','#333333')); ?>;font-weight:<?php echo esc_attr(get_theme_mod('info_button_font_weight','normal')); ?>;text-decoration:none;}

a.button.info:hover,a.button.info:focus{background-color:<?php echo esc_attr(get_theme_mod('info_button_hover_color','#61b6d9')); ?>;color:<?php echo esc_attr(get_theme_mod('info_button_font_hover_color','#ffffff')); ?>;text-decoration: none;}

#backtotop{background-color:<?php echo esc_attr(get_theme_mod('backtotop_color','#333333')); ?>;color:<?php echo esc_attr(get_theme_mod('backtotop_font_color','#ffffff')); ?>;}

#backtotop:hover,#backtotop:focus{background-color:<?php echo esc_attr(get_theme_mod('backtotop_hover_color','#242424')); ?>;}

.social-navigation a[href$="/feed/"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_feed_color','#444444')); ?>;}

.social-navigation a[href*="codepen.io"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_codepen_color','#444444')); ?>;}

.social-navigation a[href*="digg.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_digg_color','#444444')); ?>;}

.social-navigation a[href*="dribbble.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dribble_color','#444444')); ?>;}

.social-navigation a[href*="dropbox.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dropbox_color','#444444')); ?>;}

.social-navigation a[href*="facebook.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_facebook_color','#444444')); ?>;}

.social-navigation a[href*="flickr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_flicker_color','#444444')); ?>;}

.social-navigation a[href*="foursquare.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_foursquare_color','#444444')); ?>;}

.social-navigation a[href*="google.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_google_color','#444444')); ?>;}

.social-navigation a[href*="github.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_github_color','#444444')); ?>;}

.social-navigation a[href*="instagram.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_instagram_color','#444444')); ?>;}

.social-navigation a[href*="linkedin.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_linkedin_color','#444444')); ?>;}

.social-navigation a[href*="pinterest.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pinterest_color','#444444')); ?>;}

.social-navigation a[href*="getpocket.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pocket_color','#444444')); ?>;}

.social-navigation a[href*="polldaddy.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_polldaddy_color','#444444')); ?>;}

.social-navigation a[href*="reddit.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_reddit_color','#444444')); ?>;}

.social-navigation a[href*="stumbleupon.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_stumbleupon_color','#444444')); ?>;}

.social-navigation a[href*="tumblr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_tumblr_color','#444444')); ?>;}

.social-navigation a[href*="twitter.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitter_color','#444444')); ?>;}

.social-navigation a[href*="vimeo.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_vimeo_color','#444444')); ?>;}

.social-navigation a[href*="wordpress.com"]:before,.social-navigation a[href*="wordpress.org"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_wordpress_color','#444444')); ?>;}

.social-navigation a[href*="youtube.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_youtube_color','#444444')); ?>;}

.social-navigation a[href*="mailto:"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_mailto_color','#444444')); ?>;}

.social-navigation a[href*="spotify.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_spotify_color','#444444')); ?>;}

.social-navigation a[href*="twitch.tv"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitch_color','#444444')); ?>;}

.social-navigation a:hover[href$="/feed/"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_feed_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="codepen.io"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_codepen_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="digg.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_digg_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="dribbble.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dribble_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="dropbox.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_dropbox_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="facebook.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_facebook_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="flickr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_flicker_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="foursquare.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_foursquare_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="google.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_google_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="github.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_github_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="instagram.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_instagram_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="linkedin.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_linkedin_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="pinterest.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pinterest_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="getpocket.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_pocket_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="polldaddy.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_polldaddy_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="reddit.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_reddit_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="stumbleupon.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_stumbleupon_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="tumblr.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_tumblr_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="twitter.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitter_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="vimeo.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_vimeo_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="wordpress.com"]:before,.social-navigation a:hover[href*="wordpress.org"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_wordpress_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="youtube.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_youtube_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="mailto:"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_mailto_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="spotify.com"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_spotify_hover_color','#0078a0')); ?>;}

.social-navigation a:hover[href*="twitch.tv"]:before{color:<?php echo esc_attr(get_theme_mod('wpforge_social_twitch_hover_color','#0078a0')); ?>;}</style>
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
    wp_enqueue_script( 'wpforge-customizer', get_template_directory_uri() . '/js/theme-customizer.js', array( 'customize-preview' ), '6.2', true );
  }
  add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );
}
