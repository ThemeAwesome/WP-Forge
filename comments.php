<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-FOrge 5.2.1
 */

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required()) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if (have_comments()) : ?>

	<h2 class="comments-title">
		<?php
			printf( _n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(),'wpforge'),
				number_format_i18n(get_comments_number()),get_the_title());
		?>
	</h2>

	<ol class="comment-list">
		<?php
			wp_list_comments( array(
				'callback' => 'wpforge_comment',
				'style' => 'ol',
				'short_ping' => true,
			));
		?>
	</ol>

	<?php if (get_comment_pages_count() > 1 && get_option('page_comments')) : ?>
	<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e('Comment navigation','wpforge'); ?></h1>
		<div class="nav-previous"><?php previous_comments_link(__('&larr; Older Comments','wpforge')); ?></div>
		<div class="nav-next"><?php next_comments_link(__('Newer Comments &rarr;','wpforge')); ?></div>
	</nav>
	<?php endif; // Check for comment navigation. ?>

	<?php if (! comments_open()) : ?>
	<p class="no-comments"><?php _e('Comments are closed.','wpforge'); ?></p>
	<?php endif; ?>

	<?php endif; // have_comments() ?>

	<?php comment_form(); ?>

</div>