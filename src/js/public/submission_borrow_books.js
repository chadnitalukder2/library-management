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
        
        const validateFormData = validation(formDataObject);
        if (validateFormData !== true) {
            let errors = validateFormData;
            $form.find('.tm_error').remove();
            for (let key in errors) {
                $form.find(`[name="${key}"]`).after(`<div class="tm_error">${errors[key]}</div>`);
            }
            return;
        }

        $.post(window.lmt_public.ajax_url, {
            action: 'lmt_borrow_record',
            route: 'post_borrow_record',
            lmt_admin_nonce: lmt_public.lmt_public_nonce,
            data: formDataObject,

        }).then((response) => {
            if (response.success === true ) {
                $form.find('.tm_error').remove();
                $form.find('.tm_success').remove();
                $form.append('<div class="tm_success">Book has been Borrowed successfully</div>');
                $form.trigger('reset');
                formDataObject = {};
            } else {
                $form.find('.tm_error').remove();
                $form.find('.tm_success').remove();
                $form.append('<div  class="tm_error">Something went wrong. Please try again later</div>');
            }
        }).catch((error) => {
            console.log(error, 'error');
            $form.find('.tm_error').remove();
            $form.find('.tm_success').remove();
            $form.append('<div class="tm_error">Something went wrong. Please try again later</div>');
        });

    })
    return true;
}
const validation = (formData) => {
    let errors = {};
    if (formData.borrow_date === '') {
        errors.borrow_date = 'Borrow date is required';
    }
    if (formData.return_date === '') {
        errors.return_date = 'Return Date is required';
    }

    if (Object.keys(errors).length > 0) {
        return errors;
    }

    return true;
}

export {submissionBorrowBooks};