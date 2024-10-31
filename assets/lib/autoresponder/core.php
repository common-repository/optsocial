<?php
global $qt_popup_x1x_options;

$qt_popup_x1x_options['tab-ar'] = array (

        'name' => 'Auto-Responders',
        'options' => array (

            'auto_responder' => array(

                'name' => 'auto_responder',
                'type' => 'dropdown',
                'print' => __('Auto-Responder'),
                'help' => 'Select Auto-Responder.',
                'data' => 'text',
                'value' => 'mailchimp',
                'items' => array ( '' => 'None', 'mailchimp' => 'MailChimp' )

            ),
        )
);

include_once plugin_dir_path(__FILE__).'../mailchimp/core.php';


function qt_popup_ar_process( $user_from, $user_id, $user_email, $user_first_name, $user_last_name ) {
    global $qt_popup_x1x_data, $qt_popup_functions;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    if ($user_last_name!='') {
        $user_name = $user_first_name.' '.$user_last_name;
    } else {
        $user_name = $user_first_name;
    }

    $tmp_ar = '';
    if ( !empty($qt_popup_tmp_options['auto_responder']) ) {
        $tmp_ar = $qt_popup_tmp_options['auto_responder'];

    switch ($tmp_ar) {

        case 'mailchimp':
            qt_popup_ar_mc_process( $user_email, $user_name, $user_first_name, $user_last_name );
            break;

        default:
            $tmp_ar = '';
    }


    }

}
