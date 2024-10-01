<?php 

namespace libraryManagement\Classes\Models;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class Category extends Model {
    protected $model = 'lmt_category';

    public function saveCategory($data){
      
        $id = Arr::get($data,'id', null);
        if($id){
            return LMTDBModel('lmt_category')->where('id', $id)->update($data);
        }else{
           return LMTDBModel('lmt_category')->insert($data);
        }
    }

    public function getCategory(){
        $per_page = sanitize_text_field(Arr::get($_REQUEST, 'per_page', 0)) ;
        $page = sanitize_text_field(Arr::get($_REQUEST, 'page', 1));
        $search = sanitize_text_field(Arr::get($_REQUEST, 'search', ''));
        $orderby = sanitize_text_field(Arr::get($_REQUEST, 'orderby', 'id'));
        $order = sanitize_text_field(Arr::get($_REQUEST, 'order', 'DESC'));
        $offset = ($page - 1) * $per_page;

        $query = $this->table('lmt_category')->select('*')->where('name', 'LIKE', '%'.$search.'%');
        $total = $query->getCount();
        $response = $query->orderBy($orderby, $order)->limit($per_page)->offset($offset)->get();


        $data['total'] = $total;
        $data['categories'] = $response;

        return $data;

    }

    public static function deleteCategories($id){
        return LMTDBModel('lmt_category')->where('id', $id)->delete();
    }
}