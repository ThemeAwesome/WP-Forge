<?php
/**
 * The template for displaying posts in the Audio post format on index and archive pages
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php the_post_thumbnail(); ?>
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpforge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'wpforge' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wpforge' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
        	<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'audio' ) ); ?>" title="View all Audio Posts"><i class="fa fa-volume-up"></i> <?php echo get_post_format_string( 'audio' ); ?></a>
			<?php wpforge_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'wpforge' ), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' ); ?>
			<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
