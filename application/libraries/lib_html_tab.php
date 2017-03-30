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
class Lib_html_tab extends Lib_core{
    public $container_fluid = false;
    private $menu_html = [];
    private $body_html = [];
    private $view = false;
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("Lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function add_item($id, $label, $html, $options = []) {
        $options_arr = array_merge([
            "class" => false,
            "icon" => false,
            "onclick" => false,
            "show" => false,
        ], $options);
        
        $icon = $options_arr["icon"] ? "<i class='fa {$options_arr["icon"]} margin-right-5' aria-hidden='true'></i>" : "";
        $fade = $options_arr["show"] ? "fade in" : "";
        $active = $options_arr["show"] ? "active" : "";
        
        $this->menu_html[$id] = "
            <li role='presentation' class='$active'>
                <a href='#$id' id='$id-tab' class='tab-link' role='tab' data-toggle='tab' aria-controls='$id' aria-expanded='true'>
                    <span class='text'><span>{$icon}{$label}</span></span>
                </a>
            </li>
        ";
        
        $this->body_html[$id] = "
            <div role='tabpanel' class='tab-pane $fade $active' id='$id' aria-labelledby='profile-tab'>
                $html
            </div>
        ";
    }
    //--------------------------------------------------------------------------
    public function set_view($label, $view, $data, $options = []) {
        $options_arr = array_merge([
            "id" => "tab_".rand(1000, 9999),
        ], $options);
        $CI_Controller = CI_Controller::get_instance();
        $html = $CI_Controller->load->view($view, $data, true);
        
        $this->add_item($options_arr["id"], $label, $html, $options);
    }
    //--------------------------------------------------------------------------
    public function display($Lib_html = false) {
        $container = $this->container_fluid ? "container-fluid" : "container";
        $elements = implode("", $this->menu_html);
        $body = implode("", $this->body_html);
        
        echo "
            <div class='wrapper'>
                <div class='$container'>
                    <div class='bs-example bs-example-tabs' role='tabpanel' data-example-id='togglable-tabs'>
                        <ul id='myTab' class='nav nav-tabs nav-tabs-responsive' role='tablist'>
                            $elements
                        </ul>

                        <div id='myTabContent' class='tab-content'>
                            $body
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
    //--------------------------------------------------------------------------
}