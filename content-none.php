<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>
	<article id="post-0" class="post no-results not-found">
		<?php if ( current_user_can( 'edit_posts' ) ) : // Show a different message to a logged-in user who can add posts. ?>
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'No posts to display', 'wp-forge' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'wp-forge' ), admin_url( 'post-new.php' ) ); ?></p>
			</div><!-- .entry-content -->
		<?php else : ?>	
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'wp-forge' ); ?></h1>
			</header>
			<div class="entry-content">
				<p><?php _e( 'Apologies, but no results were found. Perhaps another search will help you find what you&#39;re looking for.', 'wp-forge' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</article><!-- #post-0 -->