<?php

/**
 * Plugin Name:       Kulturkortet Import
 * Plugin URI:        (#plugin_url#)
 * Description:       Imports events from Mittkulturkort.se
 * Version:           1.0.0
 * Author:            Kristoffer Svanmark, Sebastian Thulin
 * Author URI:        (#plugin_author_url#)
 * License:           MIT
 * License URI:       https://opensource.org/licenses/MIT
 * Text Domain:       kulturkortet-import
 * Domain Path:       /languages
 */

 // Protect agains direct file access
if (! defined('WPINC')) {
    die;
}

define('KULTURKORTETIMPORT_PATH', plugin_dir_path(__FILE__));
define('KULTURKORTETIMPORT_URL', plugins_url('', __FILE__));
define('KULTURKORTETIMPORT_TEMPLATE_PATH', KULTURKORTETIMPORT_PATH . 'templates/');

load_plugin_textdomain('kulturkortet-import', false, plugin_basename(dirname(__FILE__)) . '/languages');

require_once KULTURKORTETIMPORT_PATH . 'source/php/Vendor/Psr4ClassLoader.php';
require_once KULTURKORTETIMPORT_PATH . 'Public.php';

// Instantiate and register the autoloader
$loader = new KulturkortetImport\Vendor\Psr4ClassLoader();
$loader->addPrefix('KulturkortetImport', KULTURKORTETIMPORT_PATH);
$loader->addPrefix('KulturkortetImport', KULTURKORTETIMPORT_PATH . 'source/php/');
$loader->register();

// Start application
new KulturkortetImport\App();
