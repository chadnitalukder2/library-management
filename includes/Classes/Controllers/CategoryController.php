<?php
namespace libraryManagement\Classes\Controllers;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Services\CategoryServices;
use libraryManagement\Classes\Models\Category;

class CategoryController{
    public function registerAjaxRoutes() {
        lmtValidateNonce('lmt_admin_nonce');
        $route = sanitize_text_field($_REQUEST['route']);
        $routeMaps = array(
            'post_category' => 'postCategory',
            'get_categories' => 'getCategories'
        );
        if (isset($routeMaps[$route])) {
            $this->{$routeMaps[$route]}();
            die();
        }
    }

    public function postCategory(){
        $form_data = Arr::get($_REQUEST, 'data');
        
        $sanitize_data = CategoryServices::sanitize($form_data);
        $validation = CategoryServices::validate($sanitize_data);

        if(!empty($validation)){
            wp_send_json_error($validation);
        }

        $response = (new Category())->saveCategory($sanitize_data);
     
        if ($response) {
            wp_send_json_success('Category updated successfully');
        } else {
            wp_send_json_error('Failed to updated Category');
        }
    }

    public function getCategories(){
        
    }
}

?>