Theme Name: WP-Forge
File Name: Changelog
Tested up to: 4.1.1
Stable tag: 5.5.1.8

== Changelog ==

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