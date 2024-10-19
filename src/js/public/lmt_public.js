
import { submissionBorrowBooks } from './submission_borrow_books.js';
import { booksSearch } from './books_search.js';



(function ($) {
    $(document).ready(function () {
        submissionBorrowBooks($);
        booksSearch($);

    });
})(jQuery);