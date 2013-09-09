<?php

if(!defined("ABSPATH")) exit;

/**
 * TABLE OF CONENTS
 * Constants
 * Dependencies
 * Theme initialization
 * Nav initialization
 * Widget initialization
 * Custom wp_title
 * Additional theme setup
 	* Addition of first and last selectors to wp_nav_menu
 	* Addition of OS information to body element as a selector
 	* Addition of browser information to body element as a selector
 */

// DEFINE CONSTANTS
define("TEMPPATH", get_template_directory_uri());
define("IMAGES", TEMPPATH . "/images/");
define("SCRIPTS", TEMPPATH . "/js/");
define("FONTS", TEMPPATH . "/fonts/");
define("STYLES", TEMPPATH . "/css/");
define("SKELETON_VERSION", "0.3.0");

// DEPENDENCIES
require(get_template_directory() . "/admin/index.php");				// highway to the danger zone
require(get_template_directory() . "/inc/browser_detection.php");	// used to generate those lovely helper selectors

/**
 * General theme support and other initialization tasks for Skeleton
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_init")) {
	function skeleton_init() {
		global $wp_version;

		// Add theme support for Automatic Feed Links
		if (version_compare($wp_version, "3.0", ">=")) {
			add_theme_support("automatic-feed-links");
		} else {
			automatic_feed_links();
		}

		remove_action('wp_head', 'wp_generator'); // remove WP version from source


		// Add theme support for Post Formats
		$formats = array("status", "quote", "gallery", "image", "video", "audio", "link", "aside");
		add_theme_support("post-formats", $formats);

		// Add theme support for Featured Images
		add_theme_support("post-thumbnails");

		// Add theme support for Custom Background
		$background_args = array(
			"default-color"				=> "ffffff",
			"default-image"				=> "",
			"wp-head-callback"			=> "_custom_background_cb",
			"admin-head-callback"		=> "",
			"admin-preview-callback"	=> "",
		);
		if(version_compare($wp_version, "3.4", ">=")) {
			add_theme_support("custom-background", $background_args);
		} else {
			add_custom_background();
		}

		// Add theme support for Custom Header
		$header_args = array(
			"default-image"			=> "",
			"width"					=> 0,
			"height"				=> 0,
			"flex-width"			=> true,
			"flex-height"			=> true,
			"random-default"		=> false,
			"header-text"			=> false,
			"default-text-color"	=> "",		// done with CSS
			"uploads"				=> true,

		);
		if(version_compare($wp_version, "3.4", ">=")) {
			add_theme_support("custom-header", $header_args);
		} else {
			add_custom_image_header();
		}
	}
}
add_action("after_setup_theme", "skeleton_init");

/**
 * Initialize menus for Skeleton
 * @return void
 * @see `/nav/` for menu files
 * @since 0.1
 */
if(!function_exists("skeleton_nav_init")) {
	function skeleton_nav_init() {
		$locations = array(
			"main-nav"		=> __("Main Menu", "skeleton_wordpress"),
			"top-nav"		=> __("Top Menu", "skeleton_wordpress"),
			"footer-nav"	=> __("Footer Menu", "skeleton_wordpress"),
		);

		register_nav_menus($locations);
	}
}
add_action("init", "skeleton_nav_init");

/**
 * Skeleton sidebar initialization information and configuration
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_sidebar_init")) {
	function skeleton_sidebar_init()  {
		$sidebar_one = array(
			"id"			=> "sidebar-1",
			"name"			=> __("Left Sidebar", "skeleton_wordpress"),
			"description"	=> __("Sidebar appears on the left side of the page on all pages unless the full-width template is selected", "skeleton_wordpress"),
			"class"			=> "sidebar left",
			"before_title"	=> '<h2 class="widgettitle">',
			"after_title"	=> "</h2>",
			"before_widget"	=> '<div id="%1$s" class="widget %2$s">',
			"after_widget"	=> "</div>",
		);

		$sidebar_two = array(
			"id"			=> "sidebar-2",
			"name"			=> __("Right Sidebar", "skeleton_wordpress"),
			"description"	=> __("Sidebar appears on the right side of the page on all pages unless the full-width template is selected", "skeleton_wordpress"),
			"class"			=> "sidebar right",
			"before_title"	=> '<h2 class="widgettitle">',
			"after_title"	=> "</h2>",
			"before_widget"	=> '<div id="%1$s" class="widget %2$s">',
			"after_widget"	=> "</div>",
		);

		$footer_widgets = array(
			'name'			=> __('Footer %d', 'skeleton_wordpress'),
			'id'			=> "footer-$i",
			'description'	=> '',
			'class'			=> '',
			'before_widget'	=> '<div id="%1$s" class="widget %2$s">',
			'after_widget'	=> '</div>',
			'before_title'	=> '<h2 class="widgettitle">',
			'after_title'	=> '</h2>'
		);

		register_sidebar($sidebar_one);
		register_sidebar($sidebar_two);
		register_sidebars(4, $footer_widgets);
	}
}
add_action("widgets_init", "skeleton_sidebar_init");

/**
 * Generates a custom and clean title tag!
 * @param string $title title to display
 * @param string $sep separator to display
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_wp_title")) {
	function skeleton_wp_title($title, $sep) {
		global $paged, $page;

		if(is_feed()) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo("name");

		// Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');

		if($site_description && (is_home() || is_front_page())) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if($paged >= 2 || $page >= 2) {
			$title = "$title $sep " . sprintf(__('Page %s', 'skeleton_wordpress'), max($paged, $page));
		}

		return $title;
	}
}
add_filter("wp_title", "skeleton_wp_title", 10, 2);

/**
 * Adds first and last classes to navigation list items
 * @param array $items
 * @return string
 * @since 0.1
 */
if(!function_exists("skeleton_add_first_last_classes_to_menu")) {
	function skeleton_add_first_last_classes_to_menu($items) {
		$items[1]->classes[] = "first";
		$items[count($items)]->classes[] = "last";
		return $items;
	}
}
add_filter("wp_nav_menu_objects", "skeleton_add_first_last_classes_to_menu");

/**
 * Function to add OS to body class. Mobile support included.
 * @param string [ $classes = "" ]
 * @return string
 */
if(!function_exists("skeleton_add_os_to_body")) {
	function skeleton_add_os_to_body($classes = "") {
		global $tmp;
		$tmp = get_browser_info();
		$classes[] = $tmp["os"];
		return $classes;
	}
}
add_filter("body_class", "skeleton_add_os_to_body");

/**
 * Function to add current browser to body class
 * @param string [ $classes = "" ]
 * @return string
 */
if(!function_exists("skeleton_add_browser_to_body")) {
	function skeleton_add_browser_to_body($classes = "") {
		global $tmp;
		$tmp = get_browser_info();
		$classes[] = $tmp["browser_name"];
		return $classes;
	}
}
add_filter("body_class", "skeleton_add_browser_to_body");