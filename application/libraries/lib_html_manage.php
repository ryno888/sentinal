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
    public function add_button($label, $onclick, $options = []) {
        $options_arr = array_merge([
            "class" => "btn btn-default btn-sm btn-block"
        ], $options);
        
        $this->menu_html[] = lib_html_tags::button($label, $onclick, $options_arr);
    }
    //--------------------------------------------------------------------------
    private function get_elements_html() {
        $elements = false;
        
        foreach ($this->menu_html as $element) {
            $elements .= "
                <li class='list-group-item'>
                    $element
                </li>
            ";
        }
        
        return $elements;
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
        
        $elements = $this->get_elements_html();
        
        echo "
            <div class='container'>
                <div class='row'>
                    <div class='col-md-3'>
                        $this->titel
                        <ul class='list-group'>
                            $elements
                        </ul>
                    </div>
                    <div class='col-md-9'>
                        $inner_html
                    </div>
                </div>
            </div>
            ";
    }
    //--------------------------------------------------------------------------
}