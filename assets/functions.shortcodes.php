<?php

/**
 * All shortcode-related functions are here!
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * TABLE OF CONTENTS
 * functions in no particular order
 * `add_shortcode()`
 * @see http://codex.wordpress.org/Shortcode_API
 */

/**
 * 
 * 
 * 
 * 
 */
if(!function_exists("skeleton_shortcode_button")) {
	function skeleton_shortcode_button($atts, $content = '') {
		$classes = array();
		$styles = array();
		$href = '#';
		$new_window = false;

		$classes[] = 'nice_button';

		if (is_array($atts)) {
			if (array_key_exists("size", $atts)) {
				$classes[] = $atts['size'];
			}

			if (array_key_exists("style", $atts)) {
				$classes[] = $atts['style'];
			}

			if (array_key_exists("color", $atts)) {
				if ($atts['color'][0] == "#") {
					$styles[] = 'background-color: '.$atts['color'].';'; 
				} else {
					$classes[] = $atts['color'];
				}
			}

			if (array_key_exists('border', $atts)) {
				$styles[] = 'border-color: '.$atts['border'].';';
			}

			if (array_key_exists('text', $atts)) {
				$styles[] = 'color: '.$atts['text'].';';
			}

			if (array_key_exists('class', $atts)) {
				$classes[] = $atts['class'];
			}

			if (array_key_exists('link', $atts)) {
				$href = $atts['link'];
			}

			if (array_key_exists('window', $atts)) {
				$new_window = ($atts['window'] == 'true');
			}
		}

		return '<a href="'.$href.'" class="'.implode(' ', $classes).'" style="'.implode(' ', $styles).'"'.($new_window ? ' target="_blank"': '').'>'.$content.'</a>';
	}
}

/**
 * Give us some lovin'
 * @param string $atts
 * @param string $content [ $content = NULL ]
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_shotcode_credit")) {
	function skeleton_shotcode_credit($atts, $content = NULL) {
		if($content == NULL) {
			$content = "Skeleton Wordpress"; // woosh
		} else {
			$content = htmlspecialchars(strip_tags($content)); // keep it safe
		}
		return '<a href="https://github.com/atomicpages/skeleton-wordpress">' . $content . '</a>';
	}
}

/**
 * Allows the use of a shortcode to display and format the year
 * @param string $atts
 * @return string
 * @see http://codex.wordpress.org/Formatting_Date_and_Time
 * @since 0.1
 */
if(!function_exists("skeleton_shortcode_year")) {
	function skeleton_shortcode_year($atts) {
		extract(shortcode_atts(array('format' => 'Y'), $atts));

		return date($format);
	}
}

/**
 * Produces the name of your blog
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_shortcode_blog_title")) {
	function skeleton_shortcode_blog_title() {
		return get_bloginfo("name");
	}
}

/**
 * Returns the URL of the blog
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_shortcode_home_url")) {
	function skeleton_shortcode_home_url() {
		return home_url();
	}
}

/**
 * Generates a link to wordpress.org
 * @return string
 * @since 0.3
 */
if(!function_exists("skeleton_shortcode_wordpress_link")) {
	function skeleton_shortcode_wordpress_link() {
		return '<a href="http://wordpress.org/" target="_blank">WordPress</a>';
	}
}

// ADD SHORTCODES
add_shortcode("button", "skeleton_shortcode_button");
add_shortcode("credit", "skeleton_shotcode_credit");
add_shortcode("year", "skeleton_shortcode_year");
add_shortcode("wordpress", "skeleton_shortcode_wordpress_link");
add_shortcode("blog_title", "skeleton_shortcode_blog_title");
add_shortcode("home_url", "skeleton_shortcode_home_url");