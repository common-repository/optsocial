<?php
include_once plugin_dir_path(__FILE__).'admin.php';
include_once plugin_dir_path(__FILE__).'custom.php';

global $qt_popup_x1x_options;

$qt_popup_x1x_options['tab-ar-mc'] = array (

        'name' => 'MailChimp',
        'options' => array (

            'mailchimp_api_key' => array(

                'name' => 'mailchimp_api_key',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'MailChimp API Key.',

            ),

            'mailchimp_list_id' => array(

                'name' => 'mailchimp_list_id',
                'type' => 'dropdown',
                'print' => __('MailChimp List'),
                'help' => 'Select MailChimp List from Drop-Down. Make sure you have set MailChimp API Key first.',
                'data' => 'text',
                'value' => '',
                'items' => qt_popup_mc_pop()

            ),

/*
            'mailchimp_list_id' => array(

                'name' => 'mailchimp_list_id',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'MailChimp List ID. *Leave empty if not used or if you want to use an official MailChimp plugin! Connect with MailChimp will work only if API Key and List ID filled in.',

            ),
*/




            'mailchimp_double_opt' => array(

                'name' => 'mailchimp_double_opt',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to Enable/Disable Double Opt-In. Default: Off.',
                'data' => 'bool',
                'value' => '0',

            ),

            'mailchimp_welcome' => array(

                'name' => 'mailchimp_mailchimp_welcome',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to Enable/Disable Welcome eMail. Default: On.',
                'data' => 'bool',
                'value' => '1',

            ),


        )
);
