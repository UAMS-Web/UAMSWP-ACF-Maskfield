<?php

/**
 * The plugin's main file, with WordPress mocked.
 *
 * @see uamswp-acf-maskfield.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

use function Brain\Monkey\Actions\expectAdded;
use function Brain\Monkey\Functions\when;

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
        'version' => '1.0.1',
        'url' => 'https://example.org/wp-content/plugins/uamswp-acf-maskfield/',
        'path' => '/var/www/wp-content/plugins/uamswp-acf-maskfield/',
    ]);
});

it('points both ACF hooks at its own include_field method', function (): void {
    $callbacks = [];
    foreach (['acf/include_field_types', 'acf/register_fields'] as $hook) {
        expectAdded($hook)->once()->whenHappen(function ($callback) use (&$callbacks, $hook): void {
            $callbacks[$hook] = $callback;
        });
    }

    $plugin = new uamswp_acf_plugin_maskfield;

    expect($callbacks)->toBe([
        'acf/include_field_types' => [$plugin, 'include_field'],
        'acf/register_fields' => [$plugin, 'include_field'],
    ]);
});

it('loads its text domain and field class when ACF asks for the field type', function (): void {
    require_once __DIR__.'/../Support/AcfFieldStub.php';

    when('__')->returnArg();
    Functions\expect('plugin_basename')
        ->once()
        ->with(dirname(__DIR__, 2))
        ->andReturn('uamswp-acf-maskfield');
    Functions\expect('load_plugin_textdomain')
        ->once()
        ->with('acf-maskfield', false, 'uamswp-acf-maskfield/lang');

    (new uamswp_acf_plugin_maskfield)->include_field();

    expect(class_exists('uamswp_acf_field_maskfield', false))->toBeTrue();
});

it('accepts the ACF major version the v4 hook passes', function (): void {
    require_once __DIR__.'/../Support/AcfFieldStub.php';

    when('__')->returnArg();
    when('plugin_basename')->justReturn('uamswp-acf-maskfield');

    Functions\expect('load_plugin_textdomain')->once();

    // WordPress passes the hook's arguments along, and the v4 hook passes the major version.
    $plugin = new uamswp_acf_plugin_maskfield;
    (new ReflectionMethod($plugin, 'include_field'))->invokeArgs($plugin, [4]);
});
