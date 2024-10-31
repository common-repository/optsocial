<?php

function qt_popup_admin_js() {
    wp_enqueue_script('jquery');
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');

    wp_enqueue_script( 'qt-popup-custom-script-handle', plugins_url('/js/admin.js', __FILE__), array('jquery', 'media-upload', 'thickbox', 'wp-color-picker'), 1, true );


    wp_enqueue_style( 'qt-popup-admin-style', plugins_url('/css/admin.css', __FILE__), null );


    wp_enqueue_style( 'thickbox' );
    wp_enqueue_style( 'wp-color-picker' );
}
add_action( 'admin_enqueue_scripts', 'qt_popup_admin_js' );
