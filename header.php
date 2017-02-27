<?php
/**
 * The Header template of our theme.
 * @since WP-Forge 5.5.1.7
 * @version 6.3.0.1
 */
?><!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

        <?php if( get_theme_mod('wpforge_nav_select','topbar') == 'offcanvas' || get_theme_mod('wpforge_mobile_display','no') == 'yes') { ?>
            <?php get_template_part('content', 'off_canvas'); ?>
        <?php } // end if ?>
        <?php if( get_theme_mod('wpforge_nav_select','topbar') == 'topbar') { ?>
            <?php if( get_theme_mod('wpforge_nav_position') == 'scroll' || get_theme_mod('wpforge_nav_position') == 'fixed') { ?>
                <?php get_template_part('content', 'nav'); ?>
            <?php } // end if ?>
        <?php } // end if ?>
        <div class="header_container">
        <header id="header" class="header_wrap row" role="banner">
            <div class="site-header medium-12 large-12 columns">
                <?php if ( get_header_image() ) : ?>
                <div class="header-logo">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" /></a>
                </div><!-- /.header-logo -->
                <?php endif; ?>
                <div class="header-info">
                    <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </h1>
                    <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                </div><!-- /.header-info -->
             </div><!-- .site-header -->
        </header><!-- #header -->
        </div><!-- end .header_container -->
        <?php if( get_theme_mod('wpforge_nav_select','topbar') == 'topbar') { ?>
            <?php if( get_theme_mod('wpforge_nav_position','normal') == 'normal' || get_theme_mod('wpforge_nav_position') == 'sticky') { ?>
                <?php get_template_part('content','nav'); ?>
            <?php } // end if ?>
        <?php } // end if ?>
        <div class="content_container">
        <section class="content_wrap row" role="document">
