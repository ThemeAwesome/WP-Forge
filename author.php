<?php
/**
 * The template for displaying Author Archive pages.
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */
get_header(); ?>
	<div id="content" class="medium-8 large-8 columns" role="main">
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">','</ul></nav>'); } ?>
		<?php if ( have_posts() ) : ?>
			<?php the_post(); ?>
			<header class="archive-header">
				<h3 class="archive-title"><?php printf( __( 'Author: %s', 'wp-forge' ), '<span class="vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( "ID" ) ) ) . '" title="' . esc_attr( get_the_author() ) . '" rel="me">' . get_the_author() . '</a></span>' ); ?></h3>
			</header><!-- .archive-header -->
			<?php rewind_posts(); ?>
			<?php
			// If a user has filled out their description, show a bio on their entries.
			if ( get_the_author_meta( 'description' ) ) : ?>
				<div class="author-info small-12 medium-12 large-12 columns">
					<div class="author-avatar small-12 medium-12 large-12 columns">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpforge_author_bio_avatar_size', 200 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description small-12 medium-12 large-12 columns">
						<h3><?php printf( __( 'About %s', 'wp-forge' ), get_the_author() ); ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', get_post_format() ); ?>
			<?php endwhile; ?>
			<?php wpforge_content_nav( 'nav-below' ); ?>
		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>
	</div><!-- #content -->
<?php get_sidebar(); ?>
<?php get_footer(); ?>