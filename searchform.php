<?php
/**
 * The template for displaying the search form.
 *
 * @package WordPress
 * @subpackage WP_Forge
 * @since WP-Forge 5.2.0
 */
?>

<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="row collapse">
		<div class="large-9 columns">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'wpforge'); ?>">
		</div>
		<div class="large-3 columns">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'wpforge'); ?>" class="button postfix">
		</div>
	</div>
</form>