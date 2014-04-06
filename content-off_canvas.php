<?php
/**
 * The template that supplies Off-Canvas support to WP-Forge
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.2
 */
?>

<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>

  <div class="off-canvas-wrap">
  
  	<div class="inner-wrap">

  		<nav class="tab-bar show-for-small-only">
        
        	<?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?>  
                <section class="right-small">
                    <a class="right-off-canvas-toggle menu-icon" ><span></span></a>
                </section>
            <?php } else { ?>
                <section class="left-small">
                    <a class="left-off-canvas-toggle menu-icon" ><span></span></a>
                </section>            
			<?php } // end if ?>
            
            <?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?> 
            
            <section class="middle tab-bar-section go-right">
              
              <h5 class="title">
              
                <?php if( get_theme_mod( 'wpforge_nav_title' ) == 'yes') { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_theme_mod( 'wpforge_nav_text' ); ?>" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php } // end if ?>      
              
              </h5>
        
            </section>
            
            <?php } else { ?>
            
            <section class="middle tab-bar-section go-left">
              
              <h5 class="title">
              
                <?php if( get_theme_mod( 'wpforge_nav_title' ) == 'yes') { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_theme_mod( 'wpforge_nav_text' ); ?>" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
                <?php } else { ?>
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                <?php } // end if ?>      
              
              </h5>
        
            </section>
            
            <?php } // end if ?>            
    
          </nav>
          
          <?php if( get_theme_mod( 'wpforge_mobile_position' ) == 'right') { ?> 

          <aside class="right-off-canvas-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'depth' => 0,
                    'items_wrap' => '<ul class="off-canvas-list">%3$s</ul>',
                    'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                    'walker' => new wpforge_walker( array(
                        'in_top_bar' => true,
                        'item_type' => 'li',
                        'menu_type' => 'main-menu'
                    ) ),
                ) );
                ?>
          </aside>
          
          <?php } else { ?>
          
          <aside class="left-off-canvas-menu">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'depth' => 0,
                    'items_wrap' => '<ul class="off-canvas-list">%3$s</ul>',
                    'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                    'walker' => new wpforge_walker( array(
                        'in_top_bar' => true,
                        'item_type' => 'li',
                        'menu_type' => 'main-menu'
                    ) ),
                ) );
                ?>
          </aside>
          
          <?php } // end if ?>         
          
<?php } // end if ?>