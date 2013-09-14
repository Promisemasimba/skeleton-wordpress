<?php

class Skeleton_shortcode {

	/**
	 * A simple metod that builds the logic of the column shortcodes. Makes everyone's life easier.
	 * @param int $number
	 * @return string
	 * @access public
	 * @since 0.3
	 */
	public function build_columns($number) {
		if($number < 2 || $number > 6) {
			die("Only a minimum of two columns or a maximum of six columns are supported");
		}
	}

	public function is_last_col() {
		// condition...
	}

}