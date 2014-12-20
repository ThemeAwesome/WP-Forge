<?php
/**
 * The template that supplies our WordPress Social Menu
 *
 * @author Justin Tadlock
 * @see http://justintadlock.com/archives/2013/08/14/social-nav-menus-part-2
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.0.1
 */
?>

<div class="social_wrap medium-12 large-12 columns">
	<?php if ( has_nav_menu( 'social' ) ) : ?>
		<nav id="social-navigation" class="social-navigation" role="navigation">
			<?php
				// Social links navigation menu.
				wp_nav_menu( array(
					'theme_location' => 'social',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
		</nav><!-- .social-navigation -->
	<?php endif; ?>
</div><!-- social-menu -->