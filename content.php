<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.5.1.7
 *
 * @version 5.5.2.5
 */
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<header class="entry-header">
			<?php  if( get_theme_mod( 'wpforge_cat_display','yes' ) == 'yes') { ?>
				<?php  if( get_theme_mod( 'wpforge_cat_position','top' ) == 'top') { ?>
					<?php wpforge_entry_meta_categories(); ?>
				<?php } // end if ?>
			<?php } // end if ?>
			<?php if ( is_single() ) : ?>
				<h1 class="entry-title"><?php the_title(); ?></h1>
			<?php else : ?>
				<h1 class="entry-title">
					<a href="<?php the_permalink(); ?>" title="<?php echo esc_attr( sprintf( __( 'Permalink to %s', 'wp-forge' ), the_title_attribute( 'echo=0' ) ) ); ?>" rel="bookmark"><?php the_title(); ?></a>
				</h1>
			<?php endif; // is_single() ?>
			<div class="entry-meta-header">
				<?php  if( get_theme_mod( 'wpforge_meta_display','yes' ) == 'yes') { ?>
					<?php wpforge_entry_meta_header(); ?>
				<?php } // end if ?>
				<?php if ( comments_open() ) : ?>			
					<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wp-forge' ) . '</span>', __( '1 Comment', 'wp-forge' ), __( '% Comments', 'wp-forge' ) ); ?>
				<?php edit_post_link( __( 'Edit', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span>','</span>' ); ?>
				<?php else : ?>
				<?php edit_post_link( __( 'Edit', 'wp-forge' ), '<span class="edit-link-none"><span class="genericon genericon-edit"></span>','</span>' ); ?>								
				<?php endif; // comments_open() ?>
			</div><!-- end .entry-meta-header -->
			<?php if ( is_single() ) : ?>
	            <?php if ( get_theme_mod( 'wpforge_single_thumb_display' ) == 'yes' ) : // Show thumbnail in single post view if theme customizer option is set to yes ?>
	            	<?php the_post_thumbnail(); ?>
	            <?php endif; // end if ?>
            <?php endif; // end if ?>
			<?php if ( is_home() && get_theme_mod( 'wpforge_thumb_display' ) == 'yes' ) : // Display thumbnail on home page if theme customizer option is set to yes ?>
            	<?php the_post_thumbnail(); ?>
            <?php endif; // end if ?>
		</header><!-- .entry-header -->
		<?php if ( is_home() && get_theme_mod( 'wpforge_post_display' ) == 'excerpt' ) : // Display Excerpts if theme customizer option is set to excerpt ?>
            <div class="entry-summary">
                <?php the_excerpt(); ?>
            </div><!-- .entry-summary -->
		<?php else : ?>
            <div class="entry-content">
                <?php the_content( __( 'Continue reading <span class="meta-nav">&raquo;</span>', 'wp-forge' ) ); ?>
                <?php wp_link_pages( array( 'before' => '<div class="page-links">' . __( 'Pages:', 'wp-forge' ), 'after' => '</div>' ) ); ?>
            </div><!-- .entry-content -->
		<?php endif; // end if ?>
		<footer class="entry-meta">
			<div class="entry-meta-footer">
				<?php  if( get_theme_mod( 'wpforge_cat_display' ) == 'yes') { ?>
					<?php  if( get_theme_mod( 'wpforge_cat_position' ) == 'bottom') { ?>
						<?php wpforge_bottom_meta_categories(); ?>
					<?php } // end if ?>
				<?php } // end if ?>
				<?php  if( get_theme_mod( 'wpforge_tag_display','yes' ) == 'yes') { ?>
					<?php wpforge_entry_meta_footer(); ?>
				<?php } // end if ?>
			</div><!-- end .entry-meta-footer -->
				<?php get_template_part( 'content', 'author' ); ?>
		</footer><!-- .entry-meta -->
	</article><!-- #post -->