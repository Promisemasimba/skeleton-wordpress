<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;
?>

<?php
/**
 * This is a generic template for the right sidebar
 *
 * @package WordPress
 * @subpackage Skeleton
 * @author Dennis Thompson
 * @copyright 2009-2013 AtomicPages LLC
 * @license license.txt
 * @since 0.3
 */
?>

<?php if(is_active_sidebar("sidebar-right")) : ?>
	<?php skeleton_sidebar_before(); ?>
	<div class="sidebar">
		<aside class="four columns">
			<div class="widget-wrapper">
			<?php if(!is_dynamic_sidebar()) : // if there are no widgets... ?>
				<div class="widget-title"><?php _e("In Archive", "skeleton_wordpress") ?></div>
				<ul>
					<?php wp_get_archives(array('type' => 'monthly', 'limit' => 6)); ?>
				</ul>
			<?php else : ?>
			<?php dynamic_sidebar("sidebar-right") ?>
			<?php endif; ?>
			</div>
		</aside>
	</div>
	<?php skeleton_sidebar_after(); ?>
<?php endif; ?>
