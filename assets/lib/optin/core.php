<?php
global $qt_popup_x1x_options;

$qt_popup_x1x_options['tab-optin'] = array (

        'name' => 'Opt-In',
        'options' => array (

            'optin_button_text' => array(

                'name' => 'optin_button_text',
                'type' => 'input',
                'data' => 'text',
                'value' => __('Subscribe Now!'),
                'print' => __(''),
                'help' => 'OptIn Button Text',

            ),

            'optin_button_background' => array(

                'name' => 'optin_button_background',
                'type' => 'color',
                'print' => __(''),
                'help' => 'OptIn Button Background Color',
                'data' => 'color',
                'value' => '#FFB347',

            ),

            'page_after_optin' => array(

                'name' => 'page_after_optin',
                'type' => 'dropdown',
                'print' => __('Redirect after OptIn'),
                'help' => 'Redirect user to the specified page right after OptIn.',
                'data' => 'text',
                'value' => '#',
                'items' => qt_popup_populate_pages_slug( array ( '#' => 'NO (Default)' ) )

            ),

        )

);

function qt_popup_head_optin() {
    global $qt_popup_x1x_data;
    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

//    $tmp_col = $qt_popup_tmp_options['optin_button_color'];
    $tmp_bg  = $qt_popup_tmp_options['optin_button_background'];

    echo "<script>";
    echo "jQuery(document).ready(function(){";
//    echo "jQuery('.qtinput-btn').attr('style', 'color: ".$tmp_col.";');";
    echo "jQuery('.qtinput-btn').attr('style', 'background: ".$tmp_bg.";');";
    echo "});";
    echo "</script>\n";
}
add_action('wp_head', 'qt_popup_head_optin');

function qt_popup_opt() {

    if (isset($_POST['qtpopup_reg_opt'])) {

        $user_email  = sanitize_email( $_POST['qtpopup_email'] );

        if ( isset($_POST['qtpopup_name']) ) { 
            $user_name   = sanitize_text_field( $_POST['qtpopup_name'] );
        } else {
            $user_name   = substr( $user_email, 0, strpos($user_email, '@') );
        }

        setcookie('qt_popup_cta', 'OI', time()+15552000, QT_POPUP_COOKIEPATH);
        qt_popup_custom_cta('OI','',$user_email,$user_name,'');

    } else {

    }
}
add_action( 'init', 'qt_popup_opt' );

function qt_popup_lib_optin_enqueue_style() {
    wp_enqueue_style( 'qt-popup-style-optin',  plugins_url('optin.css', __FILE__), false );
}


add_action( 'wp_enqueue_scripts', 'qt_popup_lib_optin_enqueue_style' );

include_once plugin_dir_path(__FILE__).'shortcode.php';
