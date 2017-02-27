<?php
/**
 * The default template for displaying content in the footer.
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
<?php //Text and nav centered
 if( get_theme_mod( 'wpforge_footer_position','center' ) == 'center') { ?>
        <div class="medium-12 large-12 columns">
            <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'secondary',
                    'container'       => 'div',
                    'container_class' => 'table mbl',
                    'menu_class' => 'menu navcntr',
                    'fallback_cb' => false
                ) ); ?>
            <?php endif; ?> 
        </div><!-- .columns -->    
        <div id="ftxt" class="site-info medium-12 large-12 columns cntr">
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo wp_kses_post(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('https://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
        </div><!-- .site-info -->
<?php } // end if ?>   
<?php //Text right with nav left
 if( get_theme_mod( 'wpforge_footer_position' ) == 'right') { ?>
        <div class="medium-7 large-7 columns">
            <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'secondary',
                    'container' => false,
                    'menu_class' => 'menu left',
                    'fallback_cb' => false
                ) ); ?>
            <?php endif; ?>    
        </div><!-- .columns --> 
        <div id="ftxt" class="site-info medium-5 large-5 columns rt">
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo wp_kses_post(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('https://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
        </div><!-- .site-info -->
<?php } // end if ?>
<?php //Text left with nav right
 if( get_theme_mod( 'wpforge_footer_position' ) == 'left') { ?>
        <div id="ftxt" class="site-info medium-5 large-5 columns lft">
            <?php if( get_theme_mod( 'wpforge_footer_text' ) ) { ?>
                <p><?php echo wp_kses_post(get_theme_mod( 'wpforge_footer_text')); ?></p>
            <?php } else { ?>
                 <p><?php _e( 'Powered by', 'wp-forge' ); ?> <a href="<?php echo esc_url(__('https://themeawesome.com/responsive-wordpress-theme/','wp-forge')); ?>" rel="follow" target="_blank" title="<?php _e( 'A Responsive WordPress Theme', 'wp-forge' ); ?>"><?php _e( 'WP-Forge', 'wp-forge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wp-forge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wp-forge' ); ?>"><?php _e( 'WordPress', 'wp-forge' ); ?></a></p>
            <?php } // end if ?>
        </div><!-- .site-info -->
        <div class="medium-7 large-7 columns">
            <?php if ( has_nav_menu('secondary')  ) : // Only display menu in the footer if one is assigned ?>
                <?php wp_nav_menu( array(
                    'theme_location' => 'secondary',
                    'container' => false,
                    'menu_class' => 'menu right',
                    'fallback_cb' => false
                ) ); ?>
            <?php endif; ?>  
        </div><!-- .columns -->
<?php } // end if ?>