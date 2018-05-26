<?php
if ( ! is_active_sidebar( 'footer-sidebar-1' )
	&& ! is_active_sidebar( 'footer-sidebar-2' )
	&& ! is_active_sidebar( 'footer-sidebar-3' )
    && ! is_active_sidebar( 'footer-sidebar-4' )
	)
	return;
?>
<div class="sidebar_container">
    <div id="secondary-sidebar" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" class="sidebar_wrap grid-container widget-area" role="complementary">
    <div class="grid-x grid-padding-x">
		<?php if ( is_active_sidebar( 'footer-sidebar-1' ) ) : ?>
        <div class="large-auto cell">
            <?php dynamic_sidebar( 'footer-sidebar-1' ); ?>
        </div><!-- .first -->
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'footer-sidebar-2' ) ) : ?>
        <div class="large-auto cell">
            <?php dynamic_sidebar( 'footer-sidebar-2' ); ?>
        </div><!-- .second -->
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'footer-sidebar-3' ) ) : ?>
        <div class="large-auto cell">
            <?php dynamic_sidebar( 'footer-sidebar-3' ); ?>
        </div><!-- .third -->
        <?php endif; ?>
        <?php if ( is_active_sidebar( 'footer-sidebar-4' ) ) : ?>
        <div class="large-auto cell">
            <?php dynamic_sidebar( 'footer-sidebar-4' ); ?>
        </div><!-- .fourth -->
        <?php endif; ?>
    </div><!-- #secondary -->
    </div><!-- .grid-x .grid-margin-x -->
</div><!-- end .sidebar_container -->
