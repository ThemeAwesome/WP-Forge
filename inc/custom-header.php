<?php
/**
 * Implements an optional custom header for WP-Forge.
 * See http://codex.wordpress.org/Custom_Headers
 *
 * @package WordPress
 * @subpackage Twenty_Twelve
 * @since WP-Forge 1.0
 */

/**
 * Sets up the WordPress core custom header arguments and settings.
 *
 * @uses add_theme_support() to register support for 3.4 and up.
 * @uses wpforge_header_style() to style front-end.
 * @uses wpforge_admin_header_style() to style wp-admin form.
 * @uses wpforge_admin_header_image() to add custom markup to wp-admin form.
 *
 * @since WP-Forge 1.0
 */
function wpforge_custom_header_setup() {
	$args = array(
		// Text color and image (empty to use none).
		'default-text-color'     => '444444',
		'default-image'          => '',

		// Set height and width, with a maximum value for the width.
		'height'                 => 125,
		'width'                  => 300,
		'max-width'              => 300,

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
 * Loads our special font CSS file.
 *
 * @since WP-Forge 1.0
 *
 * @return void
 */
function wpforge_font() {
	$fonts_url = wpforge_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'wpforge-fonts', esc_url_raw( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'wpforge_font' );

/**
 * Styles the header text displayed on the blog.
 *
 * get_header_textcolor() options: 515151 is default, hide text (returns 'blank'), or any hex value.
 *
 * @since WP-Forge 1.0
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
		.site-title,
		.site-description {
			position: absolute;
			clip: rect(1px 1px 1px 1px); /* IE7 */
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text, use that.
		else :
	?>
		.site-header h1 a,
		.site-header h2 {
			color: #<?php echo $text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @since WP-Forge 1.0
 */
function wpforge_admin_header_style() {
?>
	<style type="text/css" id="wpforge-admin-header-css">
	.appearance_page_custom-header #headimg {
		border: none;
		font-family: "Open Sans", Helvetica, Arial, sans-serif;
	}
	#headimg h1,
	#headimg h2 {
		line-height: 1.285714286;
		margin: 0;
		padding: 0;
	}
	#headimg h1 a {
		color: #515151;
		text-decoration: none;
		font-size: 38px;
		font-weight:normal!important;		
	}
	#headimg h1 a:hover {
		color: #21759b !important; /* Has to override custom inline style. */
	}
	#headimg h2 {
		color: #757575;
		font-size: 13px;
	}
	#headimg img {
		max-width: <?php echo get_theme_support( 'custom-header', 'max-width' ); ?>px;
	}
	.header-logo, .header-info {
		position:relative;
		float:left;
		display:block;
	}	
	.header-info {
		margin-top:30px;
	}		
	</style>
<?php
}

/**
 * Outputs markup to be displayed on the Appearance > Header admin panel.
 * This callback overrides the default markup displayed there.
 *
 * @since WP-Forge 1.0
 */
function wpforge_admin_header_image() {
	?>
	<div id="headimg">
    <div class="header-logo">
		<?php $header_image = get_header_image();
		if ( ! empty( $header_image ) ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
		<?php endif; ?>  
    </div>
    <div class="header-info">  
		<?php
		if ( ! display_header_text() )
			$style = ' style="display:none;"';
		else
			$style = ' style="color:#' . get_header_textcolor() . ';"';
		?>
		<h1 class="displaying-header-text"><a id="name"<?php echo $style; ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
		<h2 id="desc" class="displaying-header-text"<?php echo $style; ?>><?php bloginfo( 'description' ); ?></h2>
        </div>
	</div>
<?php }