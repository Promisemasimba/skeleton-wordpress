<?php

// Exit if access directly
if (!defined("ABSPATH")) exit; 

define("TEMPPATH", get_template_directory_uri());
define("IMAGES", TEMPPATH . "/images");
define("SCRIPTS", TEMPPATH . "/js");
define("FONTS", TEMPPATH . "/fonts");
define("CORE_STYLES", TEMPPATH . "/css");
define("SKELETON_VERSION", "0.13.0");

// include browser detection script for body classes
include("inc/browser_detection.php");

/**
 * General theme support and other initialization tasks for Skeleton
 */
if(!function_exists("skeleton_init")) {
	function skeleton_init()  {
		global $wp_version;

		// Add theme support for Automatic Feed Links
		if (version_compare($wp_version, "3.0", ">=")) {
			add_theme_support("automatic-feed-links");
		} else {
			automatic_feed_links();
		}


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
		if (version_compare($wp_version, "3.4", ">=")) {
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
			"default-text-color"	=> "",
			"uploads"				=> true,

		);
		if (version_compare($wp_version, "3.4", ">=")) {
			add_theme_support("custom-header", $header_args);
		} else {
			add_custom_image_header();
		}

		if(!function_exists('optionsframework_init')) {
			define('OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/inc/');
			require_once dirname(__FILE__) . '/inc/options-framework.php';
		}
	}
}
add_action("after_setup_theme", "skeleton_init");

/**
 * Initialize menus for Skeleton
 */
if(!function_exists("skeleton_nav_init")) {
	function skeleton_nav_init() {
		$locations = array(
			"main-nav"		=> __("Main Menu", "text_domain"),
			"top-nav"		=> __("Top Menu", "text_domain"),
			"footer-nav"	=> __("Footer Menu", "text_domain"),
		);

		register_nav_menus($locations);
	}
}
add_action("init", "skeleton_nav_init");

/**
 * Generates a custom and clean title tag
 * @param string $title title to display
 * @param string $sep separator to display
 * @return string
 */
if(!function_exists("skeleton_wp_title")) {
	function skeleton_wp_title($title, $sep) {
		global $paged, $page;

		if (is_feed()) {
			return $title;
		}

		// Add the site name.
		$title .= get_bloginfo("name");

		// Add the site description for the home/front page.
		$site_description = get_bloginfo('description', 'display');

		if ($site_description && (is_home() || is_front_page())) {
			$title = "$title $sep $site_description";
		}

		// Add a page number if necessary.
		if ($paged >= 2 || $page >= 2) {
			$title = "$title $sep " . sprintf( __( 'Page %s', 'twentytwelve' ), max( $paged, $page ) );
		}

		return $title;
	}
}
add_filter( 'wp_title', 'skeleton_wp_title', 10, 2 );

/**
 * Skeleton sidebar initialization information and configuration
 */
if(!function_exists("skeleton_sidebar_init")) {
	function skeleton_sidebar_init()  {
		$sidebar_one = array(
			"id"			=> "sidebar-1",
			"name"			=> __("Left Sidebar", "text_domain"),
			"description"	=> __("Sidebar appears on the left side of the page on all pages unless the full-width template is selected", "text_domain"),
			"class"			=> "sidebar left",
			"before_title"	=> "<h2 class=\"widgettitle\">",
			"after_title"	=> "</h2>",
			"before_widget"	=> "<div id=\"%1$s\" class=\"widget %2$s\">",
			"after_widget"	=> "</div>",
		);

		$sidebar_two = array(
			"id"			=> "sidebar-2",
			"name"			=> __("Right Sidebar", "text_domain"),
			"description"	=> __("Sidebar appears on the right side of the page on all pages unless the full-width template is selected", "text_domain"),
			"class"			=> "sidebar right",
			"before_title"	=> "<h2 class=\"widgettitle\">",
			"after_title"	=> "</h2>",
			"before_widget"	=> "<div id=\"%1$s\" class=\"widget %2$s\">",
			"after_widget"	=> "</div>",
		);

		$footer_widgets = array(
			'name'			=> __('Footer %d', 'txt_domain'),
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
 * Adds first and last classes to navigation list items
 * @return string
 */
if(!function_exists("skeleton_add_first_last")) {
	function skeleton_add_first_last_classes_to_menu($items) {
		$items[1]->classes[] = "first";
		$items[count($items)]->classes[] = "last";
		return $items;
	}
}
add_filter("wp_nav_menu_objects", "skeleton_add_first_last_classes_to_menu");

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

/**
 * Function to add OS to body class. Mobile support included.
 * @param void
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
add_filter('body_class', 'skeleton_add_os_to_body');

/**
 * Function to add current browser to body class
 * @param void
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
add_filter('body_class', 'skeleton_add_browser_to_body');

if(!function_exists("skeleton_add_styles")) {
	function skeleton_add_styles() {
		wp_register_style('skeleton-base', get_template_directory_uri() . '/css/base.css', array(), '1.2.2', 'screen');
		wp_register_style('skeleton-core', get_template_directory_uri() . '/css/skeleton.css', array(), '1.2.2', 'all');
		wp_register_style('skeleton-layout', get_template_directory_uri() . '/css/layout.css', array(), '1.2.2', 'screen');
		wp_register_style('skeleton-style', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
		wp_enqueue_style('skeleton-base');
		wp_enqueue_style('skeleton-core');
		wp_enqueue_style('skeleton-layout');
		wp_enqueue_style('skeleton-style');
	}
}
add_action('wp_enqueue_scripts', 'skeleton_add_styles');

if(!function_exists("skeleton_add_scripts")) {
	function skeleton_add_scripts() {
		// remove default jQuery
		wp_deregister_script('jquery');

		wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '1.10.1', true);
		wp_register_script('skeleton-respond', get_template_directory_uri() . '/js/respond.min.js', false, '1.1.0', true);
		wp_register_script('skeleton-modernizr', get_template_directory_uri() . '/js/modernizr.min.js', false, '2.6.2', true);
		wp_register_script('skeleton-script', get_template_directory_uri() . '/js/dev/skeleton.js', false, '0.11.0', true);

		// register the scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('skeleton-respond');
		wp_enqueue_script('skeleton-modernizr');
		wp_enqueue_script('skeleton-script');
	}
}
add_action('wp_enqueue_scripts', 'skeleton_add_scripts');