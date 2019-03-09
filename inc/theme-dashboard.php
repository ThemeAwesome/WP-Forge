<?php
// Load CSS
if ( ! function_exists( 'wpforge_load_admin_scripts' ) ) {
    function wpforge_load_admin_scripts() {
        wp_enqueue_style('dashboard-css', get_template_directory_uri() . '/css/admin.css');
    }
    add_action( 'admin_enqueue_scripts', 'wpforge_load_admin_scripts' );
}
// Add theme page
if ( ! function_exists( 'wpforge_theme_info' ) ) {
    function wpforge_theme_info() {
        $menu_title = esc_html__('WP-Forge', 'wp-forge');
        add_theme_page( esc_html__('WP-Forge', 'wp-forge'),$menu_title,'edit_theme_options','wpforge','wpforge_theme_info_page');
    }
    add_action('admin_menu', 'wpforge_theme_info');
}
// Admin notice - Shows just one time
if ( ! function_exists( 'wpforge_admin_notice' ) ) {
    function wpforge_admin_notice() { 
        $theme_data = wp_get_theme();?>
        <div class="update notice notice-success notice-alt is-dismissible">
            <p><?php printf( esc_html__( 'Thank you for choosing %1$s! Please take a minute and visit the %2$s', 'wp-forge' ),  $theme_data->Name, '<a href="'.esc_url( add_query_arg( array( 'page' => 'wpforge' ), admin_url( 'themes.php' ) ) ).'">'.esc_html__( 'Welcome Page', 'wp-forge' ).'</a>'  ); ?></p>
        </div>
        <?php
    }
}
// Activation notice
if ( ! function_exists( 'wpforge_admin_notice_activation' ) ) {
    function wpforge_admin_notice_activation(){
        global $pagenow;
        if ( is_admin() && ('themes.php' == $pagenow) && isset( $_GET['activated'] ) ) {
            add_action( 'admin_notices', 'wpforge_admin_notice' );
        }
    }
    add_action( 'load-themes.php',  'wpforge_admin_notice_activation');
}
function wpforge_theme_info_page() {
    $theme_data = wp_get_theme('wp-forge');
    $tab = null;
    if ( isset( $_GET['tab'] ) ) {
        $tab = $_GET['tab'];
    } else {
        $tab = null;
}
?>
    <div class="wrap about-wrap theme_info_wrapper">
        <h1><?php printf( esc_html__('%s %1s', 'wp-forge'), $theme_data->Name, $theme_data->Version ); ?></h1>
        <div class="about-text">
            <?php esc_html_e('A WordPress theme built using the latest version of Foundation for Sites (6.5.3), from Zurb, the most advanced responsive front-end framework in the world. By combining WordPress and Foundation for Sites you get a resposive WordPress theme that makes creating websites fun and exciting again!','wp-forge'); ?>
        </div><!-- end about-text -->
        <a target="_blank" href="<?php echo esc_url('https://themeawesome.com/'); ?>" class="theme-badge wp-badge"><span>ThemeAWESOME</span></a>
        <h2 class="nav-tab-wrapper">
            <a href="?page=wpforge" class="nav-tab<?php echo is_null($tab) ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Get Started','wp-forge') ?></a>
            <a href="?page=wpforge&tab=support" class="nav-tab<?php echo $tab == 'support' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Support', 'wp-forge'); ?></a>
            <a href="?page=wpforge&tab=themes" class="nav-tab<?php echo $tab == 'themes' ? ' nav-tab-active' : null; ?>"><?php esc_html_e('Try TotalPress!','wp-forge'); ?></span></a>
        </h2><!-- end nav-tab-wrapper -->
        <?php if ( is_null( $tab ) ) { ?>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="small-12 large-4 cell">
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Theme Customizer', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('%s uses the Theme Customizer for all theme settings. Click "Customize WP-Forge" to start personalizing your site.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p><a href="<?php echo esc_url( admin_url('customize.php') ); ?>" class="button button-primary"><?php esc_html_e('Customize WP-Forge', 'wp-forge'); ?></a></p>
                        </div><!-- end theme_link -->
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Theme Documentation', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('Need any help to setup and configure %s? Please read the theme documentation.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p><a href="<?php echo esc_url( 'https://themeawesome.com/docs/wp-forge/' ); ?>" target="_blank" class="button button-primary"><?php esc_html_e('WP-Forge Documentation', 'wp-forge'); ?></a>
                            </p></div><!-- end theme_link -->
                        <div class="theme_link">
                            <h3><?php esc_html_e( 'Having Trouble, Need some help?', 'wp-forge' ); ?></h3>
                            <p class="about"><?php printf(esc_html__('Support for %s is provided through the WordPress Support Forums.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p><a href="<?php echo esc_url('https://wordpress.org/support/theme/wp-forge' ); ?>" target="_blank" class="button button-primary"><?php echo sprintf( esc_html__('Visit Support Forums', 'wp-forge'), $theme_data->Name); ?></a></p>
                        </div><!-- end theme_link -->
                    </div><!-- end cell -->
                    <div class="theme-image small-12 large-auto cell">
                        <img src="<?php echo get_template_directory_uri(); ?>/screenshot.png" alt="Theme Screenshot" />
                        <p class="cntr"><strong><?php esc_html_e( 'What do you think of WP-Forge?', 'wp-forge' ); ?></strong><br />
                        <?php _e('Please <a target="_blank" href="https://wordpress.org/support/theme/wp-forge/reviews/">rate and review WP-Forge</a> on WordPress.org.', 'wp-forge'); ?><br />
                        <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
                    </div><!-- end theme_info_right -->
            </div><!-- end theme_info_wrapper -->
        <?php } ?>

        <?php if ( $tab == 'support' ) { ?>
            <div class="theme-support grid-container"><div class="grid-x grid-padding-x"><div class="mall-12 large-auto cell"><h3><span class="dashicons dashicons-edit"></span> Contact Support</h3><p>I hope you will enjoy using WP-Forge, as much as I've enjoyed creating it. <br/><br/>If you have any questions, concerns, please feel free to contact me anytime.</p><p><a class="button button-primary" href="https://themeawesome.com/contact/" target="_blank">Contact Support</a></p></div><div class="small-12 large-auto cell"><h3><span class="dashicons dashicons-book"></span> Documentation</h3><p>Read the full documentation to learn how to set up and use WP-Forge right out of the box.</p><p> You will also find documentation on how to use some of the hidden benefits of TotalPress.</p><p><a class="button button-primary" href="https://themeawesome.com/docs/wp-forge/" target="_blank">WP-Forge Documentation</a></p></div><div class="small-12 large-auto cell"><h3><span class="dashicons dashicons-chart-line"></span> Changelog</h3><p>Want to get brought up to speed and stay updated on the latest theme changes? <br/><br/>View the latest changes, fixes and features implemented in the latest verion of WP-Forge.</p><p><a class="button button-primary" href="https://github.com/ThemeAwesome/wp-forge/blob/master/CHANGELOG.md" target="_blank">View the Changelog</a></p></div></div></div>
        <?php } ?>
        <?php if ( $tab == 'themes' ) { ?>
            <div class="grid-container">
                <div class="grid-x grid-padding-x">
                    <div class="small-12 large-4 cell">
                        <div class="theme_link">
                            <h2><?php esc_html_e( 'TotalPress', 'wp-forge' ); ?></h2>
                            <p class="about-totalpress"><?php printf(__('My name is TotalPress! I&#39;m a WordPress Foundation for Sites theme based off _s (Underscores). This means I&#39;m responsive and look good on any device. I have a lot of hooks and filters, ten (10) widget areas and six (6) different sidebar page templates. I use the Kirki plugin for the theme customizer and the Meta Box plugin for post and page metaboxes. Did I mention that I work really well with page builders like Elementor and Header Footer Elementor. Download me today and take me for a spin.', 'wp-forge'), $theme_data->Name); ?></p>
                            <p>
                                <a href="<?php echo esc_url('https://wordpress.org/themes/totalpress/'); ?>" class="button button-primary" target="_blank"><?php esc_html_e('Download Today', 'wp-forge'); ?></a>
                            </p>
                        </div><!-- end theme_link -->
                    </div><!-- end theme_info_left -->

                    <div class="theme-image small-12 large-auto cell">
                        <img src="https://i.imgur.com/cPMtZVm.png" alt="TotalPress" />
                        <p class="cntr"><strong><?php esc_html_e('If you use TotalPress, let me know what you think.','wp-forge'); ?></strong><br />
                        <?php _e('Please <a target="_blank" href="https://wordpress.org/support/theme/totalpress/reviews/">rate and review TotalPress</a> on WordPress.org.', 'wp-forge'); ?><br />
                        <span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span><span class="dashicons dashicons-star-filled"></span></p>
                    </div><!-- end theme_info_right -->
                </div><!-- end columns -->
            </div><!-- end row -->
        <?php } ?>

        <?php do_action( 'wpforge_more_tabs_details', $tab ); ?>

    </div> <!-- END .theme_info -->
    <script type="text/javascript">
        jQuery(document).ready(function( $ ){
            $('body').addClass('about-php');
        } );
    </script>
    <?php
}