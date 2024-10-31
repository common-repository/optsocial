<?php

include_once plugin_dir_path(__FILE__).'scripts.php';

function qt_popup_load() {

    global $qt_popup_x1x_data, $wp_query;

    $tmp_go = true;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    if ( is_user_logged_in() || is_feed() ) {
        return;
    }

    if (!$qt_popup_tmp_options['popup_status']) {
        return;
    }

    if ( isset( $qt_popup_x1x_data['no_go'] ) ) {
        if ( is_page( $qt_popup_x1x_data['no_go'] ) ) {
            $tmp_go = false;
        }
    }

    if ( isset($_COOKIE['qt_popup_cta']) && $qt_popup_tmp_options['stop_after_cta'] ) {
        $tmp_go = false; // ACTION ALREADY EXECUTED
    }

    $tmp_deploy_val = 0;
    if ( isset($_COOKIE['qt_popup_deploy']) ) {
        $tmp_deploy_val = $_COOKIE['qt_popup_deploy'];
    }

    if ( $qt_popup_tmp_options['popup_show_times']>0 && $tmp_deploy_val>=$qt_popup_tmp_options['popup_show_times'] ) {
        $tmp_go = false;
    }

    if ( $tmp_go ) {

        $tmp_show_int = 0;
        if ( isset($qt_popup_tmp_options['popup_show_interval']) ) $tmp_show_int = $qt_popup_tmp_options['popup_show_interval'];

        setcookie( 'qt_popup_deploy', $tmp_deploy_val + 1, time() + $tmp_show_int, QT_POPUP_COOKIEPATH );

        add_action( 'wp_head', 'qt_popup_head' );

        add_action( 'wp_footer', 'qt_popup_footer' );

        add_action( 'wp_footer', 'qt_popup_z_timer', 40 );

    }

}
add_action( 'template_redirect', 'qt_popup_load' );

function qt_popup_footer() {
    echo "\n\n" . '<!-- Qt Pop-Up Tmpl -->' . "\n";
    include_once plugin_dir_path( __FILE__ ).'tmpl.php';
    echo '<!-- End Qt Pop-Up Tmpl -->' . "\n\n";
}

include_once plugin_dir_path(__FILE__).'custom.php';
include_once plugin_dir_path(__FILE__).'shortcodes.php';
include_once plugin_dir_path(__FILE__).'shortcodes-custom.php';
