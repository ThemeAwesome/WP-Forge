<?php
/**
 * The default template for displaying content in the footer.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

<?php
/**
 * Text and Nav default
 *
 * @since WP-Forge 5.5.1.7
 */
 if( get_theme_mod( 'wpforge_footer_position' ) == '') { ?>

    <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>

        <div class="medium-12 large-12 columns">
            
            <?php wp_nav_menu( array(
                'theme_location' => 'secondary',
                'container'       => 'div',
                'container_class' => 'table',
                'menu_class' => 'inline-list navcntr',
                'fallback_cb' => false
            ) ); ?>
                    
        </div><!-- .seven columns -->
                     
        <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php else : ?>

        <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php endif; ?>

<?php } // end if ?> 

<?php
/**
 * Text and Nav centered
 * Menu and text positioned in the center
 *
 * @since WP-Forge 5.5.1.7
 */
 if( get_theme_mod( 'wpforge_footer_position' ) == 'center') { ?>

    <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>

        <div class="medium-12 large-12 columns">
            
            <?php wp_nav_menu( array(
                'theme_location' => 'secondary',
                'container'       => 'div',
                'container_class' => 'table',
                'menu_class' => 'inline-list navcntr',
                'fallback_cb' => false
            ) ); ?>
                    
        </div><!-- .seven columns -->
                     
        <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php else : ?>

        <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php endif; ?>

<?php } // end if ?>   

<?php
/**
 * Text Right - Nav Left
 * Menu positioned to the left and copyright text positioned to the right
 *
 * @since WP-Forge 5.5.1.7
 */
 if( get_theme_mod( 'wpforge_footer_position' ) == 'right') { ?>

    <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>

        <div class="medium-7 large-7 columns">
            
            <?php wp_nav_menu( array(
                'theme_location' => 'secondary',
                'container' => false,
                'menu_class' => 'inline-list left',
                'fallback_cb' => false
            ) ); ?>
                    
        </div><!-- .seven columns -->
                 
        <div id="ftxt" class="site-info medium-5 large-5 columns rt">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php else : ?>

        <div id="ftxt" class="site-info medium-12 large-12 columns rt">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php endif; ?>

<?php } // end if ?>

<?php
/**
 * Text Left - Nav Right
 * Menu positioned to the right and copyright text positioned to the left.
 *
 * @since WP-Forge 5.5.1.7
 */
 if( get_theme_mod( 'wpforge_footer_position' ) == 'left') { ?>

    <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>

        <div id="ftxt" class="site-info medium-5 large-5 columns lft">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

        <div class="medium-7 large-7 columns">
            
            <?php wp_nav_menu( array(
                'theme_location' => 'secondary',
                'container' => false,
                'menu_class' => 'inline-list right',
                'fallback_cb' => false
            ) ); ?>
                    
        </div><!-- .seven columns -->

    <?php else : ?>

        <div id="ftxt" class="site-info medium-12 large-12 columns lft">
            
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo esc_attr(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
                
        </div><!-- .site-info -->

    <?php endif; ?>

<?php } // end if ?>