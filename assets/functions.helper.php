<?php

/**
 * Little helper functions that really have no other place
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * Adds the slider to the home page
 * @return void
 */
if(!function_exists("skeleton_slider")) {
	function skeleton_slider() {
		global $data;
		if(is_array($data['pingu_slider']) && !empty($data["pingu_slider"][1]["url"])) {
			$slides  = $data['pingu_slider'];
			foreach($slides as $slide) {
				$slider  .= "<li>";
				if($slide["link"]) {
					$slider .= '<a href="'.$slide["link"].'">';
				}

				$slider .= '<img src="' . $slide['url'] . '">';

				if($slide["link"]) {
					$slider .= "</a>";
				}

				$slider  .= "</li>";
			}

			echo $slider;
		}

		// return false;
	}
}

/**
 * Prints the logo to the page
 * @return void
 */
if(!function_exists("skeleton_logo")) {
	function skeleton_logo() {
		global $data;
		echo '<a href="' . get_bloginfo("url") . '"><img src="' . $data["logo"] . '" alt="' . get_bloginfo('name') . '"></a>';
	}
}

/**
 * Determined whether or not the logo "exists" or not
 * @return bool
 */
if(!function_exists("logo_exists")) {
	function logo_exists() {
		if(empty($data["logo"])) {
			return TRUE;
		}

		return FALSE;
	}
}
