<?php 
namespace libraryManagement\Classes\Models;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class Books extends Model {
    protected $model = 'lmt_books';

    public function saveBooks($data){ 
        
        $id = Arr::get($data,'id', null);
        if($id){
            return LMTDBModel('lmt_books')->where('id', $id)->update($data);
        }else{
           return LMTDBModel('lmt_books')->insert($data);
        }
     
    }

    public function getBooks(){

        $per_page = sanitize_text_field(Arr::get($_REQUEST, 'per_page', 2)) ;
        $page = sanitize_text_field(Arr::get($_REQUEST, 'page', 1));
        $search = sanitize_text_field(Arr::get($_REQUEST, 'search', ''));
        $orderby = sanitize_text_field(Arr::get($_REQUEST, 'orderby', 'id'));
        $order = sanitize_text_field(Arr::get($_REQUEST, 'order', 'DESC'));
        $offset = ($page - 1) * $per_page;
        //dd($per_page, $page);
        $query = $this->table('lmt_books')->select('*')->where('book_name', 'LIKE', '%'.$search.'%');
        $total = $query->getCount();
        $response = $query->orderBy($orderby, $order)->limit($per_page)->offset($offset)->get();

        foreach ($response as $key => $value) {
            $response[$key]->images = maybe_unserialize($value->images);
        }

        $data['total'] = $total;
        $data['books'] = $response;

        return $data;

    }

    public static function deleteBooks($id){
        return LMTDBModel('lmt_books')->where('id', $id)->delete();
    }

     public function getBooksById($id){
        if(!$id){
            return;
        }
        $query = $this->table('lmt_books')->select('*')->where('id', $id)->get();
        
        return $query;
     }
}