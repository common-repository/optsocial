<?php

function qt_popup_mc_pop() {
    global $qt_popup_x1x_data;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

        $ret = array( '' => 'None' );

        $mckey		= $qt_popup_tmp_options['mailchimp_api_key'];

        if ( !empty($mckey) ) {

            include_once plugin_dir_path(__FILE__).'MCAPI.class.php';

		    $mailChimp	= new MCAPI ( $mckey );
            $ttt        = $mailChimp->lists();

            foreach($ttt['data'] as $rrr) {
                $ret[$rrr['id']] = $rrr['name'];
            }
        }
    return $ret;
}
