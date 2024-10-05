<?php 
namespace libraryManagement\Classes\Hooks;
use libraryManagement\Classes\Modules\ProcessPreviewPage;
//use libraryManagement\Views\Checkout\SubmissionCheckout;

class Actions {
    public function __construct() {
        $this->register();
    }

    public function register() {
        // Handle Exterior Pages
        add_action('wp', array(new ProcessPreviewPage(), 'handleExteriorPages'));
        // Load Some Classes
        add_action('init', array($this, 'initClasses'));

    }
    public function initClasses() {
        // (new PaymentHandler())->init();
        // (new SubmissionCheckout())->init();

    }
}