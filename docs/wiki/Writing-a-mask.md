Written against the unreleased `main` branch.

The **Input Mask** setting is handed to Inputmask exactly as you type it, as the single argument of `.inputmask()`. Inputmask reads that text as a mask, or as the name of one of its built-in aliases. This page covers the mask characters you will use most; the [Inputmask documentation](https://github.com/RobinHerbots/Inputmask#readme) has the full syntax. The plugin ships Inputmask 5.0.8-beta.73.

## The mask characters

| Character | Accepts |
| --- | --- |
| `9` | one digit, 0 to 9 |
| `a` | one letter |
| `*` | one letter or digit |
| any other character | itself, filled in for the reader |

A character that is meant literally but is also a mask character is escaped with a backslash: `\9` is a literal 9.

## Masks to start from

| For | Input Mask | A full entry |
| --- | --- | --- |
| US phone number | `(999) 999-9999` | `(501) 555-0100` |
| ZIP code | `99999` | `12345` |
| ZIP+4 | `99999-9999` | `12345-6789` |
| Two letters and four digits | `aa9999` | `AB1234` |
| An ID of the form in the setting's own example | `99-9999999` | `12-3456789` |

## Steps

1. Write the shape of the value with the characters above, for example `99999-9999`.
2. Enter it in the field's **Input Mask** setting, by itself: no quotes and no `'mask':` prefix. The setting passes the text through unchanged, so quotes and a prefix become part of the mask.
3. Save the field group and try the field on a post, typing a full value and a short one.

## Reference

- [Field reference](Field-reference.md#settings): the Input Mask setting.
- [Field reference](Field-reference.md#what-the-field-stores): what is saved.
