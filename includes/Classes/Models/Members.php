<?php 

namespace libraryManagement\Classes\Models;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class Members extends Model {
    protected $model = 'lmt_members';


    public function getMembers(){
        $per_page = sanitize_text_field(Arr::get($_REQUEST, 'per_page', 0)) ;
        $page = sanitize_text_field(Arr::get($_REQUEST, 'page', 1));
        $search = sanitize_text_field(Arr::get($_REQUEST, 'search', ''));
        $orderby = sanitize_text_field(Arr::get($_REQUEST, 'orderby', 'id'));
        $order = sanitize_text_field(Arr::get($_REQUEST, 'order', 'DESC'));
        $offset = ($page - 1) * $per_page;

        $query = $this->table('lmt_members')->select('*')->where('name', 'LIKE', '%'.$search.'%');
        $total = $query->getCount();
        $response = $query->orderBy($orderby, $order)->limit($per_page)->offset($offset)->get();


        $data['total'] = $total;
        $data['members'] = $response;

        return $data;

    }

    public static function deleteMember($id){
        return LMTDBModel('lmt_members')->where('id', $id)->delete();
    }
}