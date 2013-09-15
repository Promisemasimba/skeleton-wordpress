<?php

if(!defined("ABSPATH")) exit;

if(!function_exists("skeleton_content_before")) {
	function skeleton_content_before() {
		do_action("skeleton_content_before");
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