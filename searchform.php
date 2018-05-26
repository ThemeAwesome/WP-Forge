<form role="search" method="get" id="searchform" action="<?php echo home_url('/'); ?>">
	<div class="grid-container">
	<div class="grid-x grid-margin-x large-margin-collapse">
		<div class="small-12 large-9 cell">
			<input type="text" value="" name="s" id="s" placeholder="<?php esc_attr_e('Search', 'wp-forge'); ?>">
		</div><!-- end columns -->
		<div class=" auto cell">
			<input type="submit" id="searchsubmit" value="<?php esc_attr_e('Search', 'wp-forge'); ?>" class="button">
		</div><!-- end columns -->
	</div>
	</div><!-- end .row -->
</form>
