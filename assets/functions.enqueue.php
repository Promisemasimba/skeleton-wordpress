<?php

/**
 * Want to enqueue a script or style? Want to register those styles? Want to replace an existing style? Do so here.
 *
 * @package WordPress
 * @subpackage skeleton_wordpress
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * TABLE OF CONTENTS
 * Style enqueue
 * Script enqueue
 * Analytics enqueue
 */

/**
 * Add all of the base styles
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_add_styles")) {
	function skeleton_add_styles() {
		wp_enqueue_style("skeleton-base", STYLES . "base.css", array(), "1.4.2", "screen"); // optional
		wp_enqueue_style("skeleton-core", STYLES . "skeleton.css", array(), "1.4.2", "all"); // required
		wp_enqueue_style("skeleton-layout", STYLES . "layout.css", array(), "1.4.2", "screen"); // optional
		wp_enqueue_style("skeleton-style", TEMPPATH . "/style.css", array(), "1.0", "all"); // required
	}
}
add_action("wp_enqueue_scripts", "skeleton_add_styles");

/**
 * Add all of the base scripts
 * @return void
 * @since 0.1
 */
if(!function_exists("skeleton_add_scripts")) {
	function skeleton_add_scripts() {
		global $data;
		wp_deregister_script("jquery"); // remove that default jQuery!
		wp_enqueue_script("jquery", SCRIPTS . "jquery.min.js", false, "1.10.1", true); // ahh, up to date!
		wp_enqueue_script("skeleton-respond", SCRIPTS . "respond.min.js", false, "1.1.0", true); // allow IE to cooperate for media queries
		wp_enqueue_script("skeleton-modernizr", SCRIPTS . "modernizr.min.js", false, "2.6.2", true); // make older browser behave
		if(count($data["pingu_slider"]) != 0) {
			wp_enqueue_script("flexslider", SCRIPTS . "jquery.flexslider.min.js", false, "2.2.0", true);
		}
		wp_enqueue_script("skeleton-script", SCRIPTS . "dev/skeleton.js", false, "0.11.0", true); // your custom scripts
	}
}
add_action("wp_enqueue_scripts", "skeleton_add_scripts");