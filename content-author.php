			<?php if ( is_singular() && get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
				<div class="author-info small-12 large-12 cell">
					<div class="author-avatar small-12 medium-12 large-12 columns">
						<?php echo get_avatar( get_the_author_meta( 'user_email' ), apply_filters( 'wpforge_author_bio_avatar_size', 96 ) ); ?>
					</div><!-- .author-avatar -->
					<div class="author-description small-12 large-12 cell">
						<h3><?php printf( __( 'About %s', 'wp-forge' ), get_the_author() ); ?></h3>
						<p><?php the_author_meta( 'description' ); ?></p>
						<div class="author-link">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" rel="author">
								<?php printf( __( 'View all posts by %s <span class="meta-nav">&raquo;</span>', 'wp-forge' ), get_the_author() ); ?>
							</a>
						</div><!-- .author-link	-->
					</div><!-- .author-description -->
				</div><!-- .author-info -->
			<?php endif; ?>
