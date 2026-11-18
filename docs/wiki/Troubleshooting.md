Written against the unreleased `main` branch.

One entry per symptom, as you meet it: the behavior, its cause, and the fix.

- [The field accepts nothing, or only odd characters](#the-field-accepts-nothing-or-only-odd-characters)
- [The field takes any text and shows no mask](#the-field-takes-any-text-and-shows-no-mask)
- [Mask Field is missing from the field type list](#mask-field-is-missing-from-the-field-type-list)
- [Fixed](#fixed)

## The field accepts nothing, or only odd characters

The field shows a mask with quotes, a colon or the word `mask` in it, and refuses most of what you type.

**Cause:** the Input Mask setting holds more than the mask, for example `'mask': '99-9999999'`. The setting is passed to Inputmask unchanged, so the quotes, the colon and the letters become part of the mask (in a mask, `a` means "one letter").

**Fix:** enter the mask by itself: `99-9999999`. See [Writing a mask](Writing-a-mask.md).

## The field takes any text and shows no mask

The field looks and behaves like a plain text input.

**Cause:** either the Input Mask setting is empty, or the mask script did not run on that screen.

**Fix:** check the field's Input Mask setting first. If it is set, open the browser console on the edit screen: an error from another script that runs earlier can stop `assets/js/input.js` from running, and `$field.inputmask is not a function` means the Inputmask script did not load.

## Mask Field is missing from the field type list

**Cause:** the plugin is not active, or Advanced Custom Fields is not. The field type is registered on ACF's `acf/include_field_types` action, so it needs ACF 5 or later to be active.

**Fix:** activate both plugins under *Plugins*, then reload the field group.

## Fixed

Problems fixed in a release stay here, with the release that fixed them, instead of being deleted. None yet.
