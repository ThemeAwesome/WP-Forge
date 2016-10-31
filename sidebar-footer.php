<?php
/**
 * The Footer Sidebar. This sidebar contains the four footer widget areas.
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */
if ( ! is_active_sidebar( 'footer-sidebar-1' )
	&& ! is_active_sidebar( 'footer-sidebar-2' )
	&& ! is_active_sidebar( 'footer-sidebar-3' )
    && ! is_active_sidebar( 'footer-sidebar-4' )
	)
	return;
?>
<div class="sidebar_container">
    <div id="secondary-sidebar" class="sidebar_wrap row widget-area" role="complementary">
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
        <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
        <div class="<?php wpforge_footer_sidebar_class(); ?> columns">
            <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
        </div><!-- .fourth -->
        <?php endif; ?>
    </div><!-- #secondary -->
</div><!-- end .sidebar_container -->
