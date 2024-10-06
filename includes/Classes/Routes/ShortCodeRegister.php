<?php
namespace libraryManagement\Classes\Routes;
use libraryManagement\Classes\View;

class ShortcodeRegister {

    public function register() {
        add_action('wp_enqueue_scripts', function () {
            wp_enqueue_style('library_management_public_css', LIBRARYMANAGEMENT_URL.'assets/css/lmt_public.css', [], LIBRARYMANAGEMENT_VERSION);
            wp_enqueue_script( 'library_management_public_js', LIBRARYMANAGEMENT_URL.'assets/js/lmt_public.js',array('jquery'),LIBRARYMANAGEMENT_VERSION, false );

            wp_localize_script('library_management_public_js', 'lmt_public', [
                'ajax_url' => admin_url('admin-ajax.php'),
                'lmt_public_nonce' => wp_create_nonce('lmt_admin_nonce'),
            ]);
        });

        add_shortcode('lmt_book_search', array($this, 'bookSearchShortCode'));
    }

  
    public function bookSearchShortCode($atts) {
        ob_start();
       
        View::render('Books/BooksIndex',[
        ]);
        return ob_get_clean();
    }
}


