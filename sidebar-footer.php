<?php
/**
 * The sidebar containing the footer widget areas.
 *
 * If no active widgets are in either sidebar, they will be hidden completely.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */

/*
 * The footer widget area is triggered if any of the areas
 * have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, we wont see anything.
 */
if ( ! is_active_sidebar( 'sidebar-4' )
	&& ! is_active_sidebar( 'sidebar-5' )
	&& ! is_active_sidebar( 'sidebar-6' )
	
	)
	return;

// If we get this far, we have widgets. Let do this.
?>
<div id="secondary-sidebar" class="row widget-area" role="complementary">

	<div class="large-12 columns">

		<?php if ( is_active_sidebar( 'sidebar-4' ) ) : ?>
        <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'sidebar-4' ); ?>
        </div><!-- .first -->
        <?php endif; ?>
    
        <?php if ( is_active_sidebar( 'sidebar-5' ) ) : ?>
        <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'sidebar-5' ); ?>
        </div><!-- .second -->
        <?php endif; ?>
        
        <?php if ( is_active_sidebar( 'sidebar-6' ) ) : ?>
        <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'sidebar-6' ); ?>
        </div><!-- .third -->
        <?php endif; ?>
    
	</div><!-- /columns -->    
            
</div><!-- #secondary -->