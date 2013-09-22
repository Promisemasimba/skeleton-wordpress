<?php
if ( !defined("ABSPATH")) exit;

/**
 * Top navigation file. This provides the most essential information that is
 * required to make this navigation work in WordPress. See comments on individual
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

<?php if(has_nav_menu("top-nav")) : // does the menu exist? ?>
<div class="wrapper top-navigation">
<?php
	wp_nav_menu(
		array(
			"container"			=> "nav", 						// may be replaced with a div
			// "container"			=> "div", 					// uncommenting changes to div instead of nav
			"container_class"	=> "container",					// do not change
			"container_id"		=> "nav", 						// change if you want, it's there if you need it
			"fallback_cb"		=> false,
			"menu_class"		=> "sixteen columns top-nav",	// do not change
			"theme_location"	=> "top-nav"
		)
	);
?>
</div><!-- /.wrapper.main-navigation -->
<?php endif; ?>