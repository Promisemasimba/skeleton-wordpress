<?php

class Skeleton_Helper {

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

	private function _find_enquque_type($string) {
		$string = explode(".", $string);
		// assume nothing
		return $string[count($string) - 1];
	}

	public function __destruct() {
		static::$log[] = "Skeleton helper closed";
	}

}