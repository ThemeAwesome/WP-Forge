<?php
//Handles the width and other elements in the Customizer.
add_action( 'customize_controls_enqueue_scripts', 'themedemo_customizer_style');
function themedemo_customizer_style() {
    wp_add_inline_style( 'customize-controls', 
      '#customize-controls .description{font-size:9px}
      li.customize-section-description-container .description {font-size:12px!important}');
}
if ( ! function_exists( 'wpforge_customize_register' ) ) {
  function wpforge_customize_register( $wp_customize ) {

 // Add selective refresh to site title and description
  if ( isset( $wp_customize->selective_refresh ) ) {
      $wp_customize->selective_refresh->add_partial( 'blogname', array(
          'selector' => 'h1.site-title a',
          'render_callback' => 'wpforge_customize_partial_blogname',
      ) );
      
      $wp_customize->selective_refresh->add_partial( 'blogdescription', array(
          'selector' => 'p.site-description',
          'render_callback' => 'wpforge_customize_partial_blogdescription',
      ) );
  }
  // Render the site title for the selective refresh partial.
  if ( ! function_exists( 'wpforge_customize_partial_blogname' ) ) :
    function wpforge_customize_partial_blogname() {
      bloginfo( 'name' );
    }
  endif;
  // Render the site tagline for the selective refresh partial.
  if ( ! function_exists( 'wpforge_customize_partial_blogdescription' ) ) :
    function wpforge_customize_partial_blogdescription() {
      bloginfo( 'description' );
    }
  endif;
  // 1.0 Defaults
  $wp_customize->get_section('header_image')->panel = 'wpforge_header'; // Add to Header Panel
  $wp_customize->get_section('header_image')->priority = 40; // Shows before site title and tagline
  $wp_customize->get_section('title_tagline')->priority = 50; // Shows after the Header image section
  $wp_customize->get_section('title_tagline')->panel = 'wpforge_header'; // Add to Header Panel
  $wp_customize->get_section('background_image')->panel = 'wpforge_background'; // Add to Background Panel
  $wp_customize->get_section('colors')->panel = 'wpforge_colors'; // Add to Colors Panel
  $wp_customize->get_section('colors')->priority = 10; // Changed priority so it shows first in color panel
  $wp_customize->get_section('colors')->title = __( 'Header &amp; Background Colors', 'wp-forge' ); // Changed title
  $wp_customize->get_section('static_front_page')->panel = 'wpforge_front_page'; // Add to Front Panel
  $wp_customize->get_section('static_front_page')->description = __( 'Set the front page for your theme.', 'wp-forge' ); //

  // 2.0 Panels
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
  //3.0 Sections and Settings
  $wp_customize->add_section('header_content', array( /* header content section */
    'title' => __('Header Content', 'wp-forge'),
    'description' => __('Main content area of your header, i.e site title, site description and logo.', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_header',
  ));
  $wp_customize->add_setting('header_width',array( /* header width */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('header_width',array(
    'label' => __('Header Content Width','wp-forge'),
    'description' => __('Default: 75rem', 'wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('header_color', array( /* header background color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'header_color',array(
    'label' => __('Header Content Background Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'header_content',
    'settings' => 'header_color',
  )));
  $wp_customize->add_setting('wpforge_site_title_font_size',array( /* site title font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_site_title_font_size',array(
    'label' => __('Site Title Font Size','wp-forge'),
    'description' => __('Default: 3rem', 'wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
    'priority' => 25,
  ));



  $wp_customize->add_setting('wpforge_header_padding',array( /* change header padding */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_header_padding',array(
    'label' => __('Header Padding','wp-forge'),
    'description' => __('Default: 45px 0', 'wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
    'priority' => 26,
  ));


  $wp_customize->add_setting('wpforge_site_desc_font_size',array( /* site description font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_site_desc_font_size',array(
    'label' => __('Site Description Font Size','wp-forge'),
    'description' => __('Default: 1.6875rem', 'wp-forge'),
    'section' => 'header_content',
    'type' => 'text',
  ));
  // remove title
  $wp_customize->add_setting( 'wpforge_hide_sitetitle',
      array(
          'sanitize_callback' => 'wpforge_sanitize_checkbox',
          'default'           => 0,
          'transport'         => 'postMessage'
      ));
  $wp_customize->add_control('wpforge_hide_sitetitle',
      array(
          'label'     => __('Hide site title', 'wp-forge'),
          'section'   => 'title_tagline',
          'type'      => 'checkbox',
      ));
  // remove tagline
  $wp_customize->add_setting('wpforge_hide_tagline',
      array(
          'sanitize_callback' => 'wpforge_sanitize_checkbox',
          'default'           => '',
          'transport'         => 'postMessage'
      ));
  $wp_customize->add_control('wpforge_hide_tagline',
      array(
          'label'     => __('Hide site tagline', 'wp-forge'),
          'section'     => 'title_tagline',
          'type'          => 'checkbox',

      ));
  $wp_customize->add_section('nav_content', array( /* nav wrapper section */
    'title' => __('Nav Content Area', 'wp-forge'),
    'priority' => 30,
    'panel' => 'wpforge_navigation',
    'description' => __('Change the width and background color of the navigation area of your theme.', 'wp-forge'),
  ));
  $wp_customize->add_setting('nav_width',array( /* nav content width */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('nav_width',array(
    'label' => __('Nav Content Width','wp-forge'),
    'description' => __('Default: 75rem', 'wp-forge'),
    'section' => 'nav_content',
    'type' => 'text',
  ));
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
    'label' => __('Select Main Menu Type', 'wp-forge'),
    'description' => __('Default: Top-Bar', 'wp-forge'),
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
    'label' => __('Top-Bar Position', 'wp-forge'),
    'description' => __('Default: Normal', 'wp-forge'),
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
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_title_area',array(
    'type' => 'select',
    'active_callback' => 'wpforge_title_callback',
    'label' => __('Show top-bar title area?', 'wp-forge'),
    'description' => __('Default: Yes', 'wp-forge'),
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
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_link_position',array(
    'type' => 'select',
    'active_callback' => 'wpforge_link_position_callback',
    'label' => __('Top-Bar link position?', 'wp-forge'),
    'description' => __('Default: Right', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'right' => __('Links to the right', 'wp-forge'),
      'left'  => __('Links to the left', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_top_bar_font_size',array( /* top-bar font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_top_bar_font_size',array(
    'label' => __('Top-Bar Font Size','wp-forge'),
    'description' => __('Default: 0.825rem', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
  ));
     $wp_customize->add_setting('wpforge_top_bar_arrow_position',array( /* top-bar arrow position */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_top_bar_arrow_position',array(
    'label' => __('Top-Bar Dropdown Arrow Position','wp-forge'),
    'description' => __('Default: -0.125rem', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_nav_text',array( /* top-bar main link anchor text */
    'default' => 'Menu',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_nav_text',array(
    'label' => __('Change Top-Bar Hamburger Icon Title Text','wp-forge'),
    'description' => __('Default: Menu', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'offcanvas_second_mobile_callback',
  ));
  $wp_customize->add_setting('wpforge_mobile_display',array( /* off-canvas for mobile */
    'default' => 'no',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_display',
    'priority' => 7,
  ));
  $wp_customize->add_control('wpforge_mobile_display',array(
    'type' => 'select',
    'label' => __('Use Mobile Off-Canvas?', 'wp-forge'),
    'description' => __('Default: No', 'wp-forge'),
    'section' => 'top_bar',
    'choices' => array(
      'no'  => __('No', 'wp-forge'),
      'yes' => __('Yes', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('offcanvas_mobile_position',array( /* off-canvas mobile icon position */
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'offcanvas_mobile_position_sanitize',
    'priority' => 8,
  ));
  $wp_customize->add_control('offcanvas_mobile_position',array(
    'type' => 'select',
    'label' => __('Mobile Off-Canvas Icon Left or Right?', 'wp-forge'),
    'description' => __('Default: Left', 'wp-forge'),
    'section' => 'top_bar',
    'active_callback' => 'offcanvas_mobile_callback',
    'choices' => array(
      'left'  => __('Left', 'wp-forge'),
      'right' => __('Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('offcanvas_mobile_transition',array( /* off-canvas mobile transition */
    'default' => 'push',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'offcanvas_mobile_transition_sanitize',
    'priority' => 9,
  ));
  $wp_customize->add_control('offcanvas_mobile_transition',array(
    'type' => 'select',
    'label' => __('Mobile Off-Canvas Transition', 'wp-forge'),
    'description' => __('Default: Push', 'wp-forge'),
    'section' => 'top_bar',
    'active_callback' => 'offcanvas_mobile_callback',
    'choices' => array(
      'push'    => __('Push', 'wp-forge'),
      'overlap' => __('Overlap', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('offcanvas_mobile_text',array( /* off-canvas mobile hamburger text */
    'default' => 'Menu',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('offcanvas_mobile_text',array(
    'label' => __('Mobile Off-Canvas Hamburger Text','wp-forge'),
    'description' => __('Default: Menu', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'offcanvas_mobile_callback',
  ));
  $wp_customize->add_setting('offcanvas_mobile_text_size',array( /* off-canvas mobile title font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 11,
  ));
  $wp_customize->add_control('offcanvas_mobile_text_size',array(
    'label' => __('Mobile Off-Canvas Title Bar Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'offcanvas_mobile_callback',
  ));
  $wp_customize->add_setting('offcanvas_mobile_link_size',array( /* off-canvas mobile link size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 12,
  ));
  $wp_customize->add_control('offcanvas_mobile_link_size',array(
    'label' => __('Mobile Off-Canvas Link Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'top_bar',
    'type' => 'text',
    'active_callback' => 'offcanvas_mobile_callback',
  ));
  $wp_customize->add_section('wpforge_off_canvas', array( /* off-canvas section */
    'title' => __('Off-Canvas Settings', 'wp-forge'),
    'active_callback' => 'wpforge_off_canvas_callback',
    'description' => __('Configure the Off-Canvas menu of your theme. These options affect the normal view and mobile view of the Off-Canvas menu. ', 'wp-forge'),
    'priority' => 45,
    'panel' => 'wpforge_navigation',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_text',array( /* off-canvas hamburger text */
    'default' => 'Menu',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_off_canvas_text',array(
    'label' => __('Change Off-Canvas hamburger icon text','wp-forge'),
    'description' => __('Default: Menu', 'wp-forge'),
    'section' => 'wpforge_off_canvas',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_mobile_position',array( /* hamburger icon position */
    'default' => 'left',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_mobile_position',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_mobile_position',array(
    'type' => 'select',
    'label' => __('Show hamburger icon left or right?', 'wp-forge'),
    'description' => __('Default: Left', 'wp-forge'),
    'section' => 'wpforge_off_canvas',
    'choices' => array(
      'left'  => __('Left', 'wp-forge'),
      'right' => __('Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_offcanvas_transition',array( /* off-canvas transition */
    'default' => 'push',
    'type'    => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_offcanvas_transition',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_offcanvas_transition',array(
    'type' => 'select',
    'label' => __('Choose Off-Canvas Transition', 'wp-forge'),
    'description' => __('Default: Push', 'wp-forge'),
    'section' => 'wpforge_off_canvas',
    'choices' => array(
      'push'    => __('Push', 'wp-forge'),
      'overlap' => __('Overlap', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_off_canvas_title_font_size',array( /* off-canvas title font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_off_canvas_title_font_size',array(
    'label' => __('Off-Canvas Title Bar Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'wpforge_off_canvas',
    'type' => 'text',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_font_size',array( /* off-canvas font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 5,
  ));
  $wp_customize->add_control('wpforge_off_canvas_font_size',array(
    'label' => __('Off-Canvas Link Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'wpforge_off_canvas',
    'type' => 'text',
  ));
  $wp_customize->add_setting('site_title_link_color', array( /* site title link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_link_color',array(
    'label' => __('Site Title Link Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'colors',
    'settings' => 'site_title_link_color',
  )));
  $wp_customize->add_setting('site_title_hover_color', array( /* site title hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'site_title_hover_color',array(
    'label' => __('Site Title Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_main_color',array(
    'label' => __('Top-Bar Main Color', 'wp-forge'),
    'description' => __('Default: #333333', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_main_color',
  )));
  $wp_customize->add_setting('top_bar_hover_color', array( /* top-bar hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_hover_color',array(
    'label' => __('Top-Bar Link Background Hover Color', 'wp-forge'),
    'description' => __('Default: #242424', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_hover_color',
  )));
  $wp_customize->add_setting('top_bar_font_color', array( /* top-bar font color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_color',array(
    'label' => __('Top-Bar Link Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_font_color',
  )));
  $wp_customize->add_setting('top_bar_font_hover_color', array( /* top-bar font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_font_hover_color',array(
    'label' => __('Top-Bar Link Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_font_hover_color',
  )));
  $wp_customize->add_setting('top_bar_dropdown_arrow_color', array( /* top-bar dropdown arrow color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_dropdown_arrow_color',array(
    'label' => __('Top-Bar Dropdown Arrow Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_dropdown_arrow_color',
  )));
  $wp_customize->add_setting('top_bar_active_color', array( /* top-bar active color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'top_bar_active_color',array(
    'label' => __('Top-Bar Active Item Background Color', 'wp-forge'),
    'description' => __('Default: #242424', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'top_bar_active_color',
  )));
  $wp_customize->add_setting('current_item_link_color', array( /* current page item link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'current_item_link_color',array(
    'label' => __('Top-Bar Active Item Link Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'current_item_link_color',
  )));
  $wp_customize->add_setting('current_item_background_hover_color', array( /* current page item background hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'current_item_background_hover_color',array(
    'label' => __('Top-Bar Active Item Background Hover Color', 'wp-forge'),
    'description' => __('Default: #000000', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'current_item_background_hover_color',
  )));
  $wp_customize->add_setting('current_item_link_hover_color', array( /* current page item link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'current_item_link_hover_color',array(
    'label' => __('Top-Bar Active Item Link Hover Color', 'wp-forge'),
    'description' => __('Default: #E6E6E6', 'wp-forge'),
    'section' => 'top_bar_colors',
    'settings' => 'current_item_link_hover_color',
  )));
  $wp_customize->add_section('wpforge_off_canvas_colors', array( /* off-canvas colors section */
    'title' => __('Off-Canvas Colors', 'wp-forge'),
    'description' => __('Change colors of the Off-Canvas Menu. This affects both the mobile Off-Canvas menu (used in conjunction with the Top-Bar) as well as the regular Off-Canvas menu. ', 'wp-forge'),
    'priority' => 60,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('wpforge_off_canvas_main_color', array( /* off-canvas main color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_main_color',array(
    'label' => __('Off-Canvas Main Menu Color', 'wp-forge'),
    'description' => __('Default: #333333', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_main_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_color', array( /* hamburger icon color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_color',array(
    'label' => __('Off-Canvas Hamburger Icon Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_color',
  )));
  $wp_customize->add_setting('wpforge_hamburger_icon_hover_color', array( /* hamburger icon hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_hamburger_icon_hover_color',array(
    'label' => __('Off-Canvas Hamburger Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #E6E6E6', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_hamburger_icon_hover_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_link_color', array( /* off-canvas link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_link_color',array(
    'label' => __('Off-Canvas Link Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_link_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_hover_color', array( /* off-canvas link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_hover_color',array(
    'label' => __('Off-Canvas Link Hover Color', 'wp-forge'),
    'description' => __('Default: #E6E6E6', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_hover_color',
  )));
  $wp_customize->add_setting('wpforge_off_dropdown_arrow_color', array( /* off-canvas dropdown arrow color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_dropdown_arrow_color',array(
    'label' => __('Off-Canvas Arrow Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_dropdown_arrow_color',
  )));
  $wp_customize->add_setting('wpforge_off_canvas_background_hover_color', array( /* off-canvas background hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_off_canvas_background_hover_color',array(
    'label' => __('Off-Canvas Link Background Hover Color', 'wp-forge'),
    'description' => __('Default: #242424', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'wpforge_off_canvas_background_hover_color',
  )));
 $wp_customize->add_setting('off_canvas_active_color', array( /* off-canvas active background color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'off_canvas_active_color',array(
    'label' => __('Off-Canvas Current Menu Item Background Color', 'wp-forge'),
    'description' => __('Default: #242424', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'off_canvas_active_color',
  )));
  $wp_customize->add_setting('off_canvas_current_item_link_color', array( /* off-canvas active link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'off_canvas_current_item_link_color',array(
    'label' => __('Off-Canvas Current Menu Item Link Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'off_canvas_current_item_link_color',
  )));
 $wp_customize->add_setting('off_canvas_active_hover_color', array( /* top-bar active color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'off_canvas_active_hover_color',array(
    'label' => __('Off-Canvas Active Item Background Hover Color', 'wp-forge'),
    'description' => __('Default: #000000', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'off_canvas_active_hover_color',
  )));
    $wp_customize->add_setting('off_canvas_current_item_link_hover_color', array( /* off-canvas active link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'off_canvas_current_item_link_hover_color',array(
    'label' => __('Off-Canvas Current Menu Item Link Hover Color', 'wp-forge'),
    'description' => __('Default: #E6E6E6', 'wp-forge'),
    'section' => 'wpforge_off_canvas_colors',
    'settings' => 'off_canvas_current_item_link_hover_color',
  )));
  $wp_customize->add_section('content_colors', array( /* post content color section */
    'title' => __('Post Colors', 'wp-forge'),
    'description' => __('Change the color of text, links, hover colors and heading tags in the post content of your theme.', 'wp-forge'),
    'priority' => 65,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('category_link_color', array( /* category link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'category_link_color',array(
    'label' => __('Category Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'category_link_color',
  )));
  $wp_customize->add_setting('category_link_hover_color', array( /* category link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'category_link_hover_color',array(
    'label' => __('Category Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'category_link_hover_color',
  )));
  $wp_customize->add_setting('post_title_link_color', array( /* post title link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'post_title_link_color',array(
    'label' => __('Post Title Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'post_title_link_color',
  )));
  $wp_customize->add_setting('post_title_link_hover_color', array( /* post title link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'post_title_link_hover_color',array(
    'label' => __('Post Title Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'post_title_link_hover_color',
  )));
  $wp_customize->add_setting('single_post_title_color', array( /* single post title color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'single_post_title_color',array(
    'label' => __('Single Post View Title Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'single_post_title_color',
  )));
  $wp_customize->add_setting('meta_header_link_color', array( /* meta header link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'meta_header_link_color',array(
    'label' => __('Post Meta Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'meta_header_link_color',
  )));
  $wp_customize->add_setting('meta_header_link_hover_color', array( /* meta header link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'meta_header_link_hover_color',array(
    'label' => __('Post Meta Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'meta_header_link_hover_color',
  )));
  $wp_customize->add_setting('content_font_color', array( /* content font color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_font_color',array(
    'label' => __('Post Text Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_font_color',
  )));
  $wp_customize->add_setting('content_link_color', array( /* content link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_link_color',array(
    'label' => __('Post Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_link_color',
  )));
  $wp_customize->add_setting('content_hover_color', array( /*content link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_hover_color',array(
    'label' => __('Post Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'content_hover_color',
  )));
  $wp_customize->add_setting('tag_link_color', array( /* tag link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tag_link_color',array(
    'label' => __('Tag Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'tag_link_color',
  )));
  $wp_customize->add_setting('tag_link_hover_color', array( /* tag link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 12,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'tag_link_hover_color',array(
    'label' => __('Tag Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'tag_link_hover_color',
  )));
  $wp_customize->add_setting('wpforge_content_h1_color', array( /* content h1 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 13,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h1_color',array(
    'label' => __('Post Content H1 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h1_color',
  )));
  $wp_customize->add_setting('wpforge_content_h2_color', array( /* content h2 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 14,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h2_color',array(
    'label' => __('Post Content H2 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h2_color',
  )));
  $wp_customize->add_setting('wpforge_content_h3_color', array( /* content h3 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h3_color',array(
    'label' => __('Post Content H3 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h3_color',
  )));
  $wp_customize->add_setting('wpforge_content_h4_color', array( /* content h4 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 16,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h4_color',array(
    'label' => __('Post Content H4 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h4_color',
  )));
  $wp_customize->add_setting('wpforge_content_h5_color', array( /* content h5 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 17,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h5_color',array(
    'label' => __('Post Content H5 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h5_color',
  )));
  $wp_customize->add_setting('wpforge_content_h6_color', array( /* content h6 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 18,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_content_h6_color',array(
    'label' => __('Post Content H6 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'content_colors',
    'settings' => 'wpforge_content_h6_color',
  )));
    $wp_customize->add_section('wpforge_page_colors', array( /* page color section */
    'title' => __('Page Colors', 'wp-forge'),
    'description' => __('Change the color of text, links, hover colors and heading tags in the page content of your theme.', 'wp-forge'),
    'priority' => 70,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('wpforge_page_title_color', array( /* page title color */
    'default' => '',
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
  $wp_customize->add_setting('wpforge_page_text_color', array( /* page title color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_text_color',array(
    'label' => __('Page Text Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_text_color',
  )));
  $wp_customize->add_setting('wpforge_page_link_color', array( /* page link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_link_color',array(
    'label' => __('Page Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_link_color',
  )));
  $wp_customize->add_setting('wpforge_page_link_hover_color', array( /* page link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_link_hover_color',array(
    'label' => __('Page Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_link_hover_color',
  )));
  $wp_customize->add_setting('wpforge_page_h1_color', array( /* page h1 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h1_color',array(
    'label' => __('Page H1 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h1_color',
  )));
  $wp_customize->add_setting('wpforge_page_h2_color', array( /* page h2 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h2_color',array(
    'label' => __('Page H2 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h2_color',
  )));
  $wp_customize->add_setting('wpforge_page_h3_color', array( /* page h3 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h3_color',array(
    'label' => __('Page H3 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h3_color',
  )));
  $wp_customize->add_setting('wpforge_page_h4_color', array( /* page h4 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h4_color',array(
    'label' => __('Page H4 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h4_color',
  )));
  $wp_customize->add_setting('wpforge_page_h5_color', array( /* page h5 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h5_color',array(
    'label' => __('Page H5 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h5_color',
  )));
  $wp_customize->add_setting('wpforge_page_h6_color', array( /* page h6 color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_page_h6_color',array(
    'label' => __('Page H6 Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_page_colors',
    'settings' => 'wpforge_page_h6_color',
  )));
  $wp_customize->add_section('pagination_colors', array( /* pagination color section */
    'title' => __('Pagination Colors', 'wp-forge'),
    'description' => __('Change the colors of the built-in pagination.', 'wp-forge'),
    'priority' => 75,
    'panel' => 'wpforge_colors',
  ));
  $wp_customize->add_setting('pagination_current_color', array( /* pagination current color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_color',array(
    'label' => __('Active Link Background Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_color',
  )));
  $wp_customize->add_setting('pagination_current_font_color', array( /* pagination current font color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_current_font_color',array(
    'label' => __('Active Link Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_current_font_color',
  )));
  $wp_customize->add_setting('pagination_link_color', array( /* pagination link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_color',array(
    'label' => __('Pagination Link Color', 'wp-forge'),
    'description' => __('Default: #999999', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_color',
  )));
  $wp_customize->add_setting('pagination_link_hover_color', array( /* pagination link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_link_hover_color',array(
    'label' => __('Pagination Link Hover Color', 'wp-forge'),
    'description' => __('Default: #999999', 'wp-forge'),
    'section' => 'pagination_colors',
    'settings' => 'pagination_link_hover_color',
  )));
  $wp_customize->add_setting('pagination_hover_color', array( /* pagination background hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'pagination_hover_color',array(
    'label' => __('Pagination Background Hover Color', 'wp-forge'),
    'description' => __('Default: #E6E6E6', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_title_color',array(
    'label' => __('Sidebar Widget Title Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'main_sidebar_colors',
    'settings' => 'main_widget_title_color',
  )));
  $wp_customize->add_setting('main_widget_text_color', array( /* widget text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_text_color',array(
    'label' => __('Sidebar Text Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'main_sidebar_colors',
    'settings' => 'main_widget_text_color',
  )));
  $wp_customize->add_setting('main_widget_link_color', array( /* widget link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_link_color',array(
    'label' => __('Sidebar Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'main_sidebar_colors',
    'settings' => 'main_widget_link_color',
  )));
  $wp_customize->add_setting('main_widget_hover_color', array( /* widget link hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'main_widget_hover_color',array(
    'label' => __('Sidebar Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_title_color',array(
    'label' => __('Footer Sidebar Widget Title Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_title_color',
  )));
  $wp_customize->add_setting('footer_widget_text_color', array( /* footer sidebar text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_text_color',array(
    'label' => __('Footer Sidebar Text Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_text_color',
  )));
  $wp_customize->add_setting('footer_widget_link_color', array( /* footer sidebar widget link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_color',array(
    'label' => __('Footer Sidebar Link Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'footer_sidebar_colors',
    'settings' => 'footer_widget_link_color',
  )));
  $wp_customize->add_setting('footer_widget_link_hover_color', array( /* footer sidebar widget link hover color*/
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_widget_link_hover_color',array(
    'label' => __('Footer Sidebar Link Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_text_color',array(
    'label' => __('Footer Text Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'footer_colors',
    'settings' => 'footer_text_color',
  )));
  $wp_customize->add_setting('footer_link_color', array( /* footer link color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_link_color',array(
    'label' => __('Footer Link Color', 'wp-forge'),
    'description' => __('Default: ##008CBA', 'wp-forge'),
    'section' => 'footer_colors',
    'settings' => 'footer_link_color',
  )));
  $wp_customize->add_setting('footer_hover_color', array( /* footer hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_hover_color',array(
    'label' => __('Footer Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_color',array(
    'label' => __('Back To Top Background Color', 'wp-forge'),
    'description' => __('Default: #333333', 'wp-forge'),
    'section' => 'backtotop_colors',
    'settings' => 'backtotop_color',
  )));
  $wp_customize->add_setting('backtotop_font_color', array( /* back to top font color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_font_color',array(
    'label' => __('Back To Top Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'backtotop_colors',
    'settings' => 'backtotop_font_color',
  )));
  $wp_customize->add_setting('backtotop_hover_color', array( /* back to top hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_hover_color',array(
    'label' => __('Back To Top Background Hover Color', 'wp-forge'),
    'description' => __('Default: #242424', 'wp-forge'),
    'section' => 'backtotop_colors',
    'settings' => 'backtotop_hover_color',
  )));
  $wp_customize->add_setting('backtotop_font_hover_color', array( /* btt font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'backtotop_font_hover_color',array(
    'label' => __('Back To Top Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_feed_color',array(
    'label' => __('Feed Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_feed_color',
  )));
  $wp_customize->add_setting('wpforge_social_feed_hover_color', array( /* feed hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_feed_hover_color',array(
    'label' => __('Feed Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_feed_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_codepen_color', array( /* codepen color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_codepen_color',array(
    'label' => __('Codepen Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_codepen_color',
  )));
  $wp_customize->add_setting('wpforge_social_codepen_hover_color', array( /* codepen hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_codepen_hover_color',array(
    'label' => __('Codepen Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_codepen_hover_color',
  )));
    $wp_customize->add_setting('wpforge_social_digg_color', array( /* digg color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 5,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_digg_color',array(
    'label' => __('Digg Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_digg_color',
  )));
  $wp_customize->add_setting('wpforge_social_digg_hover_color', array( /* digg hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 6,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_digg_hover_color',array(
    'label' => __('Digg Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_digg_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_dribble_color', array( /* dribble color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 7,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dribble_color',array(
    'label' => __('Dribbble Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dribble_color',
  )));
  $wp_customize->add_setting('wpforge_social_dribble_hover_color', array( /* dribble hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 8,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dribble_hover_color',array(
    'label' => __('Dribbble Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dribble_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_dropbox_color', array( /* dropbox color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 9,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dropbox_color',array(
    'label' => __('Dropbox Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dropbox_color',
  )));
  $wp_customize->add_setting('wpforge_social_dropbox_hover_color', array( /* dropbox hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 10,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_dropbox_hover_color',array(
    'label' => __('Dropbox Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_dropbox_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_facebook_color', array( /* facebook color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 11,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_facebook_color',array(
    'label' => __('Facebook Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_facebook_color',
  )));
  $wp_customize->add_setting('wpforge_social_facebook_hover_color', array( /* facebook hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 12,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_facebook_hover_color',array(
    'label' => __('Facebook Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_facebook_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_flickr_color', array( /* flickr color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 13,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_flickr_color',array(
    'label' => __('Flickr Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_flickr_color',
  )));
  $wp_customize->add_setting('wpforge_social_flickr_hover_color', array( /* flickr hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 14,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_flickr_hover_color',array(
    'label' => __('Flickr Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_flickr_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_foursquare_color', array( /* foursquare color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_foursquare_color',array(
    'label' => __('Foursquare Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_foursquare_color',
  )));
  $wp_customize->add_setting('wpforge_social_foursquare_hover_color', array( /* foursquare hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 16,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_foursquare_hover_color',array(
    'label' => __('Foursquare Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_foursquare_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_google_color', array( /* google color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 17,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_google_color',array(
    'label' => __('Google+ Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_google_color',
  )));
  $wp_customize->add_setting('wpforge_social_google_hover_color', array( /* google hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 18,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_google_hover_color',array(
    'label' => __('Google+ Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_google_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_github_color', array( /* github color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 19,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_github_color',array(
    'label' => __('GitHub Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_github_color',
  )));
  $wp_customize->add_setting('wpforge_social_github_hover_color', array( /* github hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 20,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_github_hover_color',array(
    'label' => __('GitHub Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_github_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_instagram_color', array( /* instagram color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 21,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_instagram_color',array(
    'label' => __('Instagram Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_instagram_color',
  )));
  $wp_customize->add_setting('wpforge_social_instagram_hover_color', array( /* instagram hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 22,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_instagram_hover_color',array(
    'label' => __('Instagram Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_instagram_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_linkedin_color', array( /* linkedin color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 23,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_linkedin_color',array(
    'label' => __('LinkedIn Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_linkedin_color',
  )));
  $wp_customize->add_setting('wpforge_social_linkedin_hover_color', array( /* linkedin hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 24,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_linkedin_hover_color',array(
    'label' => __('LinkedIn Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_linkedin_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_pinterest_color', array( /* pinterest color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 25,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pinterest_color',array(
    'label' => __('Pinterest Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pinterest_color',
  )));
  $wp_customize->add_setting('wpforge_social_pinterest_hover_color', array( /* pinterest hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 26,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pinterest_hover_color',array(
    'label' => __('Pinterest Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pinterest_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_pocket_color', array( /* pocket color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 27,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pocket_color',array(
    'label' => __('Pocket Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pocket_color',
  )));
  $wp_customize->add_setting('wpforge_social_pocket_hover_color', array( /* pocket hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 28,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_pocket_hover_color',array(
    'label' => __('Pocket Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_pocket_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_polldaddy_color', array( /* polldaddy color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 29,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_polldaddy_color',array(
    'label' => __('PollDaddy Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_polldaddy_color',
  )));
  $wp_customize->add_setting('wpforge_social_polldaddy_hover_color', array( /* polldaddy hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 30,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_polldaddy_hover_color',array(
    'label' => __('PollDaddy Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_polldaddy_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_reddit_color', array( /* reddit color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 31,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_reddit_color',array(
    'label' => __('Reddit Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_reddit_color',
  )));
  $wp_customize->add_setting('wpforge_social_reddit_hover_color', array( /* reddit hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 32,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_reddit_hover_color',array(
    'label' => __('Reddit Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_reddit_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_stumbleupon_color', array( /* stumbleupon color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 33,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_stumbleupon_color',array(
    'label' => __('Stumbleupon Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_stumbleupon_color',
  )));
  $wp_customize->add_setting('wpforge_social_stumbleupon_hover_color', array( /* stumbleupon hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 34,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_stumbleupon_hover_color',array(
    'label' => __('Stumbleupon Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_stumbleupon_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_tumblr_color', array( /* tumblr color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 35,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_tumblr_color',array(
    'label' => __('Tumblr Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_tumblr_color',
  )));
  $wp_customize->add_setting('wpforge_social_tumblr_hover_color', array( /* tumblr hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 36,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_tumblr_hover_color',array(
    'label' => __('Tumblr Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_tumblr_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitter_color', array( /* twitter color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 37,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitter_color',array(
    'label' => __('Twitter Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitter_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitter_hover_color', array( /* twitter hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 38,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitter_hover_color',array(
    'label' => __('Twitter Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitter_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_vimeo_color', array( /* vimeo color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 39,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_vimeo_color',array(
    'label' => __('Vimeo Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_vimeo_color',
  )));
  $wp_customize->add_setting('wpforge_social_vimeo_hover_color', array( /* vimeo hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 40,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_vimeo_hover_color',array(
    'label' => __('Vimeo Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_vimeo_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_wordpress_color', array( /* wordpress color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 41,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_wordpress_color',array(
    'label' => __('WordPress Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_wordpress_color',
  )));
  $wp_customize->add_setting('wpforge_social_wordpress_hover_color', array( /* wordpress hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 42,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_wordpress_hover_color',array(
    'label' => __('WordPress Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_wordpress_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_youtube_color', array( /* youtube color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 43,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_youtube_color',array(
    'label' => __('YouTube Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_youtube_color',
  )));
  $wp_customize->add_setting('wpforge_social_youtube_hover_color', array( /* youtube hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 44,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_youtube_hover_color',array(
    'label' => __('YouTube Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_youtube_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_mailto_color', array( /* mailto color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 45,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_mailto_color',array(
    'label' => __('MailTo Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_mailto_color',
  )));
  $wp_customize->add_setting('wpforge_social_mailto_hover_color', array( /* mailto hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 46,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_mailto_hover_color',array(
    'label' => __('MailTo Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_mailto_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_spotify_color', array( /* spotify color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 47,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_spotify_color',array(
    'label' => __('Spotify Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_spotify_color',
  )));
  $wp_customize->add_setting('wpforge_social_spotify_hover_color', array( /* spotify hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 48,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_spotify_hover_color',array(
    'label' => __('Spotify Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_spotify_hover_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitch_color', array( /* twitch color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 49,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitch_color',array(
    'label' => __('Twitch TV Icon Color', 'wp-forge'),
    'description' => __('Default: #444444', 'wp-forge'),
    'section' => 'wpforge_social_menu_colors',
    'settings' => 'wpforge_social_twitch_color',
  )));
  $wp_customize->add_setting('wpforge_social_twitch_hover_color', array( /* twitch hover color */
    'default' => '',
    'type' => 'theme_mod',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 50,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'wpforge_social_twitch_hover_color',array(
    'label' => __('Twitch TV Icon Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
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
    'description' => __('Default: Yes, show the title', 'wp-forge'),
    'section' => 'static_front_page',
    'choices' => array(
      'yes' => __('Yes, show the title', 'wp-forge'),
      'no'  => __('No, hide the title', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('content_layout', array( /* content section */
    'title' => __('Main Content Area', 'wp-forge'),
    'description' => __('Change width and background color of main content area.', 'wp-forge'),
    'priority' => 20,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('content_width',array( /* content width */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('content_width',array(
    'label' => __('Content Width','wp-forge'),
    'description' => __('Default: 75rem', 'wp-forge'),
    'section' => 'content_layout',
    'type' => 'text',
  ));
  $wp_customize->add_setting('content_color', array( /* content background color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'content_color',array(
    'label' => __('Content Background Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_content_position',
  ));
  $wp_customize->add_control('wpforge_content_position',array(
    'type' => 'select',
    'label' => __('Main Content Positon', 'wp-forge'),
    'description' => __('Default: Left', 'wp-forge'),
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
    'description' => __('Default: Yes, show categories', 'wp-forge'),
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
    'description' => __('Default: Above post title', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'top'     => __('Above post title', 'wp-forge'),
      'bottom'  => __('Above post tags', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_category_font_size',array( /* category font size */
    'default' => '',
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
    'description' => __('Default: 0.75rem', 'wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_category_tag_font_size',array( /* category above tags font size */
    'default' => '',
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
    'description' => __('Default: 0.75rem', 'wp-forge'),
    'section' => 'post_layout',
  ));
     $wp_customize->add_setting('wpforge_category_gen_font_size',array( /* category genericon font size */
    'default' => '',
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
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_post_title_font_size',array( /* post title font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_post_title_font_size',array(
    'type' => 'text',
    'label' => __('Post Title Font Size','wp-forge'),
    'description' => __('Default: 3rem', 'wp-forge'),
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
    'description' => __('Default: Yes, display post meta', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, display post meta', 'wp-forge'),
      'no'  => __('No, hide post meta', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_postmeta_font_size',array( /* postmeta font size */
    'default' => '',
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
    'description' => __('Default: 0.75rem', 'wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_postmeta_gen_font_size',array( /* postmeta genericon font size */
    'default' => '',
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
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'description' => __('Default: Full Post', 'wp-forge'),
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
    'description' => __('Default: Yes', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes'   => __('Yes', 'wp-forge'),
      'no'  => __('No', 'wp-forge'),
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
    'description' => __('Default: Yes', 'wp-forge'),
    'section'   => 'post_layout',
    'choices'   => array(
      'yes'   => __('Yes', 'wp-forge'),
      'no'  => __('No', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_font_size',array( /* post font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 13,
  ));
  $wp_customize->add_control('wpforge_post_font_size',array(
    'type' => 'text',
    'label' => __('Post Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'description' => __('Change the font size of H1, H2, H3, H4, H5 and H6 in posts.', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 15,
  ));
  $wp_customize->add_control('wpforge_post_h1_size',array(
    'label' => __('Post H1 Font Size','wp-forge'),
    'description' => __('Default: 3rem', 'wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h1_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h2_size',array( /* Post H2 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 16,
  ));
  $wp_customize->add_control('wpforge_post_h2_size',array(
    'label' => __('Post H2 Font Size','wp-forge'),
    'description' => __('Default: 2.5rem', 'wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h2_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h3_size',array( /* Post H3 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 17,
  ));
  $wp_customize->add_control('wpforge_post_h3_size',array(
    'label' => __('Post H3 Font Size','wp-forge'),
    'description' => __('Default: 1.9375rem', 'wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h3_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h4_size',array( /* Post H4 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 18,
  ));
  $wp_customize->add_control('wpforge_post_h4_size',array(
    'label' => __('Post H4 Font Size','wp-forge'),
    'description' => __('Default: 1.5625rem', 'wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h4_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h5_size',array( /* Post H5 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 19,
  ));
  $wp_customize->add_control('wpforge_post_h5_size',array(
    'label' => __('Post H5 Font Size','wp-forge'),
    'description' => __('Default: 1.25rem', 'wp-forge'),
    'section' => 'post_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_h5_tag',
  ));

  $wp_customize->add_setting('wpforge_post_h6_size',array( /* Post H6 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 20,
  ));
  $wp_customize->add_control('wpforge_post_h6_size',array(
    'label' => __('Post H6 Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'description' => __('Default: Yes, display post tags', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, display post tags', 'wp-forge'),
      'no'  => __('No, hide post tags', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_tag_size',array( /* post tag size */
    'default' => '',
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
    'description' => __('Default: 0.75rem', 'wp-forge'),
    'section' => 'post_layout',
  ));
  $wp_customize->add_setting('wpforge_tag_gen_size',array( /* post tag size */
    'default' => '',
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
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'description' => __('Default: None', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'none'          => __('None', 'wp-forge'),
      'underline'     => __('Underline', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-through', 'wp-forge'),
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
    'description' => __('Default: None', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'none'          => __('None', 'wp-forge'),
      'underline'     => __('Underline', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_prev_next_post_display',array( /* post navigation */
    'default' => 'yes',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_wpforge_prev_next_post_display',
    'priority' => 27,
  ));
  $wp_customize->add_control('wpforge_prev_next_post_display',array(
    'type' => 'select',
    'label' => __('Display "Next and Previous Posts"','wp-forge'),
    'description' => __('Default: Yes, display "Next and Previous Posts"','wp-forge'),
    'section' => 'post_layout',
    'choices' => array(
      'yes' => __('Yes, display "Next and Previous Posts"','wp-forge'),
      'no'  => __('No, don&#39;t display "Next and Previous Posts"','wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_post_nav_display',array( /* post navigation */
    'default' => 'default',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_wpforge_post_nav_display',
    'priority' => 28,
  ));
  $wp_customize->add_control('wpforge_post_nav_display',array(
    'type'    => 'select',
    'label'   => __('Post Navigation or Pagination?', 'wp-forge'),
    'description' => __('Default: Default', 'wp-forge'),
    'section'   => 'post_layout',
    'choices'   => array(
      'default'   => __('Default', 'wp-forge'),
      'pagenavi'  => __('Pagination', 'wp-forge'),
    ),
  ));
  $wp_customize->add_section('page_layout', array( /* page section */
    'title' => __('Page Configuration', 'wp-forge'),
    'description' => __('Configure the appearance of certain page elements in your theme.', 'wp-forge'),
    'priority' => 40,
    'panel' => 'wpforge_content',
  ));
  $wp_customize->add_setting('wpforge_page_title_font_size',array( /* page title font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_page_title_font_size',array(
    'type' => 'text',
    'label' => __('Page Title Font Size','wp-forge'),
    'description' => __('Default: 3rem', 'wp-forge'),
    'section' => 'page_layout',
  ));
  $wp_customize->add_setting('wpforge_page_content_font_size',array( /* page content font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 2,
  ));
  $wp_customize->add_control('wpforge_page_content_font_size',array(
    'type' => 'text',
    'label' => __('Page Content Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'description' => __('Default: None', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'none'          => __('None', 'wp-forge'),
      'underline'     => __('Underline', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Underline', 'wp-forge'),
    'section' => 'page_layout',
    'choices' => array(
      'underline'     => __('Underline', 'wp-forge'),
      'none'          => __('None', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
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
    'description' => __('Change the font size of H1, H2, H3, H4, H5 and H6.', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 7,
  ));
  $wp_customize->add_control('wpforge_page_h1_size',array(
    'label' => __('Page H1 Font Size','wp-forge'),
    'description' => __('Default: 3rem', 'wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h1_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h2_size',array( /* page h2 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 8,
  ));
  $wp_customize->add_control('wpforge_page_h2_size',array(
    'label' => __('Page H2 Font Size','wp-forge'),
    'description' => __('Default: 2.5rem', 'wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h2_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h3_size',array( /* page h3 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 9,
  ));
  $wp_customize->add_control('wpforge_page_h3_size',array(
    'label' => __('Page H3 Font Size','wp-forge'),
    'description' => __('Default: 1.9375rem', 'wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h3_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h4_size',array( /* page h4 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('wpforge_page_h4_size',array(
    'label' => __('Page H4 Font Size','wp-forge'),
    'description' => __('Default: 1.5626rem', 'wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h4_tag',
  ));

  $wp_customize->add_setting('wpforge_page_h5_size',array( /* page h5 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 11,
  ));
  $wp_customize->add_control('wpforge_page_h5_size',array(
    'label' => __('Page H5 Font Size','wp-forge'),
    'description' => __('Default: 1.25rem', 'wp-forge'),
    'section' => 'page_layout',
    'type' => 'text',
    'active_callback' => 'wpforge_change_page_h5_tag',
  ));
  $wp_customize->add_setting('wpforge_page_h6_size',array( /* page h6 font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 12,
  ));
  $wp_customize->add_control('wpforge_page_h6_size',array(
    'label' => __('Page H6 Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('wpforge_sidebar_widget_title',array(
    'label' => __('Sidebar Widget Title Font Size','wp-forge'),
    'description' => __('Default: 0.875rem', 'wp-forge'),
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
    'description' => __('Default: Uppercase', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_sidebar_font_size',array( /* sidebar font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 4,
  ));
  $wp_customize->add_control('wpforge_sidebar_font_size',array(
    'label' => __('Sidebar Font Size','wp-forge'),
    'description' => __('Default: 0.875rem', 'wp-forge'),
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
    'description' => __('Default: None', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'none'          => __('None', 'wp-forge'),
      'underline'     => __('Underline', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Underline', 'wp-forge'),
    'section' => 'wpforge_sidebar_content',
    'choices' => array(
      'underline'     => __('Underline', 'wp-forge'),
      'none'          => __('None', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 1,
  ));
  $wp_customize->add_control('footer_sidebar_width',array(
    'label' => __('Footer Sidebar Content Width','wp-forge'),
    'description' => __('Default: 75rem', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('footer_sidebar_color', array( /* footer sidebar contet background color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_sidebar_color',array(
    'label' => __('Footer Sidebar Background Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'settings' => 'footer_sidebar_color',
  )));
  $wp_customize->add_setting('wpforge_footer_sidebar_widget_title',array( /* footer sidebar widget title size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 3,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_widget_title',array(
    'label' => __('Footer Sidebar Widget Title Font Size','wp-forge'),
    'description' => __('Default: 0.875rem', 'wp-forge'),
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
    'description' => __('Default: Uppercase', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_sidebar_font_size',array( /* footer sidebar font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 6,
  ));
  $wp_customize->add_control('wpforge_footer_sidebar_font_size',array(
    'label' => __('Footer Sidebar Font Size','wp-forge'),
    'description' => __('Default: 0.875rem', 'wp-forge'),
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
    'description' => __('Default: None', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'none'          => __('None', 'wp-forge'),
      'underline'     => __('Underline', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Underline', 'wp-forge'),
    'section' => 'wpforge_footer_sidebar_content',
    'choices' => array(
      'underline'     => __('Underline', 'wp-forge'),
      'none'          => __('None', 'wp-forge'),
      'overline'      => __('Overline', 'wp-forge'),
      'line-through'  => __('Line-Through', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
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
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 10,
  ));
  $wp_customize->add_control('footer_content_width',array(
    'label' => __('Footer Content Width','wp-forge'),
    'description' => __('Default: 74rem', 'wp-forge'),
    'section' => 'footer_content',
    'type' => 'text',
  ));
  $wp_customize->add_setting('footer_content_color', array( /* footer content background color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 15,
    ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'footer_content_color',array(
    'label' => __('Footer Content Background Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'description' => __('Change text in the footer area. HTML is allowed.', 'wp-forge'),
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
    'description' => __('Default: Text &amp; Nav Centered', 'wp-forge'),
    'section' => 'footer_content',
    'choices' => array(
      'center'  => __('Text &amp; Nav Centered', 'wp-forge'),
      'right'   => __('Text Right - Nav Left', 'wp-forge'),
      'left'    => __('Text Left - Nav Right', 'wp-forge'),
    ),
  ));
  $wp_customize->add_setting('wpforge_footer_txt_size',array( /* footer text font size */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'wpforge_sanitize_text',
    'priority' => 30,
  ));
  $wp_customize->add_control('wpforge_footer_txt_size',array(
    'label' => __('Footer Font Size','wp-forge'),
    'description' => __('Default: 1rem', 'wp-forge'),
    'section' => 'footer_content',
    'type' => 'text',
  ));
  $wp_customize->add_section('primary_button_settings', array( /* primary button settings */
    'title' => __('Primary Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Primary Button.', 'wp-forge'),
    'priority' => 1,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('primary_button_color', array( /* primary button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_color',array(
    'label' => __('Primary Button Color', 'wp-forge'),
    'description' => __('Default: #008CBA', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_color',
  )));
  $wp_customize->add_setting('primary_button_hover_color', array( /* primary button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_hover_color',array(
    'label' => __('Primary Button Hover Color', 'wp-forge'),
    'description' => __('Default: #0078a0', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_hover_color',
  )));
  $wp_customize->add_setting('primary_button_font_color', array( /* primary button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_font_color',array(
    'label' => __('Primary Button Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'primary_button_settings',
    'settings' => 'primary_button_font_color',
  )));
  $wp_customize->add_setting('primary_button_font_hover_color', array( /* primary button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'primary_button_font_hover_color',array(
    'label' => __('Primary Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'primary_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('secondary_button_settings', array( /* secondary button settings */
    'title' => __('Secondary Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Secondary Button.', 'wp-forge'),
    'priority' => 2,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('secondary_button_color', array( /* secondary button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_color',array(
    'label' => __('Secondary Button Color', 'wp-forge'),
    'description' => __('Default: #777777', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_color',
  )));
  $wp_customize->add_setting('secondary_button_hover_color', array( /* secondary button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_hover_color',array(
    'label' => __('Secondary Button Hover Color', 'wp-forge'),
    'description' => __('Default: #5f5f5f', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_hover_color',
  )));
  $wp_customize->add_setting('secondary_button_font_color', array( /* secondary button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_font_color',array(
    'label' => __('Secondary Button Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'settings' => 'secondary_button_font_color',
  )));
  $wp_customize->add_setting('secondary_button_font_hover_color', array( /* secondary button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'secondary_button_font_hover_color',array(
    'label' => __('Secondary Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #777777', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'secondary_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('success_button_settings', array( /* success button settings */
    'title' => __('Success Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Success Button.', 'wp-forge'),
    'priority' => 3,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('success_button_color', array( /* success button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_color',array(
    'label' => __('Success Button Color', 'wp-forge'),
    'description' => __('Default: #3adb76', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_color',
  )));
  $wp_customize->add_setting('success_button_hover_color', array( /* success button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_hover_color',array(
    'label' => __('Success Button Hover Color', 'wp-forge'),
    'description' => __('Default: #22bb5b', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_hover_color',
  )));
  $wp_customize->add_setting('success_button_font_color', array( /* success button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_font_color',array(
    'label' => __('Success Button Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'success_button_settings',
    'settings' => 'success_button_font_color',
  )));
  $wp_customize->add_setting('success_button_font_hover_color', array( /* success button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'success_button_font_hover_color',array(
    'label' => __('Success Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'success_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('warning_button_settings', array( /* Warning Button settings */
    'title' => __('Warning Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Warning Button.', 'wp-forge'),
    'priority' => 4,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('warning_button_color', array( /* Warning Button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_color',array(
    'label' => __('Warning Button Color', 'wp-forge'),
    'description' => __('Default: #ffae00', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_color',
  )));
  $wp_customize->add_setting('warning_button_hover_color', array( /* Warning Button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_hover_color',array(
    'label' => __('Warning Button Hover Color', 'wp-forge'),
    'description' => __('Default: #cc8b00', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_hover_color',
  )));
  $wp_customize->add_setting('warning_button_font_color', array( /* Warning Button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_font_color',array(
    'label' => __('Warning Button Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'warning_button_settings',
    'settings' => 'warning_button_font_color',
  )));
  $wp_customize->add_setting('warning_button_font_hover_color', array( /* Warning Button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'warning_button_font_hover_color',array(
    'label' => __('Warning Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'warning_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('alert_button_settings', array( /* Alert Button settings */
    'title' => __('Alert Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Alert Button.', 'wp-forge'),
    'priority' => 5,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('alert_button_color', array( /* Alert Button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_color',array(
    'label' => __('Alert Button Color', 'wp-forge'),
    'description' => __('Default: #ec5840', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_color',
  )));
  $wp_customize->add_setting('alert_button_hover_color', array( /* Alert Button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_hover_color',array(
    'label' => __('Alert Button Hover Color', 'wp-forge'),
    'description' => __('Default: #da3116', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_hover_color',
  )));
  $wp_customize->add_setting('alert_button_font_color', array( /* Alert Button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_font_color',array(
    'label' => __('Alert Button Font Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
    'section' => 'alert_button_settings',
    'settings' => 'alert_button_font_color',
  )));
  $wp_customize->add_setting('alert_button_font_hover_color', array( /* Alert Button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'alert_button_font_hover_color',array(
    'label' => __('Alert Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'label' => __('Alert Button Font Weight', 'wp-forge'),
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'alert_button_settings',
    'type' => 'select',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));
    $wp_customize->add_section('info_button_settings', array( /* Info Button settings */
    'title' => __('Info Button Settings', 'wp-forge'),
    'description' => __('This section deals with the settings of Foundations Info Button.', 'wp-forge'),
    'priority' => 6,
    'panel' => 'wpforge_buttons',
  ));
  $wp_customize->add_setting('info_button_color', array( /* Info Button color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 1,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_color',array(
    'label' => __('Info Button Color', 'wp-forge'),
    'description' => __('Default: #a0d3e8', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_color',
  )));
  $wp_customize->add_setting('info_button_hover_color', array( /* Info Button hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 2,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_hover_color',array(
    'label' => __('Info Button Hover Color', 'wp-forge'),
    'description' => __('Default: #61b6d9', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_hover_color',
  )));
  $wp_customize->add_setting('info_button_font_color', array( /* Info Button text color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 3,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_font_color',array(
    'label' => __('Info Button Font Color', 'wp-forge'),
    'description' => __('Default: #333333', 'wp-forge'),
    'section' => 'info_button_settings',
    'settings' => 'info_button_font_color',
  )));
  $wp_customize->add_setting('info_button_font_hover_color', array( /* Info Button font hover color */
    'default' => '',
    'type' => 'theme_mod',
    'transport' => 'postMessage',
    'capability' => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    'priority' => 4,
  ));
  $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize,'info_button_font_hover_color',array(
    'label' => __('Info Button Font Hover Color', 'wp-forge'),
    'description' => __('Default: #FFFFFF', 'wp-forge'),
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
    'description' => __('Default: Normal', 'wp-forge'),
    'section' => 'info_button_settings',
    'choices' => array(
      'normal'   => __('Normal', 'wp-forge'),
      'bold'     => __('Bold', 'wp-forge'),
    ),
  ));

  // 4.0 Sanitation
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
        'pagenavi'  => __('Pagination', 'wp-forge'),
      );
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_wpforge_prev_next_post_display( $input ) { // Default Post Nav Display
      $valid = array(
        'yes' => __('Yes, display "Next and Previous Posts"','wp-forge'),
        'no'  => __('No, don&#39;t display "Next and Previous Posts"','wp-forge'),
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
        'none'          => __('none', 'wp-forge'),
        'underline'     => __('underline', 'wp-forge'),
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
        'xy'   => __('XY Grid', 'wp-forge'),
        'float'   => __('Float Grid', 'wp-forge'),
        'flex'    => __('Flex Grid', 'wp-forge'),
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
  function wpforge_sanitize_offcanvas_transition( $input ) { // Off-Canvas Transition
      $valid = array(
        'push'    => __('Push', 'wp-forge'),
        'overlap' => __('Overlap', 'wp-forge'),
      );
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function offcanvas_mobile_position_sanitize( $input ) { // off-canvas mobile icon position
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
  function offcanvas_mobile_transition_sanitize( $input ) { // off-canvas mobile transition
      $valid = array(
        'push'    => __('Push', 'wp-forge'),
        'overlap' => __('Overlap', 'wp-forge'),
      );
      if ( array_key_exists( $input, $valid ) ) {
          return $input;
      } else {
          return '';
      }
  }
  function wpforge_sanitize_checkbox( $input ) { // sanitize checkboxes
      if ( $input == 1 ) {
          return 1;
      } else {
          return 0;
      }
  }

  // 5.0 - Active Callbacks
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
  function offcanvas_mobile_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_mobile_display')->value() == 'yes' ) {
          return true;
      } else {
          return false;
      }
  }
  function offcanvas_second_mobile_callback( $control ) {
      if ( $control->manager->get_setting('wpforge_mobile_display')->value() == 'no' ) {
          return true;
      } else {
          return false;
      }
  }
  // 6.0 - Transport
    $wp_customize->get_setting( 'header_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'header_width' )->transport = 'postMessage';
    $wp_customize->get_setting( 'site_title_hover_color' )->transport = 'postMessage';
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
    $wp_customize->get_setting( 'wpforge_off_canvas_main_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_dropdown_arrow_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_off_canvas_background_hover_color' )->transport = 'postMessage';
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
    $wp_customize->get_setting( 'current_item_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'current_item_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'off_canvas_active_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'off_canvas_current_item_link_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'off_canvas_current_item_link_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'offcanvas_mobile_text_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'offcanvas_mobile_link_size' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_content_position' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_post_nav_display' )->transport = 'postMessage';
    $wp_customize->get_setting( 'footer_content_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'wpforge_page_text_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'off_canvas_active_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'current_item_background_hover_color' )->transport = 'postMessage';
    $wp_customize->get_setting( 'post_title_link_color' )->transport = 'postMessage';
  }
  add_action( 'customize_register', 'wpforge_customize_register',99 );
}

// 7.0 Modifies our styles and writes them in the <head> element of the page.
if ( ! function_exists( 'wpforge_customize_css' ) ) {
  function wpforge_customize_css() {
    do_action('wpforge_customize_css');

    $output = '';
    if ( esc_attr(get_theme_mod('header_color')) ) {
        $output .= '' . '.header_wrap{background-color:'.esc_attr(get_theme_mod('header_color')).';}';
    }
    if ( esc_attr(get_theme_mod('header_width')) ) {
        $output .= '' . '.header_wrap{max-width:'.esc_attr(get_theme_mod('header_width')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_site_title_font_size')) ) {
        $output .= '' . '.site-title{font-size:'.esc_attr(get_theme_mod('wpforge_site_title_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('site_title_link_color')) ) {
        $output .= '' . 'h1.site-title a{color:'.esc_attr(get_theme_mod('site_title_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('site_title_hover_color')) ) {
        $output .= '' . 'h1.site-title a:hover{color:'.esc_attr(get_theme_mod('site_title_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('header_textcolor')) ) {
        $output .= '' . '.site-description{color:#'.esc_attr(get_theme_mod('header_textcolor')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_site_desc_font_size')) ) {
        $output .= '' . '.site-description{font-size:'.esc_attr(get_theme_mod('wpforge_site_desc_font_size')).';}';
    }

    if ( esc_attr(get_theme_mod('wpforge_header_padding')) ) {
        $output .= '' . '#header{padding:'.esc_attr(get_theme_mod('wpforge_header_padding')).';}';
    }

    if ( esc_attr(get_theme_mod('nav_width')) ) {
        $output .= '' . '.nav_wrap{max-width:'.esc_attr(get_theme_mod('nav_width')).';}';
    }
    if ( esc_attr(get_theme_mod('nav_width')) ) {
        $output .= '' . '.contain-to-grid .top-bar{max-width:'.esc_attr(get_theme_mod('nav_width')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_main_color')) ) {
        $output .= '' . '.contain-to-grid .top-bar,.top-bar,.top-bar ul,.top-bar ul li,.contain-to-grid,.top-bar.title-bar,.title-bar{background-color:'.esc_attr(get_theme_mod('top_bar_main_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_top_bar_font_size')) ) {
        $output .= '' . '.top-bar{font-size:'.esc_attr(get_theme_mod('wpforge_top_bar_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_top_bar_arrow_position')) ) {
        $output .= '' . '.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after{margin-top:'.esc_attr(get_theme_mod('wpforge_top_bar_arrow_position')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_hover_color')) ) {
        $output .= '' . '.top-bar-right .menu > li.name:hover,.top-bar .menu > li:not(.menu-text) > a:hover,.top-bar .menu > .active:hover{background-color:'.esc_attr(get_theme_mod('top_bar_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_font_color')) ) {
        $output .= '' . '.top-bar .menu-item a{color:'.esc_attr(get_theme_mod('top_bar_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_font_hover_color')) ) {
        $output .= '' . '.top-bar .name a:hover,.top-bar ul li a:hover,.menu .active > a:hover{color:'.esc_attr(get_theme_mod('top_bar_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')) ) {
        $output .= '' . '.dropdown.menu.medium-horizontal > li.is-dropdown-submenu-parent > a::after, .submenu-toggle::after{border-top-color:'.esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')) ) {
        $output .= '' . '.is-drilldown-submenu-parent > a::after{border-left-color: '.esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')) ) {
        $output .= '' . '.is-dropdown-submenu .is-dropdown-submenu-parent.opens-left > a::after{border-right-color:'.esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')) ) {
        $output .= '' . '.is-dropdown-submenu .is-dropdown-submenu-parent.opens-right > a::after{border-left-color:'.esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_main_color')) ) {
        $output .= '' . '.is-dropdown-submenu{border:1px solid '.esc_attr(get_theme_mod('top_bar_main_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')) ) {
        $output .= '' . '.js-drilldown-back > a::before{border-color:transparent '.esc_attr(get_theme_mod('top_bar_dropdown_arrow_color')).' transparent transparent;}';
    }
    if ( esc_attr(get_theme_mod('offcanvas_mobile_text_size')) ) {
        $output .= '' . '.off-canvas-content.mbl .title-bar-title{font-size:'.esc_attr(get_theme_mod('offcanvas_mobile_text_size')).';}';
    }
    if ( esc_attr(get_theme_mod('offcanvas_mobile_link_size')) ) {
        $output .= '' . '.off-canvas.mbl .menu-item a,.off-canvas-absolute.mbl .menu-item a{font-size:'.esc_attr(get_theme_mod('offcanvas_mobile_link_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_hamburger_icon_color')) ) {
        $output .= '' . '.off-canvas-content .menu-icon::after {background:'.esc_attr(get_theme_mod('wpforge_hamburger_icon_color')).';box-shadow: 0 7px 0 '.esc_attr(get_theme_mod('wpforge_hamburger_icon_color')).', 0 14px 0 '.esc_attr(get_theme_mod('wpforge_hamburger_icon_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_hamburger_icon_hover_color')) ) {
        $output .= '' . '.off-canvas-content .menu-icon:hover::after{background:'.esc_attr(get_theme_mod('wpforge_hamburger_icon_hover_color')).';box-shadow: 0 7px 0 '.esc_attr(get_theme_mod('wpforge_hamburger_icon_hover_color')).', 0 14px 0 '.esc_attr(get_theme_mod('wpforge_hamburger_icon_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_title_font_size')) ) {
        $output .= '' . '.off-canvas-content .title-bar-title{font-size:'.esc_attr(get_theme_mod('wpforge_off_canvas_title_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_main_color')) ) {
        $output .= '' . '.off-canvas,.off-canvas .is-drilldown-submenu,.off-canvas-absolute,.off-canvas-absolute .is-drilldown-submenu,.off-canvas-content .title-bar{background-color:'.esc_attr(get_theme_mod('wpforge_off_canvas_main_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_font_size')) ) {
        $output .= '' . '.off-canvas .menu-item a,.off-canvas-absolute .menu-item a{font-size:'.esc_attr(get_theme_mod('wpforge_off_canvas_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_link_color')) ) {
        $output .= '' . '.off-canvas .menu-item a,.off-canvas-absolute .menu-item a{color:'.esc_attr(get_theme_mod('wpforge_off_canvas_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_hover_color')) ) {
        $output .= '' . '.off-canvas .menu-item a:hover,.off-canvas-absolute .menu-item a:hover{color:'.esc_attr(get_theme_mod('wpforge_off_canvas_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_canvas_background_hover_color')) ) {
        $output .= '' . '.off-canvas .menu-item a:hover,.off-canvas-absolute .menu-item a:hover{background-color:'.esc_attr(get_theme_mod('wpforge_off_canvas_background_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_dropdown_arrow_color')) ) {
        $output .= '' . '.submenu-toggle::after{border-color: '.esc_attr(get_theme_mod('wpforge_off_dropdown_arrow_color')).' transparent transparent;}';
    }
    if ( esc_attr(get_theme_mod('wpforge_off_dropdown_arrow_color')) ) {
        $output .= '' . '.off-canvas .js-drilldown-back > a::before,.off-canvas-absolute .js-drilldown-back > a::before{border-right-color:'.esc_attr(get_theme_mod('wpforge_off_dropdown_arrow_color')).';}';
    }
    if ( esc_attr(get_theme_mod('off_canvas_active_color')) ) {
        $output .= '' . '.off-canvas .menu .menu-item-home,.off-canvas .menu .current-menu-parent,.off-canvas .menu .current-page-parent,.off-canvas .menu .current-page-ancestor,.off-canvas .menu .current_page_item,.off-canvas-absolute .menu .current-menu-parent,.off-canvas-absolute .menu .current-page-parent,.off-canvas-absolute .menu .current-page-ancestor,.off-canvas-absolute .menu .current_page_item{background-color:'.esc_attr(get_theme_mod('off_canvas_active_color')).';}';
    }
    if ( esc_attr(get_theme_mod('off_canvas_current_item_link_color')) ) {
        $output .= '' . '.off-canvas .menu .current_page_item a,.off-canvas-absolute .menu .current_page_item a{color:'.esc_attr(get_theme_mod('off_canvas_current_item_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('off_canvas_active_hover_color')) ) {
        $output .= '' . '.off-canvas .menu .current_page_item a:hover,.off-canvas-absolute .menu .current_page_item a:hover{background-color:'.esc_attr(get_theme_mod('off_canvas_active_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('off_canvas_current_item_link_hover_color')) ) {
        $output .= '' . '.off-canvas .menu .current_page_item a:hover,.off-canvas-absolute .menu .current_page_item a:hover{color:'.esc_attr(get_theme_mod('off_canvas_current_item_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('top_bar_active_color')) ) {
        $output .= '' . '.top-bar .menu .current-menu-parent, .top-bar .menu .current-page-parent, .top-bar .menu .current-page-ancestor, .top-bar .menu .current_page_item{background-color:'.esc_attr(get_theme_mod('top_bar_active_color')).';}';
    }
    if ( esc_attr(get_theme_mod('current_item_link_color')) ) {
        $output .= '' . '.top-bar .menu .current_page_item a{color:'.esc_attr(get_theme_mod('current_item_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('current_item_background_hover_color')) ) {
        $output .= '' . '.top-bar .menu .current_page_item a:hover{background-color:'.esc_attr(get_theme_mod('current_item_background_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('current_item_link_hover_color')) ) {
        $output .= '' . '.top-bar .menu .current_page_item a:hover,.dropdown.menu .is-active > a{color:'.esc_attr(get_theme_mod('current_item_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('content_width')) ) {
        $output .= '' . '.content_wrap{max-width:'.esc_attr(get_theme_mod('content_width')).';}';
    }
    if ( esc_attr(get_theme_mod('content_color')) ) {
        $output .= '' . '.content_wrap{background-color:'.esc_attr(get_theme_mod('content_color')).';}';
    }
    if ( esc_attr(get_theme_mod('category_link_color')) ) {
        $output .= '' . 'span.categories-links a{color:'.esc_attr(get_theme_mod('category_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('category_link_hover_color')) ) {
        $output .= '' . 'span.categories-links a:hover{color:'.esc_attr(get_theme_mod('category_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('single_post_title_color')) ) {
        $output .= '' . 'h1.entry-title-post{color:'.esc_attr(get_theme_mod('single_post_title_color')).';}';
    }
    if ( esc_attr(get_theme_mod('post_title_link_color')) ) {
        $output .= '' . 'h2.entry-title-post a{color:'.esc_attr(get_theme_mod('post_title_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('post_title_link_hover_color')) ) {
        $output .= '' . 'h2.entry-title-post a:hover{color:'.esc_attr(get_theme_mod('post_title_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('meta_header_link_color')) ) {
        $output .= '' . '.entry-meta-header a{color:'.esc_attr(get_theme_mod('meta_header_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('meta_header_link_hover_color')) ) {
        $output .= '' . '.entry-meta-header a:hover{color:'.esc_attr(get_theme_mod('meta_header_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('tag_link_color')) ) {
        $output .= '' . 'span.tags-links a{color:'.esc_attr(get_theme_mod('tag_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('tag_link_hover_color')) ) {
        $output .= '' . 'span.tags-links a:hover{color:'.esc_attr(get_theme_mod('tag_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_category_font_size')) ) {
        $output .= '' . '.entry-meta-categories{font-size:'.esc_attr(get_theme_mod('wpforge_category_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_postmeta_font_size')) ) {
        $output .= '' . '.entry-meta-header,span.edit-link a{font-size:'.esc_attr(get_theme_mod('wpforge_postmeta_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_postmeta_gen_font_size')) ) {
        $output .= '' . '.entry-meta-header .genericon,.entry-meta-categories .genericon,span.edit-link .genericon{font-size:'.esc_attr(get_theme_mod('wpforge_postmeta_gen_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_tag_size')) ) {
        $output .= '' . '.entry-meta-tags{font-size:'.esc_attr(get_theme_mod('wpforge_post_tag_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_tag_gen_size')) ) {
        $output .= '' . '.entry-meta-tags .genericon{font-size:'.esc_attr(get_theme_mod('wpforge_tag_gen_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_category_tag_font_size')) ) {
        $output .= '' . '.entry-meta-categories_bottom{font-size:'.esc_attr(get_theme_mod('wpforge_category_tag_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_category_gen_font_size')) ) {
        $output .= '' . '.entry-meta-categories_bottom .genericon{font-size:'.esc_attr(get_theme_mod('wpforge_category_gen_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_title_font_size')) ) {
        $output .= '' . 'h2.entry-title-post{font-size:'.esc_attr(get_theme_mod('wpforge_post_title_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('content_font_color')) ) {
        $output .= '' . '.entry-content-post p,.entry-content-post ul li,.entry-content-post ol li,.entry-content-post table,.comment-content table,.entry-content-post address,.comment-content address,.comments-area article header cite,#comments,.entry-content-post dl,.entry-content-post dt{color:'.esc_attr(get_theme_mod('content_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_font_size')) ) {
        $output .= '' . '.entry-content-post p,.entry-content-post ul li,.entry-content-post ol li,.entry-content-post table,.comment-content table,.entry-content-post address,.comment-content address,comments-area article header cite,#comments,.entry-content-post dl,.entry-content-post dt{font-size:'.esc_attr(get_theme_mod('wpforge_post_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('content_link_color')) ) {
        $output .= '' . '.entry-content-post a{color:'.esc_attr(get_theme_mod('content_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_link_weight') == 'bold') ) {
        $output .= '' . '.entry-content-post a{font-weight:'.esc_attr(get_theme_mod('wpforge_post_link_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_link_decoration') == 'underline') || 
         esc_attr(get_theme_mod('wpforge_post_link_decoration') == 'overline') || 
         esc_attr(get_theme_mod('wpforge_post_link_decoration') == 'line-through')) {
        $output .= '' . '.entry-content-post a{text-decoration:'.esc_attr(get_theme_mod('wpforge_post_link_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('content_hover_color')) ) {
        $output .= '' . '.entry-content-post a:hover{color:'.esc_attr(get_theme_mod('content_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_link_hover_decoration') == 'underline') || 
         esc_attr(get_theme_mod('wpforge_post_link_hover_decoration') == 'overline') || 
         esc_attr(get_theme_mod('wpforge_post_link_hover_decoration') == 'line-through')) {
        $output .= '' . '.entry-content-post a:hover{text-decoration:'.esc_attr(get_theme_mod('wpforge_post_link_hover_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h1_color')) ) {
        $output .= '' . '.entry-content-post h1{color:'.esc_attr(get_theme_mod('wpforge_content_h1_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h1_size')) ) {
        $output .= '' . '.entry-content-post h1{font-size:'.esc_attr(get_theme_mod('wpforge_post_h1_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h2_color')) ) {
        $output .= '' . '.entry-content-post h2{color:'.esc_attr(get_theme_mod('wpforge_content_h2_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h2_size')) ) {
        $output .= '' . '.entry-content-post h2{font-size:'.esc_attr(get_theme_mod('wpforge_post_h2_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h3_color')) ) {
        $output .= '' . '.entry-content-post h3{color:'.esc_attr(get_theme_mod('wpforge_content_h3_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h3_size')) ) {
        $output .= '' . '.entry-content-post h3{font-size:'.esc_attr(get_theme_mod('wpforge_post_h3_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h4_color')) ) {
        $output .= '' . '.entry-content-post h4{color:'.esc_attr(get_theme_mod('wpforge_content_h4_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h4_size')) ) {
        $output .= '' . '.entry-content-post h4{font-size:'.esc_attr(get_theme_mod('wpforge_post_h4_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h5_color')) ) {
        $output .= '' . '.entry-content-post h5{color:'.esc_attr(get_theme_mod('wpforge_content_h5_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h5_size')) ) {
        $output .= '' . '.entry-content-post h5{font-size:'.esc_attr(get_theme_mod('wpforge_post_h5_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_h6_color')) ) {
        $output .= '' . '.entry-content-post h6{color:'.esc_attr(get_theme_mod('wpforge_content_h6_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_post_h6_size')) ) {
        $output .= '' . '.entry-content-post h6{font-size:'.esc_attr(get_theme_mod('wpforge_post_h6_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_title_color')) ) {
        $output .= '' . 'h1.entry-title-page{color:'.esc_attr(get_theme_mod('wpforge_page_title_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_title_font_size')) ) {
        $output .= '' . 'h1.entry-title-page{font-size:'.esc_attr(get_theme_mod('wpforge_page_title_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_content_font_size')) ) {
        $output .= '' . '.entry-content-page p,.entry-content-page ul li,.entry-content-page ol li,.entry-content-page table,.entry-content-page table th,.entry-content-page .comment-content table,.entry-content-page address,.entry-content-page .comment-content address,.entry-content-page pre,.entry-content-page .comment-content pre,.comments-area article header cite,.entry-content-page #comments,.entry-content-page dl,.entry-content-page dt{font-size:'.esc_attr(get_theme_mod('wpforge_page_content_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_text_color')) ) {
        $output .= '' . '.entry-content-page p,.entry-content-page ul li,.entry-content-page ol li,.entry-content-page table,.entry-content-page table th,.entry-content-page .comment-content table,.entry-content-page address,.entry-content-page .comment-content address,.entry-content-page pre,.entry-content-page .comment-content pre,.comments-area article header cite,.entry-content-page #comments,.entry-content-page dl,.entry-content-page dt{color:'.esc_attr(get_theme_mod('wpforge_page_text_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_link_color')) ) {
        $output .= '' . '.entry-content-page a{color:'.esc_attr(get_theme_mod('wpforge_page_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_link_weight') == 'bold') ) {
        $output .= '' . '.entry-content-page a{font-weight:'.esc_attr(get_theme_mod('wpforge_page_link_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_link_decoration') == 'underline') || 
         esc_attr(get_theme_mod('wpforge_page_link_decoration') == 'overline') || 
         esc_attr(get_theme_mod('wpforge_page_link_decoration') == 'line-through') ) {
        $output .= '' . '.entry-content-page a{text-decoration:'.esc_attr(get_theme_mod('wpforge_page_link_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_link_hover_color')) ) {
        $output .= '' . '.entry-content-page a:hover{color:'.esc_attr(get_theme_mod('wpforge_page_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_link_hover_decoration') == 'none') || 
         esc_attr(get_theme_mod('wpforge_page_link_hover_decoration') == 'overline') || 
         esc_attr(get_theme_mod('wpforge_page_link_hover_decoration') == 'line-through') ) {
        $output .= '' . '.entry-content-page a:hover,.entry-content-page a:focus{text-decoration:'.esc_attr(get_theme_mod('wpforge_page_link_hover_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h1_color')) ) {
        $output .= '' . '.entry-content-page h1{color:'.esc_attr(get_theme_mod('wpforge_page_h1_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h1_size')) ) {
        $output .= '' . '.entry-content-page h1{font-size:'.esc_attr(get_theme_mod('wpforge_page_h1_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h2_color')) ) {
        $output .= '' . '.entry-content-page h2{color:'.esc_attr(get_theme_mod('wpforge_page_h2_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h2_size')) ) {
        $output .= '' . '.entry-content-page h2{font-size:'.esc_attr(get_theme_mod('wpforge_page_h2_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h3_color')) ) {
        $output .= '' . '.entry-content-page h3{color:'.esc_attr(get_theme_mod('wpforge_page_h3_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h3_size')) ) {
        $output .= '' . '.entry-content-page h3{font-size:'.esc_attr(get_theme_mod('wpforge_page_h3_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h4_color')) ) {
        $output .= '' . '.entry-content-page h4{color:'.esc_attr(get_theme_mod('wpforge_page_h4_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h4_size')) ) {
        $output .= '' . '.entry-content-page h4{font-size:'.esc_attr(get_theme_mod('wpforge_page_h4_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h5_color')) ) {
        $output .= '' . '.entry-content-page h5{color:'.esc_attr(get_theme_mod('wpforge_page_h5_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h5_size')) ) {
        $output .= '' . '.entry-content-page h5{font-size:'.esc_attr(get_theme_mod('wpforge_page_h5_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h6_color')) ) {
        $output .= '' . '.entry-content-page h6{color:'.esc_attr(get_theme_mod('wpforge_page_h6_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_page_h6_size')) ) {
        $output .= '' . '.entry-content-page h6{font-size:'.esc_attr(get_theme_mod('wpforge_page_h6_size')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_content_position') == 'right') ) {
        $output .= '' . '#content.cell{order:2;}';
    }
    if ( esc_attr(get_theme_mod('pagination_current_color')) ) {
        $output .= '' . '#content ul.pagination .current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a{background-color:'.esc_attr(get_theme_mod('pagination_current_color')).';}';
    }
    if ( esc_attr(get_theme_mod('pagination_current_font_color')) ) {
        $output .= '' . '#content ul.pagination .current a,#content ul.pagination li.current button,#content ul.pagination li.current a:hover,#content ul.pagination li.current a:focus,#content ul.pagination li.current button:hover,#content ul.pagination li.current button:focus,#content .page-links a{color:'.esc_attr(get_theme_mod('pagination_current_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('pagination_link_color')) ) {
        $output .= '' . '#content ul.pagination li a,#content ul.pagination li button{color:'.esc_attr(get_theme_mod('pagination_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('pagination_link_hover_color')) ) {
        $output .= '' . '#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus{color:'.esc_attr(get_theme_mod('pagination_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('pagination_hover_color')) ) {
        $output .= '' . '#content ul.pagination li:hover a,#content ul.pagination li a:focus,#content ul.pagination li:hover button,#content ul.pagination li button:focus{background-color:'.esc_attr(get_theme_mod('pagination_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_sidebar_width')) ) {
        $output .= '' . '#secondary-sidebar{max-width:'.esc_attr(get_theme_mod('footer_sidebar_width')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_sidebar_color')) ) {
        $output .= '' . '#secondary-sidebar{background-color:'.esc_attr(get_theme_mod('footer_sidebar_color')).';}';
    }
    if ( esc_attr(get_theme_mod('main_widget_title_color')) ) {
        $output .= '' . '.widget-title{color:'.esc_attr(get_theme_mod('main_widget_title_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_widget_title')) ) {
        $output .= '' . '.widget-title{font-size:'.esc_attr(get_theme_mod('wpforge_sidebar_widget_title')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_widget_title_weight') == 'bold') ) {
        $output .= '' . '.widget-title{font-weight:'.esc_attr(get_theme_mod('wpforge_sidebar_widget_title_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_widget_title_transform') == 'none') || esc_attr(get_theme_mod('wpforge_sidebar_widget_title_transform') == 'capitalize') || esc_attr(get_theme_mod('wpforge_sidebar_widget_title_transform') == 'lowercase') ) {
        $output .= '' . '.widget-title{text-transform:'.esc_attr(get_theme_mod('wpforge_sidebar_widget_title_transform')).';}';
    }
    if ( esc_attr(get_theme_mod('main_widget_text_color')) ) {
        $output .= '' . '#secondary p,#secondary li,#secondary .widget.widget_text{color:'.esc_attr(get_theme_mod('main_widget_text_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_font_size')) ) {
        $output .= '' . '#secondary p,#secondary li,#secondary .widget.widget_text{font-size:'.esc_attr(get_theme_mod('wpforge_sidebar_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('main_widget_link_color')) ) {
        $output .= '' . '#secondary a{color:'.esc_attr(get_theme_mod('main_widget_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_link_weight') == 'bold') ) {
        $output .= '' . '#secondary a{font-weight:'.esc_attr(get_theme_mod('wpforge_sidebar_link_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_link_decoration') == 'underline') || esc_attr(get_theme_mod('wpforge_sidebar_link_decoration') == 'overline') || esc_attr(get_theme_mod('wpforge_sidebar_link_decoration') == 'line-through') ) {
        $output .= '' . '#secondary a{text-decoration:'.esc_attr(get_theme_mod('wpforge_sidebar_link_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('main_widget_hover_color')) ) {
        $output .= '' . '#secondary a:hover{color:'.esc_attr(get_theme_mod('main_widget_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_sidebar_link_hover_decoration') == 'none') || esc_attr(get_theme_mod('wpforge_sidebar_link_hover_decoration') == 'overline') || esc_attr(get_theme_mod('wpforge_sidebar_link_hover_decoration') == 'line-through') ) {
        $output .= '' . '#secondary a:hover{text-decoration:'.esc_attr(get_theme_mod('wpforge_sidebar_link_hover_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_widget_title_color')) ) {
        $output .= '' . '#secondary-sidebar .widget-title{color:'.esc_attr(get_theme_mod('footer_widget_title_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title')) ) {
        $output .= '' . '#secondary-sidebar .widget-title{font-size:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_weight') == 'bold') ) {
        $output .= '' . '#secondary-sidebar .widget-title{font-weight:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_transform') == 'none') || esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_transform') == 'capitalize') || esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_transform') == 'lowercase') ) {
        $output .= '' . '#secondary-sidebar .widget-title{text-decoration:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_widget_title_transform')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_widget_text_color')) ) {
        $output .= '' . '#secondary-sidebar p,#secondary-sidebar li,#secondary-sidebar .widget.widget_text{color:'.esc_attr(get_theme_mod('footer_widget_text_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_font_size')) ) {
        $output .= '' . '#secondary-sidebar p,#secondary-sidebar li,#secondary-sidebar .widget.widget_text{font-size:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_font_size')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_widget_link_color')) ) {
        $output .= '' . '#secondary-sidebar a{color:'.esc_attr(get_theme_mod('footer_widget_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_link_weight') == 'bold') ) {
        $output .= '' . '#secondary-sidebar a{font-weight:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_link_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_link_decoration') == 'underline') || esc_attr(get_theme_mod('wpforge_footer_sidebar_link_decoration') == 'overline') || esc_attr(get_theme_mod('wpforge_footer_sidebar_link_decoration') == 'linethrough') ) {
        $output .= '' . '#secondary-sidebar a{text-decoration:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_link_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_widget_link_hover_color')) ) {
        $output .= '' . '#secondary-sidebar a:hover{color:'.esc_attr(get_theme_mod('footer_widget_link_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_sidebar_link_hover_decoration') == 'none') || 
      esc_attr(get_theme_mod('wpforge_footer_sidebar_link_hover_decoration') == 'overline') ||
      esc_attr(get_theme_mod('wpforge_footer_sidebar_link_hover_decoration') == 'line-through') ) {
        $output .= '' . '#secondary-sidebar a:hover{text-decoration:'.esc_attr(get_theme_mod('wpforge_footer_sidebar_link_hover_decoration')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_content_width')) ) {
        $output .= '' . 'footer[role="contentinfo"]{max-width:'.esc_attr(get_theme_mod('footer_content_width')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_content_color')) ) {
        $output .= '' . 'footer[role="contentinfo"]{background-color:'.esc_attr(get_theme_mod('footer_content_color')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_text_color')) ) {
        $output .= '' . 'footer[role="contentinfo"] p,footer[role="contentinfo"]{color:'.esc_attr(get_theme_mod('footer_text_color')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_link_color')) ) {
        $output .= '' . 'footer[role="contentinfo"] a,#footer .menu > .current_page_item > a{color:'.esc_attr(get_theme_mod('footer_link_color')).';}';
    }
    if ( esc_attr(get_theme_mod('footer_hover_color')) ) {
        $output .= '' . 'footer[role="contentinfo"] a:hover,#footer .menu > .current_page_item > a:hover{color:'.esc_attr(get_theme_mod('footer_hover_color')).'!important;}';
    }
    if ( esc_attr(get_theme_mod('wpforge_footer_txt_size')) ) {
        $output .= '' . 'footer[role="contentinfo"] p,footer[role="contentinfo"] a{font-size:'.esc_attr(get_theme_mod('wpforge_footer_txt_size')).';}';
    }
    if ( esc_attr(get_theme_mod('primary_button_color')) ) {
        $output .= '' . 'a.button,.button{background-color:'.esc_attr(get_theme_mod('primary_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('primary_button_font_color')) ) {
        $output .= '' . 'a.button,.button,button{color:'.esc_attr(get_theme_mod('primary_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('primary_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button,.button,button{font-weight:'.esc_attr(get_theme_mod('primary_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('primary_button_hover_color')) ) {
        $output .= '' . 'a.button:hover,a.button:focus,.button:hover,.button:focus{background-color:'.esc_attr(get_theme_mod('primary_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('primary_button_font_hover_color')) ) {
        $output .= '' . 'a.button:hover,a.button:focus,.button:hover,.button:focus{color:'.esc_attr(get_theme_mod('primary_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('secondary_button_color')) ) {
        $output .= '' . 'a.button.secondary{background-color:'.esc_attr(get_theme_mod('secondary_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('secondary_button_font_color')) ) {
        $output .= '' . 'a.button.secondary{color:'.esc_attr(get_theme_mod('secondary_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('secondary_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button.secondary{font-weight:'.esc_attr(get_theme_mod('secondary_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('secondary_button_hover_color')) ) {
        $output .= '' . 'a.button.secondary:hover,a.button.secondary:focus{background-color:'.esc_attr(get_theme_mod('secondary_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('secondary_button_font_hover_color')) ) {
        $output .= '' . 'a.button.secondary:hover,a.button.secondary:focus{color:'.esc_attr(get_theme_mod('secondary_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('success_button_color')) ) {
        $output .= '' . 'a.button.success{background-color:'.esc_attr(get_theme_mod('success_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('success_button_font_color')) ) {
        $output .= '' . 'a.button.success{color:'.esc_attr(get_theme_mod('success_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('success_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button.success{font-weight:'.esc_attr(get_theme_mod('success_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('success_button_hover_color')) ) {
        $output .= '' . 'a.button.success:hover,a.button.success:focus{background-color:'.esc_attr(get_theme_mod('success_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('success_button_font_hover_color')) ) {
        $output .= '' . 'a.button.success:hover,a.button.success:focus{color:'.esc_attr(get_theme_mod('success_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('warning_button_color')) ) {
        $output .= '' . 'a.button.warning{background-color:'.esc_attr(get_theme_mod('warning_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('warning_button_font_color')) ) {
        $output .= '' . 'a.button.warning{color:'.esc_attr(get_theme_mod('warning_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('warning_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button.warning{font-weight:'.esc_attr(get_theme_mod('warning_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('warning_button_hover_color')) ) {
        $output .= '' . 'a.button.warning:hover,a.button.warning:focus{background-color:'.esc_attr(get_theme_mod('warning_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('warning_button_font_hover_color')) ) {
        $output .= '' . 'a.button.warning:hover,a.button.warning:focus{color:'.esc_attr(get_theme_mod('warning_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('alert_button_color')) ) {
        $output .= '' . 'a.button.alert{background-color:'.esc_attr(get_theme_mod('alert_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('alert_button_font_color')) ) {
        $output .= '' . 'a.button.alert{color:'.esc_attr(get_theme_mod('alert_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('alert_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button.alert{font-weight:'.esc_attr(get_theme_mod('alert_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('alert_button_hover_color')) ) {
        $output .= '' . 'a.button.alert:hover,a.button.alert:focus{background-color:'.esc_attr(get_theme_mod('alert_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('alert_button_font_hover_color')) ) {
        $output .= '' . 'a.button.alert:hover,a.button.alert:focus{color:'.esc_attr(get_theme_mod('alert_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('info_button_color')) ) {
        $output .= '' . 'a.button.info{background-color:'.esc_attr(get_theme_mod('info_button_color')).';}';
    }
    if ( esc_attr(get_theme_mod('info_button_font_color')) ) {
        $output .= '' . 'a.button.info{color:'.esc_attr(get_theme_mod('info_button_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('info_button_font_weight') == 'bold') ) {
        $output .= '' . 'a.button.info{font-weight:'.esc_attr(get_theme_mod('info_button_font_weight')).';}';
    }
    if ( esc_attr(get_theme_mod('info_button_hover_color')) ) {
        $output .= '' . 'a.button.info:hover,a.button.info:focus{background-color:'.esc_attr(get_theme_mod('info_button_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('info_button_font_hover_color')) ) {
        $output .= '' . 'a.button.info:hover,a.button.info:focus{color:'.esc_attr(get_theme_mod('info_button_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('backtotop_color')) ) {
        $output .= '' . '#backtotop{background-color:'.esc_attr(get_theme_mod('backtotop_color')).';}';
    }
    if ( esc_attr(get_theme_mod('backtotop_font_color')) ) {
        $output .= '' . '#backtotop{color:'.esc_attr(get_theme_mod('backtotop_font_color')).';}';
    }
    if ( esc_attr(get_theme_mod('backtotop_hover_color')) ) {
        $output .= '' . '#backtotop:hover,#backtotop:focus{background-color:'.esc_attr(get_theme_mod('backtotop_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('backtotop_font_hover_color')) ) {
        $output .= '' . '#backtotop:hover,#backtotop:focus{color:'.esc_attr(get_theme_mod('backtotop_font_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_feed_color')) ) {
        $output .= '' . '.social-navigation a[href$="/feed/"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_feed_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_feed_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href$="/feed/"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_feed_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_mailto_color')) ) {
        $output .= '' . '.social-navigation a[href*="mailto:"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_mailto_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_mailto_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="mailto:"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_mailto_hover_color')).';}';
    } 
    if ( esc_attr(get_theme_mod('wpforge_social_codepen_color')) ) {
        $output .= '' . '.social-navigation a[href*="codepen.io"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_codepen_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_codepen_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="codepen.io"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_codepen_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_twitch_color')) ) {
        $output .= '' . '.social-navigation a[href*="twitch.tv"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_twitch_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_twitch_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="twitch.tv"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_twitch_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_digg_color')) ) {
        $output .= '' . '.social-navigation a[href*="digg.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_digg_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_digg_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="digg.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_digg_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_dribbble_color')) ) {
        $output .= '' . '.social-navigation a[href*="dribbble.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_dribbble_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_dribbble_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="dribbble.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_dribbble_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_dropbox_color')) ) {
        $output .= '' . '.social-navigation a[href*="dropbox.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_dropbox_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_dropbox_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="dropbox.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_dropbox_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_facebook_color')) ) {
        $output .= '' . '.social-navigation a[href*="facebook.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_facebook_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_facebook_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="facebook.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_facebook_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_flickr_color')) ) {
        $output .= '' . '.social-navigation a[href*="flickr.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_flickr_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_flickr_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="flickr.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_flickr_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_foursquare_color')) ) {
        $output .= '' . '.social-navigation a[href*="foursquare.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_foursquare_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_foursquare_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="foursquare.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_foursquare_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_google_color')) ) {
        $output .= '' . '.social-navigation a[href*="google.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_google_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_google_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="google.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_google_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_github_color')) ) {
        $output .= '' . '.social-navigation a[href*="github.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_github_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_github_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="github.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_github_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_instagram_color')) ) {
        $output .= '' . '.social-navigation a[href*="instagram.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_instagram_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_instagram_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="instagram.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_instagram_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_linkedin_color')) ) {
        $output .= '' . '.social-navigation a[href*="linkedin.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_linkedin_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_linkedin_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="linkedin.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_linkedin_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_pinterest_color')) ) {
        $output .= '' . '.social-navigation a[href*="pinterest.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_pinterest_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_pinterest_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="pinterest.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_pinterest_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_getpocket_color')) ) {
        $output .= '' . '.social-navigation a[href*="getpocket.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_getpocket_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_getpocket_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="getpocket.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_getpocket_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_polldaddy_color')) ) {
        $output .= '' . '.social-navigation a[href*="polldaddy.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_polldaddy_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_polldaddy_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="polldaddy.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_polldaddy_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_reddit_color')) ) {
        $output .= '' . '.social-navigation a[href*="reddit.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_reddit_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_reddit_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="reddit.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_reddit_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_stumbleupon_color')) ) {
        $output .= '' . '.social-navigation a[href*="stumbleupon.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_stumbleupon_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_stumbleupon_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="stumbleupon.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_stumbleupon_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_spotify_color')) ) {
        $output .= '' . '.social-navigation a[href*="spotify.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_spotify_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_spotify_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="spotify.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_spotify_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_tumblr_color')) ) {
        $output .= '' . '.social-navigation a[href*="tumblr.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_tumblr_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_tumblr_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="tumblr.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_tumblr_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_twitter_color')) ) {
        $output .= '' . '.social-navigation a[href*="twitter.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_twitter_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_twitter_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="twitter.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_twitter_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_wordpress_color')) ) {
        $output .= '' . '.social-navigation a[href*="wordpress.com"]:before,.social-navigation a[href*="wordpress.org"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_wordpress_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_wordpress_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="wordpress.com"]:before,.social-navigation a:hover[href*="wordpress.org"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_wordpress_hover_color')).';}';
    }   
    if ( esc_attr(get_theme_mod('wpforge_social_vimeo_color')) ) {
        $output .= '' . '.social-navigation a[href*="vimeo.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_vimeo_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_vimeo_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="vimeo.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_vimeo_hover_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_youtube_color')) ) {
        $output .= '' . '.social-navigation a[href*="youtube.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_youtube_color')).';}';
    }
    if ( esc_attr(get_theme_mod('wpforge_social_youtube_hover_color')) ) {
        $output .= '' . '.social-navigation a:hover[href*="youtube.com"]:before{color:'.esc_attr(get_theme_mod('wpforge_social_youtube_hover_color')).';}';
    }

    // stop adding
    echo ( $output ) ? '<style type="text/css" id="wpforge-customizer-css">' . apply_filters('wpforge_customizer_css', $output) . '</style>' . "\n" : '';
  }
  add_action('wp_head', 'wpforge_customize_css',100);
}

// Registers our theme customizer preview with WordPress.
if ( ! function_exists( 'wpforge_customize_preview_js' ) ) {
  function wpforge_customize_preview_js() {
    wp_enqueue_script( 'wpforge-customizer', get_template_directory_uri() . '/js/customizer.js', array('customize-preview'),WPFORGE_VERSION, true );
  }
  add_action( 'customize_preview_init', 'wpforge_customize_preview_js' );
}