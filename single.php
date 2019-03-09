<?php
get_header(); ?>
	<div id="content" class="small-12 large-8 cell" role="main">
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">','</ul></nav>'); } ?>
		<?php while ( have_posts() ) : the_post(); ?>
			<?php get_template_part( 'content', get_post_format() ); ?>
			<?php if ( get_theme_mod('wpforge_prev_next_post_display','yes') == 'yes') : ?>
				<nav class="nav-single">
					<span class="nav-previous"><?php previous_post_link( '%link', '<span class="meta-nav">' . _x( '&laquo;', 'Previous post link', 'wp-forge' ) . '</span> %title' ); ?></span>
					<span class="nav-next"><?php next_post_link( '%link', '%title <span class="meta-nav">' . _x( '&raquo;', 'Next post link', 'wp-forge' ) . '</span>' ); ?></span>
				</nav><!-- .nav-single -->
			<?php endif; // end if ?>
			<?php comments_template( '', true ); ?>
		<?php endwhile; // end of the loop. ?>
	</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>
