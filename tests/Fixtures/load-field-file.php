<?php

/**
 * Loads the field file twice, the way the plugin file does, in a fresh process, and prints
 * how many times the field class was constructed and with what settings.
 *
 * Run by tests/Unit/FieldFileLoadTest.php; the class_exists guard and the file-scope
 * `new` cannot be observed twice inside one test process.
 */

declare(strict_types=1);

define('ABSPATH', '/tmp/');

function __(string $text, string $domain): string
{
    return $domain.$text;
}

require __DIR__.'/../Support/AcfFieldStub.php';

$host = new FieldFileHost;
$host->settings = ['version' => 'fixture'];

$load = function (): void {
    require __DIR__.'/../../fields/class-uamswp-acf-field-maskfield-v5.php';
};

Closure::bind($load, $host, FieldFileHost::class)();
Closure::bind($load, $host, FieldFileHost::class)();

echo json_encode(['parent' => AcfFieldCalls::$parentConstructed]);
