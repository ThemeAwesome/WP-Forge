<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */
?>
	</section><!-- #main .wrapper -->
    
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>    
        
	<footer class="row" role="contentinfo">

        <div class="large-7 columns">
        
        	<?php wp_nav_menu( array(
            	'theme_location' => 'secondary',
                'container' => false,
                'menu_class' => 'inline-list left',
                'fallback_cb' => false
            ) ); ?>
                
       	</div><!-- .seven columns -->
             
		<div class="site-info large-5 columns">
        
            <a href="<?php echo esc_url(__('http://themeawesome.com/','wpforge')); ?>" title="<?php esc_attr_e('A mixin by ThemeAwesome.com', 'wpforge'); ?>">
            <?php printf('WP-Forge'); ?></a>
            <?php esc_attr_e('powered by', 'wpforge'); ?> <a href="<?php echo esc_url(__('http://wordpress.org/','wpforge')); ?>" title="<?php esc_attr_e('WordPress', 'wpforge'); ?>">
            <?php printf('WordPress'); ?></a>
            
		</div><!-- .site-info -->

	</footer><!-- .row -->
    
	</div><!-- #wrapper -->    

<?php wp_footer(); ?>
<script>
(function($) {
jQuery(document).foundation()
	.foundation('joyride', 'start');
})(jQuery);
</script>
</body>
</html>