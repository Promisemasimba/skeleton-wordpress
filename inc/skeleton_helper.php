<?php

class Skeleton_Helper {

	public $fonts = array(
		'sans-serif' 	=> array(
			'Cabin' 				=> 'Cabin:400,700,400italic,700italic:latin',
			'Droid Sans' 			=> 'Droid+Sans:400,700:latin',
			'Fjalla One' 			=> 'Fjalla+One::latin',
			'Francois One' 			=> 'Francois+One::latin',
			'Istok Web' 			=> 'Istok+Web:400,700,400italic,700italic:latin',
			'Lato' 					=> 'Lato:400,700,400italic,700italic:latin',
			'Maven Pro' 			=> 'Maven+Pro:400,700:latin',
			'Noto Sans' 			=> 'Noto+Sans:400,700,400italic,700italic:latin',
			'Open Sans' 			=> 'Open+Sans:400italic,700italic,400,700:latin',
			'Oxygen' 				=> 'Oxygen:400,700:latin',
			'PT Sans Caption'		=> 'PT+Sans+Caption:400,700:latin',
			'PT Sans' 				=> 'PT+Sans:400,700,400italic,700italic:latin',
			'Raleway' 				=> 'Raleway:400,700:latin',
			'Roboto' 				=> 'Roboto:400,400italic,700italic,700:latin',
			'Source Sans Pro' 		=> 'Source+Sans+Pro:400,700,400italic,700italic:latin',
			'Ubuntu' 				=> 'Ubuntu:400,700,400italic,700italic:latin'
		),
		'serif'			=> array(
			'Bitter' 				=> 'Bitter:400,700,400italic:latin',
			'Cantata One' 			=> 'Cantata+One::latin',
			'Cardo' 				=> 'Cardo:400,400italic,700:latin',
			'Crimson Text' 			=> 'Crimson+Text:400,400italic,700,700italic:latin',
			'Droid Serif' 			=> 'Droid+Serif:400,700,400italic,700italic:latin',
			'EB Garamond' 			=> 'EB+Garamond::latin',
			'Gentium Book Basic' 	=> 'Gentium+Book+Basic:400,400italic,700,700italic:latin',
			'Goudy Bookletter 1911' => 'Goudy+Bookletter+1911::latin',
			'Lora' 					=> 'Lora:400,700,400italic,700italic:latin',
			'Merriweather' 			=> 'Merriweather:400,400italic,700,700italic:latin',
			'Noto Serif' 			=> 'Noto+Serif:400,700,400italic,700italic:latin',
			'PT Serif Caption' 		=> 'PT+Serif+Caption:400,400italic:latin',
			'PT Serif' 				=> 'PT+Serif:400,700,400italic,700italic:latin',
			'Playfair Display' 		=> 'Playfair+Display:400,700,400italic,700italic:latin',
			'Quattrocento' 			=> 'Quattrocento:400,700:latin',
			'Tinos' 				=> 'Tinos:400,700,400italic,700italic:latin'
		)
	);

	/**
	 * Why a log? To help you debug!
	 * @static $log
	 */
	public static $log = array();
	
	public function __construct() {
		static::$log[] = "Skeleton helper initialized";
	}

	public function skeleton_enqueue($register) {
		if(is_array($register)) {
			foreach($register as $k => $v) {
				if(is_numeric($k)) {
					return WP_Error('broke', __("Foo"));
					// wp_register_script('jquery', get_template_directory_uri() . '/js/jquery.min.js', false, '1.10.0', true);
					// 'id' => array('path/to/file.js', $depen, $ver, $in_footer)
				}
			}
		}
	}

	public function add_font($font) {}

	public function __destruct() {
		static::$log[] = "Skeleton helper closed";
	}

	private function _find_enquque_type($string) {
		$string = explode(".", $string);
		return $string[count($string) - 1]; // assume nothing
	}

}