<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.2
 */

get_header(); ?>

		<div id="content" class="medium-12 large-12 columns" role="main">
        
        <?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<ul class="breadcrumbs">','</ul>'); } ?>

			<article id="post-0" class="post error404 no-results not-found">
				<header class="entry-header">
					<h1 class="entry-title"><?php _e( 'This is somewhat embarrassing, isn&rsquo;t it?', 'wpforge' ); ?></h1>
				</header>

				<div class="entry-content">
					<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'wpforge' ); ?></p>
					<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
						<div class="row collapse">
							<div class="medium-10 large-10 columns">
								<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'wpforge'); ?>">
							</div>
							<div class="medium-2 large-2 columns">
								<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'wpforge'); ?>" class="button postfix">
							</div>
						</div>
					</form>
				</div><!-- .entry-content -->
			</article><!-- #post-0 -->

		</div><!-- #content -->

<?php get_footer(); ?>