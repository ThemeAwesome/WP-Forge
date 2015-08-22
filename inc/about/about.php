<?php
/**
 * About WP-Forge admin page framework.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.2.2
*/   

add_action('admin_init', 'wpforge_about_setup');
function wpforge_about_setup() {
$wpforge_about = array (

array( "name" => __( 'wpforge' , 'wp-forge' ),
	"type" => "title"),

array( "type" => "open"),

// Start Tabs
array( "name" => "Start Tabs",
		"type" => "tabs-open",
		"icon" => "layout"),

// Home
array( "name" => __( '<span class="genericon genericon-home"></span> Welcome' , 'wp-forge' ),
		"id" => "tab_menu_0",
		"type" => "tab",
		"icon" => "layout",
		"class" => " selected first"),

// Get Premium
array( "name" => __( '<span class="genericon genericon-info"></span> Additional Info' , 'wp-forge' ),
		"type" => "tab",
		"id" => "tab_menu_1",
		"class" => ""),
	
array( "name" => "Close Tabs",
		"type" => "tabs-close",
		"icon" => "layout"),


array( "name" => "Start Container",
		"type" => "container-open",
		"icon" => "layout"),

array( "name" => "tab_content_0",
		"type" => "tabcontent-open",
		"display" => "block",
		"icon" => "layout"),

// Home
array( "name" => __( 'Welcome to WP-Forge' , 'wp-forge' ),
	"type" => "heading",
	"icon" => "layout"),

array("name" => __( 'Thank you for choosing WP-Forge, the best WordPress Foundation theme available! I hope you utilize WP-Forge to learn something new, create something awesome, have fun and more importantly, I hope you share what you have learned with others.' , 'wp-forge' ),
	"type" => "infotext"),

array( "name" => __( 'About WP-Forge' , 'wp-forge' ),
	"type" => "heading",
	"icon" => "layout"),

array("name" => __( 'WP-Forge is A WordPress Foundation theme that combinds two powerful platforms: WordPress, the leading open source blogging tool and content management system and ZURBs Foundation, the most advanced responsive front-end framework in the world. Foundation comes packed with all kinds of goodies. You get cool things like tooltips, modal popups, a slider, pricing tables and a whole lot more. By combining WordPress and Foundation you get a theme that makes creating websites fun and exciting again! Use WP-Forge right out of the box, or as a parent theme with WP-Starter (the child theme built for WP-Forge) to build the site you&rsquo;ve always wanted.' , 'wp-forge' ),
	"type" => "infotext"),

array( "name" => "tab_content_0",
	"type" => "tabcontent-close",
	"icon" => "layout"),
// Close Home

// Open Get Premium
array( "name" => "tab_content_1",
		"type" => "tabcontent-open",
		"display" => "none",
		"icon" => "layout"),

array( "name" => __( 'WP-Forge Quick Start Guide' , 'wp-forge' ),
	"type" => "heading",
	"icon" => "layout"),

array( "type" => "infotext",
	"name" => __( 'The Wp-Forge Quick Start Guide will walk you through every aspect of WP-Forge and the theme customizer. The guide covers each and every aspect of the different panels and sections within the Customizerenabling you to get your site up and running as fast as possible.' , 'wp-forge' )),

array( "name" => __( 'WP-Forge Support Forums' , 'wp-forge' ),
	"type" => "heading",
	"icon" => "layout"),

array( "type" => "infotext",
	"name" => __( 'Have questions about how to do something with WP-Forge? Something not working the way it should? You can get fast, friendly support using the official WP-Forge support forums located on WordPress.org - Remeber, before asking a question, check the forums to make sure your question hasn&rsquo;t been asked and answered.' , 'wp-forge' )),

array( "name" => __( 'WP-Starter' , 'wp-forge' ),
	"type" => "heading",
	"icon" => "layout"),

array( "type" => "infotext",
	"name" => __( 'I recommend you always use a child theme no matter what theme you are using for your site. If you don&rsquo;t have time to set up your own child theme I have created a child theme for use with WP-Forge called WP-Starter. Once you have installed WP-Forge, simply download and activate and you&rsquo;re ready to go. Just add your images and styles and your site will be up in no time.' , 'wp-forge' )),

array( "name" => "tab_content_1",
	"type" => "tabcontent-close",
	"icon" => "layout"),
    
// Close Get Premium

array("name" => "Close Container",
		"type" => "container-close",
		"icon" => "layout"),

array( "type" => "close") 
); return $wpforge_about; }

add_action('admin_head', 'wpforge_admin_css');

function wpforge_admin_css() { ?>
     
	<script language="JavaScript">
		jQuery.noConflict();
		jQuery(document).ready(function($) {
	
		$(".tabs .tab[id^=tab_menu]").click(function() {
			var curMenu=$(this);
			$(".tabs .tab[id^=tab_menu]").removeClass("selected");
			curMenu.addClass("selected");
	
			var index=curMenu.attr("id").split("tab_menu_")[1];
			$(".curvedContainer .tabcontent").css("display","none");
			$(".curvedContainer #tab_content_"+index).css("display","block");
		});
	});
	</script>

<?php }
function wpforge_add_admin() {
	add_theme_page( __( 'About WP-Forge' , 'wp-forge' ), __( 'About WP-Forge' , 'wp-forge' ), 'edit_theme_options', 'about.php', 'wpforge_admin', '', '1' );
}

function wpforge_admin() {
$wpforge_about = wpforge_about_setup(); 
  wp_enqueue_style('wpforge-about-style', get_template_directory_uri() . '/inc/about/css.css');
  wp_enqueue_style('wpforge-opensans', '//fonts.googleapis.com/css?family=Open+Sans:300,700');
  wp_enqueue_style('wpforge-genericons', get_template_directory_uri() . '/fonts/genericons.css','', '3.3' );
?>

	<div id="wrap_fm"><!-- [ Header ]-->
		<div class="header_fm">
			<div class="logo_fm"><?php _e( 'WP-Forge' , 'wp-forge' ); ?></div>
		</div>

		<!-- [ Top Menu ]-->
		<div class="top_menu_fm">
			<a target="_blank" class="doc_fm" href="http://themeawesome.com/docs/wp-forge/"><?php _e( '<span class="genericon genericon-book"></span> WP-Forge Quick Start Guide
' , 'wp-forge' ); ?></a> <span class="genericon genericon-dot"></span> <a target="_blank" class="support_fm" href="https://wordpress.org/support/theme/wp-forge"><?php _e( '<span class="genericon genericon-help"></span> Support' , 'wp-forge' ); ?></a> <span class="genericon genericon-dot"></span> <a target="_blank" class="premium_fm" href="http://themeawesome.com/wordpress-child-theme/"><?php _e( '<span class="genericon genericon-cloud-download"></span> Get WP-Starter' , 'wp-forge' ); ?></a>
		</div>

	<?php 
	foreach ($wpforge_about as $value) {
	switch ( $value['type'] ) {
	case "open":
	?> 
	<?php break; case "title": ?> 

	<!-- [ Body ]-->
	<div id="wrap_body_fm">
	<div class="tabscontainer">

	<?php break; case "close": ?> 

</div></div>
	
	<?php break; case "heading":?>
	<h1><?php echo $value['name']; ?></h1>
	
	<?php break; case "subheader":?>
	<div class="name_fm"><?php echo $value['name']; ?></div>
	
  <?php break; case "infotext":?>
	<div class="infotext"><?php echo $value['name']; ?></div>
	
	<?php break; case "paragraph":?>
	<div class="desc_fm"><small><?php echo $value['name']; ?></small></div>
  	
	<?php break; case "tabs-open":?>	
	<div class="tabs">
	
	<?php break; case "tabs-close":?>	
	</div>	
	
	<?php break; case "tab":?>	
	<div class="tab<?php echo $value['class']; ?>" id="<?php echo $value['id']; ?>">
	<div class="link"><?php echo $value['name']; ?></div>
	<div class="arrow"></div>
	</div>
 	
 	<?php break; case "container-open":?>	
	<div class="curvedContainer">
 	
 	<?php break; case "container-close":?>	
	</div>	
 	
	<?php break; case "tabcontent-open":?>	
	<div class="tabcontent" id="<?php echo $value['name']; ?>" style="display:<?php echo $value['display']; ?>" >
	
	<?php break; case "tabcontent-close":?>	
	</div>
	 	
<?php break;
}
}
?>

<?php
}
add_action('admin_menu', 'wpforge_add_admin'); ?>