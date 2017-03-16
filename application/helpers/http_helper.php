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
class http_helper {
    //--------------------------------------------------------------------------
    public function __construct() {
    }
    //--------------------------------------------------------------------------
    public static function build_url($path = false) {
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
    //--------------------------------------------------------------------------
}
