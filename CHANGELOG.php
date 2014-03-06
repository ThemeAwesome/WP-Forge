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
