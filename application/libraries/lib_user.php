<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of com_html
 *
 * @author Ryno Laptop
 */
class lib_user {
    
    //--------------------------------------------------------------------------
    public static function get_active_user($detail = "person"){
        $session = lib_session::get_session();
        $return = false;
        if($session->userdata('logged_in')){
            if($detail){
                $user_data = $session->userdata($detail);
                $return = $user_data && !is_null($user_data) ? $user_data : false;
            }else{
                $return = $session->userdata($detail);
            }
        }
        return $return;
    }
    //-----------------------------------------------------------------------
    public static function get_active_id() {
        $active_user = self::get_active_user();
        return $active_user && property_exists($active_user, "per_id") ? $active_user->per_id : false;
    }
    //-----------------------------------------------------------------------
    public static function unset_user() {
        $CI_instance = &get_instance();
        $CI_instance->session->set_userdata(false);
    }
    //-----------------------------------------------------------------------
    public static function set_user($data_arr = []) {
        $user_data_arr = array_merge([
            'id'  => false,
            'person'  => false,
            'logged_in' => false,
            'datetime' => lib_date::strtodatetime(),
        ], $data_arr);
        $CI_instance = &get_instance();
        $CI_instance->session->set_userdata($user_data_arr);
    }
    //-----------------------------------------------------------------------
    public static function login($username, $password) {
        $person = self::authenticate($username, $password);
        if($person){
            self::set_user([
                'id'  => $person->per_id,
                'person'  => $person,
                'logged_in' => true,
            ]);
            return true;
        }
        return false;
    }
    //-----------------------------------------------------------------------
    public static function logout() {
        self::set_user(false);
    }
    //-----------------------------------------------------------------------
    public static function authenticate($username, $password) {
        $CI_instance = &get_instance();
        $CI_instance->load->library('encrypt');
        $CI_instance->load->library('lib_string');
        
        $person = lib_database::query("SELECT * FROM person WHERE per_username = '$username'", 1);
        if($person && lib_string::decrypt($person->per_password) == $password){
            return $person;
        }
        
        return false;
    }
    //--------------------------------------------------------------------------
}
