<?php

function qt_popup_cust_title( $atts, $content = null ) {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

//	$tmp_qtlogo.'<h1>'.do_shortcode($content).'</h1>';

    $tmp_tag = 'h1';
    if (isset($atts["tag"])) { $tmp_tag = $atts["tag"]; }

    $tmp_class = '';
    if (isset($atts["class"])) { $tmp_class = $atts["class"]; }


	return '<'.$tmp_tag.' id="qt-popup-title" class="'.$tmp_class.'">'.$content.'</'.$tmp_tag.'>';
}
add_shortcode( 'qttitle', 'qt_popup_cust_title' );

function qt_popup_cust_desc( $atts, $content = null ) {
    global $qt_popup_x1x_data;
    $qt_popup_tmpl_options = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_tag = 'p';
    if (isset($atts["tag"])) { $tmp_tag = $atts["tag"]; }

    $tmp_class = '';
    if (isset($atts["class"])) { $tmp_class = $atts["class"]; }


	return '<'.$tmp_tag.' id="qt-popup-description" class="'.$tmp_class.'">'.$content.'</'.$tmp_tag.'>';
}
add_shortcode( 'qtdesc', 'qt_popup_cust_desc' );
