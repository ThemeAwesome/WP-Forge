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
