<?php

function qt_popup_fb_btn( $atts ) {
    global $qt_popup_fb_url, $qt_popup_fb_tst;

    $tmp_msg = '!!! Please SetUp FaceBook Application ID and Secret !!!';

    if ($qt_popup_fb_url!='' && $qt_popup_fb_tst!='') {
        $tmp_data = '<div><div class="qt_popup_fb"><a id="qt_fb_clk" href="'.$qt_popup_fb_url.'">'.$qt_popup_fb_tst.'</a></div></div>';
    } else {
        $tmp_data = '<span class="qt_popup_err">'.$tmp_msg.'</span>';
    }

	return $tmp_data;
}
add_shortcode( 'qtfb', 'qt_popup_fb_btn' );
