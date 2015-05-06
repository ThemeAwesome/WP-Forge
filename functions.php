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
 * @since WP-Forge 5.5.1.7
 */

/**
 * Sets up the content width value based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) )
	$content_width = 685;

/**
 * Adjusts content_width value for full-width and single image attachment
 * templates, and when there are no active widgets in the sidebar.
 *
 * @see https://developer.wordpress.com/themes/content-width/
 * @since WP-Forge 5.5.1.8
 */
if ( ! function_exists( 'wpforge_adjust_content_width' ) ) {
	function wpforge_adjust_content_width() {
	    global $content_width;
	    if ( is_page_template( 'full-width.php' ) || is_page_template( 'front-page.php' ) || is_attachment() || 
	    	! is_active_sidebar( 'sidebar-1' ))
	        $content_width = 1024;
	}
	add_action( 'template_redirect', 'wpforge_adjust_content_width' );
}

/**
 * Sets up theme defaults and registers the various WordPress features that
 * WP-Forge supports.
 *
 * @uses load_theme_textdomain() Support for translation/localization.
 * @uses add_editor_style() Support for Visual Editor stylesheet.
 * @uses add_theme_support() Support for post thumbnails, automatic feed links, custom background and post formats.
 * @uses register_nav_menu() Support for navigation menus.
 * @uses set_post_thumbnail_size() Sets a custom post thumbnail size.
 *
 * @since WP-Forge 5.5.1.8
 */
function wpforge_setup() {

	/**
	 * Add Title Tag support
	 *
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
	 *
	 * @see http://codex.wordpress.org/Automatic_Feed_Links
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Switches default core markup for search form, comment form, and comments to output valid HTML5.
	 *
	 * @see http://codex.wordpress.org/Function_Reference/add_theme_support
	 */
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ));	

	/**
	 * Add support for all available post formats by default.
	 *
	 * @see http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'audio', 'chat', 'gallery', 'image', 'link', 'quote', 'status', 'video'
	));

	/**
	 * Add Excerpt support to Pages
	 *
	 * @see http://codex.wordpress.org/Function_Reference/add_post_type_support
	 */
	add_post_type_support( 'page', 'excerpt' );

	/**
	 * Add support for Jetpack's Infinite Scroll
	 *
	 * @see http://jetpack.me/support/infinite-scroll/
	 */
	add_theme_support( 'infinite-scroll', array(
		'container' => 'content',
		'footer' => 'page',
	));	

	/**
	 * This theme uses wp_nav_menu() in three locations.
	 *
	 * @see http://codex.wordpress.org/Function_Reference/register_nav_menus
	 */
	register_nav_menus(array(
		'primary' 	=> __( 'Main Menu', 'wp-forge' ), 
		'secondary' => __( 'Footer Menu', 'wp-forge' ),
		'social' 	=> __( 'Social Menu', 'wp-forge' ),		
	));	

	/**
	 * This theme uses a custom image size for featured images, displayed on "standard" posts.
	 *
	 * @see http://codex.wordpress.org/Post_Thumbnails
	 */
	add_theme_support( 'post-thumbnails' );

	// Set custom thumbnail dimensions
	set_post_thumbnail_size( 685, 9999 ); // Unlimited height, soft crop

	/**
	 * This theme supports custom background color and image, and here we also set up the default background color.
	 *
	 * @see http://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support( 'custom-background', array(
		'default-color' => 'e6e6e6',
	));
			
}
add_action( 'after_setup_theme', 'wpforge_setup' );

/**
 * This theme styles the visual editor to resemble the theme front end.
 *
 * @see http://codex.wordpress.org/Function_Reference/add_editor_style
 */
if ( ! function_exists( 'wpforge_add_editor_styles' ) ) {
	function wpforge_add_editor_styles() {
	    $font_url = str_replace( ',', '%2C', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,400,300,600,700' );
	    add_editor_style( array(
	    	$font_url, 'css/editor-style.css','fonts/genericons.css','style.css','css/foundation.css',
	 	));
	}
	add_action( 'after_setup_theme', 'wpforge_add_editor_styles' );
}

/**
 * Adds custom header support
 *
 * @see http://codex.wordpress.org/Custom_Headers 
 */
require( get_template_directory() . '/inc/custom-header.php' );

/**
 * Loads the Customizer
 *
 * @see http://codex.wordpress.org/Theme_Customization_API
 */
require( get_template_directory() . '/inc/customizer.php' );

/**
 * Load our Google Font
 *
 * Create your own Google font function to override in a child theme.
 *
 * @see http://wptavern.com/wordpress-tip-how-to-load-google-fonts-over-ssl-and-non-ssl
 */
if ( ! function_exists( 'wpforge_google_fonts' ) ) {
	function wpforge_google_fonts() {
	    // register the font styles we want
	    wp_enqueue_style('wpforge-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300,700','', '5.5.1.8');
	}
	add_action( 'wp_enqueue_scripts', 'wpforge_google_fonts', 0);
}

/**
 * Enqueue our scripts and styles
 *
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_script
 * @see http://codex.wordpress.org/Function_Reference/wp_enqueue_style
 */
function wpforge_scripts() {
    wp_enqueue_style('wpforge-genericons', get_template_directory_uri() . '/fonts/genericons.css','', '3.3' );
    wp_enqueue_style('wpforge-normalize', get_template_directory_uri() . '/css/normalize.css','', '3.0.3' );
    wp_enqueue_style('wpforge-foundation', get_template_directory_uri() . '/css/foundation.css','', '5.5.2' );
    wp_enqueue_style('wpforge', get_stylesheet_uri(),'', '5.5.2' );
	wp_enqueue_script ('wpforge_modernizr', get_template_directory_uri() . '/js/vendor/modernizr.js', array('jquery'), '2.8.3', false );
	wp_enqueue_script ('wpforge_foundation', get_template_directory_uri() . '/js/foundation.min.js', array('jquery'), '5.5.2', true );

	/**
	 * Make the "Back" string in foundation.min.js translatable. Needs to come right after foundation.min.js is
	 * enqueued
	 *
	 * @see http://codex.wordpress.org/Function_Reference/wp_localize_script
	 */
	$translation_array = array( 'nav_back' => __( 'Back', 'wp-forge' ) );
	wp_localize_script( 'wpforge_foundation', 'foundation_strings', $translation_array );

	wp_enqueue_script ('wpforge_functions', get_template_directory_uri() . '/js/wpforge-functions.js', array('jquery'), '5.5.2', true );

}
add_action( 'wp_enqueue_scripts', 'wpforge_scripts', 0);

/**
 * Enqueue our Foundation script with a very low priority so it loads as close to the closing body tag as possible
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_prepare_foundation' ) ) {
	function wpforge_prepare_foundation() {	
		wp_enqueue_script ('wpforge_load_foundation', get_template_directory_uri() . '/js/load-foundation.js', array('wpforge_foundation'), '5.5.2', true);
	}
	add_action( 'wp_enqueue_scripts', 'wpforge_prepare_foundation', 999);
}	

/**
 * Enque threaded comments script in footer
 *
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
 *
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
 * Use the active class of ZURB Foundation on wp_list_pages output.
 *
 * @since WP-Forge 5.5.1.7 
 */
if ( ! function_exists( 'wpforge_active_list_pages_class' ) ) {
	function wpforge_active_list_pages_class( $input ) {

		$pattern = '/current_page_item/';
	    $replace = 'current_page_item active';

	    $output = preg_replace( $pattern, $replace, $input );

	    return $output;
	}
	add_filter( 'wp_list_pages', 'wpforge_active_list_pages_class', 10, 2 );
}	

/**
 * class wpforge_walker
 * Custom output to enable the ZURB Navigation style.
 *
 * @author Courtesy of Kriesi.at.
 * @see http://www.kriesi.at/archives/improve-your-wordpress-navigation-menu-output
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
		$this->nav_bar = apply_filters( 'wpforge_nav_args', wp_parse_args( $nav_args, $defaults ) );
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
 * Register our main and footer widget areas.
 *
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
	}
	add_action( 'widgets_init', 'wpforge_widgets_init' );
}

/**
 * Footer Sidebars. This will count the number of footer sidebars to enable dynamic classes in the footer area.
 * Modified version of twentyeleven_footer_sidebar_class().
 *
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
}

/**
 * Numeric Page Navi (built into the theme by default)
 *
 * @see http://320press.com/wp-foundation/
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_page_navi' ) ) {
	function wpforge_page_navi($before = '', $after = '') {
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
		previous_posts_link('&laquo; Previous', 'wp-forge');
		echo '</li>';
		for($i = $start_page; $i  <= $end_page; $i++) {
			if($i == $paged) {
				echo '<li class="current"><a href="#">'.$i.'</a></li>';
			} else {
				echo '<li><a href="'.get_pagenum_link($i).'">'.$i.'</a></li>';
			}
		}
		echo '<li class="">';
		next_posts_link('Next &raquo;', 'wp-forge');
		echo '</li>';
		echo '</ul>'.$after."";
	}
}

/**
 * Displays navigation to next/previous pages when applicable.
 *
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
 * To override this walker in a child theme without modifying the comments template
 * simply create your own wpforge_comment(), and that function will be used instead.
 * Used as a callback by wp_list_comments() for displaying the comments.
 *
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
					<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( '<span class="genericon genericon-reply"></span> Reply', 'wp-forge' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
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
 * Create your own wpforge_entry_meta_categories() to override in a child theme.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_entry_meta_categories' ) ) :
	function wpforge_entry_meta_categories() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'wp-forge' ) );
		if ( $categories_list ) {
			echo '<div class="entry-meta-categories"><span class="categories-links">' . $categories_list . '</span></div>';
		}
	}
endif;

/**
 * Print HTML with meta information for the current post-date/time and author.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_entry_meta_header' ) ) :
	function wpforge_entry_meta_header() {
		if ( is_sticky() && is_home() && ! is_paged() ) {
			echo '<span class="genericon genericon-pinned"></span> <span class="sticky-post">' . __( 'Sticky', 'wp-forge' ) . '</span>';
		}

		// Set up and print post meta information.
		printf( '<span class="entry-date updated"><span class="genericon genericon-time"></span><a href="%1$s" rel="bookmark"><time class="entry-date" datetime="%2$s">%3$s</time></a></span> <span class="byline"><span class="genericon genericon-user"></span><span class="author vcard"><a class="url fn n" href="%4$s" rel="author">%5$s</a></span></span>',
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
 * Create your own wpforge_entry_meta_footer() to override in a child theme.
 *
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
 * Extends the default WordPress body class to denote:
 * 1. Using a full-width layout, when no active widgets in the sidebar
 *    or full-width template.
 * 2. Using a full-width layout, when no active widgets in the sidebar
 *    or front-page template. 
 * 3. White or empty background color to change the layout and spacing.
 * 4. Single or multiple authors.
 * @param array Existing class values.
 * @return array Filtered class values.
 *
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_body_class' ) ) {
	function wpforge_body_class( $classes ) {
		$background_color = get_background_color();

		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/full-width.php' ) )
			$classes[] = 'full-width';

		if ( ! is_active_sidebar( 'sidebar-1' ) || is_page_template( 'page-templates/front-page.php' ) )
			$classes[] = 'front-page';		

		if ( empty( $background_color ) )
			$classes[] = 'custom-background-empty';
		elseif ( in_array( $background_color, array( 'e6e6e6', 'e6e6e6' ) ) )
			$classes[] = 'custom-background-white';

		if ( ! is_multi_author() )
			$classes[] = 'single-author';

		return $classes;
	}
	add_filter( 'body_class', 'wpforge_body_class' );
}

/**
 * Custom Excerpt Length
 *
 * @see http://codex.wordpress.org/Function_Reference/the_excerpt
 * @since WP-Forge 5.5.1.7
 */
if ( ! function_exists( 'wpforge_custom_excerpt' ) ) {
	function wpforge_custom_excerpt( $length ) { 
		return 55;
	}
	add_filter( 'excerpt_length', 'wpforge_custom_excerpt', 999 );
}

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ...
 * and a Continue reading link.
 *
 * @since WP-Forge 5.5.1.7
 *
 * @param string $more Default Read More excerpt link.
 * @return string Filtered Read More excerpt link.
 * @see Twenty Thirteen Theme Functions.php line 464
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
 *
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
 *
 * @see https://gist.github.com/Narga/2887406
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
 *
 * @see http://codex.wordpress.org/Function_Reference/the_post_thumbnail
 */
if ( ! function_exists( 'wpforge_link_postthumb' ) ) {
	function wpforge_link_postthumb( $html, $post_id, $post_image_id ) {
	  $html = '<a href="' . get_permalink( $post_id ) . '" title="' . esc_attr( get_the_title( $post_id ) ) . '">' . $html . '</a>';
	  return $html;
	}
	add_filter( 'post_thumbnail_html', 'wpforge_link_postthumb', 10, 3 );
}

/**
 * Outputs a custom Favicon in the header.
 *
 * @since WP-Forge 5.5.2
*/
if ( get_theme_mod('wpforge_favicon_url') != '' ) {
if ( ! function_exists( 'wpforge_set_favicon' ) ) {
function wpforge_set_favicon() { ?>
<link rel="shortcut icon" href="<?php echo esc_url(get_theme_mod('wpforge_favicon_url')); ?>" /> 
<?php }
add_action('wp_head', 'wpforge_set_favicon');
}
}

?>
