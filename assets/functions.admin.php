<?php

/**
 * This page bridges everything from the admin end to the frontend.
 * All of the options from SMOF are linked here along with a simple
 * helper class that does some heavy lifting.
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

add_action("wp_head", "skeleton_add_google_fonts", 10); // added before any internal styles
add_action("wp_head", "skeleton_internal_styles", 15); // after after other internal styles
add_action("wp_footer", "skeleton_internal_scripts", 29);
add_action("wp_footer", "skeleton_add_analytics", 30); // put after enqueued scripts

require("classes/class.smof.php");
$smof = new SkeletonAdmin();

/**
 * Adds an internal style sheet to wp_head
 * @return void
 */
if(!function_exists("skeleton_internal_styles")) {
	function skeleton_internal_styles() {
		global $smof;
		$body_font = $smof->get_data("body_font");
		$heading_font = $smof->get_data("heading_font");
		$nav_font = $smof->get_data("nav_font");
?>
<style type="text/css">
	body {
<?php echo $smof->build_property("background-color", "body_background") ?>
		<?php echo $smof->build_property("background-image", "custom_bg") ?>
		<?php if(!$smof->value_is_empty("custom_bg")) : ?>
		background-repeat: repeat;
		background-position: 0 0;
		<?php endif; ?>
	}
	/**
	 * reset all of the styles to match the font that is set on the body
	 */
	body,
	.button,
	button,
	input[type="submit"],
	input[type="reset"],
	input[type="button"],
	select,
	keygen {
		<?php echo $smof->build_property("font-family", "face", $body_font, "sans-serif") ?>
		<?php echo $smof->build_property("font-size", "size", $body_font) ?>
		<?php echo $smof->build_property("font-style", "style", $body_font) ?>
		<?php echo $smof->build_property("color", "color", $body_font) ?>
	}
	h1, h2, h3,
	h4, h5, h6 {
		<?php echo $smof->build_property("font-family", "face", $heading_font, "sans-serif") ?>
		<?php echo $smof->build_property("font-style", "style", $heading_font) ?>
		<?php echo $smof->build_property("color", "color", $heading_font) ?>
	}
	.wrapper nav {
		<?php echo $smof->build_property("font-family", "face", $nav_font, "sans-serif") ?>
		<?php echo $smof->build_property("font-size", "size", $nav_font) ?>
		<?php echo $smof->build_property("font-style", "style", $nav_font) ?>
		<?php echo $smof->build_property("color", "color", $nav_font) ?>
	}
	<?php echo $smof->get_data("custom_css") . "\n"; // custom styles ?>
</style>
		<?php // ... and we're back
	}
}

/**
 * Allows for custom scripts to be places just before the closing of the body tag.
 * @return void
 */
if(!function_exists("skeleton_internal_scripts")) {
	function skeleton_internal_scripts() {
		global $smof;
			?>
			<script type="text/javascript">
				(function($) {
					<?php if($smof->get_data("switch_tipsy") == "1") : ?>
					jQuery("<?php echo $smof->get_data("hidden_tipsy_selectors") ?>").tipsy({
						fade: true,
						gravity: "s"
					});
					<?php endif; ?>
					<?php if(count($smof->get_data("pingu_slider")) != 0) : ?>
					jQuery(".home-slider").flexslider({
						animation: "<?php echo $smof->get_data("slider_animation") ?>",
						direction: "<?php echo $smof->get_data("slider_direction") ?>",
						<?php if($smof->get_data("slide_auto") != "false") : ?>
						slideshow: <?php echo $smof->get_data("slide_auto") ?>,
						slideshowSpeed: <?php echo $smof->get_data("slideshow_speed") ?>,
						<?php endif; ?>
						animationSpeed: <?php echo $smof->get_data("animation_speed") ?>,
						controlNav: <?php echo $smof->get_data("slide_control_nav") ?>,
						directionNav: <?php echo $smof->get_data("slide_direction_nav") ?>
					});
					<?php endif; ?>
				})(jQuery);
			</script>
			<?php
	}
}

/**
 * Adds any user-tracking software to the bottom of each page
 * @return void
 */
if(!function_exists("skeleton_add_analytics")) {
	function skeleton_add_analytics() {
		global $smof;
		echo $smof->get_data("google_analytics");
	}
}

/**
 * Gets the custom footer text and places it on the page! Also, this function automatically executes shortcodes.
 * @return void
 */
if(!function_exists("skeleton_footer")) {
	function skeleton_footer() {
		global $smof;
		echo do_shortcode($smof->get_data("footer_text"));
	}
}


/**
 * Prints the generated URL to Google WebFonts to the head
 * @return void
 */
if(!function_exists("skeleton_add_google_fonts")) {
	function skeleton_add_google_fonts() {
		global $smof;
		echo $smof->build_google_fonts();
	}
}

if(!function_exists("skeleton_add_favicon")) {
	function add_favicon() {
		global $smof;
		if($smof->get_data("favicon")) {
			$image = wp_get_image_editor($smof->get_data("favicon"));
			if (!is_wp_error($image)) {
				$image->set_quality(100);
				$image->resize(16, 16, true);
				$image->save(wp_upload_dir()["url"] . 'favicon.ino', "ico");
			}
		}
	}
}
