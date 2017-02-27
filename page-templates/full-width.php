<?php
/**
 * Template Name: Full-width Page Template, No Sidebar
 * Template Post Type: post, page, aside, audio, chat, gallery, image, link, quote, status, video
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
get_header(); ?>
	<div id="content" class="small-12 large-12 columns" role="main">
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">','</ul></nav>'); } ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', 'page' ); ?>
			<?php //comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
<?php get_footer(); ?>