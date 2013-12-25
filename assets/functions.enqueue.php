<?php

/**
 * Handles all of the scripts and styles that are loaded onto the page.
 * If you want to add custom scripts or styles, you may edit this file
 * or use one of the helper functions to do so.
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 * @todo Add parameters or two new methods that allows developers to add custom scripts.
 */

if(!defined("ABSPATH")) exit;

/**
 * TABLE OF CONTENTS
 * Hooks
 * Style enqueue
 * Script enqueue
 */

add_action("wp_enqueue_scripts", "skeleton_add_styles");
add_action("wp_enqueue_scripts", "skeleton_add_scripts");

/**
 * Add all of the base styles
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_add_styles")) {
	function skeleton_add_styles() {
		wp_enqueue_style("skeleton-base", STYLES . "base.css", array(), "1.4.2", "screen"); 			// optional
		wp_enqueue_style("skeleton-core", STYLES . "skeleton.css", array(), "1.4.2", "all"); 					// required
		wp_enqueue_style("skeleton-style", TEMPPATH . "/style.css", array(), "1.0", "all"); 					// required
	}
}

/**
 * Add all of the base scripts
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_add_scripts")) {
	function skeleton_add_scripts() {
		global $data;
		wp_deregister_script("jquery"); // remove dat default jQuery
		wp_enqueue_script("jquery", SCRIPTS . "jquery.min.js", false, "1.10.2", true); 					// up to date (mostly)
		wp_enqueue_script("skeleton-respond", SCRIPTS . "respond.min.js", false, "1.4.0", true); 		// make IE 8 ad below behave with media queries
		wp_enqueue_script("skeleton-modernizr", SCRIPTS . "modernizr.min.js", false, "2.7.1", false); 	// make older browsers behave
		if(count($data["pingu_slider"]) != 0) {
			wp_enqueue_script("flexslider", SCRIPTS . "jquery.flexslider.min.js", false, "2.2.2", true);
		}
		wp_enqueue_script("skeleton-superfish", SCRIPTS . "superfish.min.js", false, "1.7.4", true);	// naigation dropdown
		wp_enqueue_script("skeleton-script", SCRIPTS . "dev/skeleton.js", false, "0.11.0", true); 		// your custom scripts
	}
}
