<?php

// Exit if access directly
if(!defined("ABSPATH")) exit;

define("TEMPPATH", get_template_directory_uri());
define("IMAGES", TEMPPATH . "/images/");
define("SCRIPTS", TEMPPATH . "/js/");
define("FONTS", TEMPPATH . "/fonts/");
define("STYLES", TEMPPATH . "/css/");
define("SKELETON_VERSION", "0.16.0");

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
			$title = "$title $sep " . sprintf(__('Page %s', 'twentytwelve'), max($paged, $page));
		}

		return $title;
	}
}
add_filter('wp_title', 'skeleton_wp_title', 10, 2);

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
			"before_title"	=> '<h2 class="widgettitle">',
			"after_title"	=> "</h2>",
			"before_widget"	=> '<div id="%1$s" class="widget %2$s">',
			"after_widget"	=> "</div>",
		);

		$sidebar_two = array(
			"id"			=> "sidebar-2",
			"name"			=> __("Right Sidebar", "text_domain"),
			"description"	=> __("Sidebar appears on the right side of the page on all pages unless the full-width template is selected", "text_domain"),
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

if (!function_exists('skeleton_entry_meta')) {
	/**
	 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
	 * @since Skeleton WP 1.0
	 */
	function skeleton_entry_meta() {
		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list(__(', ', 'skeleton_wordpress'));

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list('', __(', ', 'skeleton_wordpress'));

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
add_filter('body_class', 'skeleton_add_os_to_body');

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
add_filter('body_class', 'skeleton_add_browser_to_body');

if(!function_exists("skeleton_add_styles")) {
	function skeleton_add_styles() {
		wp_register_style('skeleton-base', STYLES . 'base.css', array(), '1.2.2', 'screen'); // optional
		wp_register_style('skeleton-core', STYLES . 'skeleton.css', array(), '1.2.2', 'all'); // required
		wp_register_style('skeleton-layout', STYLES . 'layout.css', array(), '1.2.2', 'screen'); // optional
		wp_register_style('skeleton-style', STYLES . 'style.css', array(), '1.0', 'all'); // required
		wp_enqueue_style('skeleton-base');
		wp_enqueue_style('skeleton-core');
		wp_enqueue_style('skeleton-layout');
		wp_enqueue_style('skeleton-style');
	}
}
add_action('wp_enqueue_scripts', 'skeleton_add_styles');

if(!function_exists("skeleton_add_scripts")) {
	function skeleton_add_scripts() {
		wp_deregister_script('jquery'); // remove that default jQuery!

		wp_register_script('jquery', SCRIPTS . 'jquery.min.js', false, '1.10.1', true); // ahh, up to date!
		wp_register_script('skeleton-respond', SCRIPTS . 'respond.min.js', false, '1.1.0', true); // allow IE to cooperate for media queries
		wp_register_script('skeleton-modernizr', SCRIPTS . 'modernizr.min.js', false, '2.6.2', true); // make older browser behave
		wp_register_script('skeleton-script', SCRIPTS . 'dev/skeleton.js', false, '0.11.0', true); // your custom scripts

		// register the scripts
		wp_enqueue_script('jquery');
		wp_enqueue_script('skeleton-respond');
		wp_enqueue_script('skeleton-modernizr');
		wp_enqueue_script('skeleton-script');
	}
}
add_action('wp_enqueue_scripts', 'skeleton_add_scripts');

if (!function_exists('skeleton_comment')) {

	/**
	 *
	 * @param object [ $comment = $GLOBALS['comment'] ]
	 * @param array $args
	 * @param int $depth
	 * @see for $args http://codex.wordpress.org/Function_Reference/comment_reply_link
	 */
	function skeleton_comment($comment, $args, $depth) {
		$GLOBALS['comment'] = $comment;
		switch ($comment->comment_type) :
			case 'pingback' :
			case 'trackback' :
		?>
		<li class="post pingback">
			<p><?php _e('Pingback:', 'skeleton_wordpress'); ?> <?php comment_author_link(); ?><?php edit_comment_link(__('Edit', 'skeleton_wordpress'), ''); ?></p>
		<?php
				break;
			default :
		?>
		<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
			<article id="comment-<?php comment_ID(); ?>" class="comment">
				<footer>
					<div class="comment-author vcard">
						<?php echo get_avatar($comment, 60); ?>
						<?php printf(__('%s <span class="says">says:</span>', 'skeleton_wordpress'), sprintf('<cite class="fn">%s</cite>', get_comment_author_link())); ?>
					</div><!-- .comment-author .vcard -->
					<?php if ($comment->comment_approved == '0') : ?>
						<em><?php _e('Your comment is awaiting moderation.', 'skeleton_wordpress'); ?></em>
						<br>
					<?php endif; ?>

					<div class="comment-meta commentmetadata">
						<a href="<?php echo esc_url(get_comment_link($comment->comment_ID)); ?>"><time datetime="<?php comment_time('c'); ?>">
						<?php
							/* translators: 1: date, 2: time */
							printf(__('%1$s at %2$s', 'skeleton_wordpress'), get_comment_date(), get_comment_time()); ?>
						</time></a>
						<?php edit_comment_link(__('Edit', 'skeleton_wordpress'), '');
						?>
					</div><!-- /.comment-meta .commentmetadata -->					
				</footer>

				<div class="comment-content"><?php comment_text(); ?></div>

				<div class="reply">
					<?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
				</div><!-- /.reply -->
			</article><!-- /#comment-## -->

		<?php
				break;
			endswitch;
	}
}