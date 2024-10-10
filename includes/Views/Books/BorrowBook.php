<?php
 $image = LIBRARYMANAGEMENT_URL . 'assets/images/sunflower.jpg';
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
                <h1>Science book</h1>
            </div>
            <div class="lmt_book_image">
                <img src="<?php echo $image ?>">
            </div>
            <div class="lmt_borrow_book_details">
                <div class="lmt_left">
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons dashicons-category"></span>
                        </div>
                        <span class="lmt_name"> <span >Category : </span>hello world</span>
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
                        <span class="lmt_name"> <span>Publisher : </span><?php echo esc_html($author) ?></span>
                    </div>
                    <div class="lmt_book">
                        <div class="lmt_icon_box">
                            <span class="icon dashicons  dashicons-calendar"></span>
                        </div>
                        <span class="lmt_name"> <span>Published Date : </span><?php echo esc_html($author) ?></span>
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
                        <span class="lmt_name"> <span> Added Date : </span><?php echo esc_html($quantity) ?></span>
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
                <p>For any issues that appear within WordPress core, please create a new ticket on trac. Use the “administration” component and the “UI” focus when creating the new ticket, and be sure to include “Dashicons” somewhere in the text of the ticket.</p>
            </div>
        </div>
    </div>
   

</div>