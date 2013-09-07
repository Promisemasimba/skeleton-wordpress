<?php

if(!defined("ABSPATH")) exit;

/**
 * TABLE OF CONTENTS
 * Shortcode functions
 * `add_shortcode`
 */

/**
 * Give us some lovin'
 * @param string $atts
 * @param string $content [ $content = NULL ]
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_credit")) {
	function skeleton_credit($atts, $content = NULL) {
		if($content == NULL) {
			$content = "Proudly Built with Skeleton Wordpress"; // woosh
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
if(!function_exists("skeleton_shortcode_blog_link")) {
	function skeleton_shortcode_blog_link() {
		return home_url();
	}
}
add_shortcode("credit", "skeleton_credit");
add_shortcode("year", "skeleton_shortcode_year");
add_shortcode("blog-title", "skeleton_shortcode_blog_title");
add_shortcode("blog-link", "skeleton_shortcode_blog_link");