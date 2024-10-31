<?php

$qt_popup_x1x_options['tab-video'] = array (

        'name' => 'Video',
        'options' => array (

            'popup_video_control' => array(

                'name' => 'popup_video_control',
                'type' => 'dropdown',
                'print' => __('Video Source'),
                'help' => 'Select Video Site.',
                'data' => 'text',
                'value' => 'https://www.youtube-nocookie.com',
                'items' => array (

                    'https://www.youtube-nocookie.com/embed/' => 'Youtube No Cookies (Recommended)',
                    'https://www.youtube.com/embed/' => 'Youtube Standard',

                )

            ),

            'popup_video' => array(

                'name' => 'popup_video',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __('Video Code ID'),
                'help' => 'Use video code ID (example: AdOXhKjCTxE) to activate video on pop-up. Use video code ID only for this option, not a full URI.<br /><br />* Only video code ID supported. Better results with "video" template.<br /><br /><strong>** Enabling video will hide PopUp Description and Bullet List</strong>.',

            ),

            'popup_video_frame' => array(

                'name' => 'popup_video_frame',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Enable/Disable decoration frame around Video.',
                'data' => 'bool',
                'value' => '1',

            ),

        )

);

function qt_popup_lib_vdo_enqueue_style() {
    wp_enqueue_style( 'qt-popup-style-vdo',  plugins_url('vdo.css', __FILE__), false );
}

function qt_popup_lib_vdo_enqueue_script() {
    wp_enqueue_script( 'qt-popup-popup-vdo-cus', plugins_url('vdo-custom.js', __FILE__), array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'qt_popup_lib_vdo_enqueue_style' );
add_action( 'wp_enqueue_scripts', 'qt_popup_lib_vdo_enqueue_script' );

include_once plugin_dir_path(__FILE__).'shortcode.php';
