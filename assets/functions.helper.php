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

if(!function_exists("skeleton_slider")) {
	function skeleton_slider() {
		global $data;
		if(is_array($data['pingu_slider'])) {
			$slider .= '<div class="wrapper slider">';
			$slider .= '<section class="container sliderc">';
			$slider  = '<div class="sixteen columns home-slider">';
			$slider .= '<ul class="slides">';
			$slides  = $data['pingu_slider'];
			foreach($slides as $slide) {
				$slider .= '<li><img src="' . $slide['url'] . '"></li>';
			}
			$slider .= "</ul>";
			$slider .= "</div>";
			$slider .= "</section>";
			$slider .= "</div>";

			echo $slider;
		}

		return false;
	}
}
