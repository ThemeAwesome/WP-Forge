<?php
/**
 * The template used for displaying page content in front-page.php
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpforge' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit', 'wpforge' ), '<span class="edit-link"><i class="icon-pencil"></i> ', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
