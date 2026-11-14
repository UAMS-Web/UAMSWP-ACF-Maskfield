<?php

/**
 * A stand-in for ACF's `acf_field` base class, which the Unit suite cannot load.
 *
 * It records only what the plugin's field class needs observed: that the parent constructor ran.
 */

declare(strict_types=1);

if (! class_exists('AcfFieldCalls')) {
    /**
     * Counts the calls the stand-in base class receives.
     */
    class AcfFieldCalls
    {
        /** @var int How many times a constructor has reached the parent. */
        public static int $parentConstructed = 0;
    }
}

if (! class_exists('acf_field')) {
    class acf_field
    {
        /** @var string */
        public $name;

        /** @var string */
        public $label;

        /** @var string */
        public $category;

        /** @var array<string, mixed> */
        public $defaults;

        /** @var array<string, string> */
        public $l10n;

        public function __construct()
        {
            AcfFieldCalls::$parentConstructed++;
        }
    }
}

if (! class_exists('FieldFileHost')) {
    /**
     * Stands in for the plugin object: the field file reads `$this->settings` when it is
     * included from the plugin's method, so a test binds the include to one of these.
     */
    class FieldFileHost
    {
        /** @var array<string, mixed> */
        public array $settings = [];
    }
}
