<?php

/**
 * This file exists solely to make wordpress happy. All of the functions are actually located in `assets/`.
 * The general idea is that allow the theme to load everything that it needs in a clear manner. This file
 * merely requires the loader file which actually loads all of the functions. See `functions.loader.php` for
 * additional information.
 */

// Exit if access directly
if(!defined("ABSPATH")) exit;

require("assets/functions.loader.php");