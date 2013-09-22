<?php

/**
 * Little helper functions that really have no other place
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

if(!function_exists("skeleton_header_image_helper_width")) {
	function skeleton_header_image_helper_width() {
		if(function_exists("get_custom_header")) {
			return get_custom_header()->width;
		}

		return HEADER_IMAGE_WIDTH;
	}
}