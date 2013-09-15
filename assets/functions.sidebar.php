<?php
// Exit if access directly
if (!defined('ABSPATH')) exit;

add_action("skeleton_content_before", "skeleton_sidebar_left");
add_action("skeleton_content_after", "skeleton_sidebar_right");

// help me!
if(!function_exists("skeleton_get_layout")) {
	function skeleton_get_layout() {
		global $data;

		return $data["layout"];
	}
}

if(!function_exists("skeleton_sidebar_left")) {
	function skeleton_sidebar_left() {
		if(skeleton_get_layout() == "2cl" || skeleton_get_layout() == "3clr") {
			return get_sidebar();
		} elseif(skeleton_get_layout() == "3cl") {
			return get_sidebar() . get_sidebar("left-2");
		}
	}
}

if(!function_exists("skeleton_sidebar_right")) {
	function skeleton_sidebar_right() {
		if(skeleton_get_layout() == "2cr" || skeleton_get_layout() == "3clr") {
			return get_sidebar("right");
		} elseif(skeleton_get_layout() == "3cr") {
			return get_sidebar("right") . get_sidebar("right-2");
		}
	}
}

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
			default :
				$classes[0] = "sixteen";
				break;
		}

		echo count($classes) != 0 ? 'class="' . implode(" ", $classes) . '"' : "";
	}
}