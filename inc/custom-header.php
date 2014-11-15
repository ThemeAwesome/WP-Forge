<?php
/**
 * Implement an optional custom header for Twenty Twelve
 *
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.4.7
 */

/**
 * Set up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses wpforge_header_style() to style front-end.
 * @uses wpforge_admin_header_style() to style wp-admin form.
 * @uses wpforge_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since WP-Forge 5.4.7
 */
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

/**
 * Style the header text displayed on the blog.
 *
 * get_header_textcolor() options: 515151 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since WP-Forge 5.4.7
 */
function wpforge_header_style() {
	$text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	if ( $text_color == get_theme_support( 'custom-header', 'default-text-color' ) )
		return;

	// If we get this far, we have custom styles.
	?>
<style type="text/css" id="wpforge-header-css">
<?php
	// Has the text been hidden?
	if ( ! display_header_text() ) :
?>
.site-title, .site-description {position: absolute; clip: rect(1px 1px 1px 1px); clip: rect(1px, 1px, 1px, 1px);}
<?php else : ?>
.header-info h1 a, .header-info h2 {color: #<?php echo $text_color; ?>;}
<?php endif; ?>
</style>
<?php
}

/**
 * Style the header image displayed on the Appearance > Header admin panel.
 *
 * @since WP-Forge 5.4.7
 */
function wpforge_admin_header_style() {
?>
	<style type="text/css" id="wpforge-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		font-family: "Open Sans", Helvetica, Arial, sans-serif;
	}
	#headimg h1, #headimg h2 {
		margin: 0;
	}
	#headimg h1 {
		font-size: 2.75rem;
		font-weight: normal!important;
	}
	#headimg h1 a {
		color: #515151;
		text-decoration: none;
	}
	#headimg h1 a:hover {
		color: #21759b !important; /* Has to override custom inline style. */
	}
	#headimg h2 {
		color: #757575;
		font-size: 1.6875rem;
		font-weight: normal!important;
		line-height:1;
		margin-bottom: 24px;
	}
	#headimg img {
		margin-bottom: 1.5rem;
	}
	</style>
<?php
}

/**
 * Output markup to be displayed on the Appearance > Header admin panel.
 *
 * This callback overrides the default markup displayed there.
 *
 * @since WP-Forge 5.4.7
 */
function wpforge_admin_header_image() {
	?>
	<div id="headimg">
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>		
	</div>
<?php }