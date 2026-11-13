<?php

/**
 * Loads the plugin file twice in a fresh process and prints the hooks it registered.
 *
 * Run by tests/Unit/PluginFileLoadTest.php for the same reason as load-field-file.php.
 */

declare(strict_types=1);

define('ABSPATH', '/tmp/');

$GLOBALS['hooks'] = [];

function plugin_dir_url(string $file): string
{
    return $file.'url';
}

function plugin_dir_path(string $file): string
{
    return $file.'path';
}

function add_action(string $hook, array $callback): void
{
    $GLOBALS['hooks'][] = [$hook, $callback[1]];
}

require __DIR__.'/../../uamswp-acf-maskfield.php';
require __DIR__.'/../../uamswp-acf-maskfield.php';

echo json_encode($GLOBALS['hooks']);
