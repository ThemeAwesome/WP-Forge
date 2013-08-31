<?php
/**
 * The sidebar containing the front page widget areas.
 *
 * If no active widgets in either sidebar, they will be hidden completely.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */

/*
 * The front page widget area will display if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, nothing happens.
 */
if ( ! is_active_sidebar( 'sidebar-2' )
	&& ! is_active_sidebar( 'sidebar-3' )
	
	)
	return;

// If we get this far, we have widgets. Let do this.
?>
<div id="secondary" class="row widget-area" role="complementary">

	<div class="large-12 columns">

		<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
        <div class="<?php wpforge_front_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'sidebar-2' ); ?>
        </div><!-- .first -->
        <?php endif; ?>
    
        <?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
        <div class="<?php wpforge_front_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'sidebar-3' ); ?>
        </div><!-- .second -->
        <?php endif; ?>
    
	</div><!-- /columns -->    
            
</div><!-- #secondary -->