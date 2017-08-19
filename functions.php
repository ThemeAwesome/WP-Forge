<?php
/**
 * @version 6.4.3
 */
define( 'WPFORGE_VERSION', '6.4.3' );
define( 'WPFORGE_URI', get_template_directory_uri() );
define( 'WPFORGE_DIR', get_template_directory() );
// Sets up the content width value based on the theme's design and stylesheet.
if ( ! isset( $content_width ) )
	$content_width = 800;
// Adjusts content_width value for full-width and single image attachment templates, and when there are no active
if ( ! function_exists( 'wpforge_adjust_content_width' ) ) {
	function wpforge_adjust_content_width() {
	    global $content_width;
	    if ( is_page_template( 'full-width.php' ) || is_page_template( 'front-page.php' ) || is_attachment() ||
	    	! is_active_sidebar( 'sidebar-1' ))
	        $content_width = 1200;
	}
	add_action( 'template_redirect', 'wpforge_adjust_content_width' );
}
// Sets up theme defaults and registers the various WordPress features that WP-Forge supports.
if ( ! function_exists( 'wpforge_setup' ) ) {
	function wpforge_setup() {
		// Add Title Tag support
		add_theme_support( 'title-tag' );
		// Makes WP-Forge available for translation.
		load_theme_textdomain( 'wp-forge', get_template_directory() . '/language' );
		// Adds RSS feed links to <head> for posts and comments.
		add_theme_support( 'automatic-feed-links' );
		// Adds support for WooCommerce
		add_theme_support( 'woocommerce' );
		// Adds support for Jetpacks Social Menu
		add_theme_support( 'jetpack-social-menu' );
		// Switches default core markup for search form, comment form, and comments to output valid HTML5.
		add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ));
		// Add support for all available post formats by default.
		add_theme_support( 'post-formats', array(
			'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video' ));
		// Add Excerpt support to Pages
		add_post_type_support( 'page', 'excerpt' );
		// Add support for Jetpack's Infinite Scroll
		add_theme_support( 'infinite-scroll', array( 'container' => 'content', 'footer' => 'page',	));
		// This theme uses wp_nav_menu() in three locations.
		register_nav_menus(array('primary' 	=> __('Main Menu','wp-forge'),'secondary' => __('Footer Menu','wp-forge'),'social' 	=> __('Social Menu','wp-forge'), ));
		// This theme uses a custom image size for featured images, displayed on "standard" posts.
		add_theme_support( 'post-thumbnails' );
		set_post_thumbnail_size( 800, 9999 ); // Unlimited height, soft crop
		// Full width image size added for featured image support in pages
		add_image_size( 'full-width-thumb', 1200, 9999 ); // Fixed width, Unlimited height, soft crop
		add_image_size('wpforge-logo', 1200, 9999); // Custom logo fixed width and unlimited height
		// This theme supports custom background color and image, and here we also set up the default background color.
		add_theme_support( 'custom-background', array( 'default-color' => 'e6e6e6', ));
		// add support for custom logo
		add_theme_support( 'custom-logo', array('size' => 'wpforge-logo' ));
		// Indicate widget sidebars can use selective refresh in the Customizer.
		add_theme_support( 'customize-selective-refresh-widgets' );
	}
	add_action( 'after_setup_theme', 'wpforge_setup' );
}
// This theme styles the visual editor to resemble the theme front end.
if ( ! function_exists( 'wpforge_add_editor_styles' ) ) {
	function wpforge_add_editor_styles() {
	    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:300,700' );
	    add_editor_style( array(
	    	'css/editor-style.css','style.css','css/foundation.css','fonts/fonts.css',$font_url,
	 	));
	}
	add_action( 'after_setup_theme', 'wpforge_add_editor_styles' );
}
// Load some files we need
require WPFORGE_DIR . '/inc/custom-header.php';
require WPFORGE_DIR . '/inc/customizer.php';
require WPFORGE_DIR . '/inc/theme-dashboard.php';
// Load our Google Font
if ( ! function_exists( 'wpforge_google_fonts' ) ) {
	function wpforge_google_fonts() {// register the font styles we want
	    wp_enqueue_style('opensans', '//fonts.googleapis.com/css?family=Open+Sans:300,700','', '6.4');
	}
	add_action( 'wp_enqueue_scripts', 'wpforge_google_fonts', 0);
}
//Enqueue our scripts and styles
function wpforge_scripts() {
	global $wp_styles;
	  	wp_enqueue_style('fonts', WPFORGE_URI . '/fonts/fonts.css','', WPFORGE_VERSION);
			if( get_theme_mod( 'wpforge_select_css' ) == 'flex') {
				wp_enqueue_style('flex', WPFORGE_URI . '/css/foundation-flex.css','',WPFORGE_VERSION);
			} else {
				wp_enqueue_style('foundation', WPFORGE_URI . '/css/foundation.css','',WPFORGE_VERSION);
			}
	  	wp_enqueue_style('motion_ui', WPFORGE_URI . '/css/motion-ui.css','',WPFORGE_VERSION);
	  	wp_enqueue_style('wpforge', get_stylesheet_uri(),'', WPFORGE_VERSION );
	  	wp_enqueue_style('customizer', WPFORGE_URI . '/css/customizer.css','',WPFORGE_VERSION);
}
add_action( 'wp_enqueue_scripts', 'wpforge_scripts');
// Enqueue certain scripts with a very low priority so it loads as close to the closing body tag as possible
if ( ! function_exists( 'wpforge_theme_functions' ) ) {
	function wpforge_theme_functions() {
		wp_enqueue_script('what_input',WPFORGE_URI.'/js/what-input.js',array('jquery'),WPFORGE_VERSION,true);
		wp_enqueue_script('foundation',WPFORGE_URI.'/js/foundation.js',array('jquery'),WPFORGE_VERSION,true);
		wp_enqueue_script ('load_foundation', WPFORGE_URI.'/js/theme-functions.js',array('foundation'),WPFORGE_VERSION,true);
	}
	add_action('wp_enqueue_scripts','wpforge_theme_functions',999);
}
// Enque threaded comments script in footer
if ( ! function_exists( 'wpforge_enqueue_comments_reply' ) ) {
	function wpforge_enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'comment_form_before', 'wpforge_enqueue_comments_reply' );
}
// Register our main and footer widget areas.
if ( ! function_exists( 'wpforge_widgets_init' ) ) :
	function wpforge_widgets_init() {
		// Set up our array of widgets	
		$widgets = array(
			'main-sidebar' => __('Main Sidebar','wp-forge'),
			'footer-sidebar-1' => __('First Footer Widget Area','wp-forge'),
			'footer-sidebar-2' => __('Second Footer Widget Area','wp-forge'),
			'footer-sidebar-3' => __('Third Footer Widget Area','wp-forge'),
			'footer-sidebar-4' => __('Fourth Footer Widget Area','wp-forge'),
		);
		
		foreach ( $widgets as $id => $name ) {
			register_sidebar( array(
				'name'          => $name,
				'id'            => $id,
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => apply_filters('wpforge_start_widget_title','<h6 class="widget-title">'),
				'after_title'   => apply_filters('wpforge_end_widget_title','</h6>'),
			) );
		}
	}
	add_action( 'widgets_init', 'wpforge_widgets_init' );
endif;
// Displays navigation to next/previous pages when applicable.
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
// Template for comments and pingbacks.
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
// Prints HTML with meta information for current post in home and single post view: categories
if ( ! function_exists( 'wpforge_entry_meta_categories' ) ) :
	function wpforge_entry_meta_categories() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
		if ( $categories_list ) {
			echo '<div class="entry-meta-categories"><span class="categories-links">'. $categories_list .'</span></div>';
		}
	}
endif;
// Print HTML with meta information for the current post-date/time and author.
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
// Prints HTML with meta information in the footer for current post in home and single post view: tags.
if ( ! function_exists( 'wpforge_entry_meta_footer' ) ) :
	function wpforge_entry_meta_footer() {
		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'wp-forge' ) );
		if ( $tag_list ) {
			echo '<div class="entry-meta-tags"><span class="genericon genericon-tag"></span> <span class="tags-links">' . $tag_list . '</span></div>';
		}
}
endif;
// Extends the default WordPress body class
if ( ! function_exists( 'wpforge_body_class' ) ) {
	function wpforge_body_class( $classes ) {
		$background_color = get_background_color();
	    if ( get_theme_mod( 'wpforge_hide_sitetitle' ) ) {
	        $classes[] = 'no-site-title';
	    } else {
	        $classes[] = 'has-site-title';
	    }
	    if ( get_theme_mod( 'wpforge_hide_tagline' ) ) {
	        $classes[] = 'no-site-tagline';
	    } else {
	        $classes[] = 'has-site-tagline';
	    }
	    if (get_theme_mod('wpforge_hide_sitetitle') || get_theme_mod('wpforge_hide_tagline')) {
			$classes[] = 'no-header-info';
	    } else {
	        $classes[] = 'has-header-info';
	    }
		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
			$classes[] = 'full-width';
		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/front-page.php' ) )
			$classes[] = 'front-page';
		if ( ! is_multi_author() )
			$classes[] = 'single-author';
		if ( get_theme_mod( 'wpforge_mobile_position' ) == 'right' )
			$classes[] = 'off-canvas-right';
		return $classes;
	}
	add_filter( 'body_class', 'wpforge_body_class' );
}
// Custom Excerpt Length
if ( ! function_exists( 'wpforge_custom_excerpt' ) ) {
	function wpforge_custom_excerpt( $number ) {
		return 65;
	}
	add_filter( 'excerpt_length', 'wpforge_custom_excerpt' );
}
// Replaces "[...]" (appended to automatically generated excerpts) with "..." and a Continue reading link.
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
// Remove .sticky from the post_class array
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
// Removes recent comments styling injected into header by WordPress - Styles moved to style sheet
if ( ! function_exists( 'wpforge_remove_recent_comments_style' ) ) {
	function wpforge_remove_recent_comments_style() {
		global $wp_widget_factory;
		remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
	}
	add_action( 'widgets_init', 'wpforge_remove_recent_comments_style' );
}
// Link all post thumbnials to the post permalink
if ( ! function_exists( 'wpforge_link_postthumb' ) ) {
	function wpforge_link_postthumb( $html, $post_id, $post_image_id ) {
	  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
	  return $html;
	}
	add_filter( 'post_thumbnail_html', 'wpforge_link_postthumb', 10, 3 );
}
//Prints HTML with meta information at the bottom of the post 
if ( ! function_exists( 'wpforge_bottom_meta_categories' ) ) :
	function wpforge_bottom_meta_categories() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
		if ( $categories_list ) {
			echo '<div class="entry-meta-categories_bottom"><span class="categories-links"><span class="genericon genericon-category"></span> ' . $categories_list . '</span></div>';
		}
	}
endif;
// Numeric Page Navi (built into the theme by default)
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
// Walkers and menu functions for menus.
// Top-Bar Menu Walker
class Topbar_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu medium-horizontal nested\">\n";
    }
}
// Off-Canvas Menu Walker
class Off_Canvas_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu vertical nested wrap\">\n";
    }
}
// Magellan Menu Walker
class Magellan_Menu_Walker extends Walker_Nav_Menu {
    function start_lvl(&$output, $depth = 0, $args = Array() ) {
        $indent = str_repeat("\t", $depth);
        $output .= "\n$indent<ul class=\"menu\">\n";
    }
}
// Top-Bar Menu function
if ( ! function_exists( 'wpforge_top_nav' ) ) {
	function wpforge_top_nav() {
		 wp_nav_menu(array(
		 	'theme_location' => 'primary',
	        'container' => false,
	        'depth' => 0,
	        'items_wrap' => '<ul class="menu vertical medium-horizontal" data-responsive-menu="accordion medium-dropdown" data-submenu-toggle="true" data-close-on-click-inside="false">%3$s</ul>',
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
	        'items_wrap' => '<ul id="%1$s" class="%2$s" data-accordion-menu data-submenu-toggle="true">%3$s</ul>',
	        'theme_location' => 'primary',        			// Where it's located in the theme
	        'depth' => 0,                                   // Limit the depth of the nav
	        'fallback_cb' => '',                         	// Fallback function (see below)
	        'walker' => new Off_Canvas_Menu_Walker()
	    ));
	}
}
// Allows you to switch the comment form fields back to their original positions.
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
// Figure out which schema tags to apply to the <body> element
if ( ! function_exists( 'wpforge_body_schema' ) ) :
	function wpforge_body_schema() {
		// Set up blog variable
		$blog = ( is_home() || is_archive() || is_attachment() || is_tax() || is_single() ) ? true : false;
		// Set up default itemtype
		$itemtype = 'WebPage';
		// Get itemtype for the blog
		$itemtype = ( $blog ) ? 'Blog' : $itemtype;
		// Get itemtype for search results
		$itemtype = ( is_search() ) ? 'SearchResultsPage' : $itemtype;
		// Get the result
		$result = apply_filters( 'wpforge_body_itemtype', $itemtype );
		// Return our HTML
		echo "itemtype='http://schema.org/$result' itemscope='itemscope'";
	}
endif;
// Figure out which schema tags to apply to the <article> element
if ( ! function_exists( 'wpforge_article_schema' ) ) :
	function wpforge_article_schema( $type = 'CreativeWork' ) {
		// Get the itemtype
		$itemtype = apply_filters( 'wpforge_article_itemtype', $type );
		// Print the results
		echo "itemtype='http://schema.org/$itemtype' itemscope='itemscope'";
	}
endif;
// Add back to top to wp_footer
if ( ! function_exists( 'wpforge_back_to_top' ) ) :
	function wpforge_back_to_top() {
		$backtotop = sprintf( '<div id="backtotop" class="hvr-fade"><span class="genericon genericon-collapse"></span></div>' );
		echo apply_filters( 'wpforge_back_to_top', $backtotop );
	}
	add_action('wp_footer','wpforge_back_to_top');
endif;
function wpforge_setup_woocommerce() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}
	// Add support for WooCommerce features
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	//Remove default WooCommerce wrappers
	remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
	remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
	remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
}
add_action( 'after_setup_theme','wpforge_setup_woocommerce' );

// add opening containers
if ( ! function_exists( 'wpforge_woocommerce_start' ) ) :
	function wpforge_woocommerce_start() { ?>
			<div id="content" class="cell" role="main">
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php wpforge_article_schema( 'CreativeWork' ); ?>>
					<div class="entry-content" itemprop="text">
	<?php 
	}
	add_action('woocommerce_before_main_content', 'wpforge_woocommerce_start', 10);
endif;

// add closing containers
if ( ! function_exists( 'wpforge_woocommerce_end' ) ) :
	function wpforge_woocommerce_end() { ?>
					</div><!-- .entry-content -->
				</article><!-- article -->
			</div><!-- .site-main -->
	<?php
	}
	add_action('woocommerce_after_main_content', 'wpforge_woocommerce_end', 10);
endif;
