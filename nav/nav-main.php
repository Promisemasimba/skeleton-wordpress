<?php
if ( !defined('ABSPATH')) exit;

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

/*
 * ADDITIONAL INFORMATION
 * Changing container to a div:
 * 'container' => 'div'
 */
?>

<?php if(has_nav_menu("main-nav")) : // does the menu exist? ?>
<div class="wrapper nav">
<?php
	wp_nav_menu(
		array(
			'container'			=> 'nav', 						// may be replaced with a div
			'container_class'	=> 'container', 				// do not change
			'container_id'		=> 'nav', 						// do not change
			'fallback_cb'		=> false,
			'menu_class'		=> 'sixteen columns main-nav',	// do not change
			'theme_location'	=> 'main-nav'
		)
	);
?>
</div><!-- /.wrapper.nav -->
<?php endif; ?>