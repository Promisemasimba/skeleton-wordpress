<?php

/**
 * Where all of the theme layout magic happens
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */

// Exit if access directly
if (!defined('ABSPATH')) exit;

add_action("skeleton_content_before", "skeleton_sidebar_left");
add_action("skeleton_content_after", "skeleton_sidebar_right");

/**
 * Simply returns the current layout that is selected on the admin side
 * @return String
 */
if(!function_exists("skeleton_get_layout")) {
	function skeleton_get_layout() {
		global $data;

		return $data["layout"];
	}
}

/**
 * Returns the LEFT sidebar based on the active layout
 * @return String
 */
if(!function_exists("skeleton_sidebar_left")) {
	function skeleton_sidebar_left() {
		if(skeleton_get_layout() == "2cl" || skeleton_get_layout() == "3clr") {
			return get_sidebar();
		} elseif(skeleton_get_layout() == "3cl") {
			return get_sidebar() . get_sidebar("left-2");
		}
	}
}

/**
 * Returns the RIGHT sidebar based on the active layout
 * @return String
 */
if(!function_exists("skeleton_sidebar_right")) {
	function skeleton_sidebar_right() {
		if(skeleton_get_layout() == "2cr" || skeleton_get_layout() == "3clr") {
			return get_sidebar("right");
		} elseif(skeleton_get_layout() == "3cr") {
			return get_sidebar("right") . get_sidebar("right-2");
		}
	}
}

/**
 * Adds the proper classes to the main and aside elements so everything fits flush
 * @return void
 */
if(!function_exists("skeleton_main_classes")) {
	function skeleton_main_classes() {
		$classes = array("twelve", "columns", "omega"); // default classes
		switch (skeleton_get_layout()) {
			case "2cr" :
				$classes[2] = "alpha";
				break;
			case "3clr" :
				$classes[0] = "eight";
				$classes[2] = "alpha";
				$classes[ ] = "omega";
				break;
			case "3cr" :
				$classes[0] = "eight";
				$classes[2] = "alpha";
				break;
			case "3cl" :
				$classes[0] = "eight";
				break;
			case "2cl" :
				$classes[0] = "twelve";
				break;
			default :
				$classes[0] = "sixteen";
				break;
		}

		echo count($classes) != 0 ? 'class="' . implode(" ", $classes) . ' row"' : "";
	}
}
