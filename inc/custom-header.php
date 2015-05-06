<?php
/**
 * Implement an optional custom header for WP-Forge
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses wpforge_header_style() to style front-end.
 * @uses wpforge_admin_header_style() to style wp-admin form.
 * @uses wpforge_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_custom_header_setup' ) ) {
	function wpforge_custom_header_setup() {
		$args = array(
			// Text color and image (empty to use none).
			'default-text-color'     => '444444',
			'default-image'          => '',

			// Set height and width, with a maximum value for the width.
			'height'                 => 330,
			'width'                  => 994,
			'max-width'              => 994,

			// Support flexible height and width.
			'flex-height'            => true,
			'flex-width'             => true,

			// Random image rotation off by default.
			'random-default'         => false,

			// Callbacks for styling the header and the admin preview.
			'wp-head-callback'       => 'wpforge_header_style',
			'admin-head-callback'    => 'wpforge_admin_header_style',
			'admin-preview-callback' => 'wpforge_admin_header_image',
		);

		add_theme_support( 'custom-header', $args );
	}
	add_action( 'after_setup_theme', 'wpforge_custom_header_setup' );
}

/**
 * Style the header text displayed on the blog.
 *
 * get_header_textcolor() options: 444444 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_header_style' ) ) {
	function wpforge_header_style() {
		$text_color = get_header_textcolor();

		// If no custom options for text are set, let's bail
		if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
			return;

		// If we get this far, we have custom styles.
		?>
<style type="text/css" id="wpforge-custom-header-css">
<?php
	// Has the text been hidden?
	if ( ! display_header_text() ) :
?>
.site-title,.site-title h1 a,.site-description {display:none;}
<?php endif; ?>
</style>
<?php
}
}	