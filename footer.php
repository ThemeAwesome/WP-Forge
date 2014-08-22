<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.4
 */
?>
	</section><!-- #main .wrapper -->
    
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>    
        
	<footer id="footer" class="row" role="contentinfo">
        <?php get_template_part( 'content', 'footer' ); ?>
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