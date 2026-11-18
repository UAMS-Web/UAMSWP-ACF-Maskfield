Written against the unreleased `main` branch.

At the end of this page a field group has a phone number field that only accepts digits in the `(999) 999-9999` shape, and the editor shows the mask as you type.

You need WordPress 6.8 or later, Advanced Custom Fields 5 or later, and this plugin installed and active: see [Installation (README)](https://github.com/UAMS-Web/UAMSWP-ACF-Maskfield#installation).

1. **Open a field group.** In the WordPress admin, go to *ACF*, *Field Groups*, and open a group or add a new one.
2. **Add a field.** Select *Add Field*. Give it a label, for example `Phone`.
3. **Pick the type.** Under *Field Type*, choose **Mask Field**. It is listed with the basic field types.
4. **Enter the mask.** In the **Input Mask** setting, enter `(999) 999-9999`. Enter the mask by itself, with no quotes and no `'mask':` prefix.
5. **Save the field group**, and make sure its location rules show it on a post you can edit.
6. **Open that post.** The Phone field shows the mask as soon as it gets focus: `(___) ___-____`. Typing letters does nothing; typing digits fills the blanks in order.
7. **Update the post.** The field saves what the input holds, mask characters included, so a full entry is stored as `(501) 555-0100`.

**Note:** the mask is applied in the browser only. A value saved another way (an import, the REST API, `update_field()`) is stored as given, without checking it against the mask.

## Next

- [Writing a mask](Writing-a-mask.md): the characters a mask is built from, and more examples.
- [Field reference](Field-reference.md): every setting and what the field stores.
