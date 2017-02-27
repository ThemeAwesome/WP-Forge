<?php
/**
 * @version 6.3.0.1.1
 */
// Load CSS
if ( ! function_exists( 'wpforge_load_admin_scripts' ) ) {
    function wpforge_load_admin_scripts() {
        wp_enqueue_style('dashboard-css', get_template_directory_uri() . '/css/admin.css');
    }
    add_action( 'admin_enqueue_scripts', 'wpforge_load_admin_scripts' );
}
// Add theme page
if ( ! function_exists( 'wpforge_theme_info' ) ) {
    function wpforge_theme_info() {
        $menu_title = esc_html__('WP-Forge Theme', 'wp-forge');
        add_theme_page( esc_html__('WP-Forge Theme ', 'wp-forge'),$menu_title,'edit_theme_options','wpforge','wpforge_theme_info_page');
    }
    add_action('admin_menu', 'wpforge_theme_info');
}
// Admin notice - Shows just one time
if ( ! function_exists( 'wpforge_admin_notice' ) ) {
    function wpforge_admin_notice() { 
        $theme_data = wp_get_theme();?>
        <div class="update notice notice-success notice-alt is-dismissible">
            <p><?php printf( esc_html__( 'Thank you for choosing %1$s! Please take a minute and visit the %2$s', 'wp-forge' ),  $theme_data->Name, '<a href="'.esc_url( add_query_arg( array( 'page' => 'wpforge' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Welcome Page', 'wp-forge' ).'</a>'  ); ?></p>
        </div>
        <?php
    }
}
// Activation notice
if ( ! function_exists( 'wpforge_admin_notice_activation' ) ) {
    function wpforge_admin_notice_activation(){
        global $pagenow;
        if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
            add_action( 'admin_notices', 'wpforge_admin_notice' );
        }
    }
    add_action( 'load-themes.php',  'wpforge_admin_notice_activation');
}
function wpforge_theme_info_page() {
    $theme_data = wp_get_theme('wp-forge');
    $tab = null;
    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = null;
}
?>
    <div class="wrap about-wrap theme_info_wrapper">
        <h1><?php printf( esc_html__('Welcome to WP-Forge - Version %1s', 'wp-forge'), $theme_data->Version ); ?></h1>
        <div class="about-text">
            <?php esc_html_e( 'A WordPress theme built with Foundation for Sites (6.3.0.1) from Zurb, the most advanced responsive front-end framework in the world. By combining WordPress and Foundation you get a resposive WordPress theme that makes creating websites fun and exciting again!', 'wp-forge' ); ?>
        </div><!-- end about-text -->

        <a target="_blank" href="<?php echo esc_url('https://themeawesome.com/'); ?>" class="theme-badge wp-badge"><span>ThemeAwesome.com</span></a>

        <h2 class="nav-tab-wrapper">

            <a href="?page=wpforge" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'WP-Forge', 'wp-forge' ) ?></a>

            <a href="?page=wpforge&tab=changelog" class="nav-tab<?php echo $tab == 'changelog' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Changelog', 'wp-forge' ); ?></a>

            <a href="?page=wpforge&tab=themes" class="nav-tab<?php echo $tab == 'themes' ? ' nav-tab-active' : null; ?>"><?php esc_html_e( 'Themes', 'wp-forge' ); ?></span></a>

        </h2><!-- end nav-tab-wrapper -->

        <?php if ( is_null( $tab ) ) { ?>

            <div class="row rtop">

                    <div class="small-12 large-4 columns">

                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Theme Customizer', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('%s uses the Theme Customizer for all theme settings. Click "Customize WP-Forge" to start personalizing your site.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary"><?php esc_html_e('Customize WP-Forge', 'wp-forge'); ?></a>
                            </p>
                        </div><!-- end theme_link -->

                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Theme Documentation', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('Need any help to setup and configure %s? Please read the theme documentation.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url( 'https://themeawesome.com/docs/wp-forge/' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e('WP-Forge Documentation', 'wp-forge'); ?></a>
                            </p>
                        </div><!-- end theme_link -->

                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Having Trouble, Need some help?', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('Support for %s is provided through the WordPress Support Forums.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://wordpress.org/support/theme/wp-forge' ); ?>" target="_blank" class="button button-primary"><?php echo sprintf( esc_html__('Visit Support Forums', 'wp-forge'), $theme_data->Name); ?></a>
                            </p>
                        </div><!-- end theme_link -->

                    </div><!-- end theme_info_left -->

                    <div class="small-12 large-7 columns">
                        <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
                        <p class="cntr"><strong><?php esc_html_e( 'What do you think of WP-Forge?', 'wp-forge' ); ?></strong><br />
                        <?php _e('Please <a target="_blank" href="https://wordpress.org/support/theme/wp-forge/reviews/">rate and review WP-Forge</a> on WordPress.org.', 'wp-forge'); ?><br />
                        <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
                    </div><!-- end theme_info_right -->

            </div><!-- end theme_info_wrapper -->

        <?php } ?>

         <?php if ( $tab == 'changelog' ) { ?>
                <div class="row">
                    <div class="changelog small-12 large-12 columns">
<p>Theme Name: <b>WP-Forge</b><br />
Tags: <b>light, black, white, one-column, two-columns, right-sidebar, custom-background, custom-header, custom-menu, editor-style, featured-images, full-width-template, microformats, post-formats, sticky-post, translation-ready</b><br />
Requires at least: <b>4.7.2</b><br />
Tested up to: <b>4.8-alpha-40127</b><br />
Stable tag: <b>6.3.0.1</b><br />
License: <b>GPLv2 or later</b><br />
License URI: <b>http://www.gnu.org/licenses/gpl-2.0.html</b></p>

                        <h4>6.3.0.1</h4>
                        <small>Theme updated 02/27/17</small>
                        <ul>
                            <li>Updated to Foundation version 6.3.0.1</li>
                            <li>Updated Font-Awesome to 4.7</li>
                            <li>Removed <code>ap.js</code> - moved the actual call for foundation to theme-functions.js - now there is only one file.</li>
                            <li>Added <code>what-input.js</code> and <code>foundation.js</code> to the <code>wpforge_theme_functions</code> of functions.php - this makes the scripts load closer to the closing body tag as they were meant to be.</li>
                            <li>Moved to one off-canvas file for the theme by removing <code>off-canvas-mobile.php</code>. There is no need to have two of the same files being called by two different fuinctions, when one file and one function will do.</li>
                            <li>Moved Use <code>Off-Canvas for Mobile?</code> to <code>Top-Bar Settings section.</code></li>
                            <li>Added options for off-canvas that will appear when <code>Use Off-Canvas for Mobile?</code> is set to <code>Yes</code> in <code>Top-Bar Settings</code>. These settings only affect mobile Off-Canvas (the off-canvas menu used in conjunction with the top-bar)</li>
                            <li>Switched <code>data-accordion</code> to <code>data-drilldown</code> in off-canvas. <code>data-accordion</code> still does not work as of 6.3.0.1 and is slated to be possibly added to next major release, 6.4. See this thread <a href="<?php echo esc_url('https://github.com/zurb/foundation-sites/pull/9348' ); ?>" target="_blank">https://github.com/zurb/foundation-sites/pull/9348</a> - For now <code>data-drilldown</code> will remain in place until the <code>data-accordion</code> is corrected and functions properly. Thanks to @cbirdsong for asking how this is done, which promted the switch: See <a href="<?php echo esc_url('https://wordpress.org/support/topic/parent-links-of-off-canvas-mobile-menu-not-working/' ); ?>" target="_blank">https://wordpress.org/support/topic/parent-links-of-off-canvas-mobile-menu-not-working/</a></li>
                            <li>Updated <code>off-canvas</code> menu to the latest version. Unfortunately, only two Off-Canvas Directions are available: <code>position-left</code> and <code>position-right</code>. The other positions, <code>position-top</code> and <code>position-bottom</code>, are slated for possible inclusion in the next update, keep in mind I make no guarantee that they will. The reason they were not added in this update is due to the fact that currently the menu does not look proper if top or bottom is used.</li>
                            <li>Added the abilty for the user to set the Off-Canvas Transitions to <code>push</code> or <code>overlap</code>.</li>
                            <li>Removed Foundation <code>active</code> class from menus. Switched to <code>current-menu-item</code>, which is already built into WP core. In my opinion this is a much better option and is easier to style. Thanks @OttoPotto for bringing up this request which gave me the idea to switch. See this thread <a href="<?php echo esc_url('https://github.com/tsquez/wp-forge/issues/50' ); ?>" target="_blank">https://github.com/tsquez/wp-forge/issues/50</a></li>
                            <li>Removed the <code>title-bar title link</code> from top-bar and off-canvas menus. In my opinion, I feel this is redundant as normally users add a link to the home page in the menu.</li>
                            <li>Switched to <code>data-sticky-container</code> and <code>data-sticky</code> in place of <code>fixed</code> for the main menu when the Top-Bar is set to <code>Top of Browser - Fixed</code>.</li>
                            <li>Moved <code>Use Off-Canvas for Mobile?</code> section into the <code>Top-Bar Settings</code> section after movng towards one off-canvas file. Makes more sense this option should only be available if the top-bar is selected as the primary menu.</li>
                            <li>Modified the js code in <code>contain-to-grid.js</code>, which was eventually moved it to <code>theme-functions.js</code>. See this thread <a href="<?php echo esc_url('https://github.com/tsquez/wp-forge/issues/51'); ?>" target="_blank">https://github.com/tsquez/wp-forge/issues/51</a> Thanks to @HenkBarreveld.</li>
                            <li>By modifying and moving the <code>contain-to-grid</code> js this allowed for the removal of the <code>wpforge_contain_to_grid</code> function from functions.php as well as removal of the actual <code>contain-to-grid.js</code> file, as it was no longer needed.</li>
                            <li>Corrected a few issues with all of the different navigation menus regarding colors. Specific issues were how the <code>current-menu-item</code> appeared for the top-bar and off-canvas menus. Typically what would happen is, if the colors for the active or <code>current-menu-item</code> were selected for the top-bar, those color choices were applied to <code>off-canvas</code> as well. What if the user wanted different colors for the <code>current-menu-item</code> in <code>off-canvas</code>? So I added <code>current-menu-item</code> color choices to Off-Canvas Colors section.</li>
                            <li>Wrapped Recent Posts, Popular Categories, Monthly Archives and Popular Tags elements of 404.php in <code>&lt;ul&gt;</code>.</li>
                            <li>Removed references to earlier versions of the theme from CHANGELOG.txt. These references referred to an earlier version of WP-Forge which was built using Foundation 5.</li>
                            <li>Removed the old admin notice. Replaced with a new theme info page located under Apperance called 'WP-Forge Theme'.</li>
                        </ul>

                        <h4>6.2.4.2</h4>
                        <small>Theme updated 10/31/16</small>
                        <ul>
                            <li>Wrapped <code>wpforge_setup</code> function in a <code>if_function_exists</code>. Located in functions.php.</li>
                            <li>Modified the padding of the next and previous buttons in orbit.</li>
                            <li>Corrected an issue where the sub menu items could not be clicked on touch screens. Thanks to @gsatsan for bringing it to my attention: <a href="<?php echo esc_url('https://wordpress.org/support/topic/touch-menu-not-working/#post-8376221' ); ?>" target="_blank">https://wordpress.org/support/topic/touch-menu-not-working/#post-8376221</a></li>
                            <li>Updated the .po file</li>
                        </ul>

                        <h4>6.2.4.1</h4>
                        <small>Theme updated 10/27/16</small>
                        <ul>
                            <li>Removed the "scroll to function" I added in 6.2.4 - This was causing a conflict with tabs.</li>
                        </ul>

                        <h4>6.2.4</h4>
                        <small>Theme updated 10/23/16</small>
                        <ul>
                            <li>Updated Foundation to latest version, 6.2.4</li>
                            <li>Corrected issue with 'active' class css in menu widget. The background was filled the active color.</li>
                            <li>Added '!important' to line 4353 of customizer.php - this portion of the file deals whith the hover color of the active link in the sidebar menu widget. Before adding '!important', when hovering over an active link in the menu widget, the link would disappear.</li>
                            <li>Added Pricing Table css from Foundation 5.</li>
                            <li>Modified contain-to-grid.js - Thanks to @HenkBarreveld for the suggestion - see this thread: <a href="<?php echo esc_url('https://github.com/tsquez/wp-forge/issues/49' ); ?>" target="_blank">https://github.com/tsquez/wp-forge/issues/49</a></li>
                            <li>Added css that affects the look and feel of the Orbit bullets. They appear smaller now. You can easily adjust the css to suit your needs. CSS is located on line 1013 of style.css</li>
                            <li>Added flex-video class to videos shared from VideoPress.com.</li>
                            <li>Corrected issue with the arrow not showing in select boxes.</li>
                            <li>Added a "scroll to" function to 'theme-functions.js' this will allow you to add anchor points to content in your theme and associate links with those anchors. When the link is clicked, the theme will scroll to the anchor point.</li>
                        </ul>

                        <h4>6.2.3.1</h4>
                        <small>Theme updated 06/26/16</small>
                        <ul>
                            <li>Changed the <code>wp_get_attachment_metadata()</code> function for images in image.php - Seems there was an error being generated about the width and the height. Looked at the snippet in Twenty Sixteen and adjusted the function in WP-Forge.</li>
                            <li>Corrected an issue with the styling of the Sitemap template.</li>
                            <li>Removed sitemap style sheet from css folder as it was not needed.</li>
                            <li>Removed the post thumbnail from sitemap.php.</li>
                            <li>Added <code>!important</code> to line 4369 of <code>customizer.php</code> - this portion of the file deals whith the hover color of the active link in the footer. Before adding </code>!important</code>, when hovering over an active link in the footer, the link would disappear.</li>
                        </ul>

                        <h4>6.2.3</h4>
                        <small>Theme updated 06/25/16</small>
                        <ul>
                            <li>Updated to the latest version number of Foundation. No core files were update. As stated by Zurb: <em>This release builds upon 6.2.2 to improve how the settings file is generated. No changes to the core framework went in here.</em></li>
                            <li>Added popular categories, monthly archives and tags to 404.php.</li>
                            <li>Added the sitemap template back into the theme.</li>
                            <li>Updated Font-awesome to the latest version, 4.6.3.</li>
                            <li>Corrected an issue where when changing the color of the primary button, the color change would not appear in the preview but would show after the change was applied.</li>
                            </ul>

                            <h4>6.2.2</h4>
                            <small>Theme updated 05-29-16</small>
                            <ul>
                            <li>Updated to the latest version of Foundation, 6.2.2. (foundation-flex.css was not update by ZURB so version is still at 6.2.1)</li>
                            <li>Changed the name of 'wpforge-functions.js' to 'theme-functions.js'.</li>
                            <li>Added support for selective refresh for widgets. See <a href="<?php echo esc_url('https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/' ); ?>" target="_blank">https://make.wordpress.org/core/2016/03/22/implementing-selective-refresh-support-for-widgets/</a></li>
                        </ul>

                        <h4>6.2.1.3</h4>
                        <small>Theme updated 05-13-16</small>
                        <ul>
                            <li>Added a color transition to all links</li>
                            <li>Added additional options to change colors of various elements in posts. You can now change the colors associated with category lists, tag lists, meta information and post title.</li>
                            <li>Corrected an issue with the post formats where the category was displaying at the bottom of the posts.</li>
                            <li>Changed the colors of the aside post format.</li>
                            </ul>

                            <h4>6.2.1.2</h4>
                            <small>Theme updated 04/30/16</small>
                            <ul>
                            <li>Removed the java script from <code>wpforge-functions.php</code> that removed empty p and br tags from the content area. This was causing line breaks not to work.</li>
                            <li>Corrected an issue where changes made to pagination colors in customizer were not being applied in real time.</li>
                        </ul>

                        <h4>6.2.1.1</h4>
                        <small>Theme updated Apr 17, 2016</small>
                        <ul>
                            <li>Corrected and issue where some of the text in the comment form was not translateable. Thanks to @jarnoan for bringing this to my attention months ago: <a href="<?php echo esc_url('https://github.com/tsquez/wp-forge/pull/48'); ?>" target="_blank">https://github.com/tsquez/wp-forge/pull/48</a></li>
                            <li>Adjusted the Off-Canvas menu. 6.2.1 added some additional padding which made the menu look "fatter".</li>
                            <li>Updated Font-Awesome to 4.6.1</li>
                            <li>Updated Motion-Ui to 1.2.2</li>
                            <li>Adjusted the mobile styles for certain elements.</li>
                            <li>Added the following classes: secondary label radius, to the comment reply link via js in wpforge-functions.js and I also added the following classes: alert label radius, to the cancel reply link via js in wpforge-functions.js.</li>
                            <li>Removed the hr from header.php. This only displayed on small mobile devices and after a hard look, I decided to remove it.</li>
                        </ul>

                        <h4>6.2.1</h4>
                        <small>Theme updated Apr 10, 2016</small>
                        <ul>
                            <li>Updated to Foundation 6.2.1</li>
                            <li>Went back to the accordion style menu for off-canvas.</li>
                            <li>Removed the border around images.</li>
                            <li>Corrected an issue where the categories were displaying at the end of posts above the post tags even if the option was not set for them to display there.</li>
                            <li>Added .button support to the Foundation Buttons section of the customizer.</li>
                            <li>Added button support to the Foundation Buttons section of the customizer.</li>
                            <li>Modified the heading tag section of both post content and page content sections of the customizer. Now the fields to change the font size of heading tags is hidden unless a specific tag is chosen.</li>
                            <li>Added the .button class css from foundation.css to the button class in the WP-Forge style sheet. Now buttons built with  will have the same look and feel as regualr foundation buttons and will take on the modification set in the Foundation Buttons section of the customizer.</li>
                            <li>Corrected an issue where the default link color for links within a page were showing up as black. They now show properly as blue, which is the default.</li>
                        </ul>

                        <h4>6.2</h4>
                        <small>Theme updated 03-27-16</small>
                        <ul>
                            <li>Updated to the latest version of Zurb's Foundation, 6.2</li>
                            <li>Increased the width of the theme from 1024px to 1200px. This is based off the new width of rows wich is 1200px.</li>
                            <li>With the increase in width, I decided to add a fourth footer widget.</li>
                            <li>Added fonts.css to editor. Previously only genericons.css was added. Since this was combined into fonts.css with font-awesome, fonts.css was added. Now genericons and font-awesome are available via the editor.</li>
                            <li>Updated Font-Awesome to latest version, 4.5. font-awesome.min.css was added to fonts.css, the full version of Font-Awesome is located in /fonts/full (per WordPress guidelines).</li>
                            <li>Genericons css was minified and changed in fonts.css - full version of genericon.css is available in /fonts/full (per WordPress guidelines).</li>
                            <li>Added Motion-UI <a href="<?php echo esc_url('ttps://github.com/zurb/motion-ui'); ?>" target="_blank">https://github.com/zurb/motion-ui</a></li>
                            <li>Renamed load-foundation.js to app.js.</li>
                            <li>Removed normalize.css as it is now part of foundation.css.</li>
                            <li>Increased thumbnail size to 800px and full width thumbnail to 1200px.</li>
                            <li>Removed Modernizer - The way F6 is written, this file is no longer needed.</li>
                            <li>Added the contain-to-grid option back for the main menu area. Initially I removed it because the contain-to-grid element was removed in F6. However I was able to retain this option. All options previously available for the top-bar menu are still intact.</li>
                            <li>Added to ability to set the font size for the footer area.</li>
                            <li>Removed the 'wpforge_active_list_pages_class' function. This started on line 276 of functions.php - This function was not need as the 'wpforge_active_nav_class' function above it starting on line 261 added the same 'active' class to the current page item in the top-bar menu.</li>
                            <li>Added a new version of page-navi function. Old function was not displaying properly. See <a href="<?php echo esc_url('http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/'); ?>" target="_blank">http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/</a> for more information.</li>
                            <li>Removed the custom-bckground-white body class from the theme. I saw no purpose in it, so it is removed.</li>
                            <li>Removed the postfix element from the search submit button. This element was removed from F6 and shrunk the submit button in the search form widget.</li>
                            <li>Changed word-wrap for pre. Now pre wraps properly (or at least how I want it to)</li>
                            <li>Added new off-canvas menu. I was able to retain the look and functionality, plus all of the options in the customizer.</li>
                            <li>Adjusted the options for the new top-bar menu in customizer.</li>
                            <li>Added @version to all files for better version control.</li>
                            <li>Corrected an issue in the comment form. In discussion settings, unchecking "Comment author must fill out name and email" removed the "Your Name" and "Your Email" labels from the comment form. These labels appear properly now. See this thread: <a href="<?php echo esc_url('https://wordpress.org/support/topic/comment-form-labels-not-visible-on-discussion-setting-change/?replies=3#post-7869547' ); ?>" target="_blank">https://wordpress.org/support/topic/comment-form-labels-not-visible-on-discussion-setting-change?replies=3#post-7869547</a> - Thanks to user "forbc" for bringing this to my attention.</li>
                            <li>Added option in customizer to reset the comment forms back to their original positions. For details see <a href="<?php echo esc_url('http://www.wpbeginner.com/wp-tutorials/how-to-move-comment-text-field-to-bottom-in-wordpress-4-4/' ); ?>" target="_blank">http://www.wpbeginner.com/wp-tutorials/how-to-move-comment-text-field-to-bottom-in-wordpress-4-4/</a></li>
                            <li>The separator for breadcrumbs will now show automatically via css.</li>
                            <li>Added function to wpforge-functions.js that removes empty p and br tags from the content area.</li>
                            <li>Removed the About WP-Forge section under Appearance. It was kind of clunky and not dev friendly. I will be switching to a new About WP-Forge admin page. The admin notice about WP-Forge will still display once the theme has been activated.</li>
                            <li>Added the clearfix class to gallery via the wpforge-functions.js file</li>
                            <li>Added support for Jetpacks new social menu.</li>
                            <li>Fixed issue where catgories were not showing above tags if Where to display categories? was set to Above Post Tags.</li>
                            <li>Redid the comment reply button by adding a label class.</li>
                            <li>Reversed the Sticky pin icon to the other direction.</li>
                            <li>Changed the icon for the post date.</li>
                            <li>Removed the actual search form from 404.php and added <code>get_search_form function</code> instead.</li>
                            <li>Changed .entry-content for posts to .entry-content-posts and .entry-content for pages to .entry-content-pages. I did this to better help the end user control the look and feel of posts as well as pages.</li>
                            <li>Added options for font sizes, color as well as link decoration to customizer for posts, pages, sidebar and footer sidebar.</li>
                            <li>Title Area of the top-bar will only appear in Top- of Browser - Scroll and Top of Browser - Fixed. Title area does not show in Normal Position or Contain to Grid Sticky</li>
                            <li>Added Foundation Buttons Panel and sections for Foundation buttons - Now the end user can change the settings of all the Foundation buttons.</li>
                            <li>Added the option to select between regular Foundation grid or the new Foundation flex grid (this is available under the Content Settings Panel)</li>
                            <li>Left the inline css that is added to the header via the customizer as is. Meaning, each element is on its own line.</li>
                        </ul>

                        <p><small><em><strong>* Changelog only reflects changes made to the theme since Foundation for Sites was released. To view changes to the theme prior to F6, please see previous <a href="<?php echo esc_url('https://github.com/tsquez/wp-forge/releases'); ?>" target="_blank">releases on GitHub</a> or <a href="<?php echo esc_url('https://themes.trac.wordpress.org/browser/wp-forge/' ); ?>" target="_blank">Browse in Trac</a> all changes over at WordPress.org.</strong></em></small></p>

                    </div><!-- theme_info_boxed_changelog -->

                </div><!-- end col -->

        <?php } ?>

        <?php if ( $tab == 'themes' ) { ?>
            <div class="row rtop">

                <div class="small-12 large-12 columns">

                    <div class="small-12 large-4 columns">

                        <div class="theme_link">
                            <h2><?php esc_html_e( 'WP-Edify', 'wp-forge' ); ?></h2>
                            <p class="about"><?php printf(esc_html__('A one page WordPress theme built with Foundation for Sites (Foundation 6.3.0.1) from Zurb. Built specifically with the LearnDash LMS plugin in mind. If creating an educational site is not your goal, you can still use WP-Edify to create any kind of site you desire. Simple and easy! Keep in mind the demo is not complete.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://themeawesome.com/wp-edify/'); ?>" class="button button-primary" target="_blank"><?php esc_html_e('Get Notified', 'wp-forge'); ?></a>
                                <a href="<?php echo esc_url('https://themeawesome.com/themes/wp-edify'); ?>" class="button button-secondary" target="_blank">
                                <?php esc_html_e('Check Out the Demo', 'wp-forge'); ?></a>
                            </p>
                        </div><!-- end theme_link -->

                    </div><!-- end theme_info_left -->

                    <div class="small-12 large-7 columns">
                        <img src="<?php echo get_template_directory_uri(); ?>/inc/img/wp-edify.jpg" alt="WP-Edify" />
                        <p class="cntr"><strong><?php esc_html_e( 'COMING SOON!', 'wp-forge' ); ?></strong></p>
                    </div><!-- end theme_info_right -->

                </div><!-- end columns -->

            </div><!-- end row -->
        <?php } ?>

        <?php do_action( 'wpforge_more_tabs_details', $tab ); ?>

    </div> <!-- END .theme_info -->
    <script type="text/javascript">
        jQuery(  document).ready( function( $ ){
            $( 'body').addClass( 'about-php' );
        } );
    </script>
    <?php
}