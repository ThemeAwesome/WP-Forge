<?php
/**
 * WP-Forge functions and definitions.
 *
 * Sets up the theme and provides some helper functions, which are used
 * in the theme as custom template tags. Others are attached to action and
 * filter hooks in WordPress to change core functionality.
 *
 * When using a child theme (see http://codex.wordpress.org/Theme_Development and
 * http://codex.wordpress.org/Child_Themes), you can override certain functions
 * (those wrapped in a function_exists() call) by defining them first in your child theme's
 * functions.php file. The child theme's functions.php file is included before the parent
 * theme's file, so the child theme functions would be used.
 *
 * Functions that are not pluggable (not wrapped in function_exists()) are instead attached
 * to a filter or action hook.
 *
 * For more information on hooks, actions, and filters, see http://codex.wordpress.org/Plugin_API.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */

/**
 * Lets start off by cleaning up the output of wp_head()
 */
 // Remove the links to the extra feeds such as category feeds
remove_action( 'wp_head', 'feed_links_extra', 3 );
// Remove the links to the general feeds: Post and Comment Feed
remove_action( 'wp_head', 'feed_links', 2 );
// Remove the link to the Really Simple Discovery service endpoint, EditURI link
remove_action( 'wp_head', 'rsd_link' );
// Remove the link to the Windows Live Writer manifest file.
remove_action( 'wp_head', 'wlwmanifest_link' );
// Remove index link
remove_action( 'wp_head', 'index_rel_link' );
// Remove prev link
remove_action( 'wp_head', 'parent_post_rel_link', 10, 0 );
// Remove start link
remove_action( 'wp_head', 'start_post_rel_link', 10, 0 );
// Remove relational links for the posts adjacent to the current post.
remove_action( 'wp_head', 'adjacent_posts_rel_link', 10, 0 );
// Remove the XHTML generator that is generated on the wp_head hook, WP version
remove_action( 'wp_head', 'wp_generator' );

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 623;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * WP-Forge supports.
 *
 * @uses load_theme_textdomain() For translation/localization support.
 * @uses add_editor_style() To add a Visual Editor stylesheet.
 * @uses add_theme_support() To add support for post thumbnails, automatic feed links,
 * 	custom background, and post formats.
 * @uses register_nav_menu() To add support for navigation menus.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_setup() {
	/*
	 * Makes WP-Forge available for translation.
	 *
	 * Translations can be added to the /languages/ directory.
	 * If you're building a theme based on WP-Forge, use find and replace
	 * to change 'wpforge' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'wpforge', get_template_directory() . '/language' );
	
	// This theme styles the visual editor to resemble the theme style
	add_editor_style( array( 'css/foundation.css','style.css','fonts/font-awesome.css', wpforge_fonts_url() ) );

	// Adds RSS feed links to <head> for posts and comments.
	add_theme_support( 'automatic-feed-links' );
	
	// Makes our theme support WooCommerce
	add_theme_support( 'woocommerce' );	
	
	//Switches default core markup for search form, comment form, and comments to output valid HTML5.
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );	

	// This theme supports all available post formats by default. See http://codex.wordpress.org/Post_Formats
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	) );

	// This theme uses wp_nav_menu() in two locations.
	register_nav_menus(array(
		'primary' => __( 'Main Menu', 'wpforge' ), 
		'secondary' => __( 'Footer Menu', 'wpforge' ),
		'social' => __( 'Social Menu', 'wpforge' ),		
	));	

	// This theme uses a custom image size for featured images, displayed on "standard" posts.
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 623, 9999 ); // Unlimited height, soft crop
	
	add_theme_support('wpforge-backgrounds');
	add_theme_support('wpforge-fonts');
}
add_action( 'after_setup_theme', 'wpforge_setup' );

// Our custom Theme Optimizer.
require( get_template_directory() . '/inc/customizer/customizer.php' );

/**
 * Returns the Google font stylesheet URL, if available.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_fonts_url() {
	$fonts_url = '';

	/* Translators: If there are characters in your language that are not
	 * supported by Source Sans Pro, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	$open_sans_pro = _x( 'on', 'Open Sans font: on or off', 'wpforge' );

	if ( 'off' !== $open_sans_pro ) {
			$font_families[] = 'Open+Sans:300italic,300';

		$protocol = is_ssl() ? 'https' : 'http';
		$query_args = array(
			'family' => implode( '|', $font_families ),
			'subset' => 'latin,latin-ext',
		);
		$fonts_url = add_query_arg( $query_args, "$protocol://fonts.googleapis.com/css" );
	}

	return $fonts_url;
}

/**
 * Loads our special font CSS file.
 * To disable in a child theme, use wp_dequeue_style()
 * function mytheme_dequeue_fonts() {
 *     wp_dequeue_style( 'wpforge-fonts' );
 * }
 * add_action( 'wp_enqueue_scripts', 'mytheme_dequeue_fonts', 11 );
 * Also used in the Appearance > Header admin panel:
 * @see wpforge_custom_header_setup()
 *
 * @since WP-Forge 5.2.0
 *
 */
function wpforge_fonts() {
	$fonts_url = wpforge_fonts_url();
	if ( ! empty( $fonts_url ) )
		wp_enqueue_style( 'wpforge-fonts', esc_url_raw( $fonts_url ), array(), null );
}
add_action( 'wp_enqueue_scripts', 'wpforge_fonts', 0 );

/**
 * Enqueues scripts and styles for front-end.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_scripts_styles() {
	global $wp_styles;
	
	// modernizr (without media query polyfill)
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array(), '2.7.1', false );	

	// Enque threaded comments script in footer
	function my_enqueue_comments_reply() {
		if( get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
		}
	}
	add_action( 'comment_form_before', 'my_enqueue_comments_reply' );

    // Register Foundation scripts file in the footer
    wp_enqueue_script( 'foundation-js', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '', true );
	
    // Register JavaScript file with functionality specific to WP-Forge.
    wp_enqueue_script( 'functions-js', get_template_directory_uri() . '/js/functions.js', array('jquery'), '', true );

	// Load all of our stylesheets
	wp_enqueue_style( 'font-awesome', get_template_directory_uri() . '/fonts/font-awesome.css' );	
	wp_enqueue_style( 'normalize', get_template_directory_uri() . '/css/normalize.css' );
	wp_enqueue_style( 'foundation', get_template_directory_uri() . '/css/foundation.css' );
	wp_enqueue_style( 'wpforge', get_stylesheet_uri() );
}
add_action( 'wp_enqueue_scripts', 'wpforge_scripts_styles', 0 );

/**
 * Creates a nicely formatted and more specific title element text for output
 * in head of document, based on current view.
 * @param string $title Default title text for current view.
 * @param string $sep Optional separator.
 * @return string The filtered title.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'wpforge' ), max( $paged, $page ) );

	return $title;
}
add_filter( 'wp_title', 'wpforge_wp_title', 10, 2 );

/**
 * A fallback when no navigation is selected by default, otherwise it throws some nasty errors in your face.
 * From required+ Foundation http://themes.required.ch
 *
 * @since WP-Forge 5.2.0 
 */
function wpforge_menu_fallback() {
	echo '<div class="alert-box secondary"><p>';
	// Translators 1: Link to Menus, 2: Link to Customize
  	printf( __( 'Please assign a menu to the primary menu location under %1$s or %2$s the design.', 'wpforge' ),
  		sprintf(  __( '<a href="%s">Menus</a>', 'wpforge' ),
  			get_admin_url( get_current_blog_id(), 'nav-menus.php' )
  		),
  		sprintf(  __( '<a href="%s">Customize</a>', 'wpforge' ),
  			get_admin_url( get_current_blog_id(), 'customize.php' )
  		)
  	);
  	echo '</p></div>';
}

// Add Foundation 'active' class for the current menu item
function wpforge_active_nav_class( $classes, $item ) {
    if ( $item->current == 1 || $item->current_item_ancestor == true ) {
        $classes[] = 'active';
    }
    return $classes;
}
add_filter( 'nav_menu_css_class', 'wpforge_active_nav_class', 10, 2 );

/**
 * Use the active class of ZURB Foundation on wp_list_pages output.
 * From required+ Foundation http://themes.required.ch
 *
 * @since WP-Forge 5.2.0 
 */
function wpforge_active_list_pages_class( $input ) {

	$pattern = '/current_page_item/';
    $replace = 'current_page_item active';

    $output = preg_replace( $pattern, $replace, $input );

    return $output;
}
add_filter( 'wp_list_pages', 'wpforge_active_list_pages_class', 10, 2 );

/**
 * class wpforge_walker
 * Custom output to enable the the ZURB Navigation style.
 * Courtesy of Kriesi.at. http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
 * From required+ Foundation http://themes.required.ch
 *
 * @since WP-Forge 5.2.0 
 */
class wpforge_walker extends Walker_Nav_Menu {

	/**
	 * Specify the item type to allow different walkers
	 * @var array
	 */
	var $nav_bar = '';

	function __construct( $nav_args = '' ) {

		$defaults = array(
			'item_type' => 'li',
			'in_top_bar' => false,
			'menu_type' => 'main-menu' //enable menu differenciation, used in preg_replace classes[] below
		);
		$this->nav_bar = apply_filters( 'req_nav_args', wp_parse_args( $nav_args, $defaults ) );
	}

	function display_element( $element, &$children_elements, $max_depth, $depth=0, $args, &$output ) {

        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		global $wp_query;
		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$class_names = $value = '';

		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$classes[] = 'menu-item-' . $item->ID;

    // Additionnal Class cleanup, as found in Roots_Nav_Walker - Roots Theme lib/nav.php
    // see http://roots.io/ and https://github.com/roots/roots
    $slug = sanitize_title($item->title);
    $classes = preg_replace('/(current(-menu-|[-_]page[-_])(item|parent|ancestor))/', '', $classes);
    $classes = preg_replace('/^((menu|page)[-_\w+]+)+/', '', $classes);

    $menu_type = $this->nav_bar['menu_type'];
    $classes[] = 'menu-item menu-item-' . $menu_type . ' menu-item-' . $slug;
    
    $classes = array_unique($classes);

		// Check for flyout
		$flyout_toggle = '';
		if ( $args->has_children && $this->nav_bar['item_type'] == 'li' ) {

			if ( $depth == 0 && $this->nav_bar['in_top_bar'] == false ) {

				$classes[] = 'has-flyout';
				$flyout_toggle = '<a href="#" class="flyout-toggle"><span></span></a>';

			} else if ( $this->nav_bar['in_top_bar'] == true ) {

				$classes[] = 'has-dropdown';
				$flyout_toggle = '';
			}

		}

		$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args ) );
		$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

		if ( $depth > 0 ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		} else {
			$output .= $indent . ( $this->nav_bar['in_top_bar'] == true ? '<li class="divider"></li>' : '' ) . '<' . $this->nav_bar['item_type'] . ' id="menu-item-'. $item->ID . '"' . $value . $class_names .'>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output  = $args->before;
		$item_output .= '<a '. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $flyout_toggle; // Add possible flyout toggle
		$item_output .= $args->after;

		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}

	function end_el( &$output, $item, $depth = 0, $args = array() ) {

		if ( $depth > 0 ) {
			$output .= "</li>\n";
		} else {
			$output .= "</" . $this->nav_bar['item_type'] . ">\n";
		}
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {

		if ( $depth == 0 && $this->nav_bar['item_type'] == 'li' ) {
			$indent = str_repeat("\t", 1);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"flyout\">\n";
    	} else {
			$indent = str_repeat("\t", $depth);
    		$output .= $this->nav_bar['in_top_bar'] == true ? "\n$indent<ul class=\"dropdown\">\n" : "\n$indent<ul class=\"level-$depth\">\n";
		}
  	}
}

/**
 * Registers our main, front page and footer widget areas.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_widgets_init() {
	register_sidebar( array(
		'name' => __( 'Main Sidebar', 'wpforge' ),
		'id' => 'sidebar-1',
		'description' => __( 'Displays widgets in the blog area as well as pages.', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	register_sidebar( array(
		'name' => __( 'First Front Page Widget Area', 'wpforge' ),
		'id' => 'sidebar-2',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Front Page Widget Area', 'wpforge' ),
		'id' => 'sidebar-3',
		'description' => __( 'Appears when using the optional Front Page template with a page set as Static Front Page', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );	
	register_sidebar( array(
		'name' => __( 'First Footer Widget Area', 'wpforge' ),
		'id' => 'sidebar-4',
		'description' => __( 'An optional widget area for your site footer', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	register_sidebar( array(
		'name' => __( 'Second Footer Widget Area', 'wpforge' ),
		'id' => 'sidebar-5',
		'description' => __( 'An optional widget area for your site footer', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );
	register_sidebar( array(
		'name' => __( 'Third Footer Widget Area', 'wpforge' ),
		'id' => 'sidebar-6',
		'description' => __( 'An optional widget area for your site footer', 'wpforge' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h6 class="widget-title">',
		'after_title' => '</h6>',
	) );			
}
add_action( 'widgets_init', 'wpforge_widgets_init' );

// Front Page Template Sidebars. This will count the number of front page sidebars to enable dynamic classes for the home page
function wpforge_front_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-2' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-3' ) )
		$count++;		

	$class = '';

	switch ( $count ) {
		case '1':
			$class = 'medium-12 large-12';
			break;
		case '2':
			$class = 'medium-12 large-6';
			break;			
	}

	if ( $class )
		echo '' . $class . '';
}

// Footer Sidebars. This will count the number of footer sidebars to enable dynamic classes in the footer area
function wpforge_footer_sidebar_class() {
	$count = 0;

	if ( is_active_sidebar( 'sidebar-4' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-5' ) )
		$count++;

	if ( is_active_sidebar( 'sidebar-6' ) )
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
	}

	if ( $class )
		echo '' . $class . '';
}

// Numeric Page Navi (built into the theme by default) - thanks to wp-foundation (http://320press.com/wp-foundation/) 
function page_navi($before = '', $after = '') {
	global $wpdb, $wp_query;
	$request = $wp_query->request;
	$posts_per_page = intval(get_query_var('posts_per_page'));
	$paged = intval(get_query_var('paged'));
	$numposts = $wp_query->found_posts;
	$max_page = $wp_query->max_num_pages;
	if ( $numposts <= $posts_per_page ) { return; }
	if(empty($paged) || $paged == 0) {
		$paged = 1;
	}
	$pages_to_show = 7;
	$pages_to_show_minus_1 = $pages_to_show-1;
	$half_page_start = floor($pages_to_show_minus_1/2);
	$half_page_end = ceil($pages_to_show_minus_1/2);
	$start_page = $paged - $half_page_start;
	if($start_page <= 0) {
		$start_page = 1;
	}
	$end_page = $paged + $half_page_end;
	if(($end_page - $start_page) != $pages_to_show_minus_1) {
		$end_page = $start_page + $pages_to_show_minus_1;
	}
	if($end_page > $max_page) {
		$start_page = $max_page - $pages_to_show_minus_1;
		$end_page = $max_page;
	}
	if($start_page <= 0) {
		$start_page = 1;
	}
		
	echo $before.'<ul class="pagination clearfix">'."";
		
	echo '<li class="">';
	previous_posts_link('&laquo; Previous');
	echo '</li>';
	for($i = $start_page; $i  <= $end_page; $i++) {
		if($i == $paged) {
			echo '<li class="current"><a href="#">'.$i.'</a></li>';
		} else {
			echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
		}
	}
	echo '<li class="">';
	next_posts_link('Next &raquo;');
	echo '</li>';
	echo '</ul>'.$after."";
}

/**
 * Displays navigation to next/previous pages when applicable.
 *
 * @since WP-Forge 5.2.0
 */
if ( ! function_exists( 'wpforge_content_nav' ) ) :

function wpforge_content_nav( $html_id ) {
	global $wp_query;

	$html_id = esc_attr( $html_id );

	if ( $wp_query->max_num_pages > 1 ) : ?>
		<?php if(function_exists('page_navi') ) : ?>
			<?php page_navi(); ?>
		<?php else: ?>    
		<nav id="<?php echo $html_id; ?>" class="navigation" role="navigation">
			<h3 class="assistive-text"><?php _e( 'Post navigation', 'wpforge' ); ?></h3>
			<div class="nav-previous alignleft"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'wpforge' ) ); ?></div>
			<div class="nav-next alignright"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'wpforge' ) ); ?></div>
		</nav><!-- #<?php echo $html_id; ?> .navigation -->
        <?php endif; ?>        
	<?php endif;
}
endif;

/**
 * Template for comments and pingbacks.
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpforge_comment(), and that function will be used instead.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
 * @since WP-Forge 1.0
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
		<p><?php _e( 'Pingback:', 'wpforge' ); ?> <?php comment_author_link(); ?> <?php edit_comment_link( __( '(Edit)', 'wpforge' ), '<span class="edit-link"><i class="fa fa-pencil"></i> ', '</span>' ); ?></p>
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
						( $comment->user_id === $post->post_author ) ? '<span> ' . __( 'Post Author', 'wpforge' ) . '</span>' : ''
					);
					printf( '<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
						esc_url( get_comment_link( $comment->comment_ID ) ),
						get_comment_time( 'c' ),
						/* translators: 1: date, 2: time */
						sprintf( __( '%1$s at %2$s', 'wpforge' ), get_comment_date(), get_comment_time() )
					);
				?>
			</header><!-- .comment-meta -->

			<?php if ( '0' == $comment->comment_approved ) : ?>
				<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'wpforge' ); ?></p>
			<?php endif; ?>

			<section class="comment-content comment">
				<?php comment_text(); ?>
				<?php edit_comment_link( __( 'Edit', 'wpforge' ), '<p class="edit-link"><i class="fa fa-pencil"></i> ', '</p>' ); ?>
			</section><!-- .comment-content -->

			<div class="reply">
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply &raquo;', 'wpforge' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
			</div><!-- .reply -->
		</article><!-- #comment-## -->
	<?php
		break;
	endswitch; // end comment_type check
}
endif;

/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * Create your own wpforge_entry_meta() to override in a child theme.
 *
 * @since WP-Forge 1.0
 */
if ( ! function_exists( 'wpforge_entry_meta' ) ) :

function wpforge_entry_meta() {
	if ( is_sticky() && is_home() && ! is_paged() )
		echo '<i class="fa fa-thumb-tack"></i> <span class="sticky-post">' . __( 'Sticky', 'wpforge' ) . '</span>';				

	if ( ! has_post_format( '' ) && 'post' == get_post_type() )
		wpforge_entry_date();

	// Translators: used between list items, there is a space after the comma.
	$categories_list = get_the_category_list( __( ', ', 'wpforge' ) );
	if ( $categories_list ) {
		echo '<i class="fa fa-folder-open"></i> <span class="categories-links">' . $categories_list . '</span>';
	}

	// Translators: used between list items, there is a space after the comma.
	$tag_list = get_the_tag_list( '', __( ', ', 'wpforge' ) );
	if ( $tag_list ) {
		echo '<i class="fa fa-tag"></i> <span class="tags-links">' . $tag_list . '</span>';
	}

	// Post author
	if ( 'post' == get_post_type() ) {
		printf( '<i class="fa fa-user"></i> <span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
			esc_attr( sprintf( __( 'View all posts by %s', 'wpforge' ), get_the_author() ) ),
			get_the_author()
		);
	}
}
endif;

/**
 * Prints HTML with date information for current post.
 * Create your own wpforge_entry_date() to override in a child theme.
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string
 *
 * @since WP-Forge 1.0
 */
if ( ! function_exists( 'wpforge_entry_date' ) ) :

function wpforge_entry_date( $echo = true ) {
	$format_prefix = ( has_post_format( '' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'wpforge' ): '%2$s';

	$date = sprintf( '<i class="fa fa-calendar-o"></i> <span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
		esc_url( get_permalink() ),
		esc_attr( sprintf( __( 'Permalink to %s', 'wpforge' ), the_title_attribute( 'echo=0' ) ) ),
		esc_attr( get_the_date( 'c' ) ),
		esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
	);

	if ( $echo )
		echo $date;

	return $date;
}
endif;

/**
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Front Page template: thumbnail in use and number of sidebars for
 *    widget areas.
 * 3. White or empty background color to change the layout and spacing.
 * 4. Custom fonts enabled.
 * 5. Single or multiple authors.
 * @param array Existing class values.
 * @return array Filtered class values.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_body_class( $classes ) {
	$background_color = get_background_color();

	if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
		$classes[] = 'full-width';

	if ( is_page_template( 'page-templates/front-page.php' ) ) {
		$classes[] = 'template-front-page';
		if ( has_post_thumbnail() )
			$classes[] = 'has-post-thumbnail';
		if ( is_active_sidebar( 'sidebar-2' ) && is_active_sidebar( 'sidebar-3' ) )
			$classes[] = 'two-sidebars';
	}

	if ( empty( $background_color ) )
		$classes[] = 'custom-background-empty';
	elseif ( in_array( $background_color, array( 'e6e6e6', 'e6e6e6' ) ) )
		$classes[] = 'custom-background-white';

	// Enable custom font class only if the font CSS is queued to load.
	if ( wp_style_is( 'wpforge-fonts', 'queue' ) )
		$classes[] = 'custom-font-enabled';

	if ( ! is_multi_author() )
		$classes[] = 'single-author';

	return $classes;
}
add_filter( 'body_class', 'wpforge_body_class' );

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_content_width() {
	if ( is_page_template( 'page-templates/full-width.php' ) || is_attachment() || ! is_active_sidebar( 'sidebar-1' ) ) {
		global $content_width;
		$content_width = 898;
	}
}
add_action( 'template_redirect', 'wpforge_content_width' );

// Add Excerpt support to Pages
add_post_type_support( 'page', 'excerpt' );

// Custom Excerpt
function custom_excerpt_length( $length ) { 
	return 55;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function new_excerpt_more( $more ) {
	return ' <a class="read-more" href="'. get_permalink( get_the_ID() ) . '">...Continue reading &raquo;</a>';
}
add_filter( 'excerpt_more', 'new_excerpt_more' );

// Allows shortcodes to be used in text widgets
add_filter('widget_text', 'do_shortcode');

// remove the p from around imgs (http://css-tricks.com/snippets/wordpress/remove-paragraph-tags-from-around-images/)
function filter_ptags_on_images($content){
   return preg_replace('/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(<\/a>)?\s*<\/p>/iU', '\1\2\3', $content);
}
add_filter('the_content', 'filter_ptags_on_images');

// Remove height/width attributes on images so they can be responsive
add_filter( 'post_thumbnail_html', 'remove_thumbnail_dimensions', 10 );
add_filter( 'image_send_to_editor', 'remove_thumbnail_dimensions', 10 );

function remove_thumbnail_dimensions( $html ) {
    $html = preg_replace( '/(width|height)=\"\d*\"\s/', "", $html );
    return $html;
}

/**
 * Remove wp version param from any enqueued scripts
 *
 * @since WP-Forge 5.2.0
 */

function _remove_script_version( $src ){
    $parts = explode( '?ver', $src );
        return $parts[0];
}
add_filter( 'script_loader_src', '_remove_script_version', 15, 1 );
add_filter( 'style_loader_src', '_remove_script_version', 15, 1 );

/**
 * Remove .sticky from the post_class array (Thanks to required+ foundation)
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_filter_post_class( $classes ) {
    if ( ( $key = array_search( 'sticky', $classes ) ) !== false ) {
        unset( $classes[$key] );
        $classes[] = 'sticky-post';
    }
    return $classes;
}
add_filter( 'post_class', 'wpforge_filter_post_class', 20 );

/**
 * Removes recent comments styling injected into header by WordPress - Styles moved to style sheet
 * @see https://gist.github.com/Narga/2887406
 *
 * @since WP-Forge 5.2.0
 */
function wpforge_remove_recent_comments_style() {  
        global $wp_widget_factory;  
        remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );  
    }  
add_action( 'widgets_init', 'wpforge_remove_recent_comments_style' );

/**
 * Add favicon to header
 * 
 * @since WP-Forge 5.2.0
 */
function wpforge_favicon() {
echo '<link rel="shortcut icon" href="' . site_url() . '/favicon.ico" type="image/x-icon">'."\n". '<link rel="icon" href="' . site_url() . '/favicon.ico" type="image/x-icon">';
}
add_action('wp_head', 'wpforge_favicon', 0);

?>