<?php

if(!defined("ABSPATH")) exit;

add_action("wp_head", "skeleton_internal_styles");
// add_action("wp_footer", "skeleton_internal_scripts", 29);
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
?>
<style type="text/css">
	body {
<?php echo $smof->build_property("background-color", "body_background") ?>
		<?php echo $smof->build_property("background-image", "custom_bg") ?>
		<?php if(!$smof->value_is_empty("custom_bg")) : ?>
		background-repeat: repeat;
		background-position: 0 0;
		<?php endif; ?>
		<?php echo $smof->build_property("font-family", "face", $body_font, "sans-serif") ?>
		<?php echo $smof->build_property("font-size", "size", $body_font) ?>
		<?php echo $smof->build_property("font-style", "style", $body_font) ?>
		<?php  echo $smof->build_property("color", "color", $body_font) ?>
	}
	<?php echo $smof->get_data("custom_css") . "\n"; // custom styles ?>
</style>
		<?php // ... and we're back
	}
}

if(!function_exists("skeleton_internal_scripts")) {
	function skeleton_internal_scripts() {
		global $smof;
		// $smof->get_data();
	}
}

if(!function_exists("skeleton_add_analytics")) {
	function skeleton_add_analytics() {
		global $smof;

		echo $smof->get_data("google_analytics");
	}
}