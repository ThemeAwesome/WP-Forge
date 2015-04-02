<?php
/**
 * The sidebar containing the main widget area.
 *
 * If no active widgets in sidebar, let's hide it completely.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

	<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<div id="secondary" class="medium-4 large-4 columns widget-area" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>