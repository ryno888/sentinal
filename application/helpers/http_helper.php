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
        self::redirect();
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
}
