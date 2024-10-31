<?php

include_once plugin_dir_path(__FILE__).'custom.php';

$qt_popup_x1x_options['tab-google'] = array (
        'name' => 'Google',
        'options' => array (

/*
            'google_status' => array(

                'name' => 'google_status',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to Enable/Disable Google. Default: Off.',
                'data' => 'bool',
                'value' => '0',

            ),
*/

            'google_app_id' => array(

                'name' => 'google_app_id',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'Google Application ID.',

            ),
            'google_secret' => array(

                'name' => 'google_secret',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'Google Secret.',

            ),

            'google_button_text' => array(

                'name' => 'google_button_text',
                'type' => 'input',
                'data' => 'text',
                'value' => __('Continue with Google'),
                'print' => __(''),
                'help' => 'Text on Google Connect Button.',

            ),

            'page_after_gp' => array(

                'name' => 'page_after_gp',
                'type' => 'dropdown',
                'print' => __('Redirect after Google Connect'),
                'help' => 'Redirect user to the specified page right after Google Connect.',
                'data' => 'text',
                'value' => '#',
                'items' => qt_popup_populate_pages_slug( array ( '#' => 'Default' ) )

            ),

        )
    );


add_action('init', 'qt_popup_gp_core');

function qt_popup_gp_core() {

    session_start();

    global $qt_popup_x1x_data, $qt_popup_functions, $qt_popup_gp_url, $qt_popup_gp_tst;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    $qt_popup_after = '';

//  !empty..
    if ( $qt_popup_tmp_options['google_app_id']!='' && $qt_popup_tmp_options['google_secret']!='' ) {

            $clientId           = $qt_popup_tmp_options['google_app_id'];
            $clientSecret       = $qt_popup_tmp_options['google_secret'];

            $homeUrl            = get_bloginfo('url');

            $redirectUrl        = $homeUrl.'/'.$qt_popup_after; //urlencode($homeUrl.'/'.$qt_popup_after);

            include_once plugin_dir_path(__FILE__)."src/Google_Client.php";
            include_once plugin_dir_path(__FILE__)."src/contrib/Google_Oauth2Service.php";

            $gClient            = new Google_Client();
            $gClient->setApplicationName('Qt Pop-Up');
            $gClient->setClientId($clientId);
            $gClient->setClientSecret($clientSecret);
            $gClient->setRedirectUri($redirectUrl);

            $google_oauthV2     = new Google_Oauth2Service($gClient);

if ( isset($_COOKIE['QT_OAUTH']) && $_COOKIE['QT_OAUTH']=='GP' ) {

            if(isset($_REQUEST['code'])){
	            $gClient->authenticate();
	            $_SESSION['gp_token'] = $gClient->getAccessToken();

                wp_redirect( home_url( $qt_popup_after ) ); // !!!
                exit;

            }

}

            if (isset($_SESSION['gp_token'])) {
	            $gClient->setAccessToken($_SESSION['gp_token']);
            }

            if ($gClient->getAccessToken()) {
	            $userProfile = $google_oauthV2->userinfo->get();

                $tmp_id     = $userProfile['id'];
                $tmp_fname  = $userProfile['given_name'];
                $tmp_lname  = $userProfile['family_name'];
                $tmp_email  = $userProfile['email'];
                $user_name  = $tmp_fname.' '.$tmp_lname;

                unset($_SESSION['gp_token']);
                $gClient->revokeToken();
//                session_destroy();

                setcookie('QT_OAUTH', '', time()+172800 );
                setcookie('qt_popup_cta', 'GP', time()+15552000, QT_POPUP_COOKIEPATH);
                qt_popup_custom_cta( 'GP', $tmp_id, $tmp_email, $user_name, $tmp_fname, $tmp_lname );

            } else {
	            $authUrl = $gClient->createAuthUrl();
            }


        if(isset($authUrl)) {
            $qt_popup_gp_tst    = $qt_popup_tmp_options['google_button_text'];
            $qt_popup_gp_url    = $authUrl;
        } else {
            $qt_popup_gp_tst    = 'LogOut';
            $qt_popup_gp_url    = '#';
        }

    }

}

function qt_popup_lib_gp_enqueue_style() {
    wp_enqueue_style( 'qt-popup-style-gp',  plugins_url('google.css', __FILE__), false );
}

add_action( 'wp_enqueue_scripts', 'qt_popup_lib_gp_enqueue_style' );

include_once plugin_dir_path(__FILE__).'shortcode.php';
