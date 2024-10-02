<?php
namespace libraryManagement\Classes\Controllers;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Services\MembersServices;
use libraryManagement\Classes\Models\Members;

class MembersController{
    public function registerAjaxRoutes() {
        lmtValidateNonce('lmt_admin_nonce');
        $route = sanitize_text_field($_REQUEST['route']);
        $routeMaps = array(
            'get_members' => 'getMembers',
            'delete_member' => 'deleteMember'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }


    public function getMembers(){
        $response = (new Members())->getMembers();

        wp_send_json_success(
            array(
                'data' => $response,
                'message' => 'Members fetched successfully'
            )
        );
    }

    public  function deleteMember(){
        $member_id = Arr::get($_REQUEST,'id');

        if(!$member_id){
            wp_send_json_error('Member id is required');
        }
        $response = Members::deleteMember($member_id);
       
        if ($response) {
            wp_send_json_success('member deleted successfully');
        } else {
            wp_send_json_error('Failed to delete member');
        }
    }
}

?>