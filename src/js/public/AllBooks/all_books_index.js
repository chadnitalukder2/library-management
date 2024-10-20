(function ($) {
    $(document).ready(function booksSearch () {
        let $input = $('#lmt_books_search');
        let $submit = $('.lmt_search_btn')
        
        let per_page = 2;
       

        $submit.on('click' , function(e){
            e.preventDefault();
            searchApiRequest();
        })

        $('.lmt_all_books_pag').on('click', function(e){
            e.preventDefault();
            let page = $(this).data('lmt_page_no');
          
            const activePage = $('.lmt_pag_active');
            const totalPages = $('.lmt_all_books_pag').length -2;
           
            if (page === 'prev') {
                page = Math.max(1, activePage.data('lmt_page_no') - 1); // Prevent going below 1
            } else if (page === 'next') {
                page = Math.min(totalPages, activePage.data('lmt_page_no') + 1); // Prevent exceeding total pages
            }

            if (!page || page === activePage.data('lmt_page_no')) return false;

            activePage.removeClass('lmt_pag_active');
            $(`.lmt_all_books_pag[data-lmt_page_no="${page}"]`).addClass('lmt_pag_active');
    
          
            $('.lmt_pag_prev').toggleClass('lmt_pag_disabled', page === 1);
            $('.lmt_pag_next').toggleClass('lmt_pag_disabled', page === totalPages);

            searchApiRequest(page);
            
        } )

        function searchApiRequest(page){
          
            $.post(window.lmt_public.ajax_url, {
                action: 'lmt_books',
                route: 'filter_books',
                lmt_admin_nonce: lmt_public.lmt_public_nonce,
                per_page : per_page,
                page,
                search: $input.val(),
    
            }).then((response) => {
                console.log(response);
    
                $('.lmt_category_trips_wrapper').empty();
                let total = +response?.data?.total
                if(total == 0 ){
                    console.log('empty');
                    $('.lmt_category_trips_wrapper').append(`<p>There are no books</p>`);
                }
                else{
                    $('.lmt_category_trips_wrapper').append(response.data.data);
                }
            })
        }

      
     })
    //=======================================
    
    

})(jQuery);