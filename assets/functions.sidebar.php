<?php
	// Exit if access directly
	if (!defined('ABSPATH')) exit;

/* if(!function_exists("skeleton_sidebar_classes")) {
	function skeleton_sidebar_classes() {
		global $data;
		$classes = "four columns";
		if(preg_match("/^[1-3]cl/" , $data["layout"])) { // this means it's left
			$classes .= " alpha sidebar left";
		} elseif(preg_match("/^[1-3]cr/" , $data["layout"])) {
			$classes .= " omega sidebar right";
		}

		return 'class="' . $classes . '"';
	}
}

if(!function_exists("skeleton_content_classes")) {
	function skeleton_content_classes() {
		global $data;
		$classes = "twelve columns";
		if(skeleton_get_active_sidebar() == "left") {
			$classes .= "";
		}
	}
} */

// help me!
if(!function_exists("skeleton_get_layout")) {
	function skeleton_get_layout() {
		global $data;

		return $data["layout"];
	}
}

if(!function_exists("skeleton_sidebar_left")) {
	if(skeleton_get_layout() == "2cl") {
		return get_sidebar();
	}
}
add_action("skeleton_content_before", "skeleton_sidebar_left");