<?php

if(!defined("ABSPATH")) exit;

if(!function_exists("skeleton_add_analytics")) {
	function skeleton_add_analytics() {
		global $data;

		echo $data["google_analytics"];
	}
}
add_action("wp_footer", "skeleton_add_analytics", 30); // put after enqueued scripts

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
	<?php echo $data["custom_css"] . "\n"; // custom styles ?>
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