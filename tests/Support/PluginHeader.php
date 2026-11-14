<?php

/**
 * A stand-in for WordPress' `get_file_data()`, for tests that load the plugin file.
 *
 * It applies the pattern core applies: the first 8 KB of the file, line endings
 * normalized, one match per requested header.
 *
 * @see https://developer.wordpress.org/reference/functions/get_file_data/
 */

declare(strict_types=1);

/**
 * Reads header fields from a file the way `get_file_data()` does.
 *
 * @param  array<string, string>  $headers  Keys to return, mapped to the header names to find.
 * @return array<string, string>
 */
function read_file_data_like_core(string $file, array $headers): array
{
    $source = str_replace("\r", "\n", (string) file_get_contents($file, false, null, 0, 8192));
    $data = [];

    foreach ($headers as $key => $name) {
        $pattern = '/^(?:[ \t]*<\?php)?[ \t\/*#@]*'.preg_quote($name, '/').':(.*)$/mi';

        $data[$key] = preg_match($pattern, $source, $matches) === 1
            ? trim((string) preg_replace('/\s*(?:\*\/|\?>).*/', '', $matches[1]))
            : '';
    }

    return $data;
}
