<?php
namespace libraryManagement\Classes\Controllers;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Services\BorrowRecordServices;
use libraryManagement\Classes\Models\BorrowRecord;

class BorrowRecordController{
    public function registerAjaxRoutes() {
        lmtValidateNonce('lmt_admin_nonce');
        $route = sanitize_text_field($_REQUEST['route']);
        $routeMaps = array(
            'get_BorrowRecord' => 'getBorrowRecord',
            'delete_borrow_record' => 'deleteBorrowRecord'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }


    public function getBorrowRecord(){
        $response = (new BorrowRecord())->getBorrowRecord();

        wp_send_json_success(
            array(
                'data' => $response,
                'message' => 'Members fetched successfully'
            )
        );
    }

    public  function deleteBorrowRecord(){
        $borrow_record_id = Arr::get($_REQUEST,'id');

        if(!$borrow_record_id){
            wp_send_json_error('Borrow record id is required');
        }
        $response = BorrowRecord::deleteBorrowRecord($borrow_record_id);
       
        if ($response) {
            wp_send_json_success('Borrow Record deleted successfully');
        } else {
            wp_send_json_error('Failed to delete Borrow Record');
        }
    }
}

?>