<?php
namespace libraryManagement\Classes\Controllers;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Services\BooksServices;
use libraryManagement\Classes\Models\Books;
use libraryManagement\Classes\View;
use libraryManagement\Views\Books\BookCard;

class BooksController{
    public function registerAjaxRoutes() {
        lmtValidateNonce('lmt_admin_nonce');
        $route = sanitize_text_field($_REQUEST['route']);
        $routeMaps = array(
            'post_books' => 'postBooks',
            'get_books' => 'getBooks',
            'delete_books' => 'deleteBooks',
            'filter_books' => 'filterBooks'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }

    public function postBooks(){
        $form_data = Arr::get($_REQUEST, 'data');
        
        $sanitize_data = BooksServices::sanitize($form_data);
        $validation = BooksServices::validate($sanitize_data);

        if(!empty($validation)){
            wp_send_json_error($validation);
        }
       
        $response = (new Books())->saveBooks($sanitize_data);
     
        if ($response) {
            wp_send_json_success('Books updated successfully');
        } else {
            wp_send_json_error('Failed to updated books');
        }
    }

    public function getBooks() {
        $response = (new Books())->getBooks();

        wp_send_json_success(
            array(
                'data' => $response,
                'message' => 'Books fetched successfully'
            )
        );
    }

    public function filterBooks(){
        $books = (new Books())->getBooks();
    
        if ( is_array($books) && isset($books['books']) ) {
            $all_books = $books['books'];
        } else {
            return;
        }
        

        (new BookCard)->render( $all_books);

        $all_books_html = ob_get_clean();

        wp_send_json_success(
            array(
                'data' => $all_books_html,
                'total' => $books['total'],
                'message' => 'Books fetched successfully'
            )
        );
       
    }

    public  function deleteBooks(){
        $books_id = Arr::get($_REQUEST,'id');

        if(!$books_id){
            wp_send_json_error('Books id is required');
        }
        $response = Books::deleteBooks($books_id);
       
        if ($response) {
            wp_send_json_success('Books deleted successfully');
        } else {
            wp_send_json_error('Failed to delete books');
        }
    }
}

?>