<?php
namespace libraryManagement\Classes\Services;
use WPTravelManager\Classes\ArrayHelper as Arr;

class BooksServices{
    public static function sanitize($data){
        $data['book_name'] = sanitize_text_field( Arr::get($data, 'book_name') );
        $data['category_name'] = sanitize_text_field( Arr::get($data, 'category_name') );
        $data['author'] = sanitize_text_field( Arr::get($data, 'author') );
        $data['publisher'] = sanitize_text_field( Arr::get($data, 'publisher') );
        $data['published_date'] = sanitize_text_field( Arr::get($data, 'published_date') );
        $data['quantity'] = sanitize_text_field( Arr::get($data, 'quantity') );
        $data['edition'] = sanitize_text_field( Arr::get($data, 'edition') );
        $data['description'] = sanitize_text_field( Arr::get($data, 'description') );
        $data['added_date'] = sanitize_text_field( Arr::get($data, 'added_date') );

        $data['images']['id'] = sanitize_text_field( Arr::get($data,'images.id', '') );
        $data['images']['url'] = sanitize_url( Arr::get($data, 'images.url', '') );
        $data['images']['name'] = sanitize_text_field( Arr::get($data, 'images.name', '') );
        $data['images'] = maybe_serialize($data['images']);

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

        if(empty($data['book_name'])){
            $errors['book_name'] = "Book Name is required";
        }
        if(empty($data['author'])){
            $errors['author'] = "Author Name is required";
        }
        if(empty($data['category_name'])){
            $errors['category_name'] = "Category Name is required";
        }
        return $errors;
    }
}