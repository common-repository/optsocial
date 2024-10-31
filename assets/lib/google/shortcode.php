<?php

function qt_popup_gp_btn( $atts ) {
    global $qt_popup_gp_url, $qt_popup_gp_tst;

    $tmp_msg = '!!! Please SetUp Google Application ID and Secret !!!';

    if ($qt_popup_gp_url!='' && $qt_popup_gp_tst!='') {
        $tmp_data = '<div><div class="qt_popup_gp"><a id="qt_gp_clk" href="'.$qt_popup_gp_url.'">'.$qt_popup_gp_tst.'</a></div></div>';
    } else {
        
            $tmp_data = '<span class="qt_popup_err">'.$tmp_msg.'</span>';

    }

	return $tmp_data;
}
add_shortcode( 'qtgp', 'qt_popup_gp_btn' );
