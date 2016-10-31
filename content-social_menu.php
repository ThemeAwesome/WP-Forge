<?php
/**
 * The template that supplies our WordPress Social Menu
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */
?>
<?php if ( has_nav_menu( 'social' ) ) : ?>
	<div class="social_wrap medium-12 large-12 columns">
		<nav id="social-navigation" class="social-navigation" role="navigation">
			<?php wp_nav_menu( array(
					'theme_location' => 'social',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) );
			?>
		</nav><!-- .social-navigation -->
	</div><!-- .social_wrap -->
<?php endif; ?>
