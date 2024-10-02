<?php
namespace libraryManagement\Classes\Controllers;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Services\StaffServices;
use libraryManagement\Classes\Models\Staffs;

class StaffsControllers{
    public function registerAjaxRoutes() {
        lmtValidateNonce('lmt_admin_nonce');
        $route = sanitize_text_field($_REQUEST['route']);
        $routeMaps = array(
            'post_staffs' => 'postStaffs',
            'get_staffs' => 'getStaffs',
            'delete_staffs' => 'deleteStaffs'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }

    public function postStaffs(){
        $form_data = Arr::get($_REQUEST, 'data');
       
        $sanitize_data = StaffServices::sanitize($form_data);
        $validation = StaffServices::validate($sanitize_data);

        if(!empty($validation)){
            wp_send_json_error($validation);
        }

        $response = (new Staffs())->saveStaffs($sanitize_data);
     
        if ($response) {
            wp_send_json_success('Staff updated successfully');
        } else {
            wp_send_json_error('Failed to updated staff');
        }
    }

    public function getStaffs(){

        $response = (new Staffs())->getStaffs();
      
        wp_send_json_success(
            array(
                'data' => $response,
                'message' => 'Staff fetched successfully'
            )
        );
    }

    public  function deleteStaffs(){
        $staff_id = Arr::get($_REQUEST,'id');

        if(!$staff_id){
            wp_send_json_error('Staff id is required');
        }
        $response = Staffs::deleteStaffs($staff_id);
       
        if ($response) {
            wp_send_json_success('Staff deleted successfully');
        } else {
            wp_send_json_error('Failed to delete staff');
        }
    }
}

?>