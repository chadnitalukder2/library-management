<?php
namespace libraryManagement\Views\Books;



?>
<div class="lmt_container">
    <div class="lmt_content">

        <div class="lmt_page-header">
            <h1 class="lmt_page-title"> Book's Catalog</h1>
        </div>

        <div class="lmt_page_body">
            <!-- ======================================== -->
            <div class="lmt_trip_details">
                <div class="lmt_sidebar">
                   
                    <!-- ===========Destination================= -->
                    <div class="lmt_search_type">
                        <div class="lmt_filter_section_title">
                            <h3>Category</h3>
                            <span class="dashicons dashicons-arrow-down-alt2"></span>
                        </div>
                        <div class="lmt_filter_section_content">
                            <ul class="lmt_search_terms_list">
                                <li class="">
                                    <label class="container">Bhutan
                                        <input type="checkbox" value="bhutan">
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="count">2</span>
                                </li>
                                <li class="">
                                    <label class="container">Bhutan
                                        <input type="checkbox" value="bhutan">
                                        <span class="checkmark"></span>
                                    </label>
                                    <span class="count">2</span>
                                </li>
                               
                            </ul>
                        </div>

                    </div>
                   
                   
                    
                   
                    <!-- ======================================= -->
                </div>
            </div>
            <!-- ======================================= -->
            <div class="lmt_trip_card">
                <div class="lmt_travel_toolbar">
                    <div class="lmt_filter_foundposts">
                        <h2><strong><?php echo $total ?></strong> books found</h2>
                    </div>
                    <div class="lmt_dropdown">
                      <div class="lmt_input_box">
                        <input type="text" placeholder="books search by name...">
                        <button><span class="dashicons dashicons-search"></span></button>
                      </div>
                    </div>
                   
                </div>
                <!-- ================================== -->
                <div class="lmt_category_trips_wrapper">
                 <?php echo (new BookCard)->render( $all_books) ?>
                </div>
                <!-- =================================== -->
                <div class="lmt_pagination">
                    <p data-lmt_page_no="prev" class="lmt_all_trips_pag lmt_pag_prev lmt_pag_disabled"><span class="dashicons dashicons-arrow-left-alt2"></span></p>
                  
                        <p class="lmt_all_trips_pag "></p
                   
                    <p data-lmt_page_no="next" class="lmt_all_trips_pag lmt_pag_next"><span class="dashicons dashicons-arrow-right-alt2"></span></p>
                </div>

            </div>
            <!-- ======================================== -->
        </div>

    </div>
</div>


