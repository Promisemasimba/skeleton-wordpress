<?php

/**
 * Little helper functions that really have no other place
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * Adds the slider to the home page
 * @return bool
 */
if(!function_exists("skeleton_slider")) {
	function skeleton_slider() {
		global $data;
		if(is_array($data['pingu_slider']) && $data["pingu_slider"]["url"] != "") {
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

if(!function_exists("skeleton_logo")) {
	function skeleton_logo() {
		global $data;
		echo '<a href="' . get_bloginfo("url") . '"><img src="' . $data["logo"] . '" alt="' . get_bloginfo('name') . '"></a>';
	}
}

if(!function_exists("skeleton_logo_exists")) {
	function skeleton_logo_exists() {
		global $data;
		if(isset($data["logo"])) {
			return TRUE;
		}

		return FALSE;
	}
}

if(!function_exists("logo_exists")) {
	function logo_exists() {
		if(get_header_image() != "" || skeleton_logo_exists()) {
			return TRUE;
		}

		return FALSE;
	}
}
