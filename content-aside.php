<?php
/**
 * The template for displaying posts in the Aside post format on index and archive pages
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.3.1a
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php wpforge_entry_meta_categories(); ?>
		<div class="entry-meta-header">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'aside' ) ); ?>" title="View all Aside Posts"><span class="genericon genericon-aside"></span> <?php echo get_post_format_string( 'aside' ); ?></a>			
			<?php wpforge_entry_meta_header(); ?>
			<?php if ( comments_open() ) : ?>
				<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wpforge' ) . '</span>', __( '1 Comment', 'wpforge' ), __( '% Comments', 'wpforge' ) ); ?>
			<?php endif; // comments_open() ?>
		</div><!-- end .entry-meta-header -->
		<div class="aside">
			<h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpforge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a></h1>
			<div class="entry-content">
				<?php the_content( __( 'Continue reading <span class="meta-nav">&rarr;</span>', 'wpforge' ) ); ?>
			</div><!-- .entry-content -->
		</div><!-- .aside -->

		<footer class="entry-meta">
			<div class="entry-meta-footer">
				<?php wpforge_entry_meta_footer(); ?><br />
				<?php edit_post_link( __( 'Edit', 'wpforge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span> ', '</span>' ); ?>
			</div><!-- end .entry-meta-footer -->
			<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->
