<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;
?>

<?php skeleton_sidebar_before(); ?>
<div class="sidebar">
	<aside class="four columns alpha">
		<?php if(!dynamic_sidebar()) : ?>
		<div class="widget-wrapper">
			<div class="widget-title"><?php _e("In Archive", "skeleton_wordpress") ?></div>
			<ul>
				<?php wp_get_archives(array('type' => 'monthly', 'limit' => 6)); ?>
			</ul>
		</div>
		<?php endif; ?>
	</aside>
</div>
<?php skeleton_sidebar_after(); ?>