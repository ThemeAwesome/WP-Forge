            </div><!-- .grid-x .grid-margin-x -->
	   </section><!-- end .content-wrap -->
    </div><!-- end .content_container -->
	<?php
        if ( ! is_404() )
        get_sidebar( 'footer' );
    ?>
    <div class="footer_container">
    	<footer id="footer" itemtype="http://schema.org/WPFooter" itemscope="itemscope" class="footer_wrap grid-container" role="contentinfo">
            <div class="grid-x grid-padding-x">
                <?php get_template_part( 'content', 'footer' ); ?>
            	<?php get_template_part( 'content', 'social_menu' ); ?>
            </div><!-- grid-x grid-padding-x -->
    	</footer><!-- .row -->
    </div><!-- end #footer_container -->
<?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes' || get_theme_mod( 'wpforge_nav_select' ) == 'offcanvas') { ?>
        </div><!-- end off-canvas-content -->
</div><!-- end off-canvas-wrapper -->
<?php } // end if ?>
<?php wp_footer(); ?>
</body>
</html>