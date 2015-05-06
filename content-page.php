<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title"><?php the_title(); ?></h1>
		</header>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-forge' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->	
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit Page', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span>', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
