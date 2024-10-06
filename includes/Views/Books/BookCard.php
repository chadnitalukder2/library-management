<?php
namespace libraryManagement\Views\Books;
use libraryManagement\Classes\ArrayHelper as Arr;

class BookCard
{
    public function render()
    {
      
?>
            <?php
              $empty_image = LIBRARYMANAGEMENT_URL . 'assets/images/no_image.jpg';
            ?>
       
            <div class="lmt_category_trips">
                <div class="lmt_trips_details">
                    <figure class="lmt_trips_image">
                   
                            <a href="#">
                                <img src="<?php echo $empty_image ?>">
                            </a>

                    </figure>
                    <div class="lmt_category_trip_content">
                        <div class="lmt_category_title">
                            <h2>
                                <a itemprop="url" href="#">Book Name</a>
                            </h2>
                        </div>
                        <div class="lmt_category_trip_detail">
                            <div class="lmt_trip_category_price">
                                <div class="lmt_trip_desti">
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-admin-users"></span>
                                        <span class="lmt_name"> <span style="color: #1C2732;">Author :  </span></span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-text-page"></span>
                                        <span class="lmt_name"> <span>Publisher :</span>7 Day</span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-calendar"></span>
                                        <span class="lmt_name"> <span>Publish date :</span>7 Day</span>
                                    </div>
                                    
                                </div>
                            
                                <div class="lmt_trip_desti lmt_trip_budget">
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-category"></span>
                                        <span class="lmt_name"> <span >Category :  </span></span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-edit-large"></span>
                                        <span class="lmt_name"> <span>Edition :</span>7 Day</span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons  dashicons-analytics"></span>
                                        <span class="lmt_name"> <span>Quantity :</span>7 Day</span>
                                    </div>
                                </div>
                                   
                            </div>
                            <div class="lmt_trip_desc">
                              Description
                            </div>
                        </div>

                    </div>
                    <div class="lmt_trip_aval_time">
                        
                        <a href="#" class="lmt_view_btn">Book Details</a>
                    </div>
                </div>
            </div>
      
<?php
    }
}
