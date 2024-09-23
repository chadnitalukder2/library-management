<?php

/*
Plugin Name: library-management
Plugin URI: #
Description: A WordPress boilerplate plugin with Vue js.
Version: 1.0.0
Author: #
Author URI: #
License: A "Slug" license name e.g. GPL2
Text Domain: textdomain
*/


if (!defined('ABSPATH')) {
    exit;
}
if (!defined('LIBRARYMANAGEMENT_VERSION')) {
    define('LIBRARYMANAGEMENT_VERSION_LITE', true);
    define('LIBRARYMANAGEMENT_VERSION', '1.1.0');
    define('LIBRARYMANAGEMENT_MAIN_FILE', __FILE__);
    define('LIBRARYMANAGEMENT_URL', plugin_dir_url(__FILE__));
    define('LIBRARYMANAGEMENT_DIR', plugin_dir_path(__FILE__));
    define('LIBRARYMANAGEMENT_UPLOAD_DIR', '/library-management');

    class libraryManagement
    {
        public function boot()
        {
            if (is_admin()) {
                $this->adminHooks();
            }
        }

        public function adminHooks()
        {
                include LIBRARYMANAGEMENT_DIR . 'includes/Classes/Bootstrap.php';
                $bootstrap = new \libraryManagement\Classes\Bootstrap();
                $bootstrap->Boot();

        }

        public function textDomain()
        {
            load_plugin_textdomain('lmt', false, basename(dirname(__FILE__)) . '/languages');
        }
    }

    add_action('plugins_loaded', function () {
        (new libraryManagement())->boot();
    });

   
    // disabled admin-notice on dashboard
    add_action('admin_init', function () {
        $disablePages = [
            'library-management.php',
        ];
        if (isset($_GET['page']) && in_array($_GET['page'], $disablePages)) {
            remove_all_actions('admin_notices');
        }

    });
} else {
    add_action('admin_init', function () {
        deactivate_plugins(plugin_basename(__FILE__));
    });
}
