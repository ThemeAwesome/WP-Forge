<?php if ( is_active_sidebar( 'main-sidebar' ) ) : ?>
		<div id="secondary" itemtype="http://schema.org/WPSideBar" itemscope="itemscope" class="small-12 large-4 cell widget-area" role="complementary">
			<?php dynamic_sidebar( 'main-sidebar' ); ?>
		</div><!-- #secondary -->
	<?php endif; ?>
