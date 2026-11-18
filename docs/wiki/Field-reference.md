Written against the unreleased `main` branch.

The plugin registers one ACF field type. This page lists its settings, what it stores, what it loads in the editor, and what it requires.

## The field type

| Property | Value |
| --- | --- |
| Name (`type` in exports and `acf_add_local_field()`) | `maskfield` |
| Label in the field type list | Mask Field |
| Category | Basic |
| Class | `uamswp_acf_field_maskfield`, in `fields/class-uamswp-acf-field-maskfield-v5.php` |

## Settings

| Setting | Key | Type | Default | Effect |
| --- | --- | --- | --- | --- |
| Input Mask | `input_mask` | text | empty | Passed unchanged to Inputmask as the mask. See [Writing a mask](Writing-a-mask.md). |

The field also takes ACF's common settings (label, name, instructions, required, conditional logic, wrapper). **Required** adds `required="required"` to the input.

Registering the field in code:

```php
acf_add_local_field([
    'key' => 'field_example_phone',
    'label' => 'Phone',
    'name' => 'phone',
    'type' => 'maskfield',
    'input_mask' => '(999) 999-9999',
    'parent' => 'group_example',
]);
```

## What the field stores

The field is a text input, and ACF saves what the input holds when the post is saved. Inputmask is used with its defaults, so the mask characters are not removed: a phone number is stored as `(501) 555-0100`, not `5015550100`. Read it with `get_field()` as any text value.

The mask is not checked on the server. A value saved without the editor (an import, the REST API, `update_field()`) is stored as given.

## What it loads in the editor

On screens where ACF loads its field scripts, the field enqueues:

| Handle | File | Depends on |
| --- | --- | --- |
| `acf-maskfield` (script) | `assets/js/input.js` | `jquery`, `acf-input` |
| `inputmask` (script) | `assets/vendor/inputmask/jquery.inputmask.bundle.js` | `jquery` |
| `acf-maskfield` (style) | `assets/css/input.css` | `acf-input` |

Each uses the plugin's `Version` header as its version. `input.js` applies the mask on ACF's `ready` and `append` actions, so a Mask Field inside a repeater or flexible content row added after load is masked too.

## Requirements

| | |
| --- | --- |
| WordPress | 6.8 or later |
| PHP | 8.2 or later |
| Advanced Custom Fields | 5 or later (the field class extends `acf_field` and registers on `acf/include_field_types`) |

The text domain is `acf-maskfield`.
