<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;
?>

<div class="sidebar">
	<aside class="four columns omega">
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