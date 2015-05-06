Theme Name: WP-Forge
File Name: Changelog
Tested up to: 4.2.1
Stable tag: 5.5.2.1

== Changelog ==

= 5.5.2.1 =
* Updated to the latest version of Foundation 5.5.2
* Renamed the setting and control for sidebar colors. With the new WP 4.2 update this caused an issue with the way those mods were named. Mods renamed and issue is corrected.
* Corrected issue with the site title and site description. Any colors assigned being handled by both the customizer as well as the style sheet. Moved all control of these to the customizer.
* Removed the container colors from the cutomizer and to the style sheet. No need for these to be in the customizer when all can be controlled in one area. The background color of these containers were preventing any background image to show through. Now these background colors can be set individually in the style sheet.
* Corrected an issue with the top-bar when placed in Contain-To-Grid-Sticky. This was causing the main Home link to move to the right.
* Removed html5 support for gallery and caption. See the following as to why this was removed: https://wordpress.org/support/topic/html5-wp-gallery-5518
* Added the ability to upload a favicon.
* Adjusted the body class function in functions.php, line 703
* Updated .po file
* Corrected an issue with the the footer sidebar class being mislabeled in style.css. https://github.com/tsquez/wp-forge/issues/44

= 5.5.1.8 =
* Modified the description of WP-Forge in style.css.
* Removed Font-Awesome icon set. Using nothing but Genericons.
* Adjusted post thumbnail size from 653 to 685. This coincides with the content width set on line 28 of functions.php
* Added html 5 support for gallery and caption.
* Added fix for TinyMCE editor jumping all over the place. Thanks to Matt Van Andel for the fix: https://github.com/zurb/foundation/issues/6380
* Added editor-style.css - took TinyMCE Editor styles out of style css and put them here. Post and Page editor display exactly like the front end.
* Added css to hide the smiley face for stats if using Jetpack plugin on line 1299. If using Jetpack and you select the option to hide the smiley face, additional style tags are added to the header. In my opinion this doesn't look very good and adds more bloat.
* Added the .contain-to-grid element to the top-bar color css in customizer.php. Now when you select a color for the top-bar, the contain-to-grid element will take on the new color. Thanks to BadCat for pointing this out: http://www.badcat.com/
* Added version to enqueued style sheets for security. I did this to reflect the version of the theme instead of the WordPress version
* Adjusted an issue with the theme displaying horizontal scrolling when using a header image and hiding the site title and site description. https://github.com/tsquez/wp-forge/issues/40 - Thanks again to BadCat for pointing it out http://www.badcat.com/
* Added styling for Gravity Forms plugin. In IE submit buttons look squished. Removing the padding makes the submit buttons look normal (line 1306 of style.css)
* Added back the ability to change the active hover state in top-bar. I had intended to remove it as I thought it redundent, however after user atelier_tsukee brought it to my attention (https://wordpress.org/support/topic/customiser-top_bar_active_hover_color), I decided to add it back.
* Removed customizer.css from the css folder. This was accidentally left over when I was attempting something with the customizer.
* Added the .content_container background color to the customizer. Somehow this got taken out at some point.
* Added the ability to change the font color and hover font color in the top-bar via the customizer.