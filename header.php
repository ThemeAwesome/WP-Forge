<!doctype html>
<html class="no-js" <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<?php wp_head(); ?>
</head>
<body <?php wpforge_body_schema();?> <?php body_class(); ?>><a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wp-forge' ); ?></a>
    <?php if( get_theme_mod('wpforge_nav_select') == 'offcanvas' || get_theme_mod('wpforge_mobile_display') == 'yes') { ?>
        <?php get_template_part('content', 'off_canvas'); ?>
    <?php } // end if ?>
    <?php if( get_theme_mod('wpforge_nav_select','topbar') == 'topbar') { ?>
        <?php if( get_theme_mod('wpforge_nav_position') == 'scroll' || get_theme_mod('wpforge_nav_position') == 'fixed') { ?>
            <?php get_template_part('content', 'nav'); ?>
        <?php } // end if ?>
    <?php } // end if ?>
    <div class="header_container">
        <header id="header" class="header_wrap grid-container" itemtype="http://schema.org/WPHeader" itemscope="itemscope">
            <div class="grid-x grid-padding-x">
                <div class="site-header small-12 cell">
                    <?php $header_image = get_header_image();
                    if ( ! empty( $header_image ) ) { ?>
                    <div class="header-logo">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php header_image(); ?>" class="header-image" alt="<?php echo esc_attr( get_bloginfo('name', 'display') ); ?>" /></a>
                    </div><!-- .header-logo -->
                    <?php } ?>
                    <?php $header_logo = the_custom_logo();
                    if ( ! empty( $header_logo ) ) { ?>
                    <div class="header-logo">
                        <?php the_custom_logo(); ?>
                    </div><!-- .header-logo -->
                    <?php } ?>
                    <div class="header-info">
                        <?php if ( is_front_page() && is_home() ) : ?>
                        <h1 class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </h1><!-- .site-title -->
                        <?php else : ?>
                        <p class="site-title">
                            <a href="<?php echo esc_url(home_url('/')); ?>" rel="home"><?php bloginfo('name'); ?></a>
                        </p><!-- .site-title -->
                        <?php endif;
                        $description = get_bloginfo( 'description', 'display' );
                        if ( $description || is_customize_preview() ) : ?>
                        <p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
                        <?php
                        endif; ?>
                    </div><!-- .header-info -->
                </div><!-- .site-header -->
            </div><!-- .grid-x .grid-margin-x -->
        </header><!-- #header -->
    </div><!-- end .header_container -->
    <?php if( get_theme_mod('wpforge_nav_select','topbar') == 'topbar') { ?>
        <?php if( get_theme_mod('wpforge_nav_position','normal') == 'normal' || get_theme_mod('wpforge_nav_position') == 'sticky') { ?>
            <?php get_template_part('content','nav'); ?>
        <?php } // end if ?>
    <?php } // end if ?>
    <div class="content_container">
    <section class="content_wrap  grid-container" role="document"><div class="grid-x grid-padding-x">