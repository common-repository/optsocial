<?php

if ( !class_exists( 'QtFunctions' ) ) {

    class QtFunctions {

        public function __construct() {}

        public function add2array($arr,$k,$v) {
            $res = $arr[$k].=$v;
            return $res;
        }

        public function fl2name($tmp,$id) {
            $tmp = str_replace(" ","",$tmp);
            $tmp = $tmp . '' . substr($id, -5);
            $tmp = strtolower($tmp);
            return $tmp;
        }

        public function text2slug($tmp,$rep='_') {
            $tmp = str_replace(" ",$rep,$tmp);
            $tmp = strtolower($tmp);
            return $tmp;
        }

        public function slug2text($tmp) {
            $tmp = str_replace("_"," ",$tmp);
            $tmp = ucwords($tmp);
            return $tmp;
        }

        public function font2id($tmp) {
            $tmp = str_replace(" ","+",$tmp);
            return $tmp;
        }

        public function get_json_data($fname,$dt='true') {

            $ct_raw_config = $this->get_file($fname);

            $ct_raw_config = preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $ct_raw_config);
            $ct_raw_config = str_replace('\\', '\\\\', $ct_raw_config);
            $ct_arr_config = json_decode($ct_raw_config, $dt);
            return $ct_arr_config;
        }

        public function get_file($url) {
            $result = @file_get_contents($url);
            return $result;
        }

        public function get_file_curl($url) {


            $ch = curl_init();
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_URL,$url);
            $result=curl_exec($ch);
            curl_close($ch);

            return $result;
        }

    }

}
