<?php

if(!defined("ABSPATH")) exit;

/**
 * Returns an array of in-depth browser and os information for your use.
 * @return array
 */
if(!function_exists("get_browser_info")) {
	function get_browser_info() {
		$browser = browser_detection("full_assoc");
		return $browser;
	}
}

if(!function_exists("skeleton_footer")) {
	function skeleton_footer() {
		global $data;

		return $data["footer_text"];
	}
}