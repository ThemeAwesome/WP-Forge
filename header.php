<!doctype html>
<!--[if !IE]>      <html class="no-js non-ie" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 9 ]>    <html class="no-js ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 9]>  <!--> <html class="no-js" <?php language_attributes(); ?>> <!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?php wp_title('&#124;', true, 'right'); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

	<div id="wrapper">
    
		<?php $header_image = get_header_image(); if ( ! empty( $header_image ) ) : ?>  
          
            <header id="header" class="row" role="banner"> 
            	<div class="site-header large-12 columns">
                	<div class="header-logo">
                    	<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo esc_url( $header_image ); ?>" class="header-image" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" /></a>
                    </div><!-- /.header-logo --> 
                    <div class="header-info">
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>         				<h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>                    
                    </div><!-- /.header-info -->
                 </div><!-- .site-header -->
            </header><!-- #header -->
            
        <?php else : ?> 
         
            <header id="header" class="row" role="banner">
            	<div class="site-header large-12 columns">
                	<div class="header-info">            
                        <h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
                        <h2 class="site-description"><?php bloginfo( 'description' ); ?></h2>
                    </div><!-- /.header-info -->
				</div><!-- .site-header -->                    
            </header><!-- #header -->
            
        <?php endif; ?>
        
        <?php get_template_part('nav', 'top-bar'); ?>
    
        <section class="container row" role="document">