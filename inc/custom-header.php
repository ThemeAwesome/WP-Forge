<?php
/**
 * Implement an optional custom header for WP-Forge
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */

if ( ! function_exists( 'wpforge_custom_header_setup' ) ) {
	function wpforge_custom_header_setup() {
		$args = array(
			// Text color and image (empty to use none).
			'default-text-color'     => '444444',
			'default-image'          => '',

			// Set height and width, with a maximum value for the width.
			'height'                 => 175,
			'width'                  => 1200,
			'max-width'              => 1200,

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

if ( ! function_exists( 'wpforge_header_style' ) ) {
	function wpforge_header_style() { ?>
<style type="text/css" id="wpforge-custom-header-css"><?php if ( ! display_header_text() ) : ?>.site-title,.site-title h1 a,.site-description{display:none;}<?php endif; ?></style>
<?php
}
}
