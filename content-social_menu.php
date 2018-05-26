<?php if ( has_nav_menu( 'social' ) ) : ?>
	<div class="social_wrap small-12 large-12 cell text-center">
		<nav id="social-navigation" class="social-navigation" role="navigation">
			<?php wp_nav_menu( array(
					'theme_location' => 'social',
                    'container'       => 'div',
                    'container_class' => 'table mbl',
                    'menu_class' => 'menu navcntr',
					'depth'          => 1,
					'link_before'    => '<span class="screen-reader-text">',
					'link_after'     => '</span>',
				) ); ?>
		</nav><!-- .social-navigation -->
	</div><!-- .social_wrap -->
<?php endif; ?>
