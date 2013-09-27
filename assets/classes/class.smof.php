<?php

/**
 * A simple helper class to aid in bridging SMOF to Skeleton WordPress
 * @since 0.3
 */
class SkeletonAdmin {
	protected $data;

	/**
	 * Assumes SMOF
	 * @since 0.3
	 */
	public function __construct($filter_at_index = null) {
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
	 * @access private
	 */
	private function _validate_index($index) {
		if(array_key_exists($index, $this->data)) {
			return TRUE;
		}

		return FALSE;
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
	 * @return String
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
	 * @return bool
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
	 * @return bool
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
	 * Builds the URL and link tag for google fonts
	 * @param mixed $font
	 * @param String $weight
	 * @return String
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
		$face = $this->_compare_fonts($face);
		$url .= implode("|", $face);

		$url .= '">';

		return $url;
	}

	private function _compare_fonts($fonts) {
		if(is_array($fonts)) {
			$new = array();
			sort($fonts, SORT_STRING);
			$prev = "";
			foreach($fonts as $value) {
				if($value != $prev) {
					$new[] = $value;
				}
				$prev = $value;
			}

			return $new;
		} else {
			die("Parameter must be an array");
		}

		return FALSE;

	}

	/**
	 * Queries the global $data array for whatever you need! If you need multiple indexes, pass in an array. This checks the KEY values of the array only. It will NOT look through the values of the global $data array. Returns false on failure.
	 * @param mixed $keys | String for single item | Array for multiple items
	 * @return mixed
	 * @access public
	 * @todo allow user to pass in a regex that searches for a key value that matches
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

}
