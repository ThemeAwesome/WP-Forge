<?php
/**
 * The template used for displaying page content in page.php
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<h1 class="entry-title-page"><?php the_title(); ?></h1>
			<?php if (! is_page_template('page-templates/front-page.php') || ! is_page_template( 'page-templates/full-width.php')) : ?>
				<?php the_post_thumbnail('full-width-thumb'); ?>
			<?php else : ?>
				<?php the_post_thumbnail(); ?>
			<?php endif; ?>			
		</header>
		<div class="entry-content-page">
			<?php the_content(); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-forge' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->	
		<footer class="entry-meta">
			<?php edit_post_link( __( 'Edit Page', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span>', '</span>' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
