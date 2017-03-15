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
class lib_html_manage extends lib_core{
    public $container_fluid = false;
    private $menu_html = [];
    private $view = false;
    private $titel = false;
    
    public $css_link = "cursor:pointer;";
    public $css_link_hover = "background-color: #e4f5ff;";
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function set_view($view, $data = false) {
        $ci = CI_Controller::get_instance();
        $this->view = $ci->load->view($view, $data, true);
    }
    //--------------------------------------------------------------------------
    public function add($mixed) {
        $this->menu_html[] = $mixed;
    }
    //--------------------------------------------------------------------------
    public function add_item($label, $onclick, $options = []) {
        $options_arr = array_merge([
            "class" => false,
            "icon" => false,
            "onclick" => false,
        ], $options);
        
        if($options_arr["onclick"]){ 
            $onclick = $options_arr["onclick"]; 
        }else{
            $onclick = "system.browser.redirect('$onclick');"; 
        }
        
        $icon = $options_arr["icon"] ? "<i class='fa {$options_arr["icon"]} margin-right-5' aria-hidden='true'></i>" : "";
        
        $this->menu_html[] = "<li class='list-group-item manage-link' onclick=\"$onclick\"><span>{$icon}{$label}</span></li>";
    }
    //--------------------------------------------------------------------------
    public function add_title($title, $info = "", $options = []){
        $options_arr = array_merge([
            "style" => false,
            "class" => false,
            "type" => 3,
        ], $options);
        $this->titel = "
            <div class='{$options_arr['class']}' style='{$options_arr['style']}'>
				<h{$options_arr['type']}>
					$title <small>$info</small>
				</h{$options_arr['type']}>
			</div>
        ";
    }
    //--------------------------------------------------------------------------
    public function display($lib_html = false) {
        $inner_html = $lib_html ? $lib_html : $this->view;
        $container = $this->container_fluid ? "container-fluid" : "container";
        $elements = implode("", $this->menu_html);
        
        echo "
            <style>
                .manage-link { $this->css_link }
                .manage-link:hover { $this->css_link_hover }
            </style>
            <div class='$container'>
                <div class='row'>
                    <div class='col-md-2'>
                        $this->titel
                        <ul class='list-group'>
                            $elements
                        </ul>
                    </div>
                    <div class='col-md-10'>
                        $inner_html
                    </div>
                </div>
            </div>
            ";
    }
    //--------------------------------------------------------------------------
}