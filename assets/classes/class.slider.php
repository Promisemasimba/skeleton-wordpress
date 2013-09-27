<?php

class Skeleton_Slider extends SkeletonAdmin {

	private $slides;

	public function __construct() {
		$this->slides = parent::__construct("pingu_slider"); // we don't need to modify anything in global $data
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
