 const booksSearch = ($) => {
    let $input = $('#lmt_books_search');
    let $submit = $('.lmt_search_btn')

    $submit.on('click' , function(e){
        e.preventDefault();
        
        $.post(window.lmt_public.ajax_url, {
            action: 'lmt_books',
            route: 'filter_books',
            lmt_admin_nonce: lmt_public.lmt_public_nonce,
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
    })
 }

 export {booksSearch};