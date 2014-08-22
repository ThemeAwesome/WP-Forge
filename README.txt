WP-Forge v5.4
=======================================
Based on Twenty Twelve, WP-Forge is a combination of two powerful platforms. The first being WordPress, the leading open source blogging tool and content management system. The second being Foundation (v5.4), the most advanced responsive front-end framework.

Demo
=======================================
http://wpforge.themeawesome.com/

Installation
=======================================
1. Add the "wp-forge" folder to your sites theme folder (wp-content/themes) either via the Admin dashboard or FTP.
2. Go to "Appearance > Themes" and click "Activate" under WP-Forge.
3. This is more of a reminder, if you have a favicon, make sure you upload it to your site root folder.
4. Go to "Appearance > Menus" If you have not done so, create and assign menus. If you have already created menus, make sure you assign them to the appropriate areas.
5. Download and install the Github Updater from Andy Fragen - https://github.com/afragen/github-updater - This will allow you to update WP-Forge from within WordPress itself.

Configuration
=======================================
Once you have uploaded WP-Forge and activated it, go to Appearance > Customize

= Header Section
1. If you like to use a logo you can upload it here
2. Change the title of your site
3. Change the tagline of your site
4. You can hide the site title and tagline
5. Click "Save and Publish" once you are done

= Navigation Section
*Make sure you follow step #4 above before you continue
1. Click on the Navigation section
2. Select the menu you want to use in the Footer.
3. Select the menu you want to use in Main menu area
4. Select the menu you want to use for the Social menu area *Make sure to read the "Create Social Menu" section below.
5. Select the position of the main menu, Normal Position, Top of Browser and Contain-ToGrid Sticky.
	1. Normal Position - Navigation displays just below the header. This is default.
	2. Top of Browser - Navigation will appear outside of the theme at the top of the browser. Can set a fixed position or have navigation scroll with the theme.
	3. Contain-To-Grid Sticky - Navigation will remain in defaukt position until the user scrolls. Navigation will then take on a fixed position and move to the top of the browser.
6. You can select to display the site name for the home link in the navigation or if you prefer you can change the text to whatever you wish.
7. Click "Save and Publish" once you are done.

= Off-Canvas
1. Display Off-Canvas for Mobile - Choose Yes to use Off-Canvas when your site is viewd on mobile devices. The regular menu will not display. The default is set to NO. This means the regular navigation will display according to the options you have configured in the Navigation section.
2. Display Off-Canvas Left or Right - Default is Left. This will display the Off-Canvas menu to the left. If set to Right, Off-Canvas will display to the right.
3. Click "Save and Publish" once you are done

= Posts Section
1. Select to display the full version of posts or an excerpt of posts
2. Select whether or not to display post thumbnails on the index page. Default is set to NO. Change to Yes to display post thumbnails.
3. Select whether or not to display post thumbnails when viewing a single post. Default is set to NO. Change to YES to display post thumbnails in single view.
4. Click "Save and Publish" once you are done

= Footer Section
1. Allows you to change the Copyright text in the footer.
2. Click "Save and Publish" once you are done

= Background Section
1. Change the background color of your site. The defaults have been removed, so you may want to set a background color.
2. Use a background image for your site
3. Background-Size: If you want to use a large image as the background of your site, set this to cover.
3. Set how the background image repeats
4. Ste the position of the background image (if you use a background image and choose cover, set this to center)
5. Choose a fixed or scrolling background 
6. Click "Save and Publish" once you are done

= Colors
1. Change the color of page titles
2. Change the color of site text
3. Change the color of site links
4. Change the color of links on hover.
5. Click "Save and Publish" once you are done

= Static Front Page
1. Show your latest posts on the front of your site
2. Use a page on the front of your site.
3. Click "Save and Publish" once you are done

Create your Social Menu
=======================================
1. Go to "Appearance>Menus" and click "create new menu"
2. Give your menu a name and click "Create Menu"
3. On the left hand side, click on the "Links" tab and add links to your social profiles. Currently the following sites are supported: Facebook, Twitter, LinkedIn, Google+, Flickr, YouTube,
GitHub, FourSquare, Instagram, Pinterest, Tumblr, Vimeo and Dribbble
4. Once you have added links to your social profiles, scroll down and check the box next to "Social" in the Theme Locations section.
5. Click "Save Menu".

Change the location of the Social Menu
=======================================
You can change the location of the Social Menu to anywhere you want. Open up footer.php and copy and paste line 43, 44 and 45 anywhere in the theme you want.

You do not have to use line 43 or line 45. You can always just copy line 44 and paste it anywhere you want as well.

Github
=======================================
https://github.com/tsquez/WP-Forge

Author
=======================================
Thomas E. Vasquez (@tsquez)
http://themeawesome.com

Contributors
=======================================
The following individuals have contributed to WP-Forge
Felipe Trombini - http://www.felipetrombini.com.br/ - for Portuguese localization
Christopher Anderton - https://github.com/Deluxive - for Swedish localization
Andriy - https://github.com/helirexi - for Russian localization
Alfonso Correas - http://www.cor-ser.com/ - for Spanish localization

If you would like to contribute a language translation for WP-Forge, please feel free to email me @ tsquez[at]gmail.com

Additional Credits - I used various functions from different themes built with WordPress and Foundation
=======================================
Anthony Wilhelm - Reactor Theme (https://github.com/awtheme/reactor)
Zhen Huang - Reverie Theme (http://themefortress.com/reverie/)
320Press - WordPress Foundation (https://github.com/320press/wordpress-foundation)
required+ - Required-Foundation (https://github.com/wearerequired/required-foundation)

License
=======================================
GPLv2 - http://www.gnu.org/licenses/gpl-2.0.html
Foundation by ZURB is MIT - http://opensource.org/licenses/MIT

I hope you utilize WP-Forge to learn something new, create something awesome, have fun and, more importantly, I hope you share what you have learned with others.
