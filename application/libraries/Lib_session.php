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
class Lib_session extends Lib_core{
    private $session = false;
    //--------------------------------------------------------------------------
    public function __construct(){
        parent::__construct();
        $this->ci->load->library("session");
        $this->session = $this->ci->session;
    }
    //--------------------------------------------------------------------------
    public function get(){
        return $this->session;
    }
    //--------------------------------------------------------------------------
    public static function get_session(){
        $ci =& get_instance();
        $ci->load->library("session");
        return $ci->session;
    }
    //--------------------------------------------------------------------------
}
