<?php
// global functions here

function LMT_getAvatar($email, $size)
{
    $hash = md5(strtolower(trim($email)));

    /**
     * Gravatar URL by Email
     *
     * @return HTML $gravatar img attributes of the gravatar image
     */
    return apply_filters('wppayform_get_avatar',
        "https://www.gravatar.com/avatar/${hash}?s=${size}&d=mm&r=g",
        $email
    );
}

function LMTDBModel($tableName = false)
{
    // return new \libraryManagement\Classes\Models\Model($tableName);
}


function lmtValidateNonce($key = 'lmt_admin_nonce')
{
    $nonce = \libraryManagement\Classes\Services\ArrayHelper::get($_REQUEST, $key);
 
    $shouldVerify = apply_filters('lmt_nonce_verify', true);

    if ($shouldVerify && !wp_verify_nonce(wp_unslash($nonce), $key)) {
        $errors = apply_filters('azp_nonce_error', [
            'error' => [
                __('Nonce verification failed, please try again.', 'azp_app')
            ]
        ]);

        wp_send_json($errors['error'], 422);
    }
}

function lmtFormatPrice($price) {
    return '$ ' . $price;
}