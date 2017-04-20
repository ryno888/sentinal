<?php
require_once BASEPATH."../application/third_party/random_compat-2.0.4/lib/random.php";
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Lib_string{
    
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
    //--------------------------------------------------------------------------------
    /**
     * function returns the amount of words specified in a String
     * @param type $string
     * @param type $word_count
     * @return type
     */
    public static function limit_string_word_count($string, $word_count = 5){
        $word_arr = explode(' ', $string);
        $word_slice = array_slice($word_arr, 0, $word_count);
        if(count($word_arr) > $word_count){
            return implode(' ', $word_slice)."...";
        }
        return implode(' ', $word_slice); 
    }
    //--------------------------------------------------------------------------------
    /**
     * function appends a number suffix via thi applicable number passed in parms
     * @param int $number
     * @return string value with suffixed nummber
     */
    public static function append_number_suffix($number) {
        $suffix = array('th','st','nd','rd','th','th','th','th','th','th');
        if (!$number){
            return false;
        }else if((($number % 100) >= 11) && (($number%100) <= 13)){
            return $number. 'th';
        }else{
            return $number. $suffix[$number % 10];
        }
    }
    //--------------------------------------------------------------------------------
    /**
     * limits a string via the string length and not the word count. 
     * This function does however return full words with an elipses if the string length exceeds the specified parm amount
     * @param type $string
     * @param type $length
     * @return type
     */
    public static function limit_string_by_length($string, $length = 25, $return_default = "") {
        
        if(!$string || $string == '' || $string == 'null'){
            return $return_default;
        }
        if(strlen($string) < $length){
            return $string;
        }
        $return = substr($string, 0, $length);
        return $return."...";
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