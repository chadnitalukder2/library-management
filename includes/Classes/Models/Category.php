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
}