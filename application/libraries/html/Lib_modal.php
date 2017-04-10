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
    private $heading = false;
    //--------------------------------------------------------------------------
    public function __construct() {
        parent::__construct();
        $this->container_fluid = true;
        $this->id = "model_".time();
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
        echo "
            <div class='modal fade' id='$this->id' name='$this->id' tabindex='-1' role='dialog' aria-labelledby='$this->id' aria-hidden='true'>
                <div class='modal-dialog'>
                    <div class='modal-content'>

                        <div class='modal-header'>
                            <button type='button' class='close' data-dismiss='modal' aria-hidden='true'>&times;</button>
                            <h4 class='modal-title' id='modalConfirmTitle'>Confirm Delete</h4>
                        </div>

                        <div class='modal-body' id='modalConfirmBody'>
                            $inner_html
                        </div>

                        <div class='modal-footer'>
                            <button type='button' class='btn btn-danger' id='modalConfirmCancelBtn' data-dismiss='modal'>Cancel</button>
                            <a class='btn btn-success' id='modalConfirmOkBtn'>Ok</a>
                        </div>
                    </div>
                </div>
            </div>
        ";
    }
    //--------------------------------------------------------------------------
}
