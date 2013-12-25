<?php

/**
 * Let the magic begin
 *
 * @package WordPress
 * @subpackage Skeleton
 * @since 0.1
 */

if(!defined("ABSPATH")) exit;

/**
 * This file simple, yes. It loads everything that is needed for the theme. The reason for using this method is to
 * avoid cluttering a single `functions.php` file with a mixture of code. Using this method we can separate things
 * logically.
 *
 * TABLE OF CONTENTS
 * `functions.init.php` does all of the initial theme setup (e.g. sidebars, navs, etc.)
 * `functions.enqueue.php` does all of the style and script enqueuing (is that even a word?)
 * `functions.shortcodes.php` is where all shortcodes are defined!
 * `functions.posts.php` does a post include a random functions? Find it here!
 * `functions.admin.php` this is the magical bridge between SMOF and Skeleton WordPress
 * `functions.helper.php` a place for all of the fringe rejects that are seldom used
 */

require("functions.init.php");
require("functions.enqueue.php");
require("functions.shortcodes.php");
require("functions.posts.php");
require("functions.admin.php");
require("functions.helper.php");
require("functions.sidebar.php");
require("functions.hooks.php");
