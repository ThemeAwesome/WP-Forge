<?php
/**
 * The sidebar containing the main widget area.
 * @version 6.3.1.2
 */
?>
	<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<div id="secondary" class="small-12 large-4 columns widget-area" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
