<article id="post-<?php the_ID(); ?>" <?php post_class(); ?> <?php wpforge_article_schema( 'CreativeWork' ); ?>>
	<header class="entry-header">
		<?php  if( get_theme_mod( 'wpforge_cat_display','yes' ) == 'yes') { ?>
			<?php  if( get_theme_mod( 'wpforge_cat_position','top' ) == 'top') { ?>
				<?php wpforge_entry_meta_categories(); ?>
			<?php } // end if ?>
		<?php } // end if ?>
			<?php if ( is_single() ) : ?>
				<?php the_title( '<h1 class="entry-title-post" itemprop="headline">', '</h1>' ); ?>
			<?php else : ?>
				<?php the_title( sprintf( '<h2 class="entry-title-post" itemprop="headline"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			<?php endif; // is_single() ?>
		<div class="entry-meta-header">
			<a class="entry-format" href="<?php echo esc_url( get_post_format_link( 'chat' ) ); ?>" title="View all Chat Posts"><span class="genericon genericon-chat"></span> <?php echo get_post_format_string( 'chat' ); ?></a>
			<?php wpforge_entry_meta_header(); ?>
			<?php if ( comments_open() ) : ?>
				<span class="genericon genericon-comment"></span> <?php comments_popup_link( '<span class="leave-reply">' . __( 'Comment', 'wp-forge' ) . '</span>', __( '1 Comment', 'wp-forge' ), __( '% Comments', 'wp-forge' ) ); ?>
			<?php endif; // comments_open() ?>
			<?php edit_post_link( __( 'Edit', 'wp-forge' ), '<span class="edit-link"><span class="genericon genericon-edit"></span> ', '</span>' ); ?>
		</div><!-- end .entry-meta-header -->
	</header><!-- .entry-header -->
	<div class="entry-content-post" itemprop="text">
		<?php the_content(); ?>
		<?php wp_link_pages( array( 'before' => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'wp-forge' ) . '</span>', 'after' => '</div>', 'link_before' => '<span>', 'link_after' => '</span>' ) ); ?>
	</div><!-- .entry-content -->
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
