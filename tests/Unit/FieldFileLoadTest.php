<?php

/**
 * File-level behavior of the field file and the plugin file, in fresh processes.
 *
 * @see fields/class-uamswp-acf-field-maskfield-v5.php
 * @see uamswp-acf-maskfield.php
 */

declare(strict_types=1);

/**
 * Runs a PHP snippet or script in a new process and returns its standard output.
 *
 * @throws RuntimeException When the process could not be started.
 */
function runPhp(string ...$arguments): string
{
    $command = escapeshellarg(PHP_BINARY).' '.implode(' ', array_map(escapeshellarg(...), $arguments)).' 2>&1';
    $output = shell_exec($command);

    if ($output === false) {
        throw new RuntimeException('Could not start a PHP process: '.$command);
    }

    // `shell_exec()` returns null when the process printed nothing.
    return $output ?? '';
}

dataset('plugin files', [
    'plugin file' => ['uamswp-acf-maskfield.php'],
    'field file' => ['fields/class-uamswp-acf-field-maskfield-v5.php'],
]);

it('stops when the file is requested outside WordPress', function (string $file): void {
    $path = dirname(__DIR__, 2).'/'.$file;

    expect(runPhp('-r', 'require '.var_export($path, true).'; echo "reached";'))->toBe('');
})->with('plugin files');

it('constructs the field class once however many times the field file is loaded', function (): void {
    $output = runPhp(__DIR__.'/../Fixtures/load-field-file.php');

    expect(json_decode($output, true))->toBe(['parent' => 1]);
});

it('registers the include hooks once however many times the plugin file is loaded', function (): void {
    $output = runPhp(__DIR__.'/../Fixtures/load-plugin-file.php');

    expect(json_decode($output, true))->toBe([
        ['acf/include_field_types', 'include_field'],
        ['acf/register_fields', 'include_field'],
    ]);
});
