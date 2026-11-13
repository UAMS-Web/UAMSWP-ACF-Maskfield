<?php

/**
 * The field class, with ACF and WordPress mocked.
 *
 * @see fields/class-uamswp-acf-field-maskfield-v5.php
 */

declare(strict_types=1);

use Brain\Monkey\Functions;

use function Brain\Monkey\Functions\when;

/**
 * Builds a field instance, loading the field file on first use.
 *
 * The file instantiates the class at file scope using `$this->settings`, so it is
 * loaded bound to a host object that carries settings, as the plugin object does.
 *
 * @param  array<string, mixed>  $settings
 */
function makeField(array $settings = ['url' => 'https://example.org/p/', 'version' => '9.9.9']): uamswp_acf_field_maskfield
{
    require_once __DIR__.'/../Support/AcfFieldStub.php';

    if (! class_exists('uamswp_acf_field_maskfield', false)) {
        $host = new FieldFileHost;
        $host->settings = $settings;

        Closure::bind(function (): void {
            require dirname(__DIR__, 2).'/fields/class-uamswp-acf-field-maskfield-v5.php';
        }, $host, FieldFileHost::class)();
    }

    return new uamswp_acf_field_maskfield($settings);
}

beforeEach(function (): void {
    require_once __DIR__.'/../Support/AcfFieldStub.php';

    // A translation that shows its domain, so a wrong text domain is visible.
    when('__')->alias(fn (string $text, string $domain): string => $domain.'|'.$text);
    when('esc_attr')->alias(fn (string $value): string => '['.$value.']');
});

it('registers its name, label and category with ACF', function (): void {
    $before = AcfFieldCalls::$parentConstructed;

    $field = makeField();

    expect($field->name)->toBe('maskfield')
        ->and($field->label)->toBe('acf-maskfield|Mask Field')
        ->and($field->category)->toBe('basic')
        ->and(AcfFieldCalls::$parentConstructed)->toBeGreaterThan($before);
});

it('defaults the input mask to empty', function (): void {
    expect(makeField()->defaults)->toBe(['input_mask' => '']);
});

it('translates the error string for JavaScript', function (): void {
    expect(makeField()->l10n)->toBe(['error' => 'acf-maskfield|Error! Please enter a higher value']);
});

it('keeps the settings it was given', function (): void {
    $settings = ['url' => 'https://example.org/x/', 'version' => '2.0.0'];

    expect(makeField($settings)->settings)->toBe($settings);
});

it('adds an input mask setting to the field editor', function (): void {
    $field = ['type' => 'maskfield'];

    Functions\expect('acf_render_field_setting')
        ->once()
        ->with($field, [
            'label' => 'acf-maskfield|Input Mask',
            'instructions' => "acf-maskfield|Add the input Mask. Example: 'mask': '99-9999999'. More info in https://github.com/RobinHerbots/Inputmask",
            'type' => 'text',
            'name' => 'input_mask',
        ]);

    makeField()->render_field_settings($field);
});

it('renders a required text input carrying the mask', function (): void {
    ob_start();
    makeField()->render_field(['name' => 'phone', 'input_mask' => '99-999', 'value' => '12', 'required' => true]);
    $html = trim((string) ob_get_clean());

    expect($html)->toBe('<input type="text" name="[phone]" regexp="[99-999]" value="[12]" required="required" class="item-mask"/>');
});

it('renders an optional text input without the required attribute', function (): void {
    ob_start();
    makeField()->render_field(['name' => 'phone', 'input_mask' => '99-999', 'value' => '12', 'required' => false]);
    $html = trim((string) ob_get_clean());

    expect($html)->toBe('<input type="text" name="[phone]" regexp="[99-999]" value="[12]"  class="item-mask"/>');
});

it('registers and enqueues its scripts and styles from the plugin URL', function (): void {
    $url = 'https://example.org/p/';

    Functions\expect('wp_register_script')
        ->once()->with('acf-maskfield', $url.'assets/js/input.js', ['jquery', 'acf-input'], '9.9.9');
    Functions\expect('wp_register_script')
        ->once()->with('inputmask', $url.'assets/vendor/inputmask/jquery.inputmask.bundle.js', ['jquery'], '9.9.9');
    Functions\expect('wp_enqueue_script')->once()->with('acf-maskfield');
    Functions\expect('wp_enqueue_script')->once()->with('inputmask');
    Functions\expect('wp_register_style')
        ->once()->with('acf-maskfield', $url.'assets/css/input.css', ['acf-input'], '9.9.9');
    Functions\expect('wp_enqueue_style')->once()->with('acf-maskfield');

    makeField(['url' => $url, 'version' => '9.9.9'])->input_admin_enqueue_scripts();
});
