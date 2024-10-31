<?php

function qt_popup_register_settings_1() {
    global $qt_popup_x1x_data;
	register_setting( $qt_popup_x1x_data['settings_name'], $qt_popup_x1x_data['options_name'], 'qt_popup_validate_1' );

    if ( !get_option( $qt_popup_x1x_data['options_name'] ) ) {
        qt_popup_do_def( $qt_popup_x1x_data['options_name'] );
    }
}
add_action('admin_init', 'qt_popup_register_settings_1' );

function qt_popup_admin_menu() {
    global $qt_popup_x1x_data;
    add_menu_page(
        $qt_popup_x1x_data['admin_menu']['page_title'],
        $qt_popup_x1x_data['admin_menu']['menu_name'],
        $qt_popup_x1x_data['admin_menu']['capability'],
        $qt_popup_x1x_data['admin_menu']['menu_slug'],
        $qt_popup_x1x_data['admin_menu']['function'],
        $qt_popup_x1x_data['admin_menu']['icon_url'],
        $qt_popup_x1x_data['admin_menu']['position']
    );
    add_submenu_page(
        $qt_popup_x1x_data['admin_menu']['menu_slug'],
        $qt_popup_x1x_data['admin_menu']['page_title'],
        $qt_popup_x1x_data['admin_menu']['menu_title'],
        $qt_popup_x1x_data['admin_menu']['capability'],
        $qt_popup_x1x_data['admin_menu']['menu_slug']
    );

    add_submenu_page(
        $qt_popup_x1x_data['admin_menu']['menu_slug'],
            $qt_popup_x1x_data['admin_submenu']['page_title'],
            $qt_popup_x1x_data['admin_submenu']['menu_title'],
        $qt_popup_x1x_data['admin_menu']['capability'],
            $qt_popup_x1x_data['admin_submenu']['menu_slug'],
            $qt_popup_x1x_data['admin_submenu']['menu_page']
    );
}
add_action('admin_menu', 'qt_popup_admin_menu');

function qt_popup_reset_options_page() {
    global $qt_popup_x1x_data;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    if ( isset( $_POST['qt_popup_reset_options'] ) && $_POST['qt_popup_reset_options'] === 'true' ) {
        delete_option( $qt_popup_x1x_data['options_name'] );
        qt_popup_do_def( $qt_popup_x1x_data['options_name'] );
    }
    include_once( 'tmpl-reset.php' );
}

function qt_popup_options_page() {
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}
    include_once( 'tmpl-options.php' );
}

function qt_popup_validate_1($input) {
    global $qt_popup_x1x_options;
	if ( !current_user_can( 'manage_options' ) )  {
		wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
	}

    foreach ($qt_popup_x1x_options as $tmp_tabs => $tmp_inna) {
        foreach ($tmp_inna['options'] as $tmp_root => $tmp_ara) {
            $input[$tmp_ara['name']] = qt_popup_fcheck( $tmp_ara['data'], $input[$tmp_ara['name']] );
        }
    }
	return $input;
}

function qt_popup_fcheck($t, $v) {

    $allowed_html = array(
        'h2' => array(),
        'h3' => array(),
        'h4' => array(),
        'br' => array(),
        'em' => array(),
        'strong' => array(),
    );

        switch ($t) {

            case 'bool':
                $v = ( $v == 1 ? 1 : 0 );
                break;
            case 'text':
                $v =  wp_filter_nohtml_kses($v);
                break;
            case 'html':
                $v =  wp_kses($v, $allowed_html);
                break;
            case 'color':
                $v =  wp_filter_kses($v);
                break;
            case 'int':
                $v =  (int) $v;
                break;
            case 'intpos':
                $v =  (int) $v;
                if ( $v < 1 ) { $v = 1; }
                break;
            case 'float':
                $v =  (float) $v;
                break;
            case 'num':
                $v =  preg_replace('/[^0-9.]*/','',$v);
                break;
            case 'multiselect':
                if (is_array($v)) {
                    $v =  array_map( 'esc_attr', $v );
                } else {
                    $v = array();
                }
                break;
        }

        return $v;
}

function qt_popup_do_def($opt) {
    global $qt_popup_x1x_options;
    $tmp_arr = array();
    foreach ($qt_popup_x1x_options as $tmp_tabs => $tmp_inna) {
        foreach ($tmp_inna['options'] as $tmp_root => $tmp_ara) {
            $kk = $tmp_ara['name'];
            $vv = $tmp_ara['value'];
            $tmp_arr[$kk]=$vv;
        }
    }

    update_option( $opt, $tmp_arr);
}

function qt_popup_populate_g() {
    global $qt_popup_x1x_data, $qt_popup_x1x_options;

    $qt_popup_options_array_tmp = get_option( $qt_popup_x1x_data['options_name'] );

    $tmp_fonts = qt_popup_get_json_data( plugin_dir_path( __FILE__ ) . '../assets/cache/google_fonts.json' );
    $tmp_font_arr = array();
    foreach ($tmp_fonts['items'] as $tmp_font_item) {
        $tmp_font_arr[$tmp_font_item] = $tmp_font_item;
    }
    return $tmp_font_arr;
}

function qt_popup_get_json_data($fname,$dt='true') {

    $ct_raw_config =  @file_get_contents($fname);

    $ct_raw_config = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $ct_raw_config);
    $ct_raw_config = str_replace('\\', '\\\\', $ct_raw_config);
    $ct_arr_config = json_decode($ct_raw_config, $dt);
    return $ct_arr_config;
}
