<?php
namespace libraryManagement\Views\Books;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

class BookCard
{
    public function render($all_books)
    {
      
?>
            <?php
              $empty_image = LIBRARYMANAGEMENT_URL . 'assets/images/no_image.jpg';

              foreach ($all_books as $book) :
                $id = ($book->ID);
    
                $book_name = $book->book_name;
                $category_name = ($book->category_name);
                // $image = ($book->images);
                $image = Arr::get($book, 'images.1.url', null);
                $author = ($book->author);
                $edition = ($book->edition);
                $quantity = ($book->quantity);
                $description =  ($book->description);
                
            ?>
       
            <div class="lmt_category_trips">
                <div class="lmt_trips_details">
                    <figure class="lmt_trips_image">
                   
                    <?php if (!$image) : ?>
                            <a href="#">
                                <img src="<?php echo $empty_image ?>">
                            </a>

                        <?php else : ?>
                            <a href="#">
                                <img src="<?php echo $image ?>">
                            </a>
                        <?php endif; ?>

                    </figure>
                    <div class="lmt_category_trip_content">
                        <div class="lmt_category_title">
                            <h2>
                                <a itemprop="url" href="#"><?php echo esc_html($book_name) ?></a>
                            </h2>
                        </div>
                        <div class="lmt_category_trip_detail">
                            <div class="lmt_trip_category_price">
                                <div class="lmt_trip_desti">
                                <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-category"></span>
                                        <span class="lmt_name"> <span >Category : </span><?php echo esc_html($category_name) ?></span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-admin-users"></span>
                                        <span class="lmt_name"> <span>Author : </span><?php echo esc_html($author) ?></span>
                                    </div>
                                    
                                    
                                </div>
                            
                                <div class="lmt_trip_desti lmt_trip_budget">
                                    
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons dashicons-edit-large"></span>
                                        <span class="lmt_name"> <span>Edition : </span><?php echo esc_html($edition) ?></span>
                                    </div>
                                    <div class="lmt_trip_loc">
                                        <span class="icon dashicons  dashicons-analytics"></span>
                                        <span class="lmt_name"> <span>Quantity : </span><?php echo esc_html($quantity) ?></span>
                                    </div>
                                </div>
                                   
                            </div>
                            <div class="lmt_trip_desc">
                              <?php echo esc_html($description) ?>
                            </div>
                        </div>

                    </div>
                    <div class="lmt_trip_aval_time">
                        
                        <a href="#" class="lmt_view_btn">Book Details</a>
                    </div>
                </div>
            </div>
       <?php endforeach; ?>
<?php
    }
}
