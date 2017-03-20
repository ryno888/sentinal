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
class lib_html_tab extends lib_core{
    public $container_fluid = false;
    private $menu_html = [];
    private $body_html = [];
    private $view = false;
    private $titel = false;
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->ci->load->library("lib_html_tags");
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
            http_helper::go_404();
        }
    }
    //--------------------------------------------------------------------------
    public function add($mixed) {
        $this->menu_html[] = $mixed;
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
                <a href='#$id' id='$id-tab' role='tab' data-toggle='tab' aria-controls='$id' aria-expanded='true'>
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