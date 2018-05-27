<?php
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
	<nav id="comment-nav-below" class=" small-12 large-12 cell navigation comment-navigation" role="navigation">
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
				$consent  = empty( $commenter['comment_author_email'] ) ? '' : ' checked="checked"';
		   		$comments_args = array(
				  'id_form'           => 'commentform',
				  'id_submit'         => 'submit',
				  'title_reply'       => apply_filters( 'wp-forge_leave_comment',__('Leave a Comment','wp-forge')),
				  'title_reply_to'    => apply_filters( 'wp-forge_leave_reply',__('Leave a Reply to %s','wp-forge')),
				  'cancel_reply_link' => apply_filters( 'wp-forge_cancel_reply',__('Cancel Reply','wp-forge')),
				  'label_submit'      => apply_filters( 'wp-forge_post_comment',__('Post Comment','wp-forge')),
			  'comment_field' =>  '<p class="comment-form-comment"><label for="comment">' . __('Comment','wp-forge') .
			    '</label><textarea id="comment" name="comment" cols="45" rows="8" aria-required="true">' .
			    '</textarea></p>',
			  'must_log_in' => '<p class="must-log-in">' .
			    sprintf(
			      __( 'You must be <a href="%s">logged in</a> to post a comment.', 'wp-forge' ),
			      wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
			    ) . '</p>',
			  'logged_in_as' => '<p class="logged-in-as">' .
			    sprintf(
			    __('Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>','wp-forge'),
			      admin_url('profile.php'),
			      $user_identity,
			      wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
			    ) . '</p>',
			  'comment_notes_before' => '<p class="comment-notes">' .
			    __('Your email address will not be published.','wp-forge') . ( $req ? $required_text : '' ) . '</p>',
			  'fields' => apply_filters('comment_form_default_fields', array(
			    'author' =>
			      '<div class="grid container">
			       <div class="grid-x grid-padding-x">
			      	<p class="comment-form-author large-auto cell">' .
			      	'<label for="author">' . ( $req ? $required_name : 'Your Name' ) . '</label> ' .
			      	'<input id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
			      	'" size="50"' . $aria_req . ' /></p>',
			    	'email' =>
			      	'<p class="comment-form-email large-auto cell"><label for="email">' . ( $req ? $required_email : 'Your Email' ) . '</label> ' .
			      	'<input id="email" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
			      	'" size="50"' . $aria_req . ' /></p>',
			    	'url' =>
			      	'<p class="comment-form-url large-auto cell"><label for="url">' .
			      	__( 'Your Website', 'wp-forge' ) . '</label>' .
			      	'<input id="url" name="url" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) .
			      	'" size="50" /></p></div></div>',
					'cookies' => 
	                	'<p class="comment-form-cookies-consent"><input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes"' . $consent . ' />' .
	                        '<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.','wp-forge' ) . '</label></p>'
			    )
			  ),
			);
			comment_form($comments_args); ?>
</div>
