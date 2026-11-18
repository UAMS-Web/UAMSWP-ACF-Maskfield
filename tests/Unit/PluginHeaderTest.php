<?php

/**
 * The main plugin file's Version header and the version it passes on, and the WordPress floor the header and readme declare, read as text so no WordPress is needed.
 *
 * @see uamswp-acf-maskfield.php
 */

declare(strict_types=1);

require_once __DIR__.'/../Support/PluginHeader.php';

/**
 * The plugin's main file, read as text.
 */
function plugin_header_test_source(): string
{
    return (string) file_get_contents(dirname(__DIR__, 2).'/uamswp-acf-maskfield.php');
}

it('writes the Version header as a three-segment release number', function (): void {
    expect(plugin_header_test_field(plugin_header_test_source(), 'Version'))->toMatch('/^\d+\.\d+\.\d+$/');
});

it('reads the settings version from the header and does not write it a second time', function (): void {
    $source = plugin_header_test_source();

    expect($source)->toContain("'version' => get_file_data(__FILE__, ['Version' => 'Version'])['Version'],")
        ->and(preg_match("/'version'\s*=>\s*'/", $source))->toBe(0);
});

it('documents the settings version as a string, not a literal', function (): void {
    expect(preg_match('/@var array\{version: \'/', plugin_header_test_source()))->toBe(0);
});

it('declares the WordPress 6.8 floor in the header and the readme', function (): void {
    $readme = (string) file_get_contents(dirname(__DIR__, 2).'/readme.txt');

    expect(plugin_header_test_field(plugin_header_test_source(), 'Requires at least'))->toBe('6.8')
        ->and(plugin_header_test_field($readme, 'Requires at least'))->toBe('6.8')
        ->and(version_compare((string) plugin_header_test_field($readme, 'Tested up to'), '6.8', '>='))->toBeTrue();
});

it('finds the header version within the first 8 KB, as core reads it', function (): void {
    $source = plugin_header_test_source();

    expect(strpos($source, 'Version:'))->toBeLessThan(8192)
        ->and(plugin_header_test_field($source, 'Version'))->not->toBeNull();
});
