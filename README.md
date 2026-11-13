# UAMSWP ACF Mask Field

Adds Masked input to ACF.

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
4. Read the description above for usage instructions

## Tests

The suite is Pest 5 with Brain Monkey, so it runs with no database and no WordPress checkout. It needs PHP 8.4 and Composer.

```bash
composer install
composer test
```

`vendor/bin/pest` runs the same suite. Tests live in `tests/Unit/`, and each file is named `*Test.php`. Before a pull request, run the shared local CI runner: `node .claude/skills/local-ci/local-ci.mjs`.

## Authors

* **Alejandro Lucena Archilla** - [www.comerline.es](http://www.comerline.es/)
* **Todd McKee** - [www.uams.edu](https://www.uams.edu/)

## License

This plugin is licensed under the GNU General Public License, version 2 or later: see [LICENSE](LICENSE).

It is based on [acf-maskfield](https://github.com/aluckyar/acf-maskfield) by Alejandro Lucena Archilla (comerline.es), which is released under the MIT License: see [LICENSE-MIT.md](LICENSE-MIT.md) for its copyright and permission notice.

### Version 1.0.0 - Not tracked
- Initial Commit
