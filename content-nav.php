<?php
/**
 * @version 6.4.3
 */
?>
<div itemtype="http://schema.org/SiteNavigationElement" itemscope="itemscope" class="nav_container">
  <?php if( get_theme_mod( 'wpforge_nav_position','normal' ) == 'normal') { ?> 
      <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
      <div class="nav_wrap grid-container show-for-large">
      <?php } else { ?>
      <div class="nav_wrap grid-container">
      <?php } // end if ?>
        <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle="main-menu"></button>
          <div class="title-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div>
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
          <button class="menu-icon" type="button" data-toggle="main-menu"></button>
          <div class="title-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div>
    </div><!-- end title-bar -->
    <div class="top-bar" id="main-menu">
      <?php if( get_theme_mod( 'wpforge_title_area','yes' ) == 'yes') { ?>
      <div class="top-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div><!-- end top-bar-title -->
      <?php } // end if ?>
      <?php if( get_theme_mod( 'wpforge_link_position') == 'right') { ?>
      <div class="top-bar-right">
      <?php } else { ?>
      <div class="top-bar-left">
      <?php } // end if ?>
        <?php wpforge_top_nav(); ?>
      </div><!-- end top-bar-left/right -->
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
          <button class="menu-icon" type="button" data-toggle="main-menu"></button>
          <div class="title-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div>
        </div><!-- end title-bar -->
        <div class="top-bar" id="main-menu">
          <?php if( get_theme_mod( 'wpforge_title_area','yes' ) == 'yes') { ?>
          <div class="top-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div><!-- end top-bar-title -->
          <?php } // end if ?>
          <?php if( get_theme_mod( 'wpforge_link_position') == 'right') { ?>
          <div class="top-bar-right">
          <?php } else { ?>
          <div class="top-bar-left">
          <?php } // end if ?>
            <?php wpforge_top_nav(); ?>
          </div><!-- end top-bar-left/right -->
        </div><!-- end top-bar -->
      </div><!-- data-sticky -->
    </div><!-- end data-sticky-container -->
  <?php } // end if ?>

  <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>
    <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
    <div class="nav_wrap grid-container show-for-large">
    <?php } else { ?>
    <div class="nav_wrap grid-container">
    <?php } // end if ?>
      <div class="title-bar" data-responsive-toggle="main-menu" data-hide-for="medium">
          <button class="menu-icon" type="button" data-toggle="main-menu"></button>
          <div class="title-bar-title"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Menu')); ?></div>
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