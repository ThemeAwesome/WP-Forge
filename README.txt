=== WP-Forge ===
Tags: light, black, white, one-column, two-columns, right-sidebar, custom-background, custom-header, custom-menu, editor-style, featured-images, full-width-template, microformats, post-formats, sticky-post, translation-ready
Requires at least: 4.6.1
Tested up to: 4.6.1
Stable tag: 6.2.4.2
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

///////////////////////////////////
// Description
///////////////////////////////////

A WordPress theme built with ZURB's Foundation for Sites (Foundation 6), the most advanced responsive front-end framework in the world. By combining WordPress and Foundation you get a responsive WordPress theme that makes creating websites fun and exciting again! Please view the CHANGELOG.txt and README.txt files before/after installation and/or update.

///////////////////////////////////
// Bundled Resources
///////////////////////////////////

	1. Foundation Framework 6.2.4 - MIT License (https://github.com/zurb/foundation/blob/master/LICENSE)
	2. Motion-UI 1.2.2 - MIT License (https://github.com/zurb/motion-ui/blob/master/LICENSE)
	3. What-Input - MIT License (https://github.com/ten1seven/what-input/blob/master/LICENSE)
	4. Genericons 3.4.1 - GNU General Public License v2 or later (http://www.gnu.org/licenses/gpl-2.0.html)
	5. Font-Awesome 4.6.3 - See all license for Font-Awesome https://fortawesome.github.io/Font-Awesome/license/

	*minimized version of font-awesome.css as well as genericons.css is used in fonts.css, full versions are located in /fonts/full

Using rem values
=================
When you look at the style.css file you will notice that a majority of the values use rem (not em). I used the following tool to help with determining what rem value I needed to add:

https://offroadcode.com/prototypes/rem-calculator/

*When inputting a value for these divs, you can use px if that is what you are comfortable with. I do however recommend you using rem values.

///////////////////////////////////
// Installation
///////////////////////////////////

	1. In your admin panel, go to Appearance > Themes and click the Add New button.
	2. Either use the Search or Filter options to locate a Theme you would like to use or click upload and choose file, then select the theme's ZIP file. Click Install Now.
	3. Click Activate to use your new theme right away.
	4. Click Appearance -> Customize to start modifying your theme.
	5. In order to modify anything related to WordPress, you will need to make adjustments or add your own styles to style.css. In order to modify anything regarding Foundation, you need to make adjustments or add your own styles to foundation.css located in /css/foundation.css
	6. Get your theme up and running fast by visiting the WP-Forge Quick Start Guide: http://themeawesome.com/docs/wp-forge/

///////////////////////////////////
// Theme Customizer
///////////////////////////////////

WP-Forge makes use of the built in Theme Customizer. Once you have activated WP-Forge, go to Appearance -> Customize. The theme customizer of WP-Forge has ten (10) option panels. Each panel contains sections which allow you to modify WP-Forge.

///////////////////////////////////
// Header Settings
///////////////////////////////////

This panel allows you to modify the different aspects of the Header portion of your theme. The Header Image and Site Title & Tagline are default sections in the Customizer. They are also available via Appearance - Header. The following sections are available:

	1. Header Content Area* - Change the width (default is 64rem) and background color of the header content area.
        a. Header Content Width - Change the width of the header area
        b. Header Content Background Color - Change the color of the header content area
        c. Site Description Font Size - Change the font size of the Site Description
        d. Site Title Font Size - Change the font size of the site title

///////////////////////////////////
// Main Menu Settings
///////////////////////////////////

This panel deals with the main navigation area of WP-Forge. There are four sections available:

	1. Nav Content Area - Change the width (default is 64rem) and background color of the nav content area.
	2. Menu Selection - You can choose the type of menu to use with your theme. You can select Top-Bar (default) or Off-Canvas.
	   a. Top-Bar Settings - You can change the settings associated with the Top-Bar menu. You can select the position of the menu and depending on what position you select, you can choose to show or hide the title area. You can also change the text that appears in the title area.
       b. Off-Canvas Settings - Change the title bar font size as well as the links size.
	4. Mobile Menu View - Allows you to select whether or not you want to use the Off-Canvas for mobile. Also allows you to change the text that appears next to the hamburger icon as well as position the hamburger icon.

///////////////////////////////////
// Color Settings
///////////////////////////////////

The default Colors panel of the WordPress Customizer. This panel deals with the various colors associated with WP-Forge. The following sections are available:

	1. Header & Background Colors - These are the default color settings for the custom header and custom background portion of your theme. These are standard in the customizer, meaning part of WordPress core.
    2. Top-Bar Colors - Change the overall color, link, hover and active colors in the Top-Bar portion of your theme.
	4. Off-Canvas Colors - Change the overall color, link, hover and active colors fpr Off-Canvas menu of your theme.
	5. Post Colors - Change text, link and hover colors in the post content of your theme.
    6. Page Colors - Change text, link and hover colors in the page content of your theme.
    7. Pagination Colors - Change the colors associated with the built in pagination.
	8. Main Sidebar Colors - Change widget title, link and hover colors in the main sidebar area of your theme.
	9. Footer Sidebar Colors - Change widget title, link and hover colors in the Footer sidebar area of your theme.
	10. Footer Colors - Change normal text, link and hover colors in the Footer section of your theme.
	11. Back to Top Colors: Change the color and hover colors of the Back to Top button that appears in the lower right hand corner of the browser window when you scroll down.
	12. Social Menu Colors - Allows you to change the colors associated with the social links in the social menu.

///////////////////////////////////
// Front Page Settings
///////////////////////////////////

The default Front Page panel of the WordPress Customizer. The following sections are available:

	1. Static Front Page - Set up a front page for your theme. You can use either your latest blog posts or select a page.
	2. Show title on home page? - Allows you to hide the title of the page you set as the home page. This section will appear if you select to use a page for the front of your site. Page must use the front-page template.

///////////////////////////////////
// Content Settings
///////////////////////////////////

This panel deals with settings for posts and pages. The following sections are available:

    1. Foundation CSS Setting - Allows you to choose which version of foundation.css to use. You can choose regular foundation.css or foundation-flex.css
	2. Main Content Area* - Change the width (Default is 75rem) and the background color of the content area of your theme.
	2. Content Position - Choose to show the content section of the theme on the left side or the right side of the theme.
	3. Post Configuration - The following options are available:
		* Show or hide categories? - Choose to show or hide the categories.
		* Where to display categories? - Select where you want the categories to be displayed, above categories or post tags.
		* Categories Above Title Font Size - Set the font size of categories displayed above post title.
		* Categories Above Tags Font Size - Set the font size of categories displayed above post tags (only shows when Where to display categories is set to Above Post Tags).
		* Post Title Font Size - Change the font size of the post title.
		* Display post meta? - Show or hide the post meta information that displays underneath post titles. If you choose to hide the post meta, comments and edit button will still show.
		* Post Meta Font Size - Change the font size of post meta.
		* Post Meta Genericon Size - Change the font size of the genericons in post meta. If you change the font size of post meta, you can adjust the font size of the genericons to keep them proportionate.
		* Show full post or excerpt - Choose to show full posts or post excerpts
		* Display post thumbnails? - Choose to show or hide post thumbnails for posts.
		* Show single post view thumbnail? - Choose to show or hide post thumbnails in single post view.
		* Post Font Size - Change the font size of the text in posts.
		* Change Font Size of Content Headings - Change the font size of heading tags in post content.
		* Display post tags - Choose to show or hide the tags a post is assigned to.
		* Tag Font Size - Change the font size of post tags.
		* Tag Genericon Size - Change the font size of the genericon in post tags. If you change the font size of post tags, you can adjust the font size of the genericon to keep it proportionate.
		* Post Link Decoration - Select the decoration for links in post content.
		* Post Link Hover Decoration - Select the decoration for links in post content when hovered.
		* Post Link Font Weight - Select the font weight of links in posts.
		* Default Post Navigation or PageNavi? - Select to use default navigation for posts (i.e. Older posts - Newer Posts) or the built in page navigation.
		* Change Comment Form Layout? - Change the comment form to the old layout or use the new comment form layout changed in WordPress 4.4.
	4. Page Configuration - The following options are available:
		* Page Title Font Size - Change the font size of the page title.
		* Page Content Font Size - Change the font size of the text in page content.
		* Page Link Decoration - Select the decoration for links in page content.
		* Page Link Hover Decoration - Select the decoration for links in page content when hovered.
		* Page Link Font Weight - Select the font weight of links in pages.
		* Change Font Size of Page Headings - Change the font size of heading tags in page content.

///////////////////////////////////
// Main Sidebar Settings
///////////////////////////////////

This panel deals with various settings for the main sidebar area of your theme. The following settings are available:

	1. Sidebar Widget Title Font Size - Change the size of the widget titles.
	2. Sidebar Widget Title Text Transform - Controls the capitalization of the widget title.
	3. Sidebar Widget Title Weight - Set the font weight of the widget title.
	4. Sidebar Font Size - Change the font size of text, lists and links.
	5. Sidebar Link Decoration - Change the decoration of links.
	6. Sidebar Link Hover Decoration - Change the decoration of links when hovered.
	7. Sidebar Link Font Weight - Change the font weight of links.


///////////////////////////////////
// Footer Sidebar Settings
///////////////////////////////////

This panel deals the Footer Sidebar content area of the theme. The following sections are available:

	1. Footer Sidebar Content Width - Change the width (Default is 64rem).
	2. Footer Sidebar Background Color - Change the background color of the Footer Sidebar content area.
	3. Footer Sidebar Widget Title Font Size - Change the size of the widget titles.
	4. Footer Sidebar Widget Title Text Transform - Controls the capitalization of the widget title.
	5. Footer Sidebar Widget Title Weight - Set the font weight of the widget title.
	6. Footer Sidebar Font Size - Change the font size of text, lists and links.
	7. Footer Sidebar Link Decoration - Change the decoration of links.
	8. Footer Sidebar Link Hover Decoration - Change the decoration of links when hovered.
	9. Footer Sidebar Link Font Weight - Change the font weight of links.

See: http://themeawesome.com/docs/wp-forge/footer-sidebar-section/

///////////////////////////////////
// Footer Settings
///////////////////////////////////

This panel deals with the Footer Section of your theme. The following sections are in the Footer Panel:

	1. Footer Content Width* - Change the width (Default is 64rem) of the Footer Sidebar content area.
	2. Footer Content Background Color - Change the background color of the Footer Sidebar content area.
	3. Footer Text - Change the footer text of your theme and select the position in which you want it to appear.
	4. Footer Content Position - Choose how you want to display the content in the footer area.

See: http://themeawesome.com/docs/wp-forge/footer-section/

///////////////////////////////////
// Foundation Buttons
///////////////////////////////////

This section allows you to change the primary color, hover color, primary font color, font hover color as well as the font weight of all the buttons that are included with Foundation.

These buttons are Primary, Secondary, Success, Warning, Alert and Info buttons.

///////////////////////////////////
// Menus
///////////////////////////////////

The Menu panel adds custom menu management to the Customizer. It allows you to live-preview changes to your menus before they're published. WP-Forge supports three menu locations:

	1. Main Menu
	2. Footer Menu
	3. Social Menu

After you create your menus, you can select which menu appears in each location. Make sure you see the "Configure the Social Menu" below to set up your social menu.

///////////////////////////////////
// Widget
///////////////////////////////////

Widgets are independent sections of content that can be placed into the sidebar areas of your theme. The following widget areas are available:

	1. Main Sidebar - Displays widgets in the blog area as well as pages.
	2. First Footer Widget Area - An widget area for your site footer (will only appear if a widget is added)
	3. Second Footer Widget Area - A second widget area for your site footer (will only appear if a widget is added)
	4. Third Footer Widget Area - A third widget area for your site footer (will only appear if a widget is added)
	4. Fourth Footer Widget Area - A fourth widget area for your site footer (will only appear if a widget is added)

///////////////////////////////////
// Configure the Social Menu
///////////////////////////////////

WP-Forge allows you display links to your social media profiles, like Twitter and Facebook, with icons. This menu is located in the footer portion of the theme.

	Set Up
	============
	1. Create a new Custom Menu, and assign it to the Social Links Menu location.
	2. Add links to each of your social services using the Custom Links panel on the left (do not use page, post or category links). Make sure you add Link Text as well i.e. if you adding a link for Facebook, in the Link Text portion use Facebook.
	3. Icons for your social links will automatically appear if it's available.

Available icons: (Linking to any of the following sites will automatically display its icon in your social menu).

* Codepen
* Digg
* Dribbble
* Dropbox
* Facebook
* Flickr
* Foursquare
* GitHub
* Google+
* Instagram
* LinkedIn
* Email (mailto: links)
* Pinterest
* Pocket
* PollDaddy
* Reddit
* RSS Feed (URLs with /feed/)
* Spotify
* StumbleUpon
* Tumblr
* Twitch
* Twitter
* Vimeo
* WordPress
* YouTube

Social networks that aren't currently supported will be indicated by a generic share icon.

See: https://themeawesome.com/docs/wp-forge/social-menu-configuration/
