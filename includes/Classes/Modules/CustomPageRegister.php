<?php

namespace libraryManagement\Classes\Modules;

class CustomPageRegister
{
    public function registerPage()
    {
        $this->registerBooksSearchPage();
        $this->registerBookDetailsPage();
    }

    public function registerBooksSearchPage()
    {
        $page_title = 'Library Management Books';
        $page_slug = 'library-management-book-search';
        $page_settings = get_option('wp_library_management_book_search_page', $page_slug);
        if($page_settings != $page_slug){
            return;
        }
        // Check if a page with the slug exists
        $existing_page = get_page_by_path($page_slug);
        
        if (!$existing_page) {
            // Create the page since it doesn't exist
            $page = array(
                'post_title'    => $page_title,
                'post_content'  => '[lmt_book_search]',
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'page',
                'post_name'     => $page_slug, // Ensure the slug is set
            );
            $new_page_id = wp_insert_post($page);
            update_option( 'wp_library_management_book_search_page', $page_slug );
        }
    }

    public function registerBookDetailsPage()
    {
        $page_title = 'Library Management Book Details';
        $page_slug = 'library-management-book-details';
        // Check if a page with the slug exists
        $page_settings = get_option('wp_library_management_book_details_page', $page_slug);
        // if($page_settings != $page_slug){
        //     return;
        // }
        $existing_page = get_page_by_path($page_slug);
        if (!$existing_page) {
            // Create the page since it doesn't exist
            $page = array(
                'post_title'    => $page_title,
                'post_content'  => '[lmt_book]',
                'post_status'   => 'publish',
                'post_author'   => 1,
                'post_type'     => 'page',
                'post_name'     => $page_slug, // Ensure the slug is set
            );
            $new_page_id = wp_insert_post($page);
            update_option( 'wp_library_management_book_details_page', $page_slug );
        }
    }
 
}
