<?php
/**
 * The template for displaying the Top-Bar menu.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */
?>

<div class="nav_container">

<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wp-forge' ); ?></a>

<?php if( get_theme_mod( 'wpforge_nav_position' ) == '') { ?>
    <div class="nav_wrap row">
        <nav class="top-bar" data-topbar data-options="scrolltop:false; mobile_show_parent_link: true;">
            <ul class="title-area">
                <li class="name">
                    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Home')); ?></a>
                </li>
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wp-forge' ); ?></span></a></li>
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
    </div><!-- .row -->
<?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'normal') { ?>

        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="nav_wrap row hide-for-small-only">
        <?php } else { ?>
        <div class="nav_wrap row">
        <?php } // end if ?>
                <nav class="top-bar" data-topbar data-options="scrolltop:false; mobile_show_parent_link: true">
                    <ul class="title-area">
                        <li class="name">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Home')); ?></a>
                        </li> 
                        <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                        <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wp-forge' ); ?></span></a></li>
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
        </div><!-- .row -->

    <?php } // end if ?>

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'top') { ?>
        
        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="hide-for-small-only">
        <?php } else { ?>
        <div class="<?php echo esc_attr(get_theme_mod( 'wpforge_nav_display' )); ?>">
        <?php } // end if ?>
            <nav class="top-bar" data-topbar data-options="scrolltop:false; mobile_show_parent_link: true">
                <ul class="title-area">
                        <li class="name">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Home')); ?></a>
                        </li>
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                    <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wp-forge' ); ?></span></a></li>
                </ul>
                <section class="top-bar-section">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul class="right">%3$s</ul>',
                        'fallback_cb' => '', // workaround to show a message to set up a menu
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

    <?php if( get_theme_mod( 'wpforge_nav_position' ) == 'fixed') { ?>
        
        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="fixed hide-for-small-only">
        <?php } else { ?>
        <div class="fixed row">
        <?php } // end if ?>
            <nav class="top-bar" data-topbar data-options="scrolltop:false; mobile_show_parent_link: true;">
                <ul class="title-area">
                        <li class="name">
                            <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Home')); ?></a>
                        </li>              
                    <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                    <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wp-forge' ); ?></span></a></li>
                </ul>
                <section class="top-bar-section">
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'primary',
                        'container' => false,
                        'depth' => 0,
                        'items_wrap' => '<ul class="right">%3$s</ul>',
                        'fallback_cb' => '', // workaround to show a message to set up a menu
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

        <?php if( get_theme_mod( 'wpforge_mobile_display' ) == 'yes') { ?>
        <div class="nav_wrap row hide-for-small-only">
        <?php } else { ?>
        <div class="nav_wrap row">
        <?php } // end if ?>
                <div class="contain-to-grid sticky">
                    <nav class="top-bar" data-topbar data-options="scrolltop:false; mobile_show_parent_link: true;">
                        <ul class="title-area">
                            <li class="name">
                                <a href="<?php echo esc_url( home_url( '/' ) ); ?>" title="<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>" rel="home"><?php echo esc_attr(get_theme_mod('wpforge_nav_text','Home')); ?></a>
                            </li>
                            <!-- Remove the class "menu-icon" to get rid of menu icon. Take out "Menu" to just have icon alone -->
                            <li class="toggle-topbar menu-icon"><a href="#"><span><?php // _e( 'Menu', 'wp-forge' ); ?></span></a></li>
                        </ul>
                        <section class="top-bar-section">
                            <?php
                            wp_nav_menu( array(
                                'theme_location' => 'primary',
                                'container' => false,
                                'depth' => 0,
                                'items_wrap' => '<ul class="left">%3$s</ul>',
                                'fallback_cb' => '', // workaround to show a message to set up a menu
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
        </div><!-- .row -->

    <?php } // end if ?>

</div><!-- end .nav_container -->