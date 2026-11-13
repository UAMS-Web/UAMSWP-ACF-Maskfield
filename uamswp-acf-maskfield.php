<?php

/*
  Plugin Name: UAMSWP Advanced Custom Fields: Mask Field
  Plugin URI: https://github.com/UAMS-Web/UAMSWP-ACF-Maskfield
  Description: Acf Field with Input Mask
  Author: UAMS Web Services
  Author URI: https://communications.uams.edu/web/
  Version: 1.0.0
  Requires PHP: 8.2
  License: GPLv2 or later
  License URI: http://www.gnu.org/licenses/gpl-2.0.html
 */

/*
 * Origin: this plugin is based on acf-maskfield (https://github.com/aluckyar/acf-maskfield)
 * by Alejandro Lucena Archilla (comerline.es), released under the MIT License.
 * Copyright (c) 2018 Alejandro Lucena Archilla (comerline.es). The MIT copyright and
 * permission notice is in LICENSE-MIT.md and stays with copies and substantial portions
 * of this code.
 */

// exit if accessed directly
if (! defined('ABSPATH')) {
    exit;
}

// check if class already exists
if (! class_exists('uamswp_acf_plugin_maskfield')) {

    class uamswp_acf_plugin_maskfield
    {
        // vars
        /**
         * @var array{version: '1.0.0', url: mixed, path: mixed}
         */
        public $settings;

        /*
         *  __construct
         *
         *  This function will setup the class functionality
         *
         *  @type	function
         *  @date	17/02/2016
         *  @since	1.0.0
         *
         *  @param	void
         *  @return	void
         */

        public function __construct()
        {

            // settings
            // - these will be passed into the field class.
            $this->settings = [
                'version' => '1.0.0',
                'url' => plugin_dir_url(__FILE__),
                'path' => plugin_dir_path(__FILE__),
            ];

            // include field
            add_action('acf/include_field_types', [$this, 'include_field']); // v5
            add_action('acf/register_fields', [$this, 'include_field']); // v4
        }

        /*
         *  include_field
         *
         *  This function will include the field type class
         *
         *  @type	function
         *  @date	17/02/2016
         *  @since	1.0.0
         *
         *  @param	n/a (WordPress passes the major ACF version; it is not used)
         *  @return	void
         */

        public function include_field(): void
        {

            // load textdomain
            load_plugin_textdomain('acf-maskfield', false, plugin_basename(__DIR__).'/lang');

            // include
            include_once __DIR__.'/fields/class-uamswp-acf-field-maskfield-v5.php';
        }
    }

    // initialize
    new uamswp_acf_plugin_maskfield;

    // class_exists check
}
