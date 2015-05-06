<?php
/**
 * The template for displaying Archive pages.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, WP-Forge already
 * has tag.php for Tag archives, category.php for Category archives, and
 * author.php for Author archives.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 */

get_header(); ?>

	<div id="content" class="medium-8 large-8 columns" role="main">
    
    	<?php if ( function_exists('yoast_breadcrumb') ) { yoast_breadcrumb('<p class="breadcrumbs">','</p>'); } ?>

		<?php if ( have_posts() ) : ?>
			<header class="archive-header">
				<h4 class="archive-title"><?php
					if ( is_day() ) :
						printf( __( 'Daily Archives: %s', 'wp-forge' ), '<span>' . get_the_date() . '</span>' );
					elseif ( is_month() ) :
						printf( __( 'Monthly Archives: %s', 'wp-forge' ), '<span>' . get_the_date( _x( 'F Y', 'monthly archives date format', 'wp-forge' ) ) . '</span>' );
					elseif ( is_year() ) :
						printf( __( 'Yearly Archives: %s', 'wp-forge' ), '<span>' . get_the_date( _x( 'Y', 'yearly archives date format', 'wp-forge' ) ) . '</span>' );
					elseif ( is_tax( 'post_format', 'post-format-aside' ) ) :
						_e( 'Asides', 'wp-forge' );
						
					elseif ( is_tax( 'post_format', 'post-format-audio' ) ) :
						_e( 'Audio', 'wp-forge' );
						
					elseif ( is_tax( 'post_format', 'post-format-chat' ) ) :
						_e( 'Chats', 'wp-forge' );						
						
					elseif ( is_tax( 'post_format', 'post-format-gallery' ) ) :
						_e( 'Galleries', 'wp-forge' );
						
					elseif ( is_tax( 'post_format', 'post-format-image' ) ) :
						_e( 'Images', 'wp-forge' );						
						
					elseif ( is_tax( 'post_format', 'post-format-link' ) ) :
						_e( 'Links', 'wp-forge' );																
						
					elseif ( is_tax( 'post_format', 'post-format-quote' ) ) :
						_e( 'Quotes', 'wp-forge' );
						
					elseif ( is_tax( 'post_format', 'post-format-status' ) ) :
						_e( 'Status', 'wp-forge' );												

					elseif ( is_tax( 'post_format', 'post-format-video' ) ) :
						_e( 'Videos', 'wp-forge' );
						
					else :
						_e( 'Archives', 'wp-forge' );
					endif;
				?></h4>
			</header><!-- .archive-header -->

			<?php
			/* Start the Loop */
			while ( have_posts() ) : the_post();

				/* Include the post format-specific template for the content. If you want to
				 * this in a child theme then include a file called content-___.php
				 * (where ___ is the post format) and that will be used instead.
				 */
				get_template_part( 'content', get_post_format() );

			endwhile;

			wpforge_content_nav( 'nav-below' );
			?>

		<?php else : ?>
			<?php get_template_part( 'content', 'none' ); ?>
		<?php endif; ?>

		</div><!-- #content -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>