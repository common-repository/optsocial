<?php

function qt_popup_custom_cta( $user_from, $user_id, $user_email, $user_first_name, $user_last_name='' ) {
    qt_popup_ar_process( $user_from, $user_id, $user_email, $user_first_name, $user_last_name );
}

function qt_popup_populate_pages($pre=null) {
    global $qt_popup_x1x_data, $qt_popup_x1x_options;

    $ct_pages = get_pages();
    if ($pre) {
        $arr_tmp = $pre;
    } else {
        $arr_tmp = array();
    }
    foreach ( $ct_pages as $ct_page ) {
        $arr_tmp[ $ct_page->ID ] = $ct_page->post_title;
    }
    return $arr_tmp;
}

function qt_popup_populate_pages_slug($pre=null) {
    global $qt_popup_x1x_data, $qt_popup_x1x_options;

    $ct_pages = get_pages();
    if ($pre) {
        $arr_tmp = $pre;
    } else {
        $arr_tmp = array();
    }
    foreach ( $ct_pages as $ct_page ) {
        $arr_tmp[ $ct_page->post_name ] = $ct_page->post_title;
    }
    return $arr_tmp;
}
