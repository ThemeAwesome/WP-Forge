<?php
/**
 * The template that supplies Off-Canvas and Off-Canvas Mobile support to WP-Forge
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
<div class="off-canvas-wrapper">

<?php if( get_theme_mod('wpforge_nav_select') == 'offcanvas') { ?>

    <?php if( get_theme_mod( 'wpforge_mobile_position','left' ) == 'left') { ?>
	    <?php if( get_theme_mod( 'wpforge_offcanvas_transition','push' ) == 'push') { ?>
	    <div class="off-canvas-absolute position-left" id="offCanvasLeft" data-off-canvas data-transition="push">
	    <?php } // end if ?>
	    <?php if( get_theme_mod( 'wpforge_offcanvas_transition' ) == 'overlap') { ?>
	    <div class="off-canvas-absolute position-left" id="offCanvasLeft" data-off-canvas data-transition="overlap">
	    <?php } // end if ?>
      <?php wpforge_off_canvas_nav(); ?>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button><!-- end close-button -->
    	</div><!-- end off-canvas position-left -->
  	<?php } // end if ?>

  	<?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?> 	
		<?php if( get_theme_mod( 'wpforge_offcanvas_transition','push' ) == 'push') { ?>
		<div class="off-canvas-absolute position-right" id="offCanvasRight" data-off-canvas data-transition="push">
		<?php } // end if ?>
		<?php if( get_theme_mod( 'wpforge_offcanvas_transition' ) == 'overlap') { ?>
		<div class="off-canvas-absolute position-right" id="offCanvasRight" data-off-canvas data-transition="overlap">
		<?php } // end if ?>
		  <?php wpforge_off_canvas_nav(); ?>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button><!-- end close-button -->
		</div><!-- end off-canvas position-right -->
	<?php } // end if ?>

	<div class="off-canvas-content" data-off-canvas-content>
  	<?php if( get_theme_mod( 'wpforge_mobile_position','left' ) == 'left') { ?>
			<div class="title-bar">
			<div class="title-bar-left">
				<button data-open="offCanvasLeft"><span class="genericon genericon-menu"> <?php if( get_theme_mod( 'wpforge_off_canvas_text','Menu' ) ) { ?><span class="canvas-title"><?php echo get_theme_mod( 'wpforge_off_canvas_text','Menu' ); ?></span><?php } // end if ?></span></button>
			</div><!-- end title-bar-left -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

  	<?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?>
			<div class="title-bar">
			<div class="title-bar-right">
				<button data-open="offCanvasRight"><?php if( get_theme_mod( 'wpforge_off_canvas_text','Menu' ) ) { ?><span class="canvas-title"><?php echo get_theme_mod( 'wpforge_off_canvas_text','Menu' ); ?></span><?php } // end if ?> <span class="genericon genericon-menu"></span></button>
			</div><!-- end title-bar-right -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

 <?php } else { ?>

 <?php if( get_theme_mod('wpforge_nav_select') == 'topbar' || get_theme_mod('wpforge_topbar_mobile_display') == 'yes') { ?>

     <?php if( get_theme_mod( 'offcanvas_mobile_position','left' ) == 'left') { ?>
	    <?php if( get_theme_mod( 'offcanvas_mobile_transition','push' ) == 'push') { ?>
	    <div class="off-canvas-absolute position-left" id="offCanvasLeft" data-off-canvas data-transition="push">
	    <?php } // end if ?>
	    <?php if( get_theme_mod( 'offcanvas_mobile_transition' ) == 'overlap') { ?>
	    <div class="off-canvas-absolute position-left" id="offCanvasLeft" data-off-canvas data-transition="overlap">
	    <?php } // end if ?>
      <?php wpforge_off_canvas_nav(); ?>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button><!-- end close-button -->
    	</div><!-- end off-canvas position-left -->
  	<?php } // end if ?>

  	<?php if( get_theme_mod( 'offcanvas_mobile_position' ) == 'right') { ?> 	
		<?php if( get_theme_mod( 'offcanvas_mobile_transition','push' ) == 'push') { ?>
		<div class="off-canvas-absolute position-right" id="offCanvasRight" data-off-canvas data-transition="push">
		<?php } // end if ?>
		<?php if( get_theme_mod( 'offcanvas_mobile_transition' ) == 'overlap') { ?>
		<div class="off-canvas-absolute position-right" id="offCanvasRight" data-off-canvas data-transition="overlap">
		<?php } // end if ?>
		  <?php wpforge_off_canvas_nav(); ?>
			<button class="close-button" aria-label="Close menu" type="button" data-close>
				<span aria-hidden="true">&times;</span>
			</button><!-- end close-button -->
		</div><!-- end off-canvas position-right -->
	<?php } // end if ?>

	<div class="off-canvas-content" data-off-canvas-content>
  	<?php if( get_theme_mod( 'offcanvas_mobile_position','left' ) == 'left') { ?>
			<div class="title-bar hide-for-large">
			<div class="title-bar-left">
				<button data-open="offCanvasLeft"><span class="genericon genericon-menu"> <?php if( get_theme_mod( 'offcanvas_mobile_text','Menu' ) ) { ?><span class="canvas-title"><?php echo get_theme_mod( 'offcanvas_mobile_text','Menu' ); ?></span><?php } // end if ?></span></button>
			</div><!-- end title-bar-left -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

  	<?php if( get_theme_mod( 'offcanvas_mobile_position' ) == 'right') { ?>
			<div class="title-bar hide-for-large">
			<div class="title-bar-right">
				<button type="button" data-open="offCanvasRight"><?php if( get_theme_mod( 'offcanvas_mobile_text','Menu' ) ) { ?><span class="canvas-title"><?php echo get_theme_mod( 'offcanvas_mobile_text','Menu' ); ?></span><?php } // end if ?> <span class="genericon genericon-menu"></span></button>
			</div><!-- end title-bar-right -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

<?php } } // end if ?>