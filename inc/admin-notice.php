<?php
/**
 * A non-disruptive admin notice to inform users about additional resources.
 * @since WP-Forge 5.5.2.3
 * @version 6.2.4.2
 */

// Don't nag users who can't switch themes.
if ( ! is_admin() || ! current_user_can( 'switch_themes' ) )
	return;

function wpforge_admin_notice() {
	if ( isset( $_GET['wpforge-notice-dismiss'] ) )
		set_theme_mod( 'notice-dismiss', true );

	$dismiss = get_theme_mod( 'notice-dismiss', false );
	if ( $dismiss )
		return;
	?>
	<div class="updated wpforge-notice">
		<p><?php printf( __( 'Thank you for using WP-Forge! Get your site up and running fast by viewing the <a target="_blank" href="%s">WP-Forge Quick Start Guide!</a> <a style="float:right;text-decoration:none;" href="%s" title="Close this notice">x</a>', 'wp-forge' ), 'http://themeawesome.com/docs/wp-forge', esc_url( add_query_arg( 'wpforge-notice-dismiss', 1 ) ) ); ?></p>
	</div>
	<?php
}
add_action( 'admin_notices', 'wpforge_admin_notice' );