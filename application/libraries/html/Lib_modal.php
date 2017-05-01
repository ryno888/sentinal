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
class Lib_modal extends Lib_html{
    
    private $html = "";
    private $id = false;
    private $title = false;
    private $heading = false;
    public $cancel_btn_label = "Cancel";
    public $ok_btn_label = "Ok";
    //--------------------------------------------------------------------------
    public function __construct($title, $id = false) {
        parent::__construct();
        $this->title = $title;
        $this->container_fluid = true;
        $this->id = $id ? $id: "model_".time();
    }
    //--------------------------------------------------------------------------
    public function header($label, $type = 1, $attributes_arr = []) {
        $attributes = array_merge([
            "container_fluid" => $this->container_fluid
        ], $attributes_arr);
        
        $this->heading = Lib_html_tags::header($label, $type, $attributes);
    }
    //--------------------------------------------------------------------------
    public function set_id($id) {
        $this->id = $id;
    }
    //--------------------------------------------------------------------------
    public function get_id() {
        return $this->id;
    }
    //--------------------------------------------------------------------------
    public function set_heading($heading) {
        $this->heading = $heading;
    }
    //--------------------------------------------------------------------------
    public function display($return = false) {
        $inner_html = parent::display(true);
        $html = "
            <div class='modal fade' id='$this->id' name='$this->id' tabindex='-1' role='dialog' aria-labelledby='$this->id' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>

                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='{$this->id}_Title'>$this->title</h4>
                        </div>

                        <div class='modal-body' id='{$this->id}_Body'>
                            $inner_html
                        </div>

                        <div class='modal-footer'>
                        </div>
                    </div>
                </div>
            </div>
        ";
        
        if($return){
            return $html;
        }
        
        echo $html;
    }
    //--------------------------------------------------------------------------
}
