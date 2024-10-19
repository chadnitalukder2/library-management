<?php
namespace libraryManagement\Classes\Services;
use WPTravelManager\Classes\ArrayHelper as Arr;

class BorrowRecordServices{
    public static function sanitize($data){
        dd($data);
        $data['book_id'] = sanitize_text_field( Arr::get($data, 'book_id', '') );
        $data['member_id'] = sanitize_text_field( Arr::get($data, 'member_id', 1) );
        $data['borrow_date'] = sanitize_text_field( Arr::get($data, 'borrow_date') );
        $data['due_date'] = sanitize_text_field( Arr::get($data, 'due_date') );
        $data['return_date'] = sanitize_text_field( Arr::get($data, 'return_date') );
        $data['status'] = sanitize_text_field( Arr::get($data, 'status') );

        $id = Arr::get($data, 'id', null);
        if($id !== null) {
            $data['id'] = absint($data['id']);
        }
        $data['created_at'] = $id ? $data['created_at']  : current_time('mysql');
        $data['updated_at'] = current_time('mysql');
        return $data;
    }

    public static function validate($data){
       
    }
}