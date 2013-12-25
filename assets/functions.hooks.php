<?php

/**
 * Hooks, baby!
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

if(!function_exists("skeleton_content_before")) {
	function skeleton_content_before() {
		do_action("skeleton_content_before");
	}
}

if(!function_exists("skeleton_content_top")) {
	function skeleton_content_top() {
		do_action("skeleton_content_top");
	}
}

if(!function_exists("skeleton_content_bottom")) {
	function skeleton_content_bottom() {
		do_action("skeleton_content_bottom");
	}
}

if(!function_exists("skeleton_content_after")) {
	function skeleton_content_after() {
		do_action("skeleton_content_after");
	}
}

if(!function_exists("skeleton_sidebar_before")) {
	function skeleton_sidebar_before() {
		do_action("skeleton_sidebar_before");
	}
}

if(!function_exists("skeleton_sidebar_after")) {
	function skeleton_sidebar_after() {
		do_action("skeleton_sidebar_after");
	}
}

if(!function_exists("skeleton_content_top")) {
	function skeleton_content_top() {
		do_action("skeleton_content_top");
	}
}

if(!function_exists("skeleton_content_bottom")) {
	function skeleton_content_bottom() {
		do_action("skeleton_content_bottom");
	}
}

if(!function_exists("skeleton_in_header")) {
	function skeleton_in_header() {
		do_action("skeleton_in_header");
	}
}

if(!function_exists("skeleton_header_bottom")) {
	function skeleton_header_bottom() {
		do_action("skeleton_header_bottom");
	}
}

if(!function_exists("skeleton_comments_before")) {
	function skeleton_comments_before() {
		do_action("skeleton_comments_before");
	}
}

if(!function_exists("skeleton_comments_after")) {
	function skeleton_comments_after() {
		do_action("skeleton_comments_after");
	}
}

if(!function_exists("skeleton_container_before")) {
	function skeleton_container_before() {
		do_action("skeleton_container_before");
	}
}

if(!function_exists("skeleton_container_after")) {
	function skeleton_container_after() {
		do_action("skeleton_container_after");
	}
}
