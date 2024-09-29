<?php

namespace libraryManagement\Classes;

class Menu
{
    
    public function register()
    {
        add_action('admin_menu', array($this, 'addMenus'));
    }

    public function addMenus()
    {
        $menuPermission = AccessControl::hasTopLevelMenuPermission();
        if (!$menuPermission) {
            return;
        }

        $title = __('library management', 'textdomain');
        global $submenu;
        add_menu_page(
            $title,
            $title,
            $menuPermission,
            'library-management.php',
            array($this, 'enqueueAssets'),
            'dashicons-admin-site',
            25
        );
      
        $submenu['library-management.php']['my_profile'] = array(
            __(' Dashboard', 'textdomain'),
            $menuPermission,
            'admin.php?page=library-management.php#/',
        );
        $submenu['library-management.php']['books'] = array(
            __('Books', 'textdomain'),
            $menuPermission,
            'admin.php?page=library-management.php#/books',
        );
        
        $submenu['library-management.php']['settings'] = array(
            __('Settings', 'textdomain'),
            $menuPermission,
            'admin.php?page=library-management.php#/settings',
        );
       
    }

    public function enqueueAssets()
    {
        do_action('library-management/render_admin_app');
        wp_enqueue_script(
            'library-management_boot',LIBRARYMANAGEMENT_URL . 'assets/js/boot.js',array('jquery'),LIBRARYMANAGEMENT_VERSION,true
        );

        // 3rd party developers can now add their scripts here
        do_action('library-management/booting_admin_app');
        wp_enqueue_script('library-management_js',LIBRARYMANAGEMENT_URL . 'assets/js/plugin-main-js-file.js',array('library-management_boot'), LIBRARYMANAGEMENT_VERSION,true);

        //enque css file
        wp_enqueue_style('library-management_admin_css', LIBRARYMANAGEMENT_URL . 'assets/css/element.css');
        wp_enqueue_style('library-management_admin_css', LIBRARYMANAGEMENT_URL . 'assets/css/lmt_public.css');

        $libraryManagementAdminVars = apply_filters('library-management/admin_app_vars', array(
            //'image_upload_url' => admin_url('admin-ajax.php?action=wpf_global_settings_handler&route=wpf_upload_image'),
            'assets_url' => LIBRARYMANAGEMENT_URL . 'assets/',
            'ajaxurl' => admin_url('admin-ajax.php'),
            'lmt_admin_nonce' => wp_create_nonce('lmt_admin_nonce'),
            'lmt_public_nonce' => wp_create_nonce('lmt_public_nonce'),
            'server_time' => current_time('timestamp'),
        ));

        wp_localize_script('library-management_boot', 'libraryManagementAdmin', $libraryManagementAdminVars);
    }
}
