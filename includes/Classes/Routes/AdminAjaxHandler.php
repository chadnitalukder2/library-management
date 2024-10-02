<?php

namespace libraryManagement\Classes\Routes;
use libraryManagement\Classes\Controllers\CategoryController;
use libraryManagement\Classes\Controllers\BooksController;
use libraryManagement\Classes\Controllers\MembersController;
use libraryManagement\Classes\Controllers\BorrowRecordController;
use libraryManagement\Classes\Controllers\StaffsControllers;
class AdminAjaxHandler
{
    public function registerEndpoints()
    {
        add_action('wp_ajax_library-management_admin_ajax', array($this, 'handleEndPoint'));
   
        add_action('wp_ajax_lmt_category', function () {
            (new CategoryController())->registerAjaxRoutes();
        });
        add_action('wp_ajax_lmt_books', function () {
            (new BooksController())->registerAjaxRoutes();
        });
        add_action('wp_ajax_lmt_members', function () {
            (new MembersController())->registerAjaxRoutes();
        });
        add_action('wp_ajax_lmt_borrow_record', function () {
            (new BorrowRecordController())->registerAjaxRoutes();
        });
        add_action('wp_ajax_lmt_staffs', function () {
            (new StaffsControllers())->registerAjaxRoutes();
        });
       
    }
    public function handleEndPoint()
    {
        $route = sanitize_text_field($_REQUEST['route']);

        $validRoutes = array(
            'get_data' => 'getData',
        );

        if (isset($validRoutes[$route])) {
            do_action('library-management/doing_ajax_forms_' . $route);
            return $this->{$validRoutes[$route]}();
        }
        do_action('library-management/admin_ajax_handler_catch', $route);
    }

    protected function getData()
    {
        // write your sql queries here or another class, then send by a success response
        // wp_send_json_success($data);
    }
}
