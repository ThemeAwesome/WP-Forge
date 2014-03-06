<?php
/**
 * The template for displaying related posts at the end of single posts. related posts are based on tags
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */
?>
<?php if( get_theme_mod( 'wpforge_related_posts' ) == 'links') { ?>

<div class="related clearfix">
        
<?php
	$original_post = $post;
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) {
			$tagIDs[$i] = $tags[$i]->term_id;
		}
	$args=array(
	'tag__in' => $tagIDs,
	'post__not_in' => array($post->ID),
	'showposts'=>$wpforge_related_count,
	'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
	echo '<h4>'. __('Other Posts You May Be Interested In', 'wpforge'). ':</h4><ul>';
	while ($my_query->have_posts()) : $my_query->the_post(); ?>
			<li class="links"><a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title_attribute(); ?>"><?php the_title(); ?></a></li>
	<?php endwhile;
	echo '</ul>';
	}
	}
	else {
	echo '<h3>'. __('Other Posts You May Be Interested In', 'wpforge'). ':</h3>
	'. __('There are no related posts at this time.', 'wpforge'). '';
	}	
	$post = $original_post;
	wp_reset_query();
	?>
            
</div><!-- end related -->
        
<?php } // end if ?>
	
<?php if( get_theme_mod( 'wpforge_related_posts' ) == 'images') { ?>	

<div class="related clearfix">
        
<?php
	$original_post = $post;
	$tags = wp_get_post_tags($post->ID);
	$tagIDs = array();
	if ($tags) {
		$tagcount = count($tags);
		for ($i = 0; $i < $tagcount; $i++) {
			$tagIDs[$i] = $tags[$i]->term_id;
		}
	$args=array(
	'tag__in' => $tagIDs,
	'post__not_in' => array($post->ID),
	'showposts'=>$wpforge_related_count,
	'caller_get_posts'=>1
);
$my_query = new WP_Query($args);
if( $my_query->have_posts() ) {
	echo '<h4>'. __('Other Posts You May Be Interested In', 'wpforge'). ':</h4><ul>';
	while ($my_query->have_posts()) : $my_query->the_post(); ?>
    
			<li class="imglink">
            
		<?php if ( has_post_thumbnail() ) { ?>
		
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">

				<?php the_post_thumbnail('related-image'); ?>
    
    		</a>		
		 
		<? } else { ?>
        
			<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title(); ?>">
            
            	<img src="<?php echo stripslashes($wpforge_default); ?>" width="85" height="85" alt="<?php the_title(); ?>" />
                
            </a>
                
		<?php } ?>
                
            </li>
	<?php endwhile;
	echo '</ul>';
	}
	}
	else {
	echo '<h3>'. __('Other Posts You May Be Interested In', 'wpforge'). ':</h3>
	'. __('There are no related posts at this time.', 'wpforge'). '';
	}	
	$post = $original_post;
	wp_reset_query();
	?>
            
</div><!-- end related -->
        
<?php } // end if ?>       