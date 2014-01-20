<?php
/**
 * The template for displaying the Top-Bar menu.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.0.3
 */
?>
<?php if( get_theme_mod( 'wpforge_nav_position' ) == 'normal') { ?>

    <div class="row">
        <div class="navcontainer large-12 columns">
            <nav class="top-bar" data-topbar>
                <ul class="title-area">
            	<?php if( get_theme_mod( 'wpforge_nav_title' ) == 'yes') { ?>
                    <li class="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_theme_mod( 'wpforge_nav_text' ); ?>" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
                    </li>
                <?php } else { ?>
                    <li class="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </li>
                <?php } // end if ?> 
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                    <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wpforge' ); ?></span></a></li>
                </ul>
                <section class="top-bar-section">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul class="left">%3$s</ul>',
                        'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                        'walker' => new wpforge_walker( array(
                            'in_top_bar' => true,
                            'item_type' => 'li',
                            'menu_type' => 'main-menu'
                        ) ),
                    ) );
                    ?>
                </section>
            </nav>
        </div><!-- .columns -->    
    </div><!-- .row -->

<?php } // end if ?>

<?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
    <div class="<?php echo get_theme_mod( 'wpforge_nav_display' ); ?>">
        <nav class="top-bar" data-topbar>
            <ul class="title-area">
            	<?php if( get_theme_mod( 'wpforge_nav_title' ) == 'yes') { ?>
                    <li class="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_theme_mod( 'wpforge_nav_text' ); ?>" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
                    </li>
                <?php } else { ?>
                    <li class="name">
                        <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                    </li>
                <?php } // end if ?>              
                <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wpforge' ); ?></span></a></li>
            </ul>
            <section class="top-bar-section">
                <?php
                wp_nav_menu( array(
                    'theme_location' => 'primary',
                    'container' => false,
                    'depth' => 0,
                    'items_wrap' => '<ul class="right">%3$s</ul>',
                    'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                    'walker' => new wpforge_walker( array(
                        'in_top_bar' => true,
                        'item_type' => 'li',
                        'menu_type' => 'main-menu'
                    ) ),
                ) );
                ?>
            </section>
        </nav>
    </div>    

<?php } // end if ?>

<?php if( get_theme_mod( 'wpforge_nav_position' ) == 'sticky') { ?>

    <div class="row">
        <div class="navcontainer large-12 columns">
        	<div class="contain-to-grid sticky">
                <nav class="top-bar" data-topbar>
                    <ul class="title-area">
                    <?php if( get_theme_mod( 'wpforge_nav_title' ) == 'yes') { ?>
                        <li class="name">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo get_theme_mod( 'wpforge_nav_text' ); ?>" rel="home"><?php echo get_theme_mod( 'wpforge_nav_text' ); ?></a>
                        </li>
                    <?php } else { ?>
                        <li class="name">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
                        </li>
                    <?php } // end if ?> 
                        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                        <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wpforge' ); ?></span></a></li>
                    </ul>
                    <section class="top-bar-section">
                        <?php
                        wp_nav_menu( array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'depth' => 0,
                            'items_wrap' => '<ul class="left">%3$s</ul>',
                            'fallback_cb' => 'wpforge_menu_fallback', // workaround to show a message to set up a menu
                            'walker' => new wpforge_walker( array(
                                'in_top_bar' => true,
                                'item_type' => 'li',
                                'menu_type' => 'main-menu'
                            ) ),
                        ) );
                        ?>
                    </section>
                </nav>
            </div><!-- contain-to-grid sticky -->
        </div><!-- .columns -->    
    </div><!-- .row -->

<?php } // end if ?>