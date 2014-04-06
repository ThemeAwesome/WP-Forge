<?php
/**
 * The template for displaying Comments
 *
 * The area of the page that contains comments and the comment form.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-FOrge 5.2.2
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
	
			<?php // You can modify the comments form to suit your needs here. Please refer to http://codex.wordpress.org/Function_Reference/comment_form as well as http://codex.wordpress.org/Function_Reference/comments_template
				$commenter = wp_get_current_commenter();
				$req = get_option( 'require_name_email' );
				$required_text = (' Required fields are marked <span class="required">*</span>');
				$required_name =('Your Name <span class="required">*</span>');
				$required_email = ('Your Email <span class="required">*</span>');
				$aria_req = ( $req ? " aria-required='true'" : '' );

		   		$comments_args = array(
			  'id_form'           => 'commentform',
			  'id_submit'         => 'submit',
			  'title_reply'       => __( 'Leave a Reply', 'wpforge' ),
			  'title_reply_to'    => __( 'Leave a Reply to %s', 'wpforge' ),
			  'cancel_reply_link' => __( 'Cancel Reply', 'wpforge' ),
			  'label_submit'      => __( 'Post Comment', 'wpforge' ),

			  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __( 'Comment', 'wpforge' ) .
			    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			    '</textarea></p>',

			  'must_log_in' => '<p class="must-log-in">' .
			    sprintf(
			      __( 'You must be <a href="%s">logged in</a> to post a comment.' ),
			      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			    ) . '</p>',

			  'logged_in_as' => '<p class="logged-in-as">' .
			    sprintf(
			    __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
			      admin_url( 'profile.php' ),
			      $user_identity,
			      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			    ) . '</p>',

			  'comment_notes_before' => '<p class="comment-notes">' .
			    __( 'Your email address will not be published.', 'wpforge' ) . ( $req ? $required_text : '' ) . '</p>',

			  'comment_notes_after' => '<p class="form-allowed-tags">' .
			    sprintf( __( 'You may use these <abbr title="HyperText Markup Language">HTML</abbr> tags and attributes: %s' ), ' <code>' . allowed_tags() . '</code>' ) . '</p>',

			  'fields' => apply_filters( 'comment_form_default_fields', array(

			    'author' =>
			      '<p class="comment-form-author medium-6 large-6 columns">' .
			      '<label for="author">' . ( $req ? $required_name : '' ) . '</label> ' .
			      '<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			      '" size="30"' . $aria_req . ' /></p>',

			    'email' =>
			      '<p class="comment-form-email medium-6 large-6 columns"><label for="email">' . ( $req ? $required_email : '' ) . '</label> ' .
			      '<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			      '" size="30"' . $aria_req . ' /></p>',

			    'url' =>
			      '<p class="comment-form-url"><label for="url">' .
			      __( 'Your Website', 'wpforge' ) . '</label>' .
			      '<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			      '" size="30" /></p>'
			    )
			  ),
			);

			comment_form($comments_args); ?>

</div>