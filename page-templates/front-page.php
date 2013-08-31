<?php
/**
 * Template Name: Front Page Template
 *
 * Description: A page template that provides a key component of WordPress as a CMS
 * by meeting the need for a carefully crafted introductory page. The front page template
 * in WP-Forge consists of a page content area for adding text, images, video --
 * anything you'd like.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 1.0
 */

get_header(); ?>

		<div id="content" class="large-12 columns" role="main">

			<?php while ( have_posts() ) : the_post(); ?>
            
				<?php if ( has_post_thumbnail() ) : ?>
                
					<div class="large-6 columns front-image">
						<?php the_post_thumbnail(); ?>
					</div><!-- /columns --> 
                                   
                    <div class="large-6 columns front-content">
                    	<?php get_template_part( 'content', 'page' ); ?>
                    </div><!-- /columns -->
                    
                <?php else : ?>
                    
                    <?php get_template_part( 'content', 'page' ); ?>
                                      
				<?php endif; ?>

			<?php endwhile; // end of the loop. ?>

		</div><!-- #content -->
<?php get_sidebar( 'front' ); ?>        
<?php get_footer(); ?>