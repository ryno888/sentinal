<?php
require_once BASEPATH."../application/third_party/random_compat-2.0.4/lib/random.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class lib_string{
    
    //--------------------------------------------------------------------------
    public static function encrypt($string){
        $ci = &get_instance();
        $ci->load->library('encrypt');
        return $ci->encrypt->encode($string);
    }
    //--------------------------------------------------------------------------
    public static function decrypt($string){
        $ci = &get_instance();
        $ci->load->library('encrypt');
        return $ci->encrypt->decode($string);
    }
    //--------------------------------------------------------------------------
    public static function get_random_bytes($length = 32){
        try {
            $string = random_bytes($length);
        } catch (TypeError $e) {
            // Well, it's an integer, so this IS unexpected.
            die("An unexpected error has occurred");
        } catch (Error $e) {
            // This is also unexpected because 32 is a reasonable integer.
            die("An unexpected error has occurred");
        } catch (Exception $e) {
            // If you get this message, the CSPRNG failed hard.
            die("Could not generate a random string. Is our OS secure?");
        }

        return $string;
    }
    //--------------------------------------------------------------------------
    public static function rand($length) {
        $pool = array_merge(range(0,9), range('a', 'z'),range('A', 'Z'));
        $key = false;
        for($i=0; $i < $length; $i++) {
            $key .= $pool[mt_rand(0, count($pool) - 1)];
        }
        return $key;
    }
    //--------------------------------------------------------------------------
    public static function get_js_confirm_string($options = []) {
        $options_arr = array_merge([
            "message" => "Are you sure you want to continue?",
            "ok_label" => "Ok",
            "cancel_label" => "Cancel",
            "ok_callback" => false,
            "cancel_callback" => false,
        ], $options);
        $string = "";
        foreach ($options_arr as $key => $value) {
            if($value){
                $string .= " $key='$value'";
            }
        }
        return $string;
    }
    //--------------------------------------------------------------------------
}