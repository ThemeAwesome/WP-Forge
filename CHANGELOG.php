<!-- Changelog v5.2.3.1 -->
1.) Added "data-offcanvas" to line 13 of content-off_canvas.php - Seems this is needed by Off Canvas

<!-- Changelog v5.2.3 -->
1.) Updated to latest version of Foundation 5.2.3
2.) Added 'none' to the options for Background Position in the theme customizer.
3.) Changed the default text of the menu fallback function
4.) Updated normalize.css to 3.0.1 http://necolas.github.io/normalize.css/
5.) Added 'contain' to the Background Size option in customizer.
6.) Added Font-Awesome back into the mix. The shortcode plugin I am working on will use this font as well.
7.) Combined all font css into one file.
8.) Social menu icons are now handled by Font-Awesome. Font-Awesome provides a larger array of social icons.
9.) Added Russion Translation - Thanks to Andriy https://github.com/helirexi

<!-- Changelog v5.2.2.4 -->
1.) Removed all styles back to their own style sheets and called them appropriately through functions.php - Apparently this was causing WP-Forge to display incorrectly in IE and FF.

<!-- Changelog v5.2.2.3 -->
1.) Moved all css files to style.css
2.) Removed Fontawesome icon set and added the Genericons font http://genericons.com/#wordpress
3.) Changed the way the information for posts is displayed. Moved categories a post is assigned to above the title. Moved the post date, author and comments directly under the title. Tags are still listed after the post as well as the edit button that appears when the admin is logged in.
4.) Adjusted the social menu css to reflect the Genericons font.
5.) Moved the fonts folder into the inc folder
6.) Github versions of WP-Forge are now be tagged. This will allow end users to revert to previous releases of WP-Forge.
7.) Changed the appearance of the author information area - This will provide a more consistent look across different platforms. I didn't like the way it was appearing on smaller screens.
8.) Fixed issue with the post title being displayed as a link in single post view.

<!-- Changelog v5.2.2.2 -->
1.) Added support for the Github Updater from Andy Fragen https://github.com/afragen/github-updater - You will now be able to update WP-Forge from within WordPress itself. You need to download and install the Github Updater.

<!-- Changelog v5.2.2.1 -->
1.) Changed the max-width of rows in foundation.css from 62.5rem to 100%. Changed the max-width of #wrapper in style.css to 64rem (this is equivilant to 1024px based on 16px font size). This change will make it easier for users to change the width of the theme to whatever they like, even to full width.
2.) Removed the background color from rows. This is not needed as the background color of the wrapper element is white.
3.) Added function that links all post thumbnails to the post permalink.
4.) Added html5 shim to header (seems prevalent in WordPress themes)
5.) Added function that wraps inserted images in posts/pages with figure and figcaption. (thanks Tommie Landstrom)
6.) Corrected word-wrap and overflow-x issue with <pre> element. 
7.) Added data-options="mobile_show_parent_link: true" to top-bar. This will now display the parent link in mobile view. See http://foundation.zurb.com/forum/posts/809-top-bar-parent-links for more details (again thanks Tommie Landstrom)
8.) Moved Modernizr to load after jQuery

<!-- Changelog as of 04/06/2014 -->
1.) Updated to Foundation v5.2.3 (released on Friday 04/04/2014) - View changes made by Foundation via commit https://github.com/zurb/foundation/commit/520ea11dfe818691dd70cdb5c5ed5907e5e64168
2.) Removed the default values in the Background Section of the theme customizer.
3.) Added "background-size" section to Background Section of the theme customizer. This will allow users to set a full width image as the background of the site without a plugin. Read more about the "background-size" attribute http://www.w3schools.com/cssref/css3_pr_background-size.asp
4.) Removed background color from style.css and foundation.css - The default color will now be white. This will allow the user to set the initial color from within the theme customizer.
5.) Added all Foundation media queries to end of style.css - This is so users do not have to search for these in the actual Foundation Docs.
6.) .gitkeep file added to images folder. Thanks to baringji https://github.com/baringji
7.) Starting with this release main version will be updated to include minor patch version, i.e., current version is 5.2.2, if minor changes are made, the version will be appended to reflect 5.2.2.1 and so on.
8.) Updated language file.

<!-- Changelog as of 03/31/2014 -->
1.) Removed content-loop.php - This file was causing post formats to display incorrectly when "Show Full Post or Excerpt?" in the theme customizer was set to excerpt. I coded it
in an inefficient manner when I should have used the proper conditionals. Every thing is working properly.
2.) Removed an image file from the images folder that was not supposed to be there.
3.) Added <p></p> to the copyright text in the footer.

<!-- Changelog as of 03/29/2014 -->
1.) Removed the font size from footer elements. Thanks to Patrick for bringing this to my attention. View the thread: http://themeawesome.com/forums/topic/customizefootercopyright-text-firefox-shows-smaller-font-v-5-2-1/
2.) Modified comments.php - Now users can easily modify the comments form. Thanks to Joseph for giving me the inspiration. View the thread: http://themeawesome.com/forums/topic/editing-comment-form/

<!-- Changelog as of 03/28/2014 -->
1.) Added Portuguese localization file compliments of Felipe Trombini (fmtrede@gmail.com)

<!-- Changelog as of 03/27/2014 -->
1.) Added fix for the footer menu, if there is no menu added to the footer, the copyright text will now properly align to the right as it should

<!-- Changelog as of 03/26/2014 -->
1.) Removed the query string from font-awesome.css
2.) Created content-loop.php to handle an issue that was causing the excerpt to be displayed in single post view when the display option of Posts in the 
theme customizer was set to "Excerpt".
3.) Added the option to display or not display post thumbnails in single post view to theme customizer.
4.) Added Open Sans font using the @fontface method
5.) removed non printable charatcers from the comments.php file
6.) Updated language file
7.) Updated README.txt file - If you are new to WP-Forge, please make sure you read this, it has important information on how to configure WP-Forge.

<!-- Changelog as of 03/18/2014 -->

1.) Updated to latest version of Foundation, currently 5.2.3
2.) Changed the way Open-Sans is included into the theme. This will make it easier for anyone to remove the font or add their own if necessary.
3.) Added support for Jetpack's infinite scroll
4.) Added the actual search form to 404.php (I think it look better this way)

<!-- Changelog as of 02/09/2014 -->

1.) Updated WP-Forge to the latest version of Foundation, currently v5.1.1, released on 02/06/2014.
2.) Added medium column class to layout.
3.) Changed post thumbnail size from 624 to 623
4.) Fixed issue with theme customizer - site title and description were not working properly. Corrected. Now when you change the site title or site description in the customizer those changes reflect in the actual title and decription.
5.) Removed the h1 and h2 tags from the site title and site description this allows for better SEO - If you prefer to have h1 and h2 tags for site title and description, you can change it back in header.php

*for other changes to various files, please refer to the latest commit.

<!-- Changelog as of 02/08/2014 -->

1.) Updated WP-Forge to the latest version of Foundation, currently v5.1.0, released on 02/05/2014.
2.) Added new menu location called social to functions.php (line 97)
3.) Added styles for the new social menu to style sheet. (starting at line 1136)


<!-- Changelog as of 01/27/2014 -->

Functions.php
1.) Changed the priority of enque scripts as well as the favicon function to "0". This makes the sripts and styles for WP-Forge load first. (lines 142, 190 and 845)

customizer.php
1.) Removed an extra occurance of the "Change text for Home link?" in the navigation section
2.) Added Off-Canvas section under navigation section, which will aloow user to select if they want to use off-canvas menu for mobile view

style.css
1.) added new style settings for off-canvas (line 1065)
2.) removed margin from top-bar in style.css (line 315)

Files
1.) created content-off_canvas.php and added this to header.php. Also added horizontal line just under the top-bar section 
2.) added closing divs and other coding for off-canvas to footer.php (starting at line 47)
3.) added statements to content-nav.php in support of off-canvas
4.) wp-forge.po file has been updated

<!-- Changelog as of 01/22/2014 -->

Functions.php
1.) Added function to display favicon in functions.php (line 837)
2.) Added html5 support for searchform, comment form and comment list (line 85)
3.) Removed the login url redirection function that points the WP logo on the login page. Used to point to the site url, now points back to WP
4.) Removed custom admin footer message
5.) Removed support for Jetpack infinite scroll
6.) Removed Gravity Forms filter which was supposed to load gorms jquery in footer (did not work)

style.css
1.) add background to TinyMCE Editor (line 954)

Files
1.) Corrected issue with content-audio.php: removed an unclosed "if" statement
2.) Removed the link rel to favicon as this was added as a function in functions.php
