<?php
/**
 * The template for displaying Comments
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */

/* If the current post is protected by a password and the visitor has not yet entered the password we will return early
 * without loading the comments. */
if (post_password_required()) {
	return;
}
?>
<div id="comments" class="comments-area">
	<?php if (have_comments()) : ?>
	<h2 class="comments-title">
		<?php
			printf( _n('One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(),'wp-forge'),
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
	<nav id="comment-nav-below" class="large-12 medium-12 columns navigation comment-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e('Comment navigation','wp-forge'); ?></h1>
		<div class="nav-previous"><?php previous_comments_link(__('&laquo; Older Comments','wp-forge')); ?></div>
		<div class="nav-next"><?php next_comments_link(__('Newer Comments &raquo;','wp-forge')); ?></div>
	</nav>
	<?php endif; // Check for comment navigation. ?>
	<?php if (! comments_open()) : ?>
	<p class="no-comments"><?php _e('Comments are closed.','wp-forge'); ?></p>
	<?php endif; ?>
	<?php endif; // have_comments() ?>
			<?php // You can modify the comments form to suit your needs here. Please refer to http://codex.wordpress.org/Function_Reference/comment_form as well as http://codex.wordpress.org/Function_Reference/comments_template
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$required_text = __(' Required fields are marked <span class="required">*</span>', 'wp-forge');
				$required_name = __('Your Name <span class="required">*</span>', 'wp-forge');
				$required_email = __('Your Email <span class="required">*</span>', 'wp-forge');
				$aria_req = ( $req ? " aria-required='true'" : '' );
		   		$comments_args = array(
			  'id_form'           => 'commentform',
			  'id_submit'         => 'submit',
			  'title_reply'       => __( 'Leave a Reply', 'wp-forge' ),
			  'title_reply_to'    => __( 'Leave a Reply to %s', 'wp-forge' ),
			  'cancel_reply_link' => __( 'Cancel Reply', 'wp-forge' ),
			  'label_submit'      => __( 'Post Comment', 'wp-forge' ),
			  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'wp-forge' ) .
			    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			    '</textarea></p>',
			  'must_log_in' => '<p class="must-log-in">' .
			    sprintf(
			      __( 'You must be <a href="%s">logged in</a> to post a comment.', 'wp-forge' ),
			      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			    ) . '</p>',
			  'logged_in_as' => '<p class="logged-in-as">' .
			    sprintf(
			    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>', 'wp-forge' ),
			      admin_url( 'profile.php' ),
			      $user_identity,
			      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			    ) . '</p>',
			  'comment_notes_before' => '<p class="comment-notes">' .
			    __( 'Your email address will not be published.', 'wp-forge' ) . ( $req ? $required_text : '' ) . '</p>',
			  'comment_notes_after' => '<p class="form-allowed-tags">' .
			    sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s', 'wp-forge' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',
			  'fields' => apply_filters( 'comment_form_default_fields', array(
			    'author' =>
			      '<p class="comment-form-author medium-6 large-6 columns">' .
			      '<label for="author">' . ( $req ? $required_name : 'Your Name' ) . '</label> ' .
			      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			      '" size="30"' . $aria_req . ' /></p>',
			    'email' =>
			      '<p class="comment-form-email medium-6 large-6 columns"><label for="email">' . ( $req ? $required_email : 'Your Email' ) . '</label> ' .
			      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			      '" size="30"' . $aria_req . ' /></p>',
			    'url' =>
			      '<p class="comment-form-url"><label for="url">' .
			      __( 'Your Website', 'wp-forge' ) . '</label>' .
			      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			      '" size="30" /></p>'
			    )
			  ),
			);
			comment_form($comments_args); ?>
</div>
