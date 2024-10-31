<?php

function qt_popup_sc_header( $atts, $content = null ) {
	return '<div class="qtcontainer qtrow qt_popup_header">'.do_shortcode($content).'</div>';
}
add_shortcode( 'qtpopup_header', 'qt_popup_sc_header' );

function qt_popup_sc_body( $atts, $content = null ) {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_qtlogo = '';
//    if ($qt_popup_tmpl_options['close_popup_button']) {
//        $tmp_qtlogo = '<div id="qt-popup-top-seal"></div>';
//    }

    $tmp_close = '';
    if ($qt_popup_tmpl_options['close_popup_button']) {
        $tmp_close = '<span id="qt_popup_close" class="qt-popup-close-button">X</span>';
    }

	return $tmp_qtlogo.'<div id="qt_popup_popup_inner" class="qt_popup_bg"><div class="qt-popup-body"><div class="qtcontainer qtrow">'.$tmp_close.do_shortcode($content).'</div></div></div>';
}
add_shortcode( 'qtpopup', 'qt_popup_sc_body' );

function qt_popup_sc_prefooter( $atts, $content = null ) {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_deploy_val = 0;
    if (isset($_COOKIE['qt_popup_deploy'])) {
        $tmp_deploy_val = $_COOKIE['qt_popup_deploy'];
    }

    if (isset($qt_popup_tmpl_options['conditional_prefooter']) && $tmp_deploy_val<$qt_popup_tmpl_options['conditional_prefooter'] ) {
        $res = '';
    } else {
    	$res = '<div class="qtcontainer qtrow qt_popup_prefooter">'.do_shortcode($content).'</div>';
    }
    return $res;
}
add_shortcode( 'qtpopup_prefooter', 'qt_popup_sc_prefooter' );

function qt_popup_sc_footer( $atts, $content = null ) {
	return '<div class="qtcontainer qtrow qt_popup_footer">'.do_shortcode($content).'</div>';
}
add_shortcode( 'qtpopup_footer', 'qt_popup_sc_footer' );

function qt_popup_row_sc( $atts, $content = null ) {

    $cla = '';
    if (isset($atts["class"])) { $cla = $atts["class"]; }

	return '<div class="qtrow '.$cla.'">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'qtrow', 'qt_popup_row_sc' );

function qt_popup_col_sc( $atts, $content = null ) {

    $offset = '';
    if (isset($atts["offset"])) { $offset = 'qtoffset'.$atts["offset"]; }

    $span = '';
    if (isset($atts["span"])) { $span = 'qtspan'.$atts["span"]; }

    $cla = '';
    if (isset($atts["class"])) { $cla = $atts["class"]; }

	return '<div class="qtcol '.$span.' '.$offset.' '.$cla.'">' . do_shortcode($content) . '</div>';
}
add_shortcode( 'qtcol', 'qt_popup_col_sc' );

