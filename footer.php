<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>
	</section><!-- end .content-wrap -->

    </div><!-- end .content_container -->

	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>

    <div class="footer_container">

    	<footer id="footer" class="footer_wrap row" role="contentinfo">

            <?php get_template_part( 'content', 'footer' ); ?>

        	<?php get_template_part( 'content', 'social_menu' ); ?>

    	</footer><!-- .row -->

    </div><!-- end #footer_container -->

<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>

	  <a class="exit-off-canvas"></a>

	</div><!-- .inner-wrap -->

</div><!-- #off-canvas-wrap -->

<?php } // end if ?>

    <div id="backtotop" class="hvr-fade">

        <span class="genericon genericon-collapse"></span>

    </div><!-- #backtotop -->

<?php wp_footer(); ?>
</body>
</html>