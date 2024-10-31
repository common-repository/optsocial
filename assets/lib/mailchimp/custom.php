<?php
function qt_popup_ar_mc_process($user_email,$user_name,$user_first_name='',$user_last_name='') {
    global $qt_popup_x1x_data, $qt_popup_functions;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

//    if ($user_first_name=='') $user_first_name = $user_name;

    $retval         = false;

    $email_type     = 'html';

    $double_optin   = 0;
    if ( !empty($qt_popup_tmp_options['mailchimp_double_opt']) ) {
        $double_optin = $qt_popup_tmp_options['mailchimp_double_opt'];
    }

    $welcome        = 1;
    if ( !empty($qt_popup_tmp_options['mailchimp_welcome']) ) {
        $welcome = $qt_popup_tmp_options['mailchimp_welcome'];
    }

    $qt_popup_after = '';
    if ( !empty($qt_popup_tmp_options['page_after_optin']) && $qt_popup_tmp_options['page_after_optin']!='#') {
        $qt_popup_after = $qt_popup_tmp_options['page_after_optin'];
    }

        $mckey		= $qt_popup_tmp_options['mailchimp_api_key'];
        $list_id	= $qt_popup_tmp_options['mailchimp_list_id'];

        if ( !empty($mckey) && !empty($list_id) ) {

            include_once plugin_dir_path(__FILE__).'MCAPI.class.php';

		    $mailChimp	= new MCAPI ( $mckey );
		    $merge_vars	= array ( 'NAME'=>$user_name.' '.$user_last, 'FNAME'=>$user_first_name, 'LNAME'=>$user_last_name );
		    $retval 	= $mailChimp->listSubscribe( $list_id, $user_email, $merge_vars, $email_type, $double_optin, 0, 0, $welcome );
        }

    wp_redirect( home_url( $qt_popup_after ) );
    exit;
}
