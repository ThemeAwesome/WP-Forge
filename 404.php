<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

get_header(); ?>

		<div id="content" class="medium-12 large-12 columns" role="main">
        
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

			<article id="post-0" class="post error404 no-results not-found">

				<header class="entry-header">

					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wp-forge' ); ?></h1>

				</header>

				<div class="entry-content">

					<p><?php _e( 'The post, page or whatever it was you were looking for doesn&rsquo;t seem to be here. It could have been moved, deleted or maybe the URL you typed or the link you clicked was incorrect in some way.', 'wp-forge' ); ?></p>

					<h5><b><?php _e( 'Try Again?', 'wp-forge' ); ?></b></h5>

					<p><?php _e( 'I know this didn&rsquo;t work before but you may want to try searching again, only this time make sure the spelling, cApitALiZaTiOn, and punctuation are correct.', 'wp-forge' ); ?></p>

						<form style="display:inline;" action="<?php echo esc_url( home_url( '/' ) ); ?>">

							<div class="row collapse">

							<div class="large-5 medium-5 small-12 columns">

							<input type="text" value="<?php echo esc_attr($s); ?>" id="s" name="s" /> 

							</div>

							<input class="tiny button" type="submit" value="<?php _e('Search', 'wp-forge'); ?>" />

						</form>

					<h5><b><?php _e( 'Contact Us', 'wp-forge' ); ?></b></h5>

					<p><?php _e( 'If you are absolutely certain it was supposed to be here and just can&rsquo;t seem to find it, please let us know. We would be more than happy to look into the matter for you and let you know what happened.', 'wp-forge' ); ?></p>

					<h5><b><?php _e( 'Why not try something new?', 'wp-forge' ); ?></b></h5>

					<p><?php _e( 'Even though you couldn&rsquo;t find a particular item on our site, we do have other great stuff to look at. Maybe we can interest you in some of our other exciting content. Below is a list of our newest posts. ', 'wp-forge' ); ?></p>

  					<ul>
						<?php
							$recent_posts = wp_get_recent_posts(array('post_status' => 'publish'));
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
							}
						?>
					</ul>

				</div><!-- .entry-content -->
				
			</article><!-- #post-0 -->

		</div><!-- #content -->

<?php get_footer(); ?>