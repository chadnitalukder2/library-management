<?php 

namespace libraryManagement\Classes\Models;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class Staffs extends Model {
    protected $model = 'lmt_staff';

    public function saveStaffs($data){
      
        $id = Arr::get($data,'id', null);
        if($id){
            return LMTDBModel('lmt_staff')->where('id', $id)->update($data);
        }else{
           return LMTDBModel('lmt_staff')->insert($data);
        }
    }

    public function getStaffs(){
        $per_page = sanitize_text_field(Arr::get($_REQUEST, 'per_page', 0)) ;
        $page = sanitize_text_field(Arr::get($_REQUEST, 'page', 1));
        $search = sanitize_text_field(Arr::get($_REQUEST, 'search', ''));
        $orderby = sanitize_text_field(Arr::get($_REQUEST, 'orderby', 'id'));
        $order = sanitize_text_field(Arr::get($_REQUEST, 'order', 'DESC'));
        $offset = ($page - 1) * $per_page;

        $query = $this->table('lmt_staff')->select('*')->where('name', 'LIKE', '%'.$search.'%');
        $total = $query->getCount();
        $response = $query->orderBy($orderby, $order)->limit($per_page)->offset($offset)->get();


        $data['total'] = $total;
        $data['staffs'] = $response;

        return $data;

    }

    public static function deleteStaffs($id){
        return LMTDBModel('lmt_staff')->where('id', $id)->delete();
    }
}