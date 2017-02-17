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
class lib_html {
    public $container_fluid = false;
    private $ci = false;
    private $html = "";
    //--------------------------------------------------------------------------
    public function __construct() {
        $this->ci = &get_instance();
        $this->ci->load->library("lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function form($action, $id = false, $attributes_arr = [], $options = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::form_open($action, $id, $attributes, $options));
    }
    //--------------------------------------------------------------------------
    public function end_form() {
        $this->add_html(lib_html_tags::form_close());
    }
    //--------------------------------------------------------------------------
    public function fieldset_open($header, $options = []) {
        $options_arr = array_merge([
        ], $options);
        
        $this->add_html(lib_html_tags::fieldset_open($header));
    }
    //--------------------------------------------------------------------------
    public function fieldset_close() {
        $this->add_html(lib_html_tags::fieldset_close());
    }
    //--------------------------------------------------------------------------
    public function header($label, $type = 1, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::header($label, $type, $attributes));
    }
    //--------------------------------------------------------------------------
    public function itext($label, $id, $value = false, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::itext($label, $id, $value, $attributes));
    }
    //--------------------------------------------------------------------------
    public function itextarea($label, $id, $value = false, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::itextarea($label, $id, $value, $attributes));
    }
    //--------------------------------------------------------------------------
    public function ipassword($label, $id, $value = false, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::ipassword($label, $id, $value, $attributes));
    }
    //--------------------------------------------------------------------------
    public function iselect($label, $id, $value_arr = [], $value = false, $attributes_arr = []) {
        $attributes = array_merge([
        ], $attributes_arr);
        
        $this->add_html(lib_html_tags::iselect($label, $id, $value_arr, $value, $attributes));
    }
    //--------------------------------------------------------------------------
    public function add_html($html) {
        $this->html .= $html;
    }
    //--------------------------------------------------------------------------
    public function add_column($size) {
        switch ($size) {
            case "full": $this->add_html("<div class='col-md-12'>"); break;
            case "half": $this->add_html("<div class='col-md-6'>"); break;
            case "third": $this->add_html("<div class='col-md-4'>"); break;
            case "quarter": $this->add_html("<div class='col-md-3'>"); break;
        }
    }
    //--------------------------------------------------------------------------
    public function end_column() {
        $this->add_html("</div>");
    }
    //--------------------------------------------------------------------------
    public function container_wrapper($html) {
        $container = $this->container_fluid ? "container-fluid" : "container";
        return "
            <div class='$container'>
                <div class='row'>
                    $html
                </div>
            </div>
        ";
    }
    //--------------------------------------------------------------------------
    public function display() {
        echo $this->container_wrapper($this->html);
    }
    //--------------------------------------------------------------------------
    public static function make() {
        $ci = &get_instance();
        $ci->load->library("lib_database");
        return $this->ci->db;
    }
    //--------------------------------------------------------------------------
}