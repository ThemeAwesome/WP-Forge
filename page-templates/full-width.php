<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 *
 * Description: WP-Forge loves the no-sidebar look as much as
 * you do. Use this page template to remove the sidebar from any page.
 *
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

get_header(); ?>

	<div id="content" class="medium-12 large-12 columns" role="main">
    
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>

	</div><!-- #content -->

<?php get_footer(); ?>