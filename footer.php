<?php
/**
 * @version 6.4.3
 */
?>
            </div><!-- .grid-x .grid-margin-x -->
	   </section><!-- end .content-wrap -->
    </div><!-- end .content_container -->
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>
    <div class="footer_container">
    	<footer id="footer" itemtype="http://schema.org/WPFooter" itemscope="itemscope" class="footer_wrap grid-container" role="contentinfo">
            <?php get_template_part( 'content', 'footer' ); ?>
        	<?php get_template_part( 'content', 'social_menu' ); ?>
    	</footer><!-- .row -->
    </div><!-- end #footer_container -->
<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes' || get_theme_mod( 'wpforge_nav_select' ) == 'offcanvas') { ?>
        </div><!-- end off-canvas-content -->
</div><!-- end off-canvas-wrapper -->
<?php } // end if ?>
<?php wp_footer(); ?>
</body>
</html>
