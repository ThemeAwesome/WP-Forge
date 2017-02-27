<?php
/**
 * The sidebar containing the main widget area.
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
	<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<div id="secondary" class="small-12 large-4 columns widget-area" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
