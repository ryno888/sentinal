<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of lib_core
 *
 * @author Ryno Laptop
 */
class lib_core {
    public $ci = false;
    //--------------------------------------------------------------------------
    public function __construct(){
        $this->ci =& get_instance();
    }
    //--------------------------------------------------------------------------
    public function format_options($options = []){
        return lib_html_tags::get_html_options($options);
    }
    //--------------------------------------------------------------------------
}
