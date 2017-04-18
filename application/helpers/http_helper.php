<?php

/*
 * Class 
 * @filename lib 
 * @encoding UTF-8
 * @author Liquid Edge Solutions  * 
 * @copyright Copyright Liquid Edge Solutions. All rights reserved. * 
 * @programmer Ryno van Zyl * 
 * @date 14 Feb 2017 * 
 */

/**
 * Description of lib
 *
 * @author Ryno
 */
class Http_helper {
    //--------------------------------------------------------------------------
    public function __construct() {
    }
    //--------------------------------------------------------------------------
    public static function build_url($path = false) {
        if(strpos($path, "index.php") === false){
            return base_url("index.php/$path");
        }
        return base_url($path);
    }
    //--------------------------------------------------------------------------
    public static function redirect($path = false, $method = "location") {
        redirect(self::build_url($path), $method);
    }
    //--------------------------------------------------------------------------
    public static function go_home() {
        self::redirect("index.php");
    }
    //--------------------------------------------------------------------------
    public static function go_404() {
        self::redirect("index.php/index/page_not_found");
    }
    //--------------------------------------------------------------------------
    public static function get_current_url() {
        return current_url();
    }
    //--------------------------------------------------------------------------
    public static function json($data_arr = []) {
        header('Content-Type: application/json');
        echo json_encode($data_arr);
    }
    //--------------------------------------------------------------------------
    public static function error($code, $string = "") {
        $data_arr = [
            "code" => $code,
            "message" => $string,
        ];
        header('Content-Type: application/json');
        echo json_encode($data_arr);
    }
    //--------------------------------------------------------------------------
    public static function response($string = "", $options = []) {
        $options_arr = array_merge([
            "code" => 2,
            "action" => [
                "type" => "reload",
                "url" => "",
            ],
        ], $options);
        $data_arr = [
            "code" => $options_arr["code"],
            "message" => $string,
            "action" => $options_arr["action"],
        ];
        header('Content-Type: application/json');
        echo json_encode($data_arr);
    }
    //-----------------------------------------------------------------------
    public static function get_url_query_string($unset_keys = []) {
        $ci = & get_instance();
        $query_parts = $ci->uri->uri_to_assoc();
        foreach ($unset_keys as $key => $value) {
            if(isset($query_parts[$value])){
                unset($query_parts[$value]);
            }
        }
        
        return $ci->uri->assoc_to_uri($query_parts);
    }
    //--------------------------------------------------------------------------
}
