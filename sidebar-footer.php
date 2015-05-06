<?php
/**
 * The Footer Sidebar. This sidebar contains the three footer widget areas.
 *
 * If no active widgets are in either sidebar, they will be hidden completely.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

/*
 * The footer widget area is triggered if any of the areas have widgets. So let's check that first.
 *
 * If none of the sidebars have widgets, we wont see anything.
 */
if ( ! is_active_sidebar( 'footer-sidebar-1' )
	&& ! is_active_sidebar( 'footer-sidebar-2' )
	&& ! is_active_sidebar( 'footer-sidebar-3' )	
	
	)
	return;

// If we get this far, we have widgets. Let do this.
?>

<div class="sidebar_container">

    <div id="secondary-sidebar" class="sidebar_wrap row widget-area" role="complementary">

    	<div class="medium-12 large-12 columns">

    		<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
            <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
                <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
            </div><!-- .first -->
            <?php endif; ?>
        
            <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
            <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
                <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
            </div><!-- .second -->
            <?php endif; ?>
            
            <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
            <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
                <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
            </div><!-- .third -->
            <?php endif; ?>	
        
    	</div><!-- /columns -->    
                
    </div><!-- #secondary -->

</div><!-- end .sidebar_container -->