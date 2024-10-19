<?php
namespace libraryManagement\Classes\Services;
use libraryManagement\Classes\Services\ArrayHelper as Arr;
use libraryManagement\Classes\Helper;

class BorrowRecordServices{
    public static function sanitize($data){
        $data['book_id'] = sanitize_text_field( Arr::get($data, 'book_id', '') );
        $data['borrow_date'] = sanitize_text_field( Arr::get($data, 'borrow_date') );
        $data['due_date'] = sanitize_text_field( Arr::get($data, 'due_date') );
        $data['return_date'] = sanitize_text_field( Arr::get($data, 'return_date', ) );
        $data['status'] = sanitize_text_field( Arr::get($data, 'status', 'borrowed') );

        $currentUser = Helper::getUserLoginInfo();
        
        if($currentUser) {
            $data['member_id'] = $currentUser->ID;
            $data['member_email'] = $currentUser->user_email;
        }
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

        if(empty($data['borrow_date'])){
            $errors['borrow_date'] = "Borrow date is required";
        }
        if(empty($data['return_date'])){
            $errors['return_date'] = "Return date is required";
        }
        if(empty($data['member_id'])){
            $errors['member_id'] = "Member id is required";
        }
        if(empty($data['member_email'])){
            $errors['member_email'] = "Member email is required";
        }
        return $errors;
    }
}