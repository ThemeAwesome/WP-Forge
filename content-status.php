<?php
/**
 * The template for displaying posts in the Status post format on index and archive pages.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<div class="entry-meta-header">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'status' ) ); ?>" title="View all Status Posts"><span class="genericon genericon-status"></span> <?php echo get_post_format_string( 'status' ); ?></a>			
			<?php wpforge_entry_meta_header(); ?>
			<?php if ( comments_open() ) : ?>
				<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wp-forge' ) . '</span>', __( '1 Comment', 'wp-forge' ), __( '% Comments', 'wp-forge' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span> ', '</span>' ); ?>
		</div><!-- end .entry-meta-header -->		
		<div class="entry-header">
			<header>
				<h1><?php the_author(); ?></h1>
			</header>
			<?php echo get_avatar( get_the_author_meta( 'ID' ), apply_filters( 'wpforge_status_avatar', '68' ) ); ?>
		</div><!-- .entry-header -->
		<div class="entry-content">
			<?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'wp-forge' ) ); ?>
		</div><!-- .entry-content -->

		<footer class="entry-meta">
			<?php wpforge_entry_meta_footer(); ?>
			<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
