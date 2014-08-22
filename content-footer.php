<?php
/**
 * The default template for displaying content in the footer.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.4
 */
?>

<?php if( get_theme_mod( 'wpforge_footer_position' ) == 'right') { ?>

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
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                <?php } // end if ?>
                    
            </div><!-- .site-info -->

        <?php else : ?>

            <div id="ftxt" class="site-info medium-12 large-12 columns rt">
                
                <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                <?php } // end if ?>
                    
            </div><!-- .site-info -->

        <?php endif; ?>

<?php } // end if ?>

<?php if( get_theme_mod( 'wpforge_footer_position' ) == 'center') { ?>

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
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                <?php } // end if ?>
                    
            </div><!-- .site-info -->

        <?php else : ?>

            <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
                
                <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                <?php } // end if ?>
                    
            </div><!-- .site-info -->

        <?php endif; ?>

<?php } // end if ?>

<?php if( get_theme_mod( 'wpforge_footer_position' ) == 'left') { ?>

    <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>

            <div id="ftxt" class="site-info medium-5 large-5 columns lft">
                
                <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
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
                    <p><?php echo get_theme_mod( 'wpforge_footer_text'); ?></p>
                <?php } else { ?>
                    <p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                <?php } // end if ?>
                    
            </div><!-- .site-info -->

        <?php endif; ?>

<?php } // end if ?>