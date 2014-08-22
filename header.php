<?php
/**
 * The Header template of our theme.
 *
 * Displays all of the <head> section and everything up till <section class="container row" role="document">
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.4
 */
?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 7) | !(IE 8) ]><!-->
<html <?php language_attributes(); ?>>
<!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<title><?php wp_title('&ndash;', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>    

	<?php get_template_part( 'content', 'off_canvas' ); ?>

	<?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
    	<?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
        <?php get_template_part( 'content', 'nav' ); ?>
    <?php } // end if ?>    


	<div id="wrapper"> 
          
        <header id="header" class="row" role="banner"> 
            <div class="site-header medium-12 large-12 columns">
            <?php if( get_theme_mod( 'wpforge_logo' ) ) { ?>
                <div class="header-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home">
                        <img src="<?php echo get_theme_mod('wpforge_logo'); ?>" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>">
                    </a>
                </div><!-- /.header-logo -->
            <?php } // end if ?>
                <div class="header-info">
                    <p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
                    <p class="site-description"><?php bloginfo( 'description' ); ?></p>                    
                </div><!-- /.header-info -->
             </div><!-- .site-header -->
        </header><!-- #header -->
            
		<?php if( get_theme_mod( 'wpforge_nav_position' ) == 'normal') { ?>
            <?php get_template_part( 'content', 'nav' ); ?>
        <?php } // end if ?>
        
        <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>
            <?php get_template_part( 'content', 'nav' ); ?>
        <?php } // end if ?> 
        
        <hr />         
    
        <section class="container row" role="document">