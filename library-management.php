<?php

/*
Plugin Name: Library Management
Plugin URI: #
Description: A WordPress boilerplate plugin with Vue js.
Version: 1.0.0
Author: #
Author URI: #
License: A "Slug" license name e.g. GPL2
Text Domain:  library-management
*/


if (!defined('ABSPATH')) {
    exit;
}
define('LMT_URL', plugin_dir_url(__FILE__));
define('LMT_DIR', plugin_dir_path(__FILE__));

define('LMT_VERSION', '1.0.0');


add_action('plugins_loaded', function () {
    include LMT_DIR . 'includes/Classes/Bootstrap.php';
    $bootstrap = new \libraryManagement\Classes\Bootstrap();
    $bootstrap->Boot();
});




