<?php
namespace libraryManagement\Classes;
use libraryManagement\Classes\Routes\AdminAjaxHandler;
use libraryManagement\Classes\Routes\ShortcodeRegister;
use libraryManagement\Classes\Modules\CustomPageRegister;
use libraryManagement\Classes\Hooks\Actions;
class Bootstrap {
    public function Boot () {
        $this->loadClasses();
        $this->ActivatePlugin();

         //Register Admin menu
         (new Menu())->register();
        // Top Level Ajax Handlers
         (new AdminAjaxHandler())->registerEndpoints();
          // Top Level Ajax Handlers
          (new ShortcodeRegister())->register();
          (new Actions());

         add_action('library-management/render_admin_app', function () {
            (new AdminApp())->bootView();
        });
       
    }

    public function loadClasses()
    {
        require LIBRARYMANAGEMENT_DIR . 'includes/autoload.php';
    }

    public function ActivatePlugin()
    {
        //activation deactivation hook
        register_activation_hook(__FILE__, function ($newWorkWide) {
            require_once(LIBRARYMANAGEMENT_DIR . 'includes/Classes/Activator.php');
            $activator = new \libraryManagement\Classes\Activator();
            $activator->migrateDatabases($newWorkWide);
        });
        
        
        // Some time require to run the migration
        //  require_once(LIBRARYMANAGEMENT_DIR . 'includes/Classes/Activator.php');
        //  $activator = new \libraryManagement\Classes\Activator();
        //  $activator->migrateDatabases(false);

        add_action('after_setup_theme', function () {
            (new CustomPageRegister())->registerPage();
        });
    }
    

}