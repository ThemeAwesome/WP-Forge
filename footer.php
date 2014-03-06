<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */
?>
	</section><!-- #main .wrapper -->
    
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>    
        
	<footer id="footer" class="row" role="contentinfo">

        <div class="medium-7 large-7 columns">
        
        	<?php wp_nav_menu( array(
            	'theme_location' => 'secondary',
                'container' => false,
                'menu_class' => 'inline-list left',
                'fallback_cb' => false
            ) ); ?>
                
       	</div><!-- .seven columns -->
             
		<div id="ftxt" class="site-info medium-5 large-5 columns">
        
			<?php if ( get_theme_mod('wpforge_footer_text') ) : echo get_theme_mod( 'wpforge_footer_text'); else : ?>
            
				<p><?php _e( 'Powered by', 'wpforge' ); ?> <a href="<?php echo esc_url(__('http://themeawesome.com/responsive-wordpress-theme/','wpforge')); ?>" rel="nofollow" target="_blank" title="<?php _e( 'Responsive WordPress Theme by ThemeAwesome.com', 'wpforge' ); ?>"><?php _e( 'WP-Forge', 'wpforge' ); ?></a> &amp; <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" target="_blank" title="<?php _e( 'WordPress', 'wpforge' ); ?>"><?php _e( 'WordPress', 'wpforge' ); ?></a></p>
                
            <?php endif; ?>
            
		</div><!-- .site-info -->
        
        <div class="medium-12 large-12 columns">
        	<?php get_template_part( 'menu', 'social' ); ?>
        </div><!-- social-menu -->

	</footer><!-- .row -->
    
    </div><!-- #wrapper -->
    
<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>    
    
	  <a class="exit-off-canvas"></a>
      
	</div><!-- .inner-wrap -->
    
</div><!-- #off-canvas-wrap -->

<?php } // end if ?>
    
    <div id="backtotop">Top</div><!-- #backtotop -->

<?php wp_footer(); ?>
</body>
</html>