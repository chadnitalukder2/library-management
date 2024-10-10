<?php
namespace libraryManagement\Views\Books;
use libraryManagement\Classes\Services\ArrayHelper as Arr;

    $empty_image = LIBRARYMANAGEMENT_URL . 'assets/images/no_image.jpg';
    $book_name = $book->book_name;
    $category_name = ($book->category_name);
    $image = Arr::get($book, 'images.1.url', null);
    $author = ($book->author); 
    $edition = ($book->edition);
    $quantity = ($book->quantity);
    $publisher = ($book->publisher);

    $published_date = StringToDate($book->published_date);
    

    $added_date = StringToDate($book->added_date);
    $description =  ($book->description);
   $id = ($book->id)
?>
<div class="lmt_borrow_books">
    <div class="lmt_borrow_header">
        <h1 class="lmt_borrow_title">Borrow Books</h1>
    </div>
    <div class="lmt_borrow_books_container">
        <div class="lmt_borrow_record">
            <form id="lmt_submission-borrow-form">
                <div class="lmt_borrow_form">
                <div class="lmt_form_group">
                        <input type="hidden"  name="name" id="">
                    </div>
                    <div class="lmt_form_group">
                        <p for="name">Borrow Date</p>
                        <input type="date" class="lmt_input" name="name" id="lmt_name" required="">
                    </div>
                    <div class="lmt_form_group">
                        <p for="name">Return Date</p>
                        <input type="date" class="lmt_input" name="name" id="lmt_name" required="">
                    </div>

                    <div class="lmt_form_group">
                        <button class="lmt_borrow_btn">Borrow Book</button>
                    </div>
                </div>
            </form>

        </div>
        <!-- ============================= -->
        <div class="lmt_book_details">
            <div class="lmt_book_name">
                <h1><?php echo esc_html($book_name) ?></h1>
            </div>
            <div class="lmt_book_image">
            <?php if (!$image) : ?>
                    <a href="#">
                        <img src="<?php echo $empty_image ?>">
                    </a>

                <?php else : ?>
                    <a href="#">
                        <img src="<?php echo $image ?>">
                    </a>
                <?php endif; ?>
            </div>
            <div class="lmt_borrow_book_details">
                <div class="lmt_left">
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-category"></span>
                        </div>
                        <span class="lmt_name"> <span >Category : </span><?php echo esc_html($category_name) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-admin-users"></span>
                        </div>
                        <span class="lmt_name"> <span>Author : </span><?php echo esc_html($author) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-businessman"></span>
                        </div>
                        <span class="lmt_name"> <span>Publisher : </span><?php echo esc_html($publisher) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons  dashicons-calendar"></span>
                        </div>
                        <span class="lmt_name"> <span>Published Date : </span><?php echo esc_html($published_date) ?></span>
                    </div>
                </div>
                <div class="lmt_right">
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-edit-large"></span>
                        </div>
                        <span class="lmt_name"> <span>Edition : </span><?php echo esc_html($edition) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-calendar-alt"></span>
                        </div>
                        <span class="lmt_name"> <span> Added Date : </span><?php echo esc_html($added_date) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons  dashicons-analytics"></span>
                        </div>
                        <span class="lmt_name"> <span>Quantity : </span><?php echo esc_html($quantity) ?></span>
                    </div>
                </div>
            </div>
            <div class="lmt_borrow_description">
                <h1>Description</h1>
               <p><?php echo esc_html($description) ?></p>
            </div>
        </div>
    </div>
   

</div>