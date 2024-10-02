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
            'post_borrow_record' => 'postBorrowRecord',
            'get_BorrowRecord' => 'getBorrowRecord',
            'delete_borrow_record' => 'deleteBorrowRecord'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }

    public function postBorrowRecord(){
        $form_data = Arr::get($_REQUEST, 'data');
        
        $sanitize_data = BorrowRecordServices::sanitize($form_data);
        $validation = BorrowRecordServices::validate($sanitize_data);

        if(!empty($validation)){
            wp_send_json_error($validation);
        }

        $response = (new BorrowRecord())->saveBorrowRecord($sanitize_data);
     
        if ($response) {
            wp_send_json_success('Borrow Record updated successfully');
        } else {
            wp_send_json_error('Failed to updated borrow record');
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