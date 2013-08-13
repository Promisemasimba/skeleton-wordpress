<?php

/**
 * Contents:
 * 1. Constants
 * 2. Inclusions and requirements
 * 3. Initial setup
 * 		1. skeleton_init 							(setups theme capabilities)
 * 		2. skeleton_nav_init 						(registers nav areas)
 * 		3. skeleton_wp_title 						(reformats wp_title())
 * 		4. skeleton_sidebar_init 					(sets up widgetable regions of theme)
 * 4. Misc. adjustments
 * 		1. skeleton_entry_meta						(reformats entry meta information for posts and pages)
 * 		2. skeleton_add_first_last_classes_to_menu	(function name says it all)
 * 		3. skeleton_add_os_to_body 					(adds working OS to body element class attribute)
 * 		4. skeleton_add_browser_to_body 			(adds working browser to body element class attribute)
 * 5. Style and Scripts
 * 6. Shortcodes
 */ 

// Exit if access directly
if(!defined("ABSPATH")) exit;

define("TEMPPATH", get_template_directory_uri());
define("IMAGES", TEMPPATH . "/images/");
define("SCRIPTS", TEMPPATH . "/js/");
define("FONTS", TEMPPATH . "/fonts/");
define("STYLES", TEMPPATH . "/css/");
define("SKELETON_VERSION", "0.2.2");

// include browser detection script for body classes
require("admin/index.php");
include("inc/browser_detection.php");

/**
 * General theme support and other initialization tasks for Skeleton
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
			"default-text-color"	=> "",
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
 * Generates a custom and clean title tag
 * @param string $title title to display
 * @param string $sep separator to display
 * @return string
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
 * Skeleton sidebar initialization information and configuration
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

if (!function_exists("skeleton_entry_meta")) {
	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 * @since 1.0
	 */
	function skeleton_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(__(", ", "skeleton_wordpress"));

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list("", __(", ", "skeleton_wordpress"));

		$date = sprintf('<a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>',
			esc_url(get_permalink()),
			esc_attr(get_the_time()),
			esc_attr(get_the_date('c')),
			esc_html(get_the_date())
		);

		$author = sprintf('<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
			esc_url(get_author_posts_url(get_the_author_meta('ID'))),
			esc_attr(sprintf(__('View all posts by %s', 'skeleton_wordpress'), get_the_author())),
			get_the_author()
		);

		// Translators: 1 is category, 2 is tag, 3 is the date and 4 is the author's name.
		if ( $tag_list ) {
			$utility_text = __('This entry was posted in %1$s and tagged %2$s on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		} elseif ( $categories_list ) {
			$utility_text = __('This entry was posted in %1$s on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		} else {
			$utility_text = __('This entry was posted on %3$s<span class="by-author"> by %4$s</span>.', 'skeleton_wordpress');
		}
		printf(
			$utility_text,
			$categories_list,
			$tag_list,
			$date,
			$author
		);
	}
}

/**
 * Adds first and last classes to navigation list items
 * @param array $items
 * @return string
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

if(!function_exists("skeleton_add_styles")) {
	function skeleton_add_styles() {
		wp_enqueue_style("skeleton-base", STYLES . "base.css", array(), "1.4.2", "screen"); // optional
		wp_enqueue_style("skeleton-core", STYLES . "skeleton.css", array(), "1.4.2", "all"); // required
		wp_enqueue_style("skeleton-layout", STYLES . "layout.css", array(), "1.4.2", "screen"); // optional
		wp_enqueue_style("skeleton-style", TEMPPATH . "/style.css", array(), "1.0", "all"); // required
	}
}
add_action("wp_enqueue_scripts", "skeleton_add_styles");

if(!function_exists("skeleton_add_scripts")) {
	function skeleton_add_scripts() {
		global $data;
		wp_deregister_script("jquery"); // remove that default jQuery!
		wp_enqueue_script("jquery", SCRIPTS . "jquery.min.js", false, "1.10.1", true); // ahh, up to date!
		wp_enqueue_script("skeleton-respond", SCRIPTS . "respond.min.js", false, "1.1.0", true); // allow IE to cooperate for media queries
		wp_enqueue_script("skeleton-modernizr", SCRIPTS . "modernizr.min.js", false, "2.6.2", true); // make older browser behave
		wp_enqueue_script("skeleton-script", SCRIPTS . "dev/skeleton.js", false, "0.11.0", true); // your custom scripts
	}
}
add_action("wp_enqueue_scripts", "skeleton_add_scripts");

if(!function_exists("skeleton_add_analytics")) {
	function skeleton_add_analytics() {
		global $data;

		return $data["google_analytics"];
	}
}
add_action("wp_footer", "skeleton_add_analytics");

# Begin shortcodes

if(!function_exists("skeleton_shortcode_wp_link")) {
	function skeleton_shortcode_wp_link($atts) {
		return '<a href="http://wordpress.org/">WordPress</a>';
	}
}
add_shortcode("wp-link", "skeleton_shortcode_wp_link");

if(!function_exists("skeleton_shortcode_theme_link")) {
	function skeleton_shortcode_theme_link($atts) {
		return '<a href="https://github.com/atomicpages/skeleton-wordpress">Skeleton WordPress</a>';
	}
}
add_shortcode("theme-link", "skeleton_shortcode_theme_link");

// same as http://codex.wordpress.org/Formatting_Date_and_Time
if(!function_exists("skeleton_shortcode_year")) {
	function skeleton_shortcode_year($atts) {
		extract(shortcode_atts(array('format' => 'Y'), $atts));

		return date($format);
	}
}
add_shortcode("year", "skeleton_shortcode_year");

if(!function_exists("skeleton_shortcode_blog_title")) {
	function skeleton_shortcode_blog_title($atts) {
		return get_bloginfo("name");
	}
}
add_shortcode("blog-title", "skeleton_shortcode_blog_title");

if(!function_exists("skeleton_shortcode_blog_link")) {
	function skeleton_shortcode_blog_link($atts) {
		return home_url();
	}
}
add_shortcode("blog-link", "skeleton_shortcode_blog_link");

# end shortcodes

if(!function_exists("skeleton_internal_styles")) {
	function skeleton_internal_styles() {
		global $data; // reference whatever styles the user adds in the admin area
		?>
<style type="text/css">
	body {
		<?php $body_font = check_return_style("body_font") ?>
background: <?php echo check_return_style("body_background", "transparent") ?> url("<?php echo check_return_style("custom_bg") ?>") repeat 0 0;
		font: <?php echo $body_font["style"] ?> <?php echo $body_font["size"] ?> <?php echo $body_font["face"] ?>, sans-serf;
		color: <?php echo $body_font["color"]; ?>;
	}
	<?php echo check_return_style("custom_css") . "\n"; // custom styles ?>
</style>
		<?php // ... and we're back
	}
}
add_action("wp_head", "skeleton_internal_styles");

/**
 * Tests to see if the index passed exists in the global $data array
 * @param string $index index of the $data array to test
 * @return boolean
 */ 
function check_style($index) {
	global $data;
	if(in_array($index, $data) && $data[$index]) {
		return TRUE;
	}

	return FALSE;
}

/**
 * Checks to see if index exists in the $data array. If it does then whatever is on that index is returned. 
 * If it does not, then whatever is supplied for the second parameter is returned instead.
 * @param string $index index of the $data array to test
 * @param string [ $if_false = "" ] what to output if check_style returns false
 * @return string
 */ 
function check_return_style($index, $if_false = "") {
	global $data;
	if( check_style($index) ) {
		return $data[$index];
	}

	return $if_false;
}

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