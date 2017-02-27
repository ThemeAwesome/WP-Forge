<?php
/**
 * The template for displaying a "No posts found" message.
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?>
	<article id="post-0" class="post no-results not-found">
		<?php if ( current_user_can( 'edit_posts' ) ) : ?>
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'No posts to display', 'wp-forge' ); ?></h1>
			</header>
			<div class="entry-content-post">
				<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'wp-forge' ), admin_url( 'post-new.php' ) ); ?></p>
			</div><!-- .entry-content -->
		<?php else : ?>	
			<header class="entry-header">
				<h1 class="entry-title"><?php _e( 'Nothing Found', 'wp-forge' ); ?></h1>
			</header>
			<div class="entry-content-post">
				<p><?php _e( 'We know this didn&rsquo;t work before but you may want to try another search, only this time make sure the spelling, cApitALiZaTiOn, and punctuation are correct.', 'wp-forge' ); ?></p>
				<?php get_search_form(); ?>
			</div><!-- .entry-content -->
		<?php endif; ?>
	</article><!-- #post-0 -->