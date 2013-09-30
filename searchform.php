<?php
/**
 * The template for displaying search forms in Twenty Eleven
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.3
 */
?>
<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="s" class="assistive-text"><?php _e( 'Search', 'skeleton_wordpress' ); ?></label>
	<input type="search" class="field" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'skeleton_wordpress' ); ?>">
	<input type="submit" class="submit" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'skeleton_wordpress' ); ?>">
</form>
