<?php
/**
 * WP-Forge functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used in the theme as custom template tags.
 * Others are attached to action and filter hooks in WordPress to change core functionality. Any new functions will
 * be added at the end of the file. This will allow everyone to keep track of what has been added.
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 800;
/**
 * Adjusts content_width value for full-width and single image attachment templates, and when there are no active
 * widgets in the sidebar.
 * @see https://developer.wordpress.com/themes/content-width/
 * @since WP-Forge 5.5.1.8
 */
if ( ! function_exists( 'wpforge_adjust_content_width' ) ) {
	function wpforge_adjust_content_width() {
	    global $content_width;
	    if ( is_page_template( 'full-width.php' ) || is_page_template( 'front-page.php' ) || is_attachment() ||
	    	! is_active_sidebar( 'sidebar-1' ))
	        $content_width = 1200;
	}
	add_action( 'template_redirect', 'wpforge_adjust_content_width' );
}
/**
 * Sets up theme defaults and registers the various WordPress features that WP-Forge supports.
 * @since WP-Forge 5.5.1.8
 */
if ( ! function_exists( 'wpforge_setup' ) ) {
	function wpforge_setup() {
		/**
		 * Add Title Tag support
		 * @see http://codex.wordpress.org/Title_Tag
		 */
		add_theme_support( 'title-tag' );
		/**
		 * Makes WP-Forge available for translation.
		 *
		 * Translations can be added to the /languages/ directory.
		 * If you're building a theme based on WP-Forge, use find and replace
		 * to change 'wp-forge' to the name of your theme in all the template files.
		 *
		 * @see http://codex.wordpress.org/Translating_WordPress#Translation_Tools
		 */
		load_theme_textdomain( 'wp-forge', get_template_directory() . '/language' );
		/**
		 * Adds RSS feed links to <head> for posts and comments.
		 * @see http://codex.wordpress.org/Automatic_Feed_Links
		 */
		add_theme_support( 'automatic-feed-links' );
		// Adds support for WooCommerce
		add_theme_support( 'woocommerce' );
		// Adds support for Jetpacks Social Menu
		add_theme_support( 'jetpack-social-menu' );
		/**
		 * Switches default core markup for search form, comment form, and comments to output valid HTML5.
		 * @see http://codex.wordpress.org/Function_Reference/add_theme_support
		 */
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ));
		/**
		 * Add support for all available post formats by default.
		 * @see http://codex.wordpress.org/Post_Formats
		 */
		add_theme_support( 'post-formats', array(
			'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ));
		/**
		 * Add Excerpt support to Pages
		 * @see http://codex.wordpress.org/Function_Reference/add_post_type_support
		 */
		add_post_type_support( 'page', 'excerpt' );
		/**
		 * Add support for Jetpack's Infinite Scroll
		 * @see http://jetpack.me/support/infinite-scroll/
		 */
		add_theme_support( 'infinite-scroll', array(
			'container' => 'content',
			'footer' => 'page',
		));
		/**
		 * This theme uses wp_nav_menu() in three locations.
		 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
		 */
		register_nav_menus(array(
			'primary' 	=> __( 'Main Menu', 'wp-forge' ),
			'secondary' => __( 'Footer Menu', 'wp-forge' ),
			'social' 	=> __( 'Social Menu', 'wp-forge' ),
		));
		/**
		 * This theme uses a custom image size for featured images, displayed on "standard" posts.
		 * @see http://codex.wordpress.org/Post_Thumbnails
		 */
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 800, 9999 ); // Unlimited height, soft crop
		/**
		* Full width image size added for featured image support in pages
		* @since WP-Forge 5.5.2.2
		*/
		add_image_size( 'full-width-thumb', 1200, 9999 ); // Fixed width, Unlimited height, soft crop
		/**
		 * This theme supports custom background color and image, and here we also set up the default background color.
		 * @see http://codex.wordpress.org/Custom_Backgrounds
		 */
		add_theme_support( 'custom-background', array(
			'default-color' => 'e6e6e6',
		));
		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
	add_action( 'after_setup_theme', 'wpforge_setup' );
}
/**
 * This theme styles the visual editor to resemble the theme front end.
 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
 */
if ( ! function_exists( 'wpforge_add_editor_styles' ) ) {
	function wpforge_add_editor_styles() {
	    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:300,700' );
	    add_editor_style( array(
	    	'css/editor-style.css','style.css','css/foundation.css','fonts/fonts.css',$font_url,
	 	));
	}
	add_action( 'after_setup_theme', 'wpforge_add_editor_styles' );
}
/**
 * Adds custom header support
 * @see http://codex.wordpress.org/Custom_Headers
 */
require( get_template_directory() . '/inc/custom-header.php' );
/**
 * Loads the Customizer
 * @see http://codex.wordpress.org/Theme_Customization_API
 */
require( get_template_directory() . '/inc/customizer.php' );
/**
 * A non-disruptive admin notice which informs users about additional resources
 * @since WP-Forge 5.5.2.3
 */
require( get_template_directory() . '/inc/admin-notice.php' );

/**
 * Load our Google Font
 * @see http://wptavern.com/wordpress-tip-how-to-load-google-fonts-over-ssl-and-non-ssl
 */
if ( ! function_exists( 'wpforge_google_fonts' ) ) {
	function wpforge_google_fonts() {
	    // register the font styles we want
	    wp_enqueue_style('wpforge-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300,700','', '6.2');
	}
	add_action( 'wp_enqueue_scripts', 'wpforge_google_fonts', 0);
}
/**
 * Enqueue our scripts and styles
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function wpforge_scripts() {
	global $wp_styles;
	  	wp_enqueue_style('wpforge_fonts', get_template_directory_uri() . '/fonts/fonts.css','', '6.2.4.2' );

		if( get_theme_mod( 'wpforge_select_css' ) == 'flex') {
			wp_enqueue_style('wpforge_foundation', get_template_directory_uri() . '/css/foundation-flex.css','', '6.2.4.2' );
		} else {
			wp_enqueue_style('wpforge_foundation', get_template_directory_uri() . '/css/foundation.css','', '6.2.4.2' );
		}

	  	wp_enqueue_style('wpforge_motion_ui', get_template_directory_uri() . '/css/motion-ui.css','', '1.2.2' );
	  	wp_enqueue_style('wpforge', get_stylesheet_uri(),'','6.2.1.2' );
		wp_enqueue_script('wpforge_what_input', get_template_directory_uri() . '/js/what-input.js', array('jquery'),'6.2.3', true);
		wp_enqueue_script('wpforge_foundation', get_template_directory_uri() . '/js/foundation.js', array('jquery'),'6.2.3', true);
		wp_enqueue_script('wpforge_functions', get_template_directory_uri() . '/js/theme-functions.js', array('jquery'),'6.2.4.2', true);
}
add_action( 'wp_enqueue_scripts', 'wpforge_scripts', 0);
/**
 * Enqueue our Foundation script with a very low priority so it loads as close to the closing body tag as possible
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_prepare_foundation' ) ) {
	function wpforge_prepare_foundation() {
		wp_enqueue_script ('wpforge_load_foundation', get_template_directory_uri() . '/js/app.js', array('wpforge_foundation'), '6.2.4.2', true);
	}
	add_action( 'wp_enqueue_scripts', 'wpforge_prepare_foundation', 999);
}
/**
 * Enque threaded comments script in footer
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_enqueue_comments_reply' ) ) {
	function wpforge_enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'comment_form_before', 'wpforge_enqueue_comments_reply' );
}
/**
 * Add Foundation 'active' class for the current menu item
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_active_nav_class' ) ) {
	function wpforge_active_nav_class( $classes, $item ) {
	    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
	        $classes[] = 'active';
	    }
	    return $classes;
	}
	add_filter( 'nav_menu_css_class', 'wpforge_active_nav_class', 10, 2 );
}
/**
 * Register our main and footer widget areas.
 * @see http://codex.wordpress.org/Widgetizing_Themes
 */
if ( ! function_exists( 'wpforge_widgets_init' ) ) {
	function wpforge_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Main Sidebar', 'wp-forge' ),
			'id' => 'main-sidebar',
			'description' => __( 'Displays widgets in the blog area as well as pages.', 'wp-forge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
		register_sidebar( array(
			'name' => __( 'First Footer Widget Area', 'wp-forge' ),
			'id' => 'footer-sidebar-1',
			'description' => __( 'An optional widget area for your site footer', 'wp-forge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
		register_sidebar( array(
			'name' => __( 'Second Footer Widget Area', 'wp-forge' ),
			'id' => 'footer-sidebar-2',
			'description' => __( 'An second optional widget area for your site footer', 'wp-forge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
		register_sidebar( array(
			'name' => __( 'Third Footer Widget Area', 'wp-forge' ),
			'id' => 'footer-sidebar-3',
			'description' => __( 'An third optional widget area for your site footer', 'wp-forge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
		register_sidebar( array(
			'name' => __( 'Fourth Footer Widget Area', 'wp-forge' ),
			'id' => 'footer-sidebar-4',
			'description' => __( 'An fourth optional widget area for your site footer', 'wp-forge' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h6 class="widget-title">',
			'after_title' => '</h6>',
		) );
	}
	add_action( 'widgets_init', 'wpforge_widgets_init' );
}
/**
 * Footer Sidebars. This will count the number of footer sidebars to enable dynamic classes in the footer area.
 * Modified version of twentyeleven_footer_sidebar_class().
 * @see Twenty Eleven Theme Functions.php line 557
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_footer_sidebar_class' ) ) {
	function wpforge_footer_sidebar_class() {
		$count = 0;

		if ( is_active_sidebar( 'footer-sidebar-1' ) )
			$count++;

		if ( is_active_sidebar( 'footer-sidebar-2' ) )
			$count++;

		if ( is_active_sidebar( 'footer-sidebar-3' ) )
			$count++;

		if ( is_active_sidebar( 'footer-sidebar-4' ) )
			$count++;

		$class = '';

		switch ( $count ) {
			case '1':
				$class = 'medium-12 large-12';
				break;
			case '2':
				$class = 'medium-12 large-6';
				break;
			case '3':
				$class = 'medium-12 large-4';
				break;
			case '4':
				$class = 'medium-12 large-3';
				break;
		}

		if ( $class )
			echo '' . $class . '';
	}
}
/**
 * Displays navigation to next/previous pages when applicable.
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_content_nav' ) ) :

	function wpforge_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 && get_theme_mod( 'wpforge_post_nav_display' ) == 'pagenavi') : ?>

		<?php wpforge_page_navi(); ?>

		<?php else: ?>

		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post Navigation', 'wp-forge' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&laquo;</span> Older posts', 'wp-forge' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&raquo;</span>', 'wp-forge' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->

	<?php endif;
}
endif;
/**
 * Template for comments and pingbacks.
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_comment' ) ) :

	function wpforge_comment( $comment, $args, $depth ) {
		$GLOBALS['comment'] = $comment;
		switch ( $comment->comment_type ) :
			case 'pingback' :
			case 'trackback' :
			// Display trackbacks differently than normal comments.
		?>
		<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
			<p><?php _e( 'Pingback:', 'wp-forge' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span>', '</span>' ); ?></p>
		<?php
				break;
			default :
			// Proceed with normal comments.
			global $post;
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<header class="comment-meta comment-author vcard">
					<?php
						echo get_avatar( $comment, 72 );
						printf( '<cite class="fn">%1$s %2$s</cite>',
							get_comment_author_link(),
							// If current post author is also comment author, make it known visually.
							( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post Author', 'wp-forge' ) . '</span>' : ''
						);
						printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
							esc_url( get_comment_link( $comment->comment_ID ) ),
							get_comment_time( 'c' ),
							/* translators: 1: date, 2: time */
							sprintf( __( '%1$s at %2$s', 'wp-forge' ), get_comment_date(), get_comment_time() )
						);
					?>
				</header><!-- .comment-meta -->

				<?php if ( '0' == $comment->comment_approved ) : ?>
					<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wp-forge' ); ?></p>
				<?php endif; ?>

				<section class="comment-content comment">
					<?php comment_text(); ?>
				</section><!-- .comment-content -->

				<div class="reply">
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &raquo;', 'wp-forge' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				</div><!-- .reply -->
				<?php edit_comment_link( __( 'Edit', 'wp-forge' ), '<p class="edit-link"><span class="genericon genericon-edit"></span>', '</p>' ); ?>
			</article><!-- #comment-## -->
		<?php
			break;
		endswitch; // end comment_type check
}
endif;
/**
 * Prints HTML with meta information for current post in home and single post view: categories
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_entry_meta_categories' ) ) :
	function wpforge_entry_meta_categories() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
		if ( $categories_list ) {
			echo '<div class="entry-meta-categories"><span class="categories-links">'. $categories_list .'</span></div>';
		}
	}
endif;
/**
 * Print HTML with meta information for the current post-date/time and author.
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_entry_meta_header' ) ) :
	function wpforge_entry_meta_header() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="genericon genericon-pinned genericon-flip-horizontal"></span> <span class="sticky-post">' . __( 'Sticky', 'wp-forge' ) . '</span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date updated"><span class="genericon genericon-month"></span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="genericon genericon-user"></span><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
			esc_url( get_permalink() ),
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			get_the_author()
		);
	}
endif;
/**
 * Prints HTML with meta information in the footer for current post in home and single post view: tags.
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_entry_meta_footer' ) ) :

	function wpforge_entry_meta_footer() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'wp-forge' ) );
		if ( $tag_list ) {
			echo '<div class="entry-meta-tags"><span class="genericon genericon-tag"></span> <span class="tags-links">' . $tag_list . '</span></div>';
		}
}
endif;
/**
 * Extends the default WordPress body class
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_body_class' ) ) {
	function wpforge_body_class( $classes ) {
		$background_color = get_background_color();

		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
			$classes[] = 'full-width';

		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/front-page.php' ) )
			$classes[] = 'front-page';

		if ( ! is_multi_author() )
			$classes[] = 'single-author';

		if ( get_theme_mod( 'wpforge_nav_position' ) == 'fixed' )
			$classes[] = 'f-topbar-fixed';

		if ( get_theme_mod( 'wpforge_mobile_position' ) == 'right' )
			$classes[] = 'off-canvas-right';

		return $classes;
	}
	add_filter( 'body_class', 'wpforge_body_class' );
}

/**
 * Custom Excerpt Length
 * @see http://codex.wordpress.org/Function_Reference/the_excerpt
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_custom_excerpt' ) ) {
	function wpforge_custom_excerpt( $number ) {
		return 65;
	}
	add_filter( 'excerpt_length', 'wpforge_custom_excerpt' );
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with "..." and a Continue reading link.
 * @see Twenty Thirteen Theme Functions.php line 464
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_excerpt_more' ) && ! is_admin() ) :
	function wpforge_excerpt_more( $more ) {
		$link = sprintf( '<a href="%1$s" class="more-link">%2$s</a>',
			esc_url( get_permalink( get_the_ID() ) ),
				/* translators: %s: Name of current post */
				sprintf( __( 'Continue reading %s <span class="meta-nav">&raquo;</span>', 'wp-forge' ), '<span class="screen-reader-text">' . get_the_title( get_the_ID() ) . '</span>' )
			);
		return ' &hellip; ' . $link;
	}
	add_filter( 'excerpt_more', 'wpforge_excerpt_more' );
endif;
/**
 * Remove .sticky from the post_class array
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_filter_post_class' ) ) {
	function wpforge_filter_post_class( $classes ) {
	    if ( ( $key = array_search( 'sticky', $classes ) ) !== false ) {
	        unset( $classes[$key] );
	        $classes[] = 'sticky-post';
	    }
	    return $classes;
	}
	add_filter( 'post_class', 'wpforge_filter_post_class', 20 );
}
/**
 * Removes recent comments styling injected into header by WordPress - Styles moved to style sheet
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_remove_recent_comments_style' ) ) {
	function wpforge_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'wpforge_remove_recent_comments_style' );
}
/**
 * Link all post thumbnials to the post permalink
 * @see http://codex.wordpress.org/Function_Reference/the_post_thumbnail
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_link_postthumb' ) ) {
	function wpforge_link_postthumb( $html, $post_id, $post_image_id ) {
	  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
	  return $html;
	}
	add_filter( 'post_thumbnail_html', 'wpforge_link_postthumb', 10, 3 );
}
/**
 * Prints HTML with meta information for current post in home and single post view: categories
 * This displays at the bottom of the post if the option in the customizer is set to display categories
 * at the bottom of posts.
 * @since WP-Forge 5.5.2.2
 */
if ( ! function_exists( 'wpforge_bottom_meta_categories' ) ) :
	function wpforge_bottom_meta_categories() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
		if ( $categories_list ) {
			echo '<div class="entry-meta-categories_bottom"><span class="categories-links"><span class="genericon genericon-category"></span> ' . $categories_list . '</span></div>';
		}
	}
endif;
/**
 * Loads the necessary script which allows the Contain to Grid menu position to work properly (taken from Foundation 5).
 * @since WP-Forge 6.2
 */
if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') {

	if ( ! function_exists( 'wpforge_contain_to_grid' ) ) {
		function wpforge_contain_to_grid() {
			wp_enqueue_script('wpforge_sticky_menu', get_template_directory_uri() . '/js/contain-to-grid.js', array('jquery'),'6.2', true);
		}
		add_action( 'wp_enqueue_scripts', 'wpforge_contain_to_grid', 0);
 	} // end if
}
/**
 * Numeric Page Navi (built into the theme by default)
 * @see http://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 * @since WP-Forge 6.2
 */
if ( ! function_exists( 'wpforge_page_navi' ) ) {
	function wpforge_page_navi() {
		if( is_singular() )
			return;
		global $wp_query;
		/** Stop execution if there's only 1 page */
		if( $wp_query->max_num_pages <= 1 )
			return;
		$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
		$max   = intval( $wp_query->max_num_pages );
		/**	Add current page to the array */
		if ( $paged >= 1 )
			$links[] = $paged;
		/**	Add the pages around the current page to the array */
		if ( $paged >= 3 ) {
			$links[] = $paged - 1;
			$links[] = $paged - 2;
		}
		if ( ( $paged + 2 ) <= $max ) {
			$links[] = $paged + 2;
			$links[] = $paged + 1;
		}
		echo '<ul class="pagination" role="navigation" aria-label="Pagination">' . "\n";
		/**	Previous Post Link */
		if ( get_previous_posts_link() )
			printf( '<li class="pagination-previous">%s</li>' . "\n", get_previous_posts_link() );
		/**	Link to first page, plus ellipses if necessary */
		if ( ! in_array( 1, $links ) ) {
			$class = 1 == $paged ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
			if ( ! in_array( 2, $links ) )
				echo '<li>...</li>';
		}
		/**	Link to current page, plus 2 pages in either direction if necessary */
		sort( $links );
		foreach ( (array) $links as $link ) {
			$class = $paged == $link ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
		}
		/**	Link to last page, plus ellipses if necessary */
		if ( ! in_array( $max, $links ) ) {
			if ( ! in_array( $max - 1, $links ) )
				echo '<li>...</li>' . "\n";
			$class = $paged == $max ? ' class="current"' : '';
			printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
		}
		/**	Next Post Link */
		if ( get_next_posts_link() )
			printf( '<li class="pagination-next">%s</li>' . "\n", get_next_posts_link() );
		echo '</ul>' . "\n";
	}
}
/**
 * Walkers and menu functions for menus. Big thanks to Jeremy Englert of JointsWP for allowing usage.
 * @see http://jointswp.com/
 * @since WP-Forge 6.2
 */
// Top-Bar Menu Walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}
// Off-Canvas Menu Walker
class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu vertical nested\">\n";
    }
}
// Top-Bar Menu function
if ( ! function_exists( 'wpforge_top_nav' ) ) {
	function wpforge_top_nav() {
		 wp_nav_menu(array(
		 	'theme_location' => 'primary',
	        'container' => false,
	        'depth' => 0,
	        'items_wrap' => '<ul class="menu vertical medium-horizontal" data-responsive-menu="drilldown medium-dropdown" data-parent-link="true" data-close-on-click-inside="false">%3$s</ul>',
	        'fallback_cb' => '',
	        'walker' => new Topbar_Menu_Walker()
	    ));
	}
}
// Off-Canvas Menu function
if ( ! function_exists( 'wpforge_off_canvas_nav' ) ) {
	function wpforge_off_canvas_nav() {
		 wp_nav_menu(array(
	        'container' => false,                           // Remove nav container
	        'menu_class' => 'vertical menu',       			// Adding custom nav class
	        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu data-parent-link="true">%3$s</ul>',
	        'theme_location' => 'primary',        			// Where it's located in the theme
	        'depth' => 0,                                   // Limit the depth of the nav
	        'fallback_cb' => '',                         	// Fallback function (see below)
	        'walker' => new Off_Canvas_Menu_Walker()
	    ));
	}
}
/**
 * Allows you to switch the comment form fields back to their original positions.
 * @see http://www.wpbeginner.com/wp-tutorials/how-to-move-comment-text-field-to-bottom-in-wordpress-4-4/
 * @since WP-Forge 6.2
 */
if( get_theme_mod( 'wpforge_comment_layout' ) == 'old') {
	if ( ! function_exists( 'wpforge_move_comment_fields' ) ) {
		function wpforge_move_comment_fields( $fields ) {
			$comment_field = $fields['comment'];
			unset( $fields['comment'] );
			$fields['comment'] = $comment_field;
			return $fields;
		}
		add_filter( 'comment_form_fields', 'wpforge_move_comment_fields' );
	}
}
?>
