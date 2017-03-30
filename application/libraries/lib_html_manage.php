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
class Lib_html_manage extends Lib_core{
    public $container_fluid = false;
    private $menu_html = [];
    private $view = false;
    private $titel = false;
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("Lib_html_tags");
    }
    //--------------------------------------------------------------------------
    public function load_controller($controller, $method = 'index') {
        require_once(APPPATH . 'controllers/' . $controller . '.php');
        $controller = new $controller();

        return $controller->$method();
    }
    //--------------------------------------------------------------------------
    public function set_view($view, $data = false) {
        $CI_Controller = CI_Controller::get_instance();
        if (is_file(APPPATH . 'views/' . $view . ".php")) {
            $this->view = $CI_Controller->load->view($view, $data, true);
        } else {
            Http_helper::go_404();
        }
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
    public function display($Lib_html = false) {
        $inner_html = $Lib_html ? $Lib_html : $this->view;
        $container = $this->container_fluid ? "container-fluid" : "container";
        $elements = implode("", $this->menu_html);
        
        echo "
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