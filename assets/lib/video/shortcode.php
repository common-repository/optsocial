<?php

function qt_popup_video( $atts ) {
    global $qt_popup_x1x_data, $qt_popup_x1x_options;

    $qt_popup_options_array_tmp = get_option( $qt_popup_x1x_data['options_name'] );


        $tmp_vdo_url    = $qt_popup_options_array_tmp['popup_video_control'];
        $tmp_video      = $qt_popup_options_array_tmp['popup_video'];
        $tmp_autoplay   = 0;
        $tmp_frame      = $qt_popup_options_array_tmp['popup_video_frame'];

        if (isset($atts['src'])) $tmp_vdo_url           = $atts['src'];
        if (isset($atts['id'])) $tmp_video              = $atts['id'];
        if (isset($atts['autoplay'])) $tmp_autoplay     = $atts['autoplay'];
        if (isset($atts['frame'])) $tmp_frame           = $atts['frame'];

        $tmp_full       = $tmp_vdo_url.$tmp_video.'?autoplay='.$tmp_autoplay;

        if ($tmp_vdo_url=='https://www.youtube-nocookie.com/embed/' || $tmp_vdo_url=='https://www.youtube.com/embed/') {
            $tmp_full .= ';rel=0;showinfo=0;controls=0;cc_load_policy=0'; //wmode=transparent; modestbranding=1 
        }

        $tmp_f1         = "qt_popup_iframe('".$tmp_full."');";

        $tmp_fr         = 'fr-white'; if ($tmp_frame==0) {$tmp_fr.='-zero';}
        $tmp_data       = '<div class="'.$tmp_fr.'"><div id="qt-popup-yt" class="embed-container"></div></div>';

    if (isset($qt_popup_x1x_data['qt_popup_up'])) {
        $qt_popup_x1x_data['qt_popup_up'].= $tmp_f1;
    } else {
        $qt_popup_x1x_data['qt_popup_up'] = $tmp_f1;
    }

	return $tmp_data;
}
add_shortcode( 'qtvdo', 'qt_popup_video' );
