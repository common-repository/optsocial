<?php

if ( !class_exists( 'SunSetx5Render' ) ) {

    class SunSetx5Render {

        public function __construct() {}

        public function alert( $id,$class,$msg ) {
            return '<div id="'.$id.'" class="'.$class.' notice notice-success is-dismissible below-h2"><p>'.__( $msg ).'.</p><button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
        }

        public function open( $id, $label, $help ) {
            return '<tr valign="top"><th scope="row"><hr><label for="' . $id . '">' . $label . '</label></th><td><br /><div class="qt-popup-adhelp">'. $help .'</div><br />';
        }

        public function open_meta( $id, $label, $help ) {
            return '<tr valign="top"><th scope="row"><hr><label for="' . $id . '">' . $label . '</label></th></tr><tr><td><div class="qt-popup-adhelp">'. $help .'</div><br />';
        }

        public function close() {
            return '</td></tr>';
        }

        public function tizy( ) {
            return '';
        }

        public function input( $id, $full_name, $value ) {
            return '<input type="text" id="' . $id . '" name="' . $full_name . '" value="' . $value . '">';
        }

        public function check( $id, $full_name, $value, $enabled='' ) {
            return '<input class="qt-popup-switch" type="checkbox" id="' . $id . '" name="'.$full_name.'" value="1" '.checked( 1, $value, false ).' /><label for="' . $id . '">'. __('Switch') . ' '.$enabled.'</label>';
        }

        public function number( $id, $full_name, $value, $min, $max, $step ) {
            return '<input type="number" size="10" id="' . $id . '" name="'.$full_name.'" value="'.$value.'" min="' . (string) $min . '" max="' . (string) $max . '" step="' . (string) $step . '" />';
        }

        public function color( $id, $full_name, $value ) {
            return  '<input type="text" value="' . $value . '" id="' . $id . '" name="'.$full_name.'" class="qt-popup-color-picker" />';
        }

        public function longtext( $id, $full_name, $value ) {
            $cols = 24;
            return  '<textarea name="'.$full_name . '" id="' . $id . '" rows=6 cols=' . $cols . '>' . esc_textarea($value) . '</textarea>';
        }

        public function media( $id, $full_name, $value ) {

            return '<input type="text" id="' . $id . '" name="' . $full_name . '" value="' . $value . '" /><input type="button" class="qt-popup-media-upload-button button" value="Upload Image" /><br /><br /><div ><img style="max-width:230px;" class="img_prev" src="'. esc_url( $value ) .'" /></div>';
        }

        public function multiselect( $id, $full_name, $xxoptions ) {
            $multiple   = ' multiple="multiple"';
            $size       = ' size="10"';
            return '<select name="' . $full_name . '" style="width:240px;" id="' . $id . '" ' . $size . $multiple . '>' . implode( '', $xxoptions ) . '</select>';
        }

        public function dropdown( $id, $full_name, $tmp_option ) {

            return '<select name="' . $full_name . '" style="width:220px;" id="' . $id . '">' . $tmp_option . '</select>';
        }

        public function multiselect_selected( ) {
            return ' selected="selected"';
        }

        public function multiselect_option( $k, $v, $selected ) {
            return '<option value="' . $k . '"' . $selected . '>' . $v . '</option>';
        }

        public function dropdown_selected( ) {
            return ' selected';
        }

        public function dropdown_option( $k, $v, $selected ) {
            return '<option'.$selected.' value="' . $v . '">' . $k . '</option>';
        }
    }
}
