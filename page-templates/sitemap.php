<?php
/**
 * Template Name: Sitemap Template
 * Template Post Type: page
 */
get_header(); ?>
	<div id="content" class="small-12 large-12 cell" role="main">
		<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>
		<h1 class="pagetitle"><?php the_title(); ?></h1>
		<div class="grid-x grid-padding-x">
				<div class="site-map-left medium-9 large-9 cell">
					<h5><?php _e("All Posts", 'wp-forge'); ?></h5>
					<?php
					$numposts = get_theme_mod( 'wpforge_sitemap_count' );
					$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
					query_posts('showposts='.$numposts.'&paged=' . $paged); ?>
					<?php while (have_posts()) : the_post(); ?>
						<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php wpforge_article_schema('CreativeWork'); ?>>
							<header class="entry-header">
									<h5 class="entry-title">
										<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-forge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
									</h5>
								<div class="entry-meta-header">
									<?php wpforge_entry_meta_header(); ?>
									<?php if ( comments_open() ) : ?>
										<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wp-forge' ) . '</span>', __( '1 Comment', 'wp-forge' ), __( '% Comments', 'wp-forge' ) ); ?>
									<?php endif; // comments_open() ?>
								</div><!-- end .entry-meta-header -->
							</header><!-- .entry-header -->
							<div class="entry-content">
								<?php the_excerpt(); ?>
							</div><!-- .entry-content -->
						</article><!-- #post -->
					<?php endwhile; ?>
				</div><!-- end site-map-left -->
				<div class="site-map-right medium-3 large-3 cell">
					<h5><?php _e("Site Feeds", 'wp-forge'); ?></h5>
					<ul class="archives">
						<li><a href="<?php bloginfo('rss2_url'); ?>" rel="alternate" target="_blank"><?php _e("Main RSS Feed", 'wp-forge'); ?></a></li>
						<li><a href="<?php bloginfo('comments_rss2_url'); ?>" rel="alternate" target="_blank"><?php _e("Comments RSS Feed", 'wp-forge'); ?></a></li>
					</ul>
					<h5><?php _e("Pages", 'wp-forge'); ?></h5>
					<ul class="archives">
						<?php wp_list_pages('title_li='); ?>
					</ul>
					<h5><?php _e("Monthly Archives", 'wp-forge'); ?></h5>
					<ul class="archives">
						<?php wp_get_archives('show_post_count=1'); ?>
					</ul>
					<h5><?php _e("Categories", 'wp-forge'); ?></h5>
					<ul class="archives">
						<?php wp_list_categories('title_li=&show_count=1'); ?>
					</ul>
					<h5><?php _e("Top 20 Tags", 'wp-forge'); ?></h5>
					<?php wp_tag_cloud('smallest=8&largest=20'); ?>
				</div><!-- end site-map-right -->
			<footer class="entry-meta small-12 large-12 cell">
				<?php wpforge_content_nav( 'nav-below' ); ?>
			</footer><!-- .entry-meta -->
		</div>
	</div><!-- #content -->
<?php get_footer(); ?>