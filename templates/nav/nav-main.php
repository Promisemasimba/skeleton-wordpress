<?php
if ( !defined("ABSPATH")) exit;

/**
 * Main navigation file. This provides the most essential information that is
 * required to make this navigation work in wordpress. See comments on individual
 * indexes for what can be changed.
 *
 * @package			skeleton_wordpress
 * @author 			Dennis Thompson <http://atomicpages.net/>
 * @copyright		2009 - 2013 AtomicPages LLC
 * @license			license.txt MIT
 * @version			1.0
 * @since 			1.0
 */
?>

<?php if(has_nav_menu("main-nav")) : // does the menu exist? ?>
<div class="wrapper main-navigation">
<?php
	wp_nav_menu(
		array(
			"container"			=> "nav", 						// may be replaced with a div
			// "container"			=> "div", 					// uncommenting changes to div instead of nav
			"container_class"	=> "container",					// do not change
			"container_id"		=> "nav", 						// change if you want, it's there if you need it
			"fallback_cb"		=> false,
			"menu_class"		=> "sixteen columns main-nav",	// do not change
			"theme_location"	=> "main-nav"
		)
	);
?>
</div><!-- /.wrapper.main-navigation -->
<?php endif; ?>