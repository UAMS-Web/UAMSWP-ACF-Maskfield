# UAMSWP ACF Mask Field

Adds Masked input to ACF.

The [wiki](https://github.com/UAMS-Web/UAMSWP-ACF-Maskfield/wiki) has the documentation: a walkthrough, a guide to writing masks, the field reference and troubleshooting.

## Links

* [jquery.inputmask.bundle.js](https://github.com/RobinHerbots/Inputmask) by [Robin Herbots](https://github.com/RobinHerbots)
* [Advanced Custom Fields](https://www.advancedcustomfields.com/) by [Elliot Condon](https://github.com/elliotcondon)

## Compatibility

This ACF field type is compatible with:
* ACF 5

## Installation 

1. Copy the `UAMSWP-ACF-Maskfield` folder into your `wp-content/plugins` folder
2. Activate the ACF Mask Field plugin via the plugins admin page
3. Create a new field via ACF and select the Mask Field Input type
4. Enter the mask in the field's Input Mask setting: see [Adding a masked field](https://github.com/UAMS-Web/UAMSWP-ACF-Maskfield/wiki/Adding-a-masked-field) in the wiki

## Tests

The suite is Pest 5 with Brain Monkey, so it runs with no database and no WordPress checkout. It needs PHP 8.4 and Composer.

```bash
composer install
composer test
```

`vendor/bin/pest` runs the same suite. Tests live in `tests/Unit/`, and each file is named `*Test.php`. The remote `CI` check runs the full chain on every pull request, so run `composer test` before opening one.

## Credits

Developed and maintained by UAMS Web Services.

Developers:

- Josh Daugherty
- Todd McKee

Based on [acf-maskfield](https://github.com/aluckyar/acf-maskfield) by Alejandro Lucena Archilla ([comerline.es](http://www.comerline.es/)), released under the MIT License. See [License](#license).

## License

This plugin is licensed under the GNU General Public License, version 2 or later: see [LICENSE](LICENSE).

It is based on [acf-maskfield](https://github.com/aluckyar/acf-maskfield) by Alejandro Lucena Archilla (comerline.es), which is released under the MIT License: see [LICENSE-MIT.md](LICENSE-MIT.md) for its copyright and permission notice.

### Version 1.0.1
- The GitHub download holds only the files the plugin runs
- Static analysis raised to PHPStan level 10, with no change in behavior

### Version 1.0.0 - Not tracked
- Initial Commit
