<?php
namespace libraryManagement\Classes\Services;
use WPTravelManager\Classes\ArrayHelper as Arr;

class StaffServices{
    public static function sanitize($data){
        $data['name'] = sanitize_text_field( Arr::get($data, 'name') );
        $data['email'] = sanitize_text_field( Arr::get($data, 'email') );
        $data['phone'] = sanitize_text_field( Arr::get($data, 'phone') );
        $data['address'] = sanitize_text_field( Arr::get($data, 'address') );
        $data['role'] = sanitize_text_field( Arr::get($data, 'role') );
        $data['joined_date'] = sanitize_text_field( Arr::get($data, 'joined_date') );

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
            $errors['name'] = "Staff Name is required";
        }
        if(empty($data['email'])){
            $errors['email'] = "Staff email is required";
        }
        if(empty($data['phone'])){
            $errors['phone'] = "Staff phone is required";
        }
        if(empty($data['role'])){
            $errors['role'] = "Staff role is required";
        }
        return $errors;
    }
}