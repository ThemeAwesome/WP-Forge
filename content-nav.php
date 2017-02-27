<?php
/**
 * The template for displaying the Top-Bar menu and its different positions.
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
<div class="nav_container">
  <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wp-forge' ); ?></a>

  <?php if( get_theme_mod( 'wpforge_nav_position','normal' ) == 'normal') { ?> 
      <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
      <div class="nav_wrap row show-for-large">
      <?php } else { ?>
      <div class="nav_wrap row">
      <?php } // end if ?>
        <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
          <button type="button" data-toggle><span class="genericon genericon-menu"> <span class="tbar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></span></span></button>
        </div><!-- end title-bar -->
        <div class="top-bar" id="main-menu">
          <div class="top-bar-left">
            <?php wpforge_top_nav(); ?>
          </div><!-- second end top-bar -->
        </div><!-- end top-bar -->
      </div><!-- .row -->
  <?php } // end if ?>

  <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'scroll') { ?>
    <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
    <div class="title-bar show-for-large" data-responsive-toggle="main-menu" data-hide-for="medium">
    <?php } else { ?>
    <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
    <?php } // end if ?>
      <button type="button" data-toggle><span class="genericon genericon-menu"> <span class="tbar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></span></span></button>
    </div><!-- end title-bar -->
    <div class="top-bar" id="main-menu">
      <?php if( get_theme_mod( 'wpforge_title_area','yes' ) == 'yes') { ?>
      <div class="top-bar-left">
        <ul class="dropdown menu" data-dropdown-menu>
          <li class="menu-text name">
            <?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></a>
          </li><!-- end menu-text -->
        </ul>
      </div><!-- end top-bar-left -->
      <?php } // end if ?>
        <?php if( get_theme_mod( 'wpforge_link_position','left') == 'left') { ?>
        <div class="top-bar-left">
        <?php } else { ?>
        <div class="top-bar-right">
        <?php } // end if ?>
        <?php wpforge_top_nav(); ?>
      </div><!-- second end top-bar -->
    </div><!-- end top-bar -->
  <?php } // end if ?>

  <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
    <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
    <div class="fixed show-for-large">
    <?php } else { ?>
    <div data-sticky-container>
      <div data-sticky data-options="marginTop:0;" style="width:100%" data-top-anchor="1">
    <?php } // end if ?>
        <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
          <button type="button" data-toggle><span class="genericon genericon-menu"> <span class="tbar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></span></span></button>
        </div><!-- end title-bar -->
        <div class="top-bar" id="main-menu">
          <?php if( get_theme_mod( 'wpforge_title_area','yes' ) == 'yes') { ?>
          <div class="top-bar-left">
            <ul class="dropdown menu" data-dropdown-menu>
              <li class="menu-text name">
                <?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></a>
              </li><!-- end menu-text -->
            </ul>
          </div><!-- end top-bar-left -->
          <?php } // end if ?>
            <?php if( get_theme_mod( 'wpforge_link_position','left') == 'left') { ?>
            <div class="top-bar-left">
            <?php } else { ?>
            <div class="top-bar-right">
            <?php } // end if ?>
            <?php wpforge_top_nav(); ?>
          </div><!-- second end top-bar -->
        </div><!-- end top-bar -->
      </div><!-- data-sticky -->
    </div><!-- end data-sticky-container -->
  <?php } // end if ?>

  <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>
    <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
    <div class="nav_wrap row show-for-large">
    <?php } else { ?>
    <div class="nav_wrap row">
    <?php } // end if ?>
      <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
        <button type="button" data-toggle><span class="genericon genericon-menu"> <span class="tbar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></span></span></button>
      </div><!-- end title-bar -->
      <div class="contain-to-grid">
        <div class="top-bar" id="main-menu">
          <div class="top-bar-left">
            <?php wpforge_top_nav(); ?>
          </div><!-- second end top-bar -->
        </div><!-- end top-bar -->
      </div><!-- contain-to-grid sticky -->
    </div><!-- .row -->
  <?php } // end if ?>
</div><!-- end .nav_container -->  