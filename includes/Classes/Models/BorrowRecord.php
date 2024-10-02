<?php 

namespace libraryManagement\Classes\Models;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class BorrowRecord extends Model {
    protected $model = 'lmt_borrow_records';

    public function saveBorrowRecord($data){
     
        $id = Arr::get($data,'id', null);
        if($id){
            return LMTDBModel('lmt_borrow_records')->where('id', $id)->update($data);
        }else{
           return LMTDBModel('lmt_borrow_records')->insert($data);
        }
    }

    public function getBorrowRecord(){
        $per_page = sanitize_text_field(Arr::get($_REQUEST, 'per_page', 0)) ;
        $page = sanitize_text_field(Arr::get($_REQUEST, 'page', 1));
        $search = sanitize_text_field(Arr::get($_REQUEST, 'search', ''));
        $orderby = sanitize_text_field(Arr::get($_REQUEST, 'orderby', 'id'));
        $order = sanitize_text_field(Arr::get($_REQUEST, 'order', 'DESC'));
        $offset = ($page - 1) * $per_page;

        $query = $this->table('lmt_borrow_records')->select('*')->where('book_id', 'LIKE', '%'.$search.'%');
        $total = $query->getCount();
        $response = $query->orderBy($orderby, $order)->limit($per_page)->offset($offset)->get();


        $data['total'] = $total;
        $data['borrow_record'] = $response;

        return $data;

    }

    public static function deleteBorrowRecord($id){
        return LMTDBModel('lmt_borrow_records')->where('id', $id)->delete();
    }
}