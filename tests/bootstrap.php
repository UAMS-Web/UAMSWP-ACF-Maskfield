<?php

/**
 * Unit bootstrap.
 *
 * The Unit suite runs with no WordPress: WordPress functions are mocked per
 * test with Brain Monkey.
 */

declare(strict_types=1);

require_once __DIR__.'/../vendor/autoload.php';

/*
 * Patchwork first: it can only redefine functions declared in files loaded
 * after it, so loading it before the plugin lets a test mock one of the
 * plugin's own functions, not only WordPress'.
 */
require_once __DIR__.'/../vendor/antecedent/patchwork/Patchwork.php';

/*
 * The plugin opens with `defined('ABSPATH') || exit`. Define it so the file
 * loads, pointing at a directory that is not a WordPress install.
 *
 * The main plugin file is not loaded here: it instantiates its class at file
 * scope, and Brain Monkey's add_action() exists only inside a test. The tests
 * load it themselves.
 */
if (! defined('ABSPATH')) {
    define('ABSPATH', sys_get_temp_dir().'/uamswp-acf-maskfield-tests-no-wordpress/');
}

// cspell:ignore ABSPATH
