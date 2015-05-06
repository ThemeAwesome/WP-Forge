<?php
/**
 * The template for displaying posts in the Video post format on index and archive pages.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
		<div class="entry-meta-header">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'video' ) ); ?>" title="View all Video Posts"><span class="genericon genericon-video"></span> <?php echo get_post_format_string( 'video' ); ?></a>			
			<?php wpforge_entry_meta_header(); ?>
			<?php if ( comments_open() ) : ?>
				<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wp-forge' ) . '</span>', __( '1 Comment', 'wp-forge' ), __( '% Comments', 'wp-forge' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span> ', '</span>' ); ?>
		</div><!-- end .entry-meta-header -->			
			<?php if ( is_single() ) : ?>
			<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
			<h1 class="entry-title">
				<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-forge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
			</h1>
			<?php endif; // is_single() ?>
		</header><!-- .entry-header -->

		<?php if ( is_search() ) : // Only display Excerpts for Search ?>
		<div class="entry-summary">
			<?php the_excerpt(); ?>
		</div><!-- .entry-summary -->
		<?php else : ?>
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'wp-forge' ) ); ?>
			<?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-forge' ), 'after' => '</div>' ) ); ?>
		</div><!-- .entry-content -->
		<?php endif; ?>

		<footer class="entry-meta">
			<?php wpforge_entry_meta_footer(); ?>
			<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
