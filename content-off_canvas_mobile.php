<?php
/**
 * The template that supplies Off-Canvas mobile support to WP-Forge
 * @since WP-Forge 5.5.2.2
 * @version 6.2.4.2
 */
?>
<div class="off-canvas-wrapper">
  <div class="off-canvas-wrapper-inner" data-off-canvas-wrapper>
    <?php if( get_theme_mod( 'wpforge_mobile_position','left' ) == 'left') { ?>
    <div class="title-bar hide-for-large">
      <div class="title-bar-left">
        <button type="button" data-open="offCanvasLeft"><span class="genericon genericon-menu"></span></button>
        <?php if( get_theme_mod( 'wpforge_off_canvas_text','Home' ) ) { ?>
        <span class="title-bar-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home" rel="home"><?php   echo get_theme_mod( 'wpforge_off_canvas_text','Home' ); ?></a></span>
        <?php } // end if ?>
      </div><!-- end title-bar-left -->
    </div><!-- end title-bar -->    
    <div class="off-canvas position-left" id="offCanvasLeft" data-off-canvas>
      <?php wpforge_off_canvas_nav(); ?>
    </div><!-- end off-canvas position -->
    <?php } // end if ?>
    <?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?>
    <div class="title-bar hide-for-large">
      <div class="title-bar-right">
        <?php if( get_theme_mod( 'wpforge_off_canvas_text','Home' ) ) { ?>
        <span class="title-bar-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="Home" rel="home"><?php   echo get_theme_mod( 'wpforge_off_canvas_text','Home' ); ?></a></span>
        <?php } // end if ?>
        <button type="button" data-open="offCanvasRight"><span class="genericon genericon-menu"></span></button>
      </div><!-- end title-bar-right -->
    </div><!-- end title-bar -->    
    <div class="off-canvas position-right" id="offCanvasRight" data-off-canvas data-position="right">
      <?php wpforge_off_canvas_nav(); ?>
    </div><!-- end off-canvas position -->
    <?php } // end if ?>  
    <div class="off-canvas-content" data-off-canvas-content>