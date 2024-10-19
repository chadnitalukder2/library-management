const submissionBorrowBooks = ($) => {
    let $form = $('#lmt_submission-borrow-form');
    let $submit = $('.lmt_borrow_btn');

    $submit.on('click' , function(e){
        e.preventDefault();
        let formDataArray = $form.serializeArray();
        let formDataObject = {};
        
        formDataArray.forEach(item => {
            formDataObject[item.name] = item.value;
        });

        $.post(window.lmt_public.ajax_url, {
            action: 'lmt_borrow_record',
            route: 'post_borrow_record',
            lmt_admin_nonce: lmt_public.lmt_public_nonce,
            data: formDataObject,

        }).then((response) => {
            console.log(response.success , 'response');
          
        })

    })
    return true;
}

export {submissionBorrowBooks};