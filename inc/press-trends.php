<?php

function presstrends_theme() {
    // PressTrends Account API Key
    $api_key = 'etyilzsksnrzcnce6gw7p82evmpd416wwgv1';
    $auth = 'ryp88nc9lhbcj01hf9szfxcbc45ayf1wp';
    // Start of Metrics
    global $wpdb;
    $data = get_transient( 'presstrends_theme_cache_data' );
    if ( !$data || $data == '' ) {
        $api_base = 'http://api.presstrends.io/index.php/api/sites/add?auth=';
        $url      = $api_base . $auth . '&api=' . $api_key . '';
        $count_posts    = wp_count_posts();
        $count_pages    = wp_count_posts( 'page' );
        $comments_count = wp_count_comments();
        if ( function_exists( 'wp_get_theme' ) ) {
            $theme_data    = wp_get_theme();
            $theme_name    = urlencode( $theme_data->Name );
            $theme_version = $theme_data->Version;
        } else {
            $theme_data = get_theme_data( get_stylesheet_directory() . '/style.css' );
            $theme_name = $theme_data['Name'];
            $theme_version = $theme_data['Version'];
        }
        $all_plugins = get_plugins();
        $plugin_name = '';
        foreach ( $all_plugins as $plugin_file => $plugin_data ) {
            $plugin_name .= $plugin_data['Name'];
            $plugin_name .= '&';
        }
        $posts_with_comments = $wpdb->get_var( "SELECT COUNT(*) FROM $wpdb->posts WHERE post_type='post' AND comment_count > 0" );
        $avg_time_btw_posts = $wpdb->get_var("SELECT TIMESTAMPDIFF(SECOND, MIN(post_date), MAX(post_date)) / (COUNT(*)-1) FROM $wpdb->posts WHERE post_status = 'publish' AND post_type = 'post'");
        $avg_time_btw_comments = $wpdb->get_var("SELECT TIMESTAMPDIFF(SECOND, MIN(comment_date), MAX(comment_date)) / (COUNT(*)-1) FROM $wpdb->comments WHERE comment_approved = '1'");
        $data                	= array(
            'url'             	=> base64_encode(site_url()),
            'posts'           	=> $count_posts->publish,
            'pages'           	=> $count_pages->publish,
            'comments'        	=> $comments_count->total_comments,
            'approved'        	=> $comments_count->approved,
            'spam'            	=> $comments_count->spam,
            'between_posts'   	=> $avg_time_btw_posts,
            'between_comments'	=> $avg_time_btw_comments,
            'pingbacks'       	=> $wpdb->get_var( "SELECT COUNT(comment_ID) FROM $wpdb->comments WHERE comment_type = 'pingback'" ),
            'post_conversion' 	=> ( $count_posts->publish > 0 && $posts_with_comments > 0 ) ? number_format( ( $posts_with_comments / $count_posts->publish ) * 100, 0, '.', '' ) : 0,
            'theme_version'   	=> $theme_version,
            'theme_name'      	=> $theme_name,
            'site_name'       	=> str_replace( ' ', '', get_bloginfo( 'name' ) ),
            'plugins'         	=> count( get_option( 'active_plugins' ) ),
            'plugin'          	=> urlencode( $plugin_name ),
            'wpversion'       	=> get_bloginfo( 'version' ),
            'api_version'	  	=> '2.4',
        );
        foreach ( $data as $k => $v ) {
            $url .= '&' . $k . '=' . $v . '';
        }
        wp_remote_get( $url );
        set_transient( 'presstrends_theme_cache_data', $data, 60 * 60 * 24 );
    }
}
add_action('admin_init', 'presstrends_theme');

?>