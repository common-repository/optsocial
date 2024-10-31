<?php

if ( !class_exists( 'qtPopUpPreRender' ) ) {

    class qtPopUpPreRender {

        public function __construct() {}


        public function render_options($opt) {

            global $qt_popup_x1x_options, $qt_popup_render, $qt_popup_tabs_exclude;

            $options = get_option($opt);

            echo '<div id="qt-popup-adm-contain"><div class="qt-popup-adm-accordion">';

            foreach ($qt_popup_x1x_options as $tmp_tabs => $tmp_inna) {

                $tmp_tab_name = $tmp_inna['name'];

                if (in_array($tmp_tabs,$qt_popup_tabs_exclude)) continue; 

                echo '<div id="qt-popup-adm-'.$tmp_tabs.'"><a href="#qt-popup-adm-'.$tmp_tabs.'" class="qt-popup-adm-tab">'.$tmp_tab_name.'</a><div class="qt-popup-adm-content"><table class="form-table">';


                foreach ($tmp_inna['options'] as $tmp_root => $tmp_ara) {


                    $tmp_print = '';
                    if (isset($tmp_ara['print'])) $tmp_print = $tmp_ara['print'];

                    $tmp_help = '';
                    if (isset($tmp_ara['help'])) $tmp_help = $tmp_ara['help'];

                    $field = $this->render_preset_x( $tmp_ara['name'], $tmp_print );

    // $name = '';

                    $value = '';
                    $value = $options[$tmp_ara['name']];
    /*
                    if( isset ( $options[$tmp_ara['name']] ) ) {
                        $value = $options[$tmp_ara['name']];
                    }
    */

                    $res = $qt_popup_render->open( $field['id'], $field['label'], $tmp_help );

                    switch ($tmp_ara['type']) {

                        case 'tizy':
                            $res.= $qt_popup_render->tizy ( );
                            break;
                        case 'input':
                            $res.= $qt_popup_render->input ( $field['id'], $opt.'[' . $field['name'] . ']', $value );
                            break;
                        case 'number':
                            $items = $tmp_ara['items'];
                            $res.= $qt_popup_render->number ( $field['id'], $opt.'[' . $field['name'] . ']', $value, $items['min'], $items['max'], $items['step'] );
                            break;
                        case 'check':
                            if ($value == 1) {$tmp_enabled = __('On');} else {$tmp_enabled = __('Off');}
                            $res.= $qt_popup_render->check ( $field['id'], $opt . '[' . $field['name'] . ']', $value, $tmp_enabled );
                            break;
                        case 'color':
                            $res.= $qt_popup_render->color ( $field['id'], $opt.'[' . $field['name'] . ']', $value );
                            break;
                        case 'longtext':
                            $res.= $qt_popup_render->longtext ( $field['id'], $opt.'[' . $field['name'] . ']', $value );
                            break;
                        case 'media':
                            $res.= $qt_popup_render->media ( $field['id'], $opt.'[' . $field['name'] . ']', $value );
                            break;
                        case 'multiselect':
                            $field['name']      = $opt."[".$tmp_ara['name']."][]";
                            $xxoptions          = array();

                            foreach ($tmp_ara['items'] as $k => $v ) {
                                $selected = ''; 
                                if (!empty($value)) $selected = ( in_array( $k, $value ) ) ? $qt_popup_render->multiselect_selected() : '';
                                $xxoptions[] = $qt_popup_render->multiselect_option( $k, $v, $selected );
                            }
                            $res.= $qt_popup_render->multiselect ( $field['id'], $field['name'], $xxoptions );
                        break;

                        case 'dropdown':
                            $xxoptions          = array();
                            $tmp_option         = '';

                            foreach ($tmp_ara['items'] as $v => $k) {
                                $selected = ''; 
                                if ($v == $value) {
                                    $selected = $qt_popup_render->dropdown_selected();
                                }
                                $xxoptions[] = $qt_popup_render->dropdown_option( $k, $v, $selected );
                            }

                            if (!empty($xxoptions)) $tmp_option = implode( '', $xxoptions );

                            $res.= $qt_popup_render->dropdown ( $field['id'], $opt.'[' . $field['name'] . ']', $tmp_option);
                            break;

                    }

                    $res.= $qt_popup_render->close();
                    echo $res;




                }

                echo '</table></div></div>';

            }

            echo '</div></div>';

        }

        public function render_preset_x( $option, $print='' ) {
            global $qt_popup_functions, $qt_popup_x1x_data;

//            $field['id']        = $qt_popup_x1x_data['url_prefix'].'-'.$option;
            $field['id']        = $qt_popup_x1x_data['prefix'].'_'.$option;

            if ($print=='') {
                $field['label'] = __( $qt_popup_functions->slug2text($option) );
            } else {
                $field['label'] = __( $print );
            }

            $field['name']      = $option;

            return $field;
        }

    }

}
