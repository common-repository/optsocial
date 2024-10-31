<?php

include_once plugin_dir_path(__FILE__).'custom.php';

$qt_popup_x1x_options['tab110'] = array (
        'name' => 'Facebook',
        'options' => array (

/*
            'facebook_status' => array(

                'name' => 'facebook_status',
                'type' => 'check',
                'print' => __(''),
                'help' => 'Switch (On/Off) to Enable/Disable Facebook. Default: On.',
                'data' => 'bool',
                'value' => '1',

            ),
*/

            'facebook_app_id' => array(

                'name' => 'facebook_app_id',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'Facebook Application ID.',

            ),
            'facebook_secret' => array(

                'name' => 'facebook_secret',
                'type' => 'input',
                'data' => 'text',
                'value' => '',
                'print' => __(''),
                'help' => 'Facebook Secret.',

            ),

            'facebook_button_text' => array(

                'name' => 'facebook_button_text',
                'type' => 'input',
                'data' => 'text',
                'value' => __('Continue with FaceBook'),
                'print' => __(''),
                'help' => 'Text on FaceBook Connect Button.',

            ),

            'page_after_fb' => array(

                'name' => 'page_after_fb',
                'type' => 'dropdown',
                'print' => __('Redirect after FaceBook Connect'),
                'help' => 'Redirect user to the specified page right after FaceBook Connect.',
                'data' => 'text',
                'value' => '#',
                'items' => qt_popup_populate_pages_slug( array ( '#' => 'Default' ) )

            ),

        )
    );



add_action('init', 'qt_popup_fb_core');
function qt_popup_fb_core() {

    global $qt_popup_x1x_data, $qt_popup_functions, $qt_popup_fb_url, $qt_popup_fb_tst;

    $qt_popup_tmp_options = get_option( $qt_popup_x1x_data['options_name'] );

    $qt_popup_after = '';

//  !empty..
    if ( $qt_popup_tmp_options['facebook_app_id']!='' && $qt_popup_tmp_options['facebook_secret']!='' ) {

            $fbGraphUrl = 'https://graph.facebook.com/';

            $appID      = $qt_popup_tmp_options['facebook_app_id'];
            $appSecret  = $qt_popup_tmp_options['facebook_secret'];

            $appurl     = urlencode(get_bloginfo('url').'/'.$qt_popup_after);

            $qt_popup_fb_url = 'https://www.facebook.com/dialog/oauth?client_id='.$appID.'&redirect_uri='.$appurl.'&scope=email,public_profile';
            $qt_popup_fb_tst = $qt_popup_tmp_options['facebook_button_text'];

            if ( isset($_GET['error']) && ($_GET['error']=="access_denied") && ($_GET['error_code']=="200") && ($_GET['error_description']=="Permissions error") && ($_GET['error_reason']=="user_denied")) {
                wp_redirect( home_url(  ) ); // redirect after decline, set cookies!
                exit;
            }

            if ( isset($_COOKIE['QT_OAUTH']) && $_COOKIE['QT_OAUTH']=='FB' ) {
            if ( isset($_GET['code']) ) {

                $tmp_req = $fbGraphUrl."oauth/access_token?client_id=".$appID."&redirect_uri=".$appurl."&client_secret=".$appSecret."&code=".$_GET['code'];

	            $response_raw = $qt_popup_functions->get_file($tmp_req);

	            parse_str($response_raw, $response);
//                $response = json_decode($response_raw, true);

	            if ($response) {
                    if (isset($response['access_token'])) {

		                $acctok = $response['access_token'];
		                $inspect = $qt_popup_functions->get_file($fbGraphUrl."debug_token?input_token=".$acctok."&access_token=".$appID."|".$appSecret);
		                $inspect = json_decode($inspect, true);

		                if ( ($inspect['data']['app_id'] == "$appID") && ($inspect['data']['is_valid'] == "1") && ($inspect['data']['expires_at'] > time()) ) {

		                    $uid = $inspect['data']['user_id'];

//                          $tmp_url = $fbGraphUrl.'me?'.http_build_query(array(
                            $tmp_url = $fbGraphUrl.$uid.'?'.http_build_query(array(
                                'fields' => 'id,name,email,first_name,last_name',
                                'access_token' => $acctok,
                            ));

//                          $user = json_decode($qt_popup_functions->get_file($tmp_url));
                            $user = json_decode($qt_popup_functions->get_file_curl($tmp_url),true);

                            if ( isset($user['email']) && isset($user['first_name']) && isset($user['last_name']) ) {

                                $user_name  = '';
                                if (isset($user['name'])) {
                                    $user_name  = $user['name'];
                                }

                                setcookie('QT_OAUTH', '', time()+172800 );
                                setcookie('qt_popup_cta', 'FB', time()+15552000, QT_POPUP_COOKIEPATH);
                                qt_popup_custom_cta('FB',$user['id'],$user['email'],$user_name,$user['first_name'],$user['last_name']);
//  check state response

                            } else {
//
                            }

//                          wp_redirect( home_url( ) ); // !!!
//                          exit;

		                } else {
                            wp_redirect( home_url(  ) );
                            exit;
		                }
                    } else {
                        // var_dump($response);
                        wp_redirect( home_url(  ) );
                        exit;
                    }

	            }

                wp_redirect( home_url(  ) );
                exit;

            }
            }
    }

}

function qt_popup_head_fb1() {
    echo "<script>if (window.location.href.indexOf('#_=_') > 0) { window.location = window.location.href.replace(/#.*/, ''); }</script>\n";
}
add_action('wp_head', 'qt_popup_head_fb1');

function qt_popup_lib_fb_enqueue_style() {
    wp_enqueue_style( 'qt-popup-style-fb',  plugins_url('facebook.css', __FILE__), false );
}

function qt_popup_lib_fb_enqueue_script() {
//    wp_enqueue_script( 'qt-popup-popup-fb-cus', plugins_url('fb-custom.js', __FILE__), array( 'jquery' ), '', true );
}

add_action( 'wp_enqueue_scripts', 'qt_popup_lib_fb_enqueue_style' );
//add_action( 'wp_enqueue_scripts', 'qt_popup_lib_fb_enqueue_script' );

include_once plugin_dir_path(__FILE__).'shortcode.php';
