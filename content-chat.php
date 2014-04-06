<?php
/**
 * The template for displaying posts in the Chat post format on index and archive pages.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.2
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php if ( is_single() ) : ?>
		<h1 class="entry-title"><?php the_title(); ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php the_permalink(); ?>" rel="bookmark"><?php the_title(); ?></a>
		</h1>
		<?php endif; // is_single() ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wpforge' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->

		<footer class="entry-meta">
        	<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'chat' ) ); ?>" title="View all Chat Posts"><i class="fa fa-comments"></i> <?php echo get_post_format_string( 'chat' ); ?></a>
			<?php wpforge_entry_meta(); ?>
			<?php edit_post_link( __( 'Edit', 'wpforge' ), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' ); ?>
			<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
</article><!-- #post -->
