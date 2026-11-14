<?php

/**
 * Loads the plugin file twice in a fresh process and prints the hooks it registered.
 *
 * Run by tests/Unit/PluginFileLoadTest.php for the same reason as load-field-file.php.
 */

declare(strict_types=1);

define('ABSPATH', '/tmp/');

/**
 * Collects the hooks the plugin file registers, so the list keeps a known type.
 */
final class HookLog
{
    /** @var list<array{string, mixed}> */
    public static array $hooks = [];
}

function plugin_dir_url(string $file): string
{
    return $file.'url';
}

function plugin_dir_path(string $file): string
{
    return $file.'path';
}

/**
 * @param  array<int, mixed>  $callback
 */
function add_action(string $hook, array $callback): void
{
    HookLog::$hooks[] = [$hook, $callback[1]];
}

require __DIR__.'/../../uamswp-acf-maskfield.php';
require __DIR__.'/../../uamswp-acf-maskfield.php';

echo json_encode(HookLog::$hooks);
