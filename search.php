<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

get_header(); ?>

	<div id="content" class="medium-8 large-8 columns" role="main">
    
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h3><?php printf( __( 'Search Results for: %s', 'wp-forge' ), '<span>' . get_search_query() . '</span>' ); ?></h3>
			</header>

			<?php /* Start the Loop */ ?>
			<?php while ( have_posts() ) : the_post(); ?>
				<?php get_template_part( 'content', 'loop' ); ?>
			<?php endwhile; ?>

			<?php wpforge_content_nav( 'nav-below' ); ?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

	</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>