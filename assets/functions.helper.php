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

if(!function_exists("skeleton_get_active_sidebar")) {
	function skeleton_get_active_sidebar() {
		global $data;

		if(preg_match("/^[1-3]cl/", $data["layout"])) {
			$data = "left";
		} elseif(preg_match("/^[1-3]cr/", $data["layout"])) {
			$data = "right";
		} else {
			$data = FALSE;
		}

		return $data;
	}
}