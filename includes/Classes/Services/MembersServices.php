<?php
namespace libraryManagement\Classes\Services;
use WPTravelManager\Classes\ArrayHelper as Arr;

class MembersServices{
    public static function sanitize($data){
        $data['name'] = sanitize_text_field( Arr::get($data, 'name') );
        $data['description'] = sanitize_text_field( Arr::get($data, 'description') );

        $id = Arr::get($data, 'id', null);
        if($id !== null) {
            $data['id'] = absint($data['id']);
        }
        $data['created_at'] = $id ? $data['created_at']  : current_time('mysql');
        $data['updated_at'] = current_time('mysql');
        return $data;
    }

    public static function validate($data){
        $errors = [];

        if(empty($data['name'])){
            $errors['name'] = "Category Name is required";
        }
        return $errors;
    }
}