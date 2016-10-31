<?php
/**
 * The sidebar containing the main widget area.
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */
?>
	<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<div id="secondary" class="medium-4 large-4 columns widget-area" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
