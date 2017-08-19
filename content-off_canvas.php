<?php
/**
 * @version 6.4.3
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
				<button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
				<span class="title-bar-title"><?php echo get_theme_mod( 'wpforge_off_canvas_text','Menu' ); ?></span>
			</div><!-- end title-bar-left -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

  	<?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?>
		<div class="title-bar">
			<div class="title-bar-right">
				<span class="title-bar-title"><?php echo get_theme_mod( 'wpforge_off_canvas_text','Menu' ); ?></span>
				<button class="menu-icon" type="button" data-open="offCanvasRight"></button>
			</div><!-- end title-bar-right -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

 <?php } else { ?>

 <?php if( get_theme_mod('wpforge_mobile_display') == 'yes') { ?>

     <?php if( get_theme_mod( 'offcanvas_mobile_position','left' ) == 'left') { ?>
	    <?php if( get_theme_mod( 'offcanvas_mobile_transition','push' ) == 'push') { ?>
	    <div class="off-canvas-absolute mbl position-left" id="offCanvasLeft" data-off-canvas data-transition="push">
	    <?php } // end if ?>
	    <?php if( get_theme_mod( 'offcanvas_mobile_transition' ) == 'overlap') { ?>
	    <div class="off-canvas-absolute mbl position-left" id="offCanvasLeft" data-off-canvas data-transition="overlap">
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

	<div class="off-canvas-content mbl" data-off-canvas-content>
  	<?php if( get_theme_mod( 'offcanvas_mobile_position','left' ) == 'left') { ?>
		<div class="title-bar hide-for-large">
			<div class="title-bar-left">
				<button class="menu-icon" type="button" data-open="offCanvasLeft"></button>
				<span class="title-bar-title mbl"><?php echo get_theme_mod( 'offcanvas_mobile_text','Menu' ); ?></span>
			</div><!-- end title-bar-left -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

  	<?php if( get_theme_mod( 'offcanvas_mobile_position' ) == 'right') { ?>
		<div class="title-bar hide-for-large">
			<div class="title-bar-right">
				<span class="title-bar-title mbl"><?php echo get_theme_mod( 'offcanvas_mobile_text','Menu' ); ?></span>
				<button class="menu-icon" type="button" data-open="offCanvasRight"></button>
			</div><!-- end title-bar-right -->
		</div><!-- end title-bar -->
	<?php } // end if ?>

<?php } } // end if ?>