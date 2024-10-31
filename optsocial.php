<?php
/**
 * Plugin Name: OptSocial Pop-Up Lite
 * Plugin URI:  http://bit.ly/opt-social
 * Text Domain: qt_popup
 * Description: Social Opt-In Pop-Up force visitors to opt-in using two clicks Social connect that provides real visitor eMail address used for list subscription. Triggered by timer on all site or just on selected pages.
 * Version:     0.2.1
 * Author:      VantCo
 * Author URI:  http://www.vantco.com/
 * License:     GPL
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$qt_popup_x1x_data = array (
    'full_name'         => 'PopUp',
    'full_author'       => 'Qt',
    'version'           => '0.2.1',
    'settings_version'  => '16',
    'menu_icon'         => 'dashicons-welcome-widgets-menus',
    'menu_position'     => '5.44',
    'debug'             => false,
);

$qt_popup_x1x_data['owner'] = array (
        'logo'               => array (
            'img'   => plugin_dir_url(__FILE__) . 'assets/img/logo.png',
            'link'  =>'http://www.vantco.com/',
        ),
        'info'               => array (
            'info'  => $qt_popup_x1x_data['full_name'],
            'img'   => plugin_dir_url(__FILE__) . 'assets/img/opt-social-pro-full.png',
            'img2'  => plugin_dir_url(__FILE__) . 'assets/img/small-opt-social-pro-full.png',
            'tag'   => 'h2',
            'link'  =>'http://bit.ly/optsocial-pro',
        ),
        'ver'               => array (
            'label' => 'Version:',
            'info'  => $qt_popup_x1x_data['version'],
        ),
);

// Here you can add tabs to exclude from the Options. Default values will be used, admins won't be able to change those default values.
$qt_popup_tabs_exclude = array();
//$qt_popup_tabs_exclude = array('tab20','tab50');

// --- DO NOT EDIT BELOW THIS LINE  --------------------------------------------

include_once plugin_dir_path(__FILE__) . 'assets/func.php';
$qt_popup_functions = new QtFunctions();

$qt_popup_x1x_data['name']            = $qt_popup_functions->text2slug ( $qt_popup_x1x_data['full_name'] );
$qt_popup_x1x_data['author']          = $qt_popup_functions->text2slug ( $qt_popup_x1x_data['full_author'] );
$qt_popup_x1x_data['prefix']          = $qt_popup_x1x_data['author'].'_'.$qt_popup_x1x_data['name'];
$qt_popup_x1x_data['url_prefix']      = $qt_popup_x1x_data['author'].'-'.$qt_popup_x1x_data['name'];
$qt_popup_x1x_data['options_name']    = $qt_popup_x1x_data['prefix'].''.$qt_popup_x1x_data['settings_version'];
$qt_popup_x1x_data['settings_name']   = $qt_popup_x1x_data['prefix'].'_settings'.''.$qt_popup_x1x_data['settings_version'];

define( strtoupper( $qt_popup_x1x_data['prefix'] ) . '_VERSION', $qt_popup_x1x_data['version'].time());
define( strtoupper( $qt_popup_x1x_data['prefix'] ) . '_DIR', plugin_dir_path(__FILE__));
define( strtoupper( $qt_popup_x1x_data['prefix'] ) . '_URL', plugin_dir_url(__FILE__));
define( strtoupper( $qt_popup_x1x_data['prefix'] ) . '_DOMAIN', get_bloginfo('url'));
define( strtoupper( $qt_popup_x1x_data['prefix'] ) . '_COOKIEPATH', '/');

include_once plugin_dir_path(__FILE__).'assets/functions.php';

if ( is_admin() ) {

    include_once plugin_dir_path(__FILE__).'admin/render.php';
    $qt_popup_render = new SunSetx5Render();

    include_once plugin_dir_path(__FILE__).'admin/prerender.php';
    $qt_popup_prerender = new qtPopUpPreRender();

    include_once plugin_dir_path(__FILE__).'admin/core.php';

    include_once plugin_dir_path(__FILE__).'admin/custom.php';

    $qt_popup_x1x_options = array();
    include_once plugin_dir_path(__FILE__).'admin/options.php';

    $qt_popup_x1x_custom_options = array();
    include_once plugin_dir_path(__FILE__).'admin/custom-options.php';

    $qt_popup_x1x_data['admin_menu'] = array (
            'page_title' => $qt_popup_x1x_data['full_name'].' Options',
            'menu_name'  => $qt_popup_x1x_data['full_name'],
            'menu_title' => 'General Settings',
            'capability' => 'manage_options',
            'menu_slug'  => $qt_popup_x1x_data['url_prefix'].'-options-page',
            'function'   => $qt_popup_x1x_data['prefix'].'_options_page',
            'icon_url'   => $qt_popup_x1x_data['menu_icon'],
            'position'   => $qt_popup_x1x_data['menu_position']
    );

    $qt_popup_x1x_data['admin_submenu'] = array (
            'page_title' => 'Reset '.$qt_popup_x1x_data['full_name'].' Options',
            'menu_title' => 'Reset Settings',
            'menu_slug'  => $qt_popup_x1x_data['url_prefix'].'-reset-options',
            'menu_page'  => $qt_popup_x1x_data['prefix'].'_reset_options_page'
    );

    include_once plugin_dir_path(__FILE__).'admin/scripts.php';

    add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'my_plugin_action_links' );
    function my_plugin_action_links( $links ) {
        global $qt_popup_x1x_data;
        $links[] = '<a target="_blank" href="'.$qt_popup_x1x_data['owner']['info']['link'].'"><u><strong>PRO Version</strong></u></a>';
        return $links;
    }
/*
    add_filter( 'plugin_row_meta', 'ts_plugin_meta_links', 10, 2 );
    function ts_plugin_meta_links( $links, $file ) {
        global $qt_popup_x1x_data;
	    $plugin = plugin_basename(__FILE__);
	    if ( $file == $plugin ) {
		    return array_merge(
			    $links, array( '<a target="_blank" href="'.$qt_popup_x1x_data['owner']['info']['link'].'"><u><strong>PRO Version</strong></u></a>' )
		    );
	    }
	    return $links;
    }
*/
}



include_once plugin_dir_path(__FILE__).'assets/lib/optin/core.php';
include_once plugin_dir_path(__FILE__).'assets/lib/facebook/core.php';
include_once plugin_dir_path(__FILE__).'assets/lib/google/core.php';

include_once plugin_dir_path(__FILE__).'assets/lib/autoresponder/core.php';

include_once plugin_dir_path(__FILE__).'assets/lib/video/core.php';

include_once plugin_dir_path(__FILE__).'runtime/core.php';

/*
if ( $qt_popup_x1x_data['debug'] == true ) {
    register_activation_hook( __FILE__, 'my_activation_func' );
    function my_activation_func() {
        file_put_contents(__DIR__.'/err_log.txt', ob_get_contents());
    }
}
*/
