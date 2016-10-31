<?php
/**
 * The template for displaying 404 pages (Not Found).
 * @since WP-Forge 5.5.1.7
 * @version 6.2.4.2
 */
get_header(); ?>
		<div id="content" class="medium-12 large-12 columns" role="main">
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<nav aria-label="You are here:" role="navigation"><ul class="breadcrumbs">','</ul></nav>'); } ?>
			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e('This is somewhat embarrassing, isn&rsquo;t it?', 'wp-forge'); ?></h1>
				</header>
				<div class="entry-content">
					<p><?php _e( 'The post, page or whatever it was you were looking for doesn&rsquo;t seem to be here. It could have been moved, deleted or maybe the URL you typed or the link you clicked was incorrect in some way.', 'wp-forge' ); ?></p>
					<h3><?php _e( 'Please try again?', 'wp-forge' ); ?></h3>
					<p><?php _e( 'We know this didn&rsquo;t work before but you may want to try another search, only this time make sure the spelling, cApitALiZaTiOn, and punctuation are correct.', 'wp-forge' ); ?></p>
						<p><?php get_search_form(); ?></p>
					<h3><?php _e( 'Contact Us', 'wp-forge' ); ?></h3>
					<p><?php _e( 'If you are absolutely certain it was supposed to be here and just can&rsquo;t seem to find it, please let us know. We would be more than happy to look into the matter for you and let you know what happened.', 'wp-forge' ); ?></p>
					<h3><?php _e( 'Don&rsquo;t go just yet! We have other great stuff!', 'wp-forge' ); ?></h3>
					<p><?php _e( 'Even though you couldn&rsquo;t find what you were looking for, we do have other great content to offer. Use the lists below to find something new and exciting: ', 'wp-forge' ); ?></p>
					<div class="row">
					<div class="small-12 medium-3 large-3 column">
						<h4>Recent Posts</h4>
						<?php
							$recent_posts = wp_get_recent_posts(array('post_status' => 'publish'));
							foreach( $recent_posts as $recent ){
								echo '<li><a href="' . get_permalink($recent["ID"]) . '">' .   $recent["post_title"].'</a> </li> ';
							}
						?>
					</ul>
					</div>
					<div class="small-12 medium-3 large-3 column">
						<h4>Popular Categories</h4>
						<?php wp_list_categories('number=10&show_count=1&orderby=count&order=DESC&title_li=') ?>
					</div>

					<div class="small-12 medium-3 large-3 column">
						<h4>Monthly Archives</h4>
							<?php wp_get_archives( array( 'type' => 'monthly', 'limit' => 12 ) ); ?>
					</div>
					<div class="small-12 medium-3 large-3 column">
						<h4>Popular Tags</h4>
							<?php wp_tag_cloud( 'smallest=10&largest=40&number=50&orderby=count' ); ?>
					</div>
				</div><!-- end row -->
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->
		</div><!-- #content -->
<?php get_footer(); ?>
