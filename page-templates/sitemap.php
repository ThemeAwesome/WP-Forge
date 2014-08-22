<?php
/**
 * Template Name: Sitemap Template
 *
 * Description: Use this page template to add a sitemap page to your site.
 *
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.4
 */

get_header(); ?>

	<div id="content" class="medium-12 large-12 columns" role="main">
        
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<h1 class="pagetitle"><?php the_title(); ?></h1>

				<div class="medium-7 large-7 columns sitemap-left">

					<h3><i class="fa fa-pencil-square"></i> <?php _e("Posts", "wpforge"); ?></h3>

					<?php
					$numposts = get_theme_mod( 'wpforge_sitemap_count' ); 
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts('showposts='.$numposts.'&paged=' . $paged); ?>
					<?php while (have_posts()) : the_post(); ?>

						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							<header class="entry-header">
									<h5 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wpforge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h5>
								<div class="entry-meta-header">
									<?php wpforge_entry_meta_header(); ?>
									<?php if ( comments_open() ) : ?>			
										<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wpforge' ) . '</span>', __( '1 Comment', 'wpforge' ), __( '% Comments', 'wpforge' ) ); ?>
									<?php endif; // comments_open() ?>		
								</div><!-- end .entry-meta-header -->
							</header><!-- .entry-header -->
						</article><!-- #post -->

					<?php endwhile; ?>

					<?php wpforge_content_nav( 'nav-below' ); ?>

				</div><!-- end sitemap-left -->

				<div class="medium-5 large-5 columns sitemap-right">

					<h3><i class="fa fa-rss-square"></i> <?php _e("Site Feeds", "wpforge"); ?></h3>
					<ul class="archives">
						<li><a href="<?php bloginfo('rss2_url'); ?>" rel="alternate" target="_blank"><?php _e("Main RSS Feed", "wpforge"); ?></a></li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" rel="alternate" target="_blank"><?php _e("Comments RSS Feed", "wpforge"); ?></a></li>
					</ul>

					<h3><i class="fa fa-file"></i> <?php _e("Pages", "wpforge"); ?></h3>
					<ul class="archives">
						<?php wp_list_pages('title_li='); ?>
					</ul>

					<h3><i class="fa fa-calendar-o"></i> <?php _e("Monthly Archives", "wpforge"); ?></h3>
					<ul class="archives">
						<?php wp_get_archives('show_post_count=1'); ?>
					</ul>

					<h3><i class="fa fa-folder-open"></i> <?php _e("Categories", "wpforge"); ?></h3>
					<ul class="archives">
						<?php wp_list_categories('title_li=&show_count=1'); ?>
					</ul>

					<h3><i class="fa fa-tags"></i> <?php _e("Top 20 Tags", "wpforge"); ?></h3>
					<?php wp_tag_cloud('smallest=8&largest=20'); ?> 			

				</div><!-- end .sitemap-right -->

			<footer class="entry-meta">
				<?php edit_post_link( __( 'Edit Page', 'wpforge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span>', '</span>' ); ?>
			</footer><!-- .entry-meta -->

		</div><!-- #content -->

<?php get_footer(); ?>