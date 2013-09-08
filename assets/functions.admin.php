<?php

if(!defined("ABSPATH")) exit;

/**
 * A simple helper class to aid in bridging SMOF to Skeleton WordPress
 * @since 0.3
 */
class SkeletonAdmin {
	private $data;

	public function __construct() {
		global $data;
		$this->data = $data;
	}

	public function _validate_index($index) {
		if(array_key_exists($index, $this->data)) {
			return TRUE;
		}

		return FALSE;
	}

	public function get_data($index = "") {
		if(!$index) {
			return $this->data;
		}

		return $this->data[$index];
	}

	public function build_property($property, $index) {
		$index = $this->get_data($index);
		$p = "";
		if(!empty($index)) {
			if(preg_match("/image$|url$/i", $property)) {
				$p = $property . ': url("' . $index . '");' . "\n";
			} else {
				$p = $property . ": " . $index . ";\n";
			}
		}

		return $p;
	}
}

$smof = new SkeletonAdmin();
// var_dump($foo->_validate_index("custom_bg"));
// echo $foo->get_data("custom_bg");
// echo $smof->build_property("background-image", "custom_bg");

/**
 * Adds an internal style sheet to wp_head
 * @return void
 */
if(!function_exists("skeleton_internal_styles")) {
	function skeleton_internal_styles() {
		global $smof; // reference whatever styles the user adds in the admin area
		$body_font = check_return_style("body_font");
?>
<style type="text/css">
	body {
<?php echo $smof->build_property("background-color", "body_background") ?>
		<?php echo $smof->build_property("background-image", "custom_bg") ?>
		background-repeat: repeat;
		background-position: 0 0;
		font: <?php echo $body_font["style"] ?> <?php echo $body_font["size"] ?> <?php echo $body_font["face"] ?>, sans-serf;
		color: <?php echo $body_font["color"]; ?>;
	}
	<?php echo $data["custom_css"] . "\n"; // custom styles ?>
</style>
		<?php // ... and we're back
	}
}
add_action("wp_head", "skeleton_internal_styles");

if(!function_exists("skeleton_add_analytics")) {
	function skeleton_add_analytics() {
		global $smof;

		echo $smof->get_data("google_analytics");
	}
}
add_action("wp_footer", "skeleton_add_analytics", 30); // put after enqueued scripts

/**
 * Returns the footer information from SMOF
 * @return string
 */
if(!function_exists("skeleton_footer")) {
	function skeleton_footer() {
		global $data;

		return $data["footer_text"];
	}
}

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
	if(check_style($index)) {
		return $data[$index];
	}

	return $if_false;
}