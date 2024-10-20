<?php
namespace libraryManagement\Classes\Routes;

use libraryManagement\Classes\Models\Books;
use libraryManagement\Classes\View;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

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
        add_shortcode('lmt_book', array($this, 'bookDetailsShortCode'));
    }

    public function bookDetailsShortCode( $atts )
    {
        wp_enqueue_style('library_management_borrow_books_css', LIBRARYMANAGEMENT_URL.'assets/css/borrow_books.css', [], LIBRARYMANAGEMENT_VERSION);
        // Get the trip ID from the shortcode attribute or URL parameter
        $id = Arr::get($atts, 'id', isset($_GET['id']) ? intval($_GET['id']) : '');
        if( empty( $id ) ){
            return;
        }
        return $this->preparedRenderData( $id );
    }
    public function preparedRenderData( $id )
    {
        
        ob_start(); 
        $books = (new Books())->getBooksById($id);
        foreach($books as $book){
             $book = $book;
        }
      
        View::render('Books/BorrowBook',[
         'id' => $id,
         'book' => $book,
        ]);
        return ob_get_clean();
    }

  
    public function bookSearchShortCode($atts) {
        ob_start();
        wp_enqueue_script( 'library_management_public_js', LIBRARYMANAGEMENT_URL.'assets/js/all_books_index.js',array('jquery'),LIBRARYMANAGEMENT_VERSION, false );

        $books = (new Books())->getBooks();
        if ( is_array($books) && isset($books['books']) ) {
            $all_books = $books['books'];
        } else {
            return;
        }
       
        View::render('Books/BooksIndex',[
            'all_books' => $all_books,
            'total' => $books['total'],
            'total_page' => ceil($books['total'] / 2),
        ]);
        return ob_get_clean();
    }
}


