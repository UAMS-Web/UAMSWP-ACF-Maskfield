<?php

/**
 * The plugin's main file, with WordPress mocked.
 *
 * @see uamswp-acf-maskfield.php
 */

declare(strict_types=1);

use function Brain\Monkey\Functions\when;
use function Brain\Monkey\Actions\expectAdded;
use Brain\Monkey\Actions;
use Brain\Monkey\Functions;

beforeEach(function (): void {
    when('plugin_dir_url')->justReturn('https://example.org/wp-content/plugins/uamswp-acf-maskfield/');
    when('plugin_dir_path')->justReturn('/var/www/wp-content/plugins/uamswp-acf-maskfield/');

    // The file instantiates its class at file scope, so it loads once per process, in
    // whichever test runs first. Each test then builds its own instance.
    require_once dirname(__DIR__, 2).'/uamswp-acf-maskfield.php';
});

it('registers the field type on both ACF registration hooks', function (): void {
    expectAdded('acf/include_field_types')->atLeast()->once();
    expectAdded('acf/register_fields')->atLeast()->once();

    new uamswp_acf_plugin_maskfield;
});

it('passes its version, URL and path to the field class settings', function (): void {
    $plugin = new uamswp_acf_plugin_maskfield;

    expect($plugin->settings)->toBe([
        'version' => '1.0.0',
        'url' => 'https://example.org/wp-content/plugins/uamswp-acf-maskfield/',
        'path' => '/var/www/wp-content/plugins/uamswp-acf-maskfield/',
    ]);
});
