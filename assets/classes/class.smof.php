<?php

/**
 * A simple helper class to aid in bridging SMOF to Skeleton.
 * If you wish to alter this class for any reason, please extend it
 * so upgrading won't be a nightmare.
 *
 * @since 0.3
 */
class SkeletonAdmin {
	protected $data;
	protected $slides;

	/**
	 * Assumes SMOF
	 * @since 0.3
	 */
	public function __construct() {
		global $data;
		if(!is_null($filter_at_index)) {
			$this->data = $data[$filter_at_index];
		} else {
			$this->data = $data;
		}
	}

	/**
	 * This method literally just validates that the index exists in the global $data array
	 * @param mixed (int | string) $index
	 * @return bool
	 * @access protected
	 */
	protected function _validate_index($index) {
		if(array_key_exists($index, $this->data)) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Filters any identical fonts in an array, thereby compacting the array
	 * @param array $fonts
	 * @return array
	 * @access protected
	 */
	protected function _filter_identical_fonts($fonts) {
		if(is_array($fonts)) {
			return array_unique($fonts, SORT_STRING);
		} else {
			die("Parameter must be an array");
		}

	}

	/**
	 * Queries the global $data array for the given index. On failure it returns the entire array.
	 * @param String [ $index = "" ]
	 * @return String
	 * @access public
	 */
	public function get_data($index = "") {
		if(!$index) {
			return $this->data;
		}

		return $this->data[$index];
	}

	/**
	 * Builds specific properties such as non-standard background-images or anything that requires a url parameter in CSS.
	 * @param String $property
	 * @param mixed (int | string) $index
	 * @param bool [ $array = FALSE ]
	 * @param bool [ $append = FALSE ]
	 * @return string
	 * @access public
	 */
	public function build_property($property, $index, $array = FALSE, $append = FALSE) {
		if(!empty($array)) {
			$index = $array[$index];
			$index .= $append ? ", " . $append : "";
		} else {
			$index = $this->get_data($index);
		}
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

	/**
	 * Checks to see if the give value at $index is empty or not
	 * @param mixed (int | String) $index
	 * @return boolean
	 * @access public
	 */
	public function value_is_empty($index) {
	    $data = $this->get_data($index);  // fixes http://stackoverflow.com/questions/1075534/cant-use-method-return-value-in-write-context
		if(empty($data)) {
			return TRUE;
		}

		return FALSE;
	}

	/**
	 * Checks to see if the font specified is a Google Web Font or not
	 * @param String $font
	 * @return boolean
	 * @access public
	 */
	public function is_google_font($font) {
		$no_allow = array(
          	"Arial"					=> "Arial",
			"Verdana"				=> "Verdana, Geneva",
			"Trebuchet MS"			=> "Trebuchet",
			"Georgia" 				=> "Georgia",
			"Times"					=> "Times New Roman",
			"Tahoma"				=> "Tahoma, Geneva",
			"Palatino"				=> "Palatino",
			"Helvetica"				=> "Helvetica"
		);

		if(in_array($font, $no_allow)) {
			return FALSE;
		}

		return TRUE;
	}

	/**
	 * Builds the URL and link tag for Google fonts
	 * @param mixed $font
	 * @param string $weight
	 * @return string
	 * @access public
	 */
	public function build_google_fonts($fonts = array("heading_font", "nav_font", "body_font")) {
		$fonts = $this->query_array($fonts);
		$face = array();
		$url = '<link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=';
		for($i = 0; $i < count($fonts); $i++) {
			if($fonts[$i]["style"] == "normal") {
				$face[] = str_replace(" ", "+", $fonts[$i]["face"]);
			} elseif($fonts[$i]["style"] == "bold") {
				$face[] = str_replace(" ", "+", $fonts[$i]["face"]) . ":400,700";
			}
		}
		$face = $this->_filter_identical_fonts($face);
		$url .= implode("|", $face);

		$url .= '">';

		return $url;
	}

	/**
	 * Queries the global $data array for whatever you need! If you need multiple indexes, pass in an array. This checks the KEY values of the array only. It will NOT look through the values of the global $data array. Returns false on failure.
	 * @param mixed $keys | String for single item | Array for multiple items
	 * @return mixed
	 * @access public
	 * @todo allow developer to pass in a regex that searches for a key value that matches
	 */
	public function query_array($keys) {
		$chunk = array();
		if(!is_array($keys) && array_key_exists($keys, $this->data)) {
			return $this->data[$keys];
		} elseif(is_array($keys)) {
			foreach($keys as $key) {
				if(array_key_exists($key, $this->data)) {
					$chunk[] = $this->data[$key];
				}
			}

			return $chunk;
		}

		return FALSE;
	}

	/**
	 * Generates the slider
	 * @return String
	 */
	public function skeleton_slider() {
		$slider = '<ul class="slides">';
		$slides = $this->get_all_slide_urls();
		foreach($slides as $slide) {
			$slider .= '<li><img src="' . $slide . '"></li>';
		}
		$slider .= "</ul>";

		return htmlentities($slider);
	}

	/**
	 * Gets an array of slides and other meta information
	 * @return array
	 */
	public function get_all_slides() {
		return $this->slides;
	}

	/**
	 * Returns an array of the image urls
	 * @return array
	 */
	public function get_all_slide_urls() {
		$urls = array();
		$slides = $this->get_all_slides();
		foreach($slides as $slide) {
			$urls[] = $slide["url"];
		}

		return $urls;
	}

}
